<?php

namespace App\Http\Controllers;

use App\Mail\resetMail;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    // Login Form

    function login()
    {
        return view('login');
    }
    //Register Form

    function register()
    {
        return view('register');
    }
    // Store Users

    function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:10|min:3',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'required|min:6|max:13'
        ]);

        //Inserting a data

        $admins = new User();
        $admins->name = $request->name;
        $admins->email = $request->email;
        $admins->password = $request->password;
        $save = $admins->save();
        if ($save) {
            return back()->with('success', 'Hey You are Succesfully Registerd');
        } else {
            return back()->with('fail', 'Something went wrong...');
        }
    }
    // Check User Credentials and redirecting it to Welcome page

    function check(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:6|max:13|'
        ], [
            'email.exists' => 'This email is not registered! Click on create account'
        ]);
        $userinfo = Admin::where('email', '=', $request->email)->first();
        if (!$userinfo) {
            return back()->with('fail', 'Email does not exists');
        } else {
            if ($request->password == $userinfo->password) {
                $request->session()->put('LoggedUser', $userinfo->id);
                return redirect('welcome');
            } else {
                return back()->with('fail', 'Password Incorrect');
            }
        }
    }

    // Adding Logout Functionalities

    function logout()
    {
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect('/login');
        } else {
            return redirect('/login');
        }
    }

    // Dashboard Status
    function welcome()
    {
        $data = ['LoggedUserInfo' => Admin::where('id', '=', Session('LoggedUser'))->first()];
        return view('dashboard', $data);
    }

    // Forget Password

    function forgot()
    {
        return view('forgot-password');
    }
    //opening forget password edit page
    function updateForm($id)
    {
        $idd=Crypt::decryptString($id);
        $admin = Admin::find($idd);
        return view('reset-password', compact('admin'));
    }
    function update(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|max:13|same:confirm_password',
            'confirm_password' => 'required|min:6|max:13 ',
        ]);
        $admin = Admin::find($request->id);
        $admin->password = $request->password;
        $admin->save();
        return back()->with('reset', 'Your password has been succesfuly reset please login with new password');
    }
    function sendmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
        ], [
            'email.exists' => 'This email is not registered! Click on create account'
        ]);
        $email = $request->email;
        $userinfo = Admin::where('email', '=', $request->email)->first();
        $details = [
            'email' =>  $request->email,
            'id'    =>  Admin::where('email', $email)->pluck('id')->first(),
            'name'  =>  Admin::where('email', $email)->pluck('name')->first()
        ];
        //  return $details['udd'];
        if (!$userinfo) {
            return back()->with('fail', 'Email does not exists');
        } else {
            Mail::to($email)->send(new resetMail($details));
            return back()->with('message-sent', 'Your message has been sent');
        }
    }
}
