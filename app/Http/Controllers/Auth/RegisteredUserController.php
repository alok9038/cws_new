<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Back_due;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'gender'=>'required',
            'dob'=>'required',
            'address'=>'required',
            'contact' => 'required|size:10',
            'image' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $image = time() . "." . $request->image->extension();
        $request->image->move(public_path("assets/images/students"),$image);

        $user = User::create([
            'name' => $request->name,
            'mother_name' => $request->mother_name,
            'father_name' => $request->father_name,
            'education' => $request->education,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'address' => $request->address,
            'contact' => $request->contact,
            'email' => $request->email,
            'image' => $image,
            'password' => Hash::make($request->password),
        ]);

        $due = new Back_due();
        $due->user_id = $user->id;
        $due->amount = 700;
        $due->status = false;
        $due->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
