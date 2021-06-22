<?php

namespace App\Http\Controllers;

use App\Models\Enroll;
use Illuminate\Http\Request;
use App\Models\Paytm;
use Illuminate\Support\Facades\Auth;
use PaytmWallet;
use Illuminate\Support\Facades\Crypt;


class PaytmController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
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

            $enroll = Enroll::where([['user_id',Auth::id()],['id',$payment->enroll_id]])->first();
            $course_price = $enroll->course->discount_price;

            $pay_check = paid_amount($enroll->id);
            $total_pay = 0;

            foreach($pay_check as $pc){
                $total_pay += $pc->fee;
            }
            $total_pay;

            if($total_pay == $course_price){
                Enroll::where([['id',$enroll->id],['user_id',$user_id]])->update(['payment'=>'full','status'=>true]);
            }
            else{
                Enroll::where([['id',$payment->enroll_id],['user_id',$user_id]])->update(['status'=>true]);
            }

            return redirect()->route('homepage')->with('success_msg','Payment of '."$payment->fee".' is successfully done!');

        } else if ($transaction->isFailed()) {
            Paytm::where('order_id', $order_id)->update(['status' => 0, 'transaction_id' => $transaction->getTransactionId()]);
            return view('paytm-fail')->with('message', "Your payment is failed.");

        } else if ($transaction->isOpen()) {
            Paytm::where('order_id', $order_id)->update(['status' => 2, 'transaction_id' => $transaction->getTransactionId()]);
            return view('paytm-fail')->with('message', "Your payment is processing.");
        }
        $transaction->getResponseMessage(); //Get Response Message If Available

        // $transaction->getOrderId(); // Get order id
    }


    public function pay($id)
    {

        $o_id = Crypt::decryptString($id);

        $split = explode('_',$o_id);
        $enroll_id = $split[0];
        $amount = $split[1];
        $user_id = Auth::id();

        $userData = [
            'name' => Auth::user()->name, // Name of user
            'mobile' =>Auth::user()->contact, //Mobile number of user
            'email' => Auth::user()->email, //Email of user
            'fee' => $amount,
            'user_id'=>Auth::id(),
            'order_id' =>rand(1,999999), //Order id
            'enroll_id' =>$enroll_id //Order id
        ];

        Paytm::create($userData); // creates a new database record

        $payment = PaytmWallet::with('receive');

        $payment->prepare([
            'order' => $userData['order_id'],
            'user' => $user_id,
            'mobile_number' => $userData['mobile'],
            'email' => $userData['email'], // your user email address
            'amount' => $amount, // amount will be paid in INR.
            'callback_url' => route('paytm.callback') // callback URL
        ]);
        return $payment->receive();  // initiate a new payment
    }

    public function paytmPurchase()
    {
        return view('paytm');
    }
}

