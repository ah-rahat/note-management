<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Note;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserAuthController extends Controller
{
    public function register()
    {
        return view('auth-user.register');
    }

    public function post_register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:10'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $checkSave = $user->save();

        if ($checkSave) {
            return back()->with('success', 'User registered successfully!!Log In please');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', '=', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('loginId', $user->id);
                return redirect()->route('user.dashboard');
            } else {
                return back()->with('fail', "Credentials does'nt match");
            }
        } else {
            return back()->with('fail', 'This email does not exist');
        }
    }

    public function dashboard()
    {
        if (session()->has('loginId')) {
            $data = User::where('id', '=', session()->get('loginId'))->first();
        }

        $noteDatas = Note::where('user_id', '=', session()->get('loginId'))->get();

        return view('dashboard', compact('data', 'noteDatas'));
    }

    public function logout()
    {
        if (session()->has('loginId')) {
            session()->pull('loginId');
            return Redirect::to('/');
        }
    }
}
