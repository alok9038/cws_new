<?php

namespace App\Http\Controllers;

use App\Models\Enroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class EnrollController extends Controller
{
    public function viewEnroll(){
        $data['enrolls'] = Enroll::where('user_id',Auth::id())->get();
        return view('home.enroll',$data);
    }

    public function add(Request $request){

        if($request->course_id == null){
            return redirect()->back()->with('error_msg','something went wrong!');
        }

        $course_id = $request->course_id;

        $check_enroll = Enroll::where([['course_id',$course_id],['user_id',Auth::id()]])->get();

        if(count($check_enroll) > 0 && $check_enroll[0]->status == 0){
            return redirect()->route('get.enroll')->with('error_msg','Course already for in your Cart!');
        }
        elseif(count($check_enroll) > 0){
            return redirect()->back()->with('success_msg','Course already enrolled!');
        }else{
            $enroll = new Enroll();
            $enroll->course_id = $course_id;
            $enroll->user_id = Auth::id();
            $enroll->save();

            return redirect()->route('get.enroll');
        }
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
}
