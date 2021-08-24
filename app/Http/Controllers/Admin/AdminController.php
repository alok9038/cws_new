<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Back_due;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Order;
use App\Models\Paytm;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Queue\RedisQueue;
use Illuminate\Support\Facades\Auth;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function index(){
        if(Auth::user()->user_type !== 'admin'){
            return redirect()->route('login');
        }
        $data['course'] = Course::count();
        $data['users'] = User::where('user_type','!=','admin')->count();
        $data['payments'] = Paytm::where([['status',true],['enroll_id','!=',null]])->get();
        $data['get_payments'] = Paytm::where([['created_at','>=',Carbon::now()->subdays(30)],['status',1]])->orderBy('id','desc')->paginate(10);
        $data['dues'] = Enroll::where('status',1)->get();

        return view('admin.index',$data);
    }

    public function students(Request $request){
        $data['users'] = User::where('user_type','student')->get();

        return view('admin.users',$data);
    }

    public function deleteStudent(Request $request){
        $id = $request->user_id;

        $user = User::where('id',$id)->delete();
        if($user){
            toast('Student Successfully Removed!','success');
            return redirect()->back();
        }
        else{
            toast('Something went Wrong!','error');
            return redirect()->back();
        }
    }

    public function earning(){
        $data['get_payments'] = Paytm::where([['created_at','>=',Carbon::now()->subdays(30)],['status',1]])->orderBy('id','desc')->paginate(10);
        return view('admin.payments',$data);
    }

    public function duePayments(){
        $data['enrolls'] = Paytm::where('status',true)->orderBy('id','desc')->get();
        // die;
        return view('admin.due_payments',$data);
    }

    public function paymentSetting(){
        return view('admin.payment_setting');
    }

    public function paymentSettingStore(Request $request)
    {
        $input = $request->all();

        $env_keys_save = DotenvEditor::setKeys([
            'PAYTM_ENVIRONMENT' => $input['PAYTM_ENVIRONMENT'],
            'PAYTM_MERCHANT_ID' => $input['PAYTM_MERCHANT_ID'],
            'PAYTM_MERCHANT_KEY' => $input['PAYTM_MERCHANT_KEY'],
        ]);

        $env_keys_save->save();

        Alert::toast('Paytm settings has been updated !','success');
        return redirect()->back();
    }

    public function backDues(){
        $data['dues'] = Back_due::orderBy('id','desc')->get();
        return view('admin.back_dues',$data);
    }

    public function backDuesStatus(Request $request){
        $id = $request->dues_id;

        $query = Back_due::where('id',$id)->first();

        if($query->status == 0){
            Back_due::where('id',$id)->update(['status'=>1]);
            toast('Dues Paid!','success');
        }
        else{
            Back_due::where('id',$id)->update(['status'=>0]);
            toast('Dues Unpaid!','success');
        }

        return redirect()->back();
    }

    public function updateDuesAmount(Request $request)
    {
        $id = $request->dues_id;

        $query = Back_due::where('id',$id)->update(['amount'=>$request->amount]);

        if($query){
            toast('Amount updated!','success');
        }
        else{
            toast('Amount updated!','success');
        }

        return redirect()->back();
    }
}
