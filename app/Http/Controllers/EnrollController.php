<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enroll;
use App\Models\Paytm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class EnrollController extends Controller
{
    public function viewEnroll(){
        $data['enrolls'] = Enroll::where([['user_id',Auth::id()],['status',false]])->get();
        return view('home.enroll',$data);
    }

    public function add(Request $request){

        if($request->course_id == null){
            return redirect()->back()->with('error_msg','something went wrong!');
        }

        $course_id = $request->course_id;

        $check = Enroll::where([['user_id',Auth::id()],['status','1']])->get();

        if(count($check) > 0 ){
            return redirect()->back()->with('error_msg','Already enrolled for '. $check[0]->course->title .', Complete it first!');
        }
        else{
            $check_enroll = Enroll::where([['course_id',$course_id],['user_id',Auth::id()]])->get();
            $check_cart = Enroll::where([['user_id',Auth::id()],['status',false]])->get();

            if(count($check_enroll) > 0 && $check_enroll[0]->status == 0){
                return redirect()->route('get.enroll')->with('error_msg','Course already for in your Cart!');
            }
            elseif(count($check_enroll) > 0){
                return redirect()->back()->with('success_msg','Course already enrolled!');
            }
            elseif(count($check_cart) !== 0){
                return redirect()->route('get.enroll')->with('success_msg',''. $check_cart[0]->course->title .' Course already in your cart!');
            }else{
                $enroll = new Enroll();
                $enroll->course_id = $course_id;
                $enroll->user_id = Auth::id();
                $enroll->save();

                return redirect()->route('get.enroll');
            }
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
        $enroll_id =  $getType[1];
        $amount=  $getType[2];

        $id = Crypt::encryptString($enroll_id.'_'.$amount);

        $enroll = Enroll::where('id',$enroll_id)->count();
        if($enroll > 0){
            if($payment_type == 'installment'){
                Enroll::where('id',$enroll_id)->update(['payment'=>'installment']);
                return redirect()->route('paytm.payment',['id'=>$id]);
            }
            elseif($payment_type == 'full'){
                Enroll::where('id',$enroll_id)->update(['payment'=>'full']);
                return redirect()->route('paytm.payment',['id'=>$id]);
            }
        }


    }

    public function payDues(Request $request){
        $user_id = Auth::id();
        $amount = $request->custom_payment;
        // $amount = 100;
        $enroll_id = $request->enroll_id;

        $id = Crypt::encryptString($enroll_id.'_'.$amount);

        $enroll = Enroll::where([['user_id',$user_id],['id',$enroll_id]])->get();

        $course_charge = $enroll[0]->course->discount_price;


        $payment = Paytm::where([['user_id',$user_id],['enroll_id',$enroll_id],['status',false]])->get();
        $total_pay = 0;
        foreach($payment as $p){
            $total_pay += $p->fee;
        }

        $dues = $course_charge - $total_pay;

        if(count($enroll) > 0){
            if($dues >= $amount){
                return redirect()->route('paytm.payment',['id'=>$id]);
            }
            else{
                return redirect()->back()->with('error_msg','This Amount is greater than your Dues amount!');
            }
        }
    }
}
