<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function updateDetails(Request $request){
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'father_name'=>'required',
            'mother_name'=>'required',
        ]);

        $user = User::where('id',Auth::id())->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->contact = $request->phone;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->save();

        if($user){
            toast('Details Updated!','success');
            return redirect()->back();
        }else{
            toast('something went Wrong!','error');
            return redirect()->back();
        }
    }

    public function changePassword(Request $request){
        $request->validate([
            'current_password'=>'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error_msg', 'Current password does not match!');
        }

        $user =User::find(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();

        Alert::toast('Password Successfully updated!','success');
        return redirect()->back();

    }

    public function updateDp(Request $request){
        File::delete('images/students/'.Auth::user()->image);

        if($request->hasFile('image')){
            $image = time() . "." . $request->image->extension();
            $request->image->move(public_path("assets/images/students"),$image);

            $user = User::where('id',Auth::id())->first();
            $user->image = $image;
            $user->save();

            toast('Profile Image Updated','success');
        }
        else{
            toast('something went wrong!','error');
        }

        return redirect()->back();

    }
}
