<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enroll;
use App\Models\Order;
use App\Models\Paytm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class EnrollController extends Controller
{
    public function viewEnroll(){
        // $data['enrolls'] = Enroll::where([['user_id',Auth::id()],['status',false]])->get();
        $data['enrolls'] = Order::where([['user_id',Auth::id()],['ordered',false]])->first();
        return view('home.enroll',$data);
    }

    public function add(Request $request){

        if($request->course_id == null){
            return redirect()->back()->with('error_msg','something went wrong!');
        }

        $course_id = $request->course_id;

        $check = Enroll::where([['user_id',Auth::id()],['status','1']])->get();

        $count = Course::where('id',$course_id)->get();
        $user =  Auth::id();

        if(count($count) > 0){
            $order = Order::where([['user_id',$user],['ordered',false]])->get();
            if(count($order) > 0){
                $enroll = new Enroll();
                $enroll->status = false;
                $enroll->user_id = $user;
                $enroll->order_id = $order[0]->id;
                $enroll->course_id = $course_id;
                $enroll->save();
            }
            else{
                $order = new Order;
                $order->ordered = false;
                $order->user_id = $user;
                $order->save();

                $last_id = $order->id;

                $cart = new Enroll();
                $cart->status = false;
                $cart->user_id = $user;
                $cart->order_id = $last_id;
                $cart->course_id = $course_id;
                $cart->save();
            }

            toast('Course Added to Cart!','success');
            return redirect()->route('get.enroll');
        }

    }

    public function dropEnroll(Request $request){
        $enroll_id = $request->enroll_id;

        Enroll::where('id',$enroll_id)->delete();

        return redirect()->back()->with('success_msg','Course Removed From your Cart!');
    }

    public function checkout(Request $request){
        $paymentType = $request->payment_type;
        $getType = explode('_',$paymentType);

        $payment_type =  $getType[0];
        $order_id =  $getType[1];
        $amount=  $getType[2] / 1884;

        $id = Crypt::encryptString($order_id.'_'.$amount);

        $enroll = Enroll::where('order_id',$order_id)->count();
        if($enroll > 0){
            if($payment_type == 'installment'){
                Enroll::where([['order_id',$order_id],['status',false]])->update(['payment'=>'installment']);
                Order::where([['id',$order_id],['ordered',false]])->update(['payment'=>'installment']);
                return redirect()->route('paytm.payment',['id'=>$id]);
            }
            elseif($payment_type == 'full'){
                Enroll::where([['order_id',$order_id],['status',false]])->update(['payment'=>'full']);
                Order::where([['id',$order_id],['ordered',false]])->update(['payment'=>'full']);
                return redirect()->route('paytm.payment',['id'=>$id]);
            }
            elseif($payment_type == 'monthly'){
                Enroll::where([['order_id',$order_id],['status',false]])->update(['payment'=>'monthly']);
                Order::where([['id',$order_id],['ordered',false]])->update(['payment'=>'monthly']);
                return redirect()->route('paytm.payment',['id'=>$id]);
            }
        }
        else{
            toast('Something Went Wrong','error');
        }


    }

    public function payDues(Request $request){
        $user_id = Auth::id();
        $amount = $request->custom_payment;
        // $amount = 100;
        $enroll_id = $request->enroll_id;

        $id = Crypt::encryptString($enroll_id.'_'.$amount);

        $enroll = Order::where([['user_id',$user_id],['id',$enroll_id]])->first();

        // $course_charge = $enroll[0]->course->discount_price;

        $course_charge = 0;
        foreach($enroll->InCart as $enroll){
            $course_charge += $enroll->course->discount_price;
        }

        $payment = Paytm::where([['user_id',$user_id],['enroll_id',$enroll_id],['status',false]])->get();
        $total_pay = 0;
        foreach($payment as $p){
            $total_pay += $p->fee;
        }

        $dues = $course_charge - $total_pay;

        // if(count($enroll->InCart) > 0){
            if($dues >= $amount){
                return redirect()->route('paytm.payment',['id'=>$id]);
            }
            else{
                return redirect()->back()->with('error_msg','This Amount is greater than your Dues amount!');
            }
        // }
    }
}
