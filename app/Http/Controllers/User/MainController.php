<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Back_due;
use App\Models\Enroll;
use App\Models\Order;
use App\Models\Paytm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function index(){
        $data['enrolls'] = Order::where([['user_id',Auth::id()],['ordered',true]])->get();
        $data['total_amounts'] = Enroll::where([['user_id',Auth::id()],['status',true]])->get();
        $data['payments'] = Paytm::where([['user_id',Auth::id()],['status',true],['enroll_id','!=',null]])->get();
        $data['back_dues'] = Back_due::where([['user_id',Auth::id()],['status',false]])->first();
        return view('user.index',$data);
    }

    public function course(){
        // $data['enrolls'] = Enroll::where([['user_id',Auth::id()],['status',true]])->get();
        $data['enrolls'] = Order::where([['user_id',Auth::id()],['ordered',true]])->get();

        return view('user.myCourse',$data);
    }

    public function payment(){
        $data['payments'] = Paytm::where([['user_id',Auth::id()],['status',true]])->orderBy('id','desc')->paginate(10);
        return view('user.payments',$data);
    }
    public function paymentRecords($slug, $id){
        $e_id =  Crypt::decrypt($id);
        $data['payments'] = Paytm::where([['user_id',Auth::id()],['enroll_id',$e_id]])->orderBy('id','desc')->paginate(10);
        return view('user.paymentRecord',$data);
    }
    public function setting(){
        return view('user.setting');
    }

    public function changePassword(Request $request){
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
        ]);

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->oldpassword , $hashedPassword )) {

             if (!Hash::check($request->newpassword , $hashedPassword)) {

                $users =User::find(Auth::user()->id);
                $users->password = bcrypt($request->newpassword);
                User::where( 'id' , Auth::user()->id)->update( array( 'password' =>  $users->password));

                return redirect()->back()->with('success_msg','Password successfully updated!');
            }
            else{
                return redirect()->back()->with('success_msg','new password can not be the old password!');
            }
        }
        else{
            return redirect()->back()->with('error_msg','old password does not matched!');
        }

    }

}
