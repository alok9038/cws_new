<?php

use App\Models\Course;

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



?>
