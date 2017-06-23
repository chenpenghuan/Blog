<?php

namespace App\Http\Controllers;

use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class AdminController extends CommenController
{
    public function captcha($tmp=null){
        $builder=new CaptchaBuilder();
        $builder->build();
        $phrase = $builder->getPhrase();
        Session::flash('milkcaptcha', $phrase);
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }
    public function login(Request $request){
        if($request->isMethod('post') && $request->has(['username','password','captcha'])){
            if ($request->get('captcha')!=Session::get('milkcaptcha')){
                return back()->with('msg',Config::get('options.CaptchaError'));
            }
            if($request->input('username')==Config::get('options.UserName') && md5('cphCPH123'.md5($request->input('password')))==Config::get('options.PassWord')){
                Session::put('username',Config::get('options.UserName'));
                //return view('back');
                return redirect('items/list')->with('msg',Config::get('options.LoginSuccess'));
            }else{
                return back()->with('msg',Config::get('options.LoginError'));
            }
        }
        Session::forget('username');
        return view('Admin.login');
    }
    public function logout(){
        if (Session::has('username') && Session::get('username')!=null){
            Session::put('username',null);
            $msg='成功退出';
        }else{
            $msg='您当前并未登陆';
        }
        return redirect('admin/login')->with('msg',$msg);
    }
}
