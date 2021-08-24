<?php

use App\Models\Course;
use App\Models\Enroll;
use App\Models\Order;
use App\Models\Paytm;
use App\Models\SiteSetting;
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
        $payment = Paytm::where([['user_id',Auth::id()],['status',1]])->orderBy('id','desc')->get();
        return $payment;
    }
}
if(!function_exists('enrolled_course')){
    function enrolled_course($id){
        $enroll = Enroll::where([['user_id',Auth::id()],['id',$id]])->get();
        return $enroll;
    }
}

if(!function_exists('site')){
    function site(){
        $site = SiteSetting::first();
        return $site;
    }
}

if(!function_exists('check_enroll')){
    function check_enroll($course_id){
        $check_enroll = Enroll::where([['course_id',$course_id],['user_id',Auth::id()],['status',true]])->get();
        return $check_enroll;
    }
}

if(!function_exists('course_amount')){
    function course_amount($user_id){
        $enroll = Enroll::where([['user_id',$user_id],['status',1]])->get();
        return $enroll;
    }
}


if(!function_exists('dues_amount')){
    function dues_amount($id){
        $enroll =  Paytm::where([['user_id',$id],['status',true],['enroll_id','!=',null]])->get();
        return $enroll;
    }
}



if(!function_exists('pp')){
    function pp($id){
        $enroll =  Paytm::where([['user_id',Auth::id()],['status',true],['enroll_id',$id]])->get();

        return $enroll;
    }
}




?>
