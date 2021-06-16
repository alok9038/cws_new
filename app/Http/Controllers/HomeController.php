<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        return view('home.index');
    }
    public function viewCourse($slug, $id){
        $data['course'] = Course::where('id',$id)->first();
        return view('home.course',$data);
    }
}
