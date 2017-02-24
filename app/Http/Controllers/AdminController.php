<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class AdminController extends CommenController
{
    public function login(Request $request){
        if($request->isMethod('post') && $request->has(['username','password'])){
            if($request->input('username')==Config::get('options.UserName') && $request->input('password')==Config::get('options.PassWord')){
                Session::put('username',Config::get('options.UserName'));
                return view('back');
            }else{
                return back()->with('msg',Config::get('options.LoginError'));
            }
        }
        return view('Admin.login');
    }
    public function logout(){
        Session::put('username',null);
        return view('Admin.login');
    }
}
