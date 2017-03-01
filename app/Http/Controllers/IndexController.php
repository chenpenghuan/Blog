<?php

namespace App\Http\Controllers;

use App\Http\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexController extends CommenController
{
    public function index(){
        $articles=Articles::where('status','=',1)->where('recommend','=',1)->get(['id','title','abstract','updated_at']);
        return view('Index/index',['articles'=>$articles]);
    }
    public function userinfo(){
        return view('Index/userinfo');
    }
    public function list(Request $request){
        if($request->has(['type','firid']) && in_array($request->input('type'),['1','2']) && is_numeric($request->input('firid'))){
            $articles=Articles::where('status','=',1)->where('item_fir','=',$request->input('firid'));
            if($request->has('secid') && is_numeric($request->input('secid'))){
                $articles=$articles->where('item_sec','=',$request->input('secid'));
            }else{
                $articles=$articles->where('item_sec','=',null);
            }
        }else{
            return view('Index.error');
        }
        $articles=$articles->get(['id','title','abstract','updated_at']);
        return view('Index.list',['articles'=>$articles]);
    }
    public function show(Request $request){
        if($request->has('id') && is_numeric($request->input('id'))){
            $article=Articles::where('id','=',$request->input('id'))->first(['body','updated_at']);
            return view('Index.show',['article'=>$article]);
        }else{
            return view('Index.error');
        }
    }
    public function setsession(Request $request){
        Session::put('key1','value1');
    }
    public function getsession(Request $request){
        p(Session::get('key1'));
        p(Session::getId());
        //69Z7Un4Rw4gCUQTfLKe78CG1yltzUxnjX5YJg6ty
    }
}
