<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'home']]);
        $this->middleware('auth', ['only' => ['logout', 'home']]);
    }
    
    /**
     * Show the login form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view("login");
    }
    
    /**
     * Authenticate the user
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
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
    
    public function home()
    {
        return view('home');
    }
    
    /**
     * Logout the user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
