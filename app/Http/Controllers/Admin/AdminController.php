<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        if(Auth::user()->user_type !== 'admin'){
            return redirect()->route('login');
        }
        $data['course'] = Course::count();
        return view('admin.index',$data);
    }
}
