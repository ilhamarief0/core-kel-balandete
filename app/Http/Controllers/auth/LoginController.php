<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        $title = "Login";
        return view('auth.login', compact('title'));
    }

    public function LoginAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            Session::flash('success', 'Successfully logged in');
            return redirect()->route('backend.dashboard.index')->with('loginSuccess', 'Berhasil Login!');
        }

    }
}
