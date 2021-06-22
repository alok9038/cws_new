<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    public function home(){
        return view('home.index');
    }
    public function viewCourse($slug, $id){
        $c_id =  Crypt::decrypt($id);
        $data['course'] = Course::where('id',$c_id)->first();
        return view('home.course',$data);
    }

    public function forgotPassword(){
        return view('home.forgot_password');
    }
}
