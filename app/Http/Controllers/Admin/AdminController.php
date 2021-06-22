<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Paytm;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        if(Auth::user()->user_type !== 'admin'){
            return redirect()->route('login');
        }
        $data['course'] = Course::count();
        $data['users'] = User::where('user_type','!=','admin')->count();
        $data['payments'] = Paytm::where('status','1')->get();
        $data['get_payments'] = Paytm::where([['created_at','>=',Carbon::now()->subdays(30)],['status',1]])->orderBy('id','desc')->paginate(10);
        $data['dues'] = Enroll::where([['payment','installment'],['status',1]])->get();

        return view('admin.index',$data);
    }

    public function students(Request $request){
        if($request->gender !== null && $request->gender == 'all'){
            $data['users'] = User::where('user_type','!=','admin')->paginate(10);
        }
        elseif($request->gender !== null ){
            $data['users'] = User::where([['gender',$request->gender],['user_type','student']])->paginate(10);
        }
        else{
            $data['users'] = User::where('user_type','student')->paginate(10);
        }

        return view('admin.users',$data);
    }

    public function earning(){
        $data['get_payments'] = Paytm::where([['created_at','>=',Carbon::now()->subdays(30)],['status',1]])->orderBy('id','desc')->paginate(10);
        return view('admin.payments',$data);
    }

    public function duePayments(){
        $data['enrolls'] = Enroll::where([['status',true],['payment','installment']])->get();
        return view('admin.due_payments',$data);
    }
}
