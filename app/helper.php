<?php

use App\Models\Course;
use App\Models\Enroll;
use App\Models\Paytm;
use Illuminate\Support\Facades\Auth;

if(!function_exists('featured_course')){
    function featured_course(){
        $course = Course::where('featured','yes')->orderBy('id','desc')->get();

        return $course;
    }
}
if(!function_exists('footer_featured_course')){
    function footer_featured_course(){
        $course = Course::where('featured','yes')->orderBy('id','desc')->limit(4)->get();
        return $course;
    }
}

if(!function_exists('courses')){
    function courses(){
        $courses = Course::inRandomOrder()->get();

        return $courses;
    }
}
if(!function_exists('related_course')){
    function related_course($id){
        $courses = Course::where('id','!=',$id)->inRandomOrder()->limit(4)->get();
        return $courses;
    }
}
if(!function_exists('paid_amount')){
    function paid_amount($id){
        $payment = Paytm::where([['enroll_id',$id],['user_id',Auth::id()],['status',true]])->get();
        return $payment;
    }
}
if(!function_exists('payments')){
    function payments(){
        $payment = Paytm::where('user_id',Auth::id())->orderBy('id','desc')->get();
        return $payment;
    }
}
if(!function_exists('enrolled_course')){
    function enrolled_course($id){
        $enroll = Enroll::where([['user_id',Auth::id()],['id',$id]])->get();
        return $enroll;
    }
}



?>
