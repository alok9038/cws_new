<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function home(){
        $mytime = Carbon::now();
        $last_date = $mytime->toDateString();
        $data['workshops'] =  Workshop::where([['last_date','>=',$last_date],['created_at','<=',$mytime]])->get();
        return view('home.index',$data);
    }
    public function viewCourse($slug){
        // $c_id =  Crypt::decrypt($id);
        $data['course'] = Course::where('slug',$slug)->first();
        return view('home.course',$data);
    }

    public function forgotPassword(){
        return view('home.forgot_password');
    }
}
