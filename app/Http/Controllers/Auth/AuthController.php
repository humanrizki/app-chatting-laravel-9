<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest',['except'=>'logout']);
    }
    public function register(){
        return view('auth.register');
    }
    public function storeRegister(Request $request){
        $validator = Validator::make($request->all(),[
            'username'=>'required|alpha_dash|string|min:4|max:30',
            'name'=>'required|string|min:4|max:50',
            'email'=>'required|string|email:dns|unique:users',
            'password'=>'required|string|min:8|max:30',
        ])->validate();
        User::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        if(Auth::attempt(['email'=>$validator['email'], 'password'=>$validator['password']])){
            $request->session()->regenerate();
            return redirect('/auth/login');
        } else {
            return redirect('/auth/register');
        }
    }
    public function showLogin(){
        return view('auth.login');
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required',
            'password'=>'required'
        ])->validate();
        if(Auth::attempt($validator)){
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }
        return redirect('/auth/login')->with('loginError','Login failed!');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/auth/login');
    }
}
