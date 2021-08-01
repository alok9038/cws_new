<?php

namespace App\Http\Controllers;

use Anand\LaravelPaytmWallet\Facades\PaytmWallet;
use App\Models\Paytm;
use App\Models\Workshop;
use App\Models\WorkshopEnroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class WorkshopController extends Controller
{
    public function index(){
        $data['workshops'] = Workshop::orderBy('id','desc')->get();
        return view('admin.workshop',$data);
    }

    public function create(){
        return view('admin.add_workshop');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'event_date' => 'required',
            'event_time' => 'required',
            'last_date' => 'required',
            'fee' => 'required',
        ]);


        $workshop = new Workshop();
        $workshop->title = $request->title;
        $workshop->event_date = $request->event_date;
        $workshop->time = $request->event_time;
        $workshop->last_date = $request->last_date;
        $workshop->fee = $request->fee;
        if($request->has('image')){
            $image = time() . "." . $request->image->extension();
            $request->image->move(public_path("assets/images/workshop"),$image);
            $workshop->image = $image;
        }
        $workshop->description = $request->description;
        $workshop->save();

        toast('Workshop Has been Added!','success');
        return redirect()->route('admin.workshop.view');
    }

    public function edit(Request $request){
        $request->validate([
            'title' => 'required',
            'event_date' => 'required',
            'event_time' => 'required',
            'last_date' => 'required',
            'fee' => 'required',
        ]);

        $workshop = Workshop::where('id',$request->workshop_id)->first();
        $workshop->title = $request->title;
        $workshop->event_date = $request->event_date;
        $workshop->time = $request->event_time;
        $workshop->last_date = $request->last_date;
        $workshop->fee = $request->fee;
        $workshop->description = $request->description;
        if($request->has('image')){
            $image = time() . "." . $request->image->extension();
            $request->image->move(public_path("assets/images/workshop"),$image);
            $workshop->image = $image;
        }
        $workshop->save();

        toast('Workshop Has been Updated!','success');
        return redirect()->route('admin.workshop.view');
    }

    public function delete(Request $request){
        $id = $request->workshop_id;

        $query = Workshop::where('id',$id)->delete();
        if($query){
            toast('Workshop Has been Deleted!','success');
            return redirect()->route('admin.workshop.view');
        }
        else{
            toast('Something Went Wrong!','error');
            return redirect()->route('admin.workshop.view');
        }
    }

    public function pay(Request $request)
    {

        $id = $request->workshop_id;
        $amount = $request->amount;
        $user_id = Auth::id();

        $userData = [
            'name' => Auth::user()->name, // Name of user
            'mobile' =>Auth::user()->contact, //Mobile number of user
            'email' => Auth::user()->email, //Email of user
            'fee' => $amount,
            'user_id'=>Auth::id(),
            'order_id' =>Auth::user()->name.'_'.rand(1,999999), //Order id
            'workshop_id' =>$id //Order id
        ];

        Paytm::create($userData); // creates a new database record

        $payment = PaytmWallet::with('receive');

        $payment->prepare([
            'order' => $userData['order_id'],
            'user' => $user_id,
            'mobile_number' => $userData['mobile'],
            'email' => $userData['email'], // your user email address
            'amount' => $amount, // amount will be paid in INR.
            'callback_url' => route('workshop.paytm.callback') // callback URL
        ]);
        return $payment->receive();  // initiate a new payment
    }

    public function paytmcallback()
    {
        $user_id  = Auth::id();
        $transaction = PaytmWallet::with('receive');

        $response = $transaction->response();

        $order_id = $transaction->getOrderId(); // return a order id
        $transaction->getTransactionId(); // return a transaction id

        if ($transaction->isSuccessful()) {
            Paytm::where([['order_id', $order_id],['user_id',$user_id]])->update(['status' => 1, 'transaction_id' => $transaction->getTransactionId()]);
            $payment = Paytm::where('order_id',$order_id)->first();

            $w = new WorkshopEnroll();
            $w->user_id = Auth::id();
            $w->payment_id = $payment->id;
            $w->workshop_id = $payment->workshop_id;
            $w->save();

            toast('Payment of '."$payment->fee".' is successfully Done!','success');
            return redirect()->route('homepage');

        } else if ($transaction->isFailed()) {
            $payment = Paytm::where([['order_id', $order_id],['user_id',$user_id]])->update(['status' => 0, 'transaction_id' => $transaction->getTransactionId()]);

            toast('Your payment  of '."$payment->fee".' is not Done!','error');
            return redirect()->route('homepage');

        } else if ($transaction->isOpen()) {
            Paytm::where('order_id', $order_id)->update(['status' => 2, 'transaction_id' => $transaction->getTransactionId()]);
            toast("Your payment is processing.",'error');
            return redirect()->route('homepage');

        }
        $transaction->getResponseMessage(); //Get Response Message If Available

        // $transaction->getOrderId(); // Get order id
    }
}
