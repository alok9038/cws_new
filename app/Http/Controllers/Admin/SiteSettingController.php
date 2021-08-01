<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rules;

class SiteSettingController extends Controller
{
    public function viewSetting(){
        return view('admin.setting');
    }

    public function logo(Request $request){
        $logo = SiteSetting::first();

        if($logo->logo !== null){
            File::delete("storage/logo/".$logo->image);
        }

        $logo = time(). "." . $request->logo->extension();
        $request->logo->move(public_path("storage/logo"),$logo);

        SiteSetting::first()->update([
            'logo'=>$logo
        ]);

        return redirect()->back()->with('success_msg','Logo successfully Changed!');
    }

    public function updateFavicon(Request $request){
        $logo = SiteSetting::first();

        if($logo->favicon !== null){
            File::delete("storage/favicon/".$logo->image);
        }

        $logo = time(). "." . $request->favicon->extension();
        $request->favicon->move(public_path("storage/favicon"),$logo);

        SiteSetting::first()->update([
            'favicon'=>$logo
        ]);

        return redirect()->back()->with('success_msg','Favicon successfully Changed!');

    }

    public function updateAdminDetails(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
        ]);

        $user = User::where([['id',Auth::id()],['user_type','admin']])->update([
            'name'=>$request->name,
            'email'=>$request->email
        ]);

        if($user){
            Alert::toast('Details Successfully Updated!','success');
            return redirect()->back();

        }else{
            Alert::toast('Something Went Wrong!','error');
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

    public function updateDetails(Request $request){
        $request->validate([
            'contact'=>'required|size:10',
            'address'=>'required',
            'about_us'=>'required',
            'facebook'=>'required',
            'twitter'=>'required',
            'linkedin'=>'required',
            'google'=>'required',
        ]);

        SiteSetting::first()->update([
            'contact'=>$request->contact,
            'address'=>$request->address,
            'about_us'=>$request->about_us,
            'facebook'=>$request->facebook,
            'twitter'=>$request->twitter,
            'linkedin'=>$request->linkedin,
            'google'=>$request->google,
        ]);

        Alert::toast('Site Details Successfully Updated!','success');
        return redirect()->back();
    }
}
