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

        $check = Enroll::where([['user_id',Auth::id()],['status',0]])->get();

        $count = Course::where('id',$course_id)->get();
        $user =  Auth::id();

        if($check->count() > 0){
            toast('Course Already in Your Cart!','info');
            return redirect()->route('get.enroll');
        }
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

        $enroll = Order::where([['user_id',$user_id],['id',$enroll_id]])->get();

        $cc = 0;
        foreach($enroll as $e)
        {
            foreach ($e->InCart as $enroll){
                $cc += $enroll->course->discount_price;
            }

            $tt = 0;
            foreach (pp($enroll->order_id) as $try) {
                $tt += $try->fee;
            }
        }

        $total_dues = $cc - $tt;

        // $total = Enroll::where([['user_id',Auth::id()],['status',true]])->get();
        // $payments = Paytm::where([['user_id',Auth::id()],['status',true],['workshop_id',null]])->get();

        // $total_amount =0;
        // foreach($total as $t){
        //     $total_amount += $t->course->discount_price;
        // }
        // $dues =0;
        // foreach($payments as $p){
        //     $dues += $p->fee;
        // }

        // $total_dues = $total_amount - $dues;

        // die;
        if($total_dues >= $amount){
            return redirect()->route('paytm.payment',['id'=>$id]);
        }
        else{
            toast('₹ .'.$amount.'. Amount Is Greater than Dues Amount!');
            return redirect()->back();
        }

    }
}
