<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login()
    {
        return view("login");
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt(["username" => $request->username, "password" => $request->password]))
        {
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors(["error" => "The provided credentials are incorrect."]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
