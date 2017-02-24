<?php

namespace App\Http\Controllers;

use App\Http\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ArticlesController extends CommenController
{
    public function list(){
        $articles=Articles::where('status','=',1)->get(array_keys(Articles::$labelDict));
        return view('Article.list',['articles'=>$articles]);
    }
    public function edit(Request $request){
        $article=Articles::where('id','=',$request->input('id'))->first();
        return view('Article.edit',['article'=>$article]);
    }
    public function saveedit(Request $request){
        $this->validate($request, ['title' => 'required|min:6|max:100', 'abstract' => 'required|min:6|max:100','body'=>'required|min:6'], ['required' => ':attribute 不能为空', 'min' => ':attribute 不能少于6个字符', 'max' => ':attribute 不能大于100个字符'], ['title' => '标题', 'abstract' => '摘要','body'=>'内容']);
        if(is_numeric($request->input('id'))){
            $write=Articles::where('id','=',$request->input('id'))->update(['title'=>$request->input('title'),'abstract'=>$request->input('abstract'),'item_fir'=>$request->input('item1_id'),'item_sec'=>$request->input('item2_id'),'body'=>$request->input('body'),'recommend'=>$request->input('recommend')]);
        }
        if ($write != null) {
            if ((is_numeric($write) && $write == 1) || $write->exists == true) {
                return back()->with('msg',Config::get('options.EditSucceed.Articles'));
            } else {
                return back()->with('msg',Config::get('options.EditFailed.Articles'));
            }
        }else{
            return back()->with('msg',Config::get('options.DataError'));
        }
    }
    public function create(Request $request){
        return view('Article.create');
    }
    public function savecreate(Request $request){
        $this->validate($request, ['title' => 'required|min:6|max:100', 'abstract' => 'required|min:6|max:100','body'=>'required|min:6'], ['required' => ':attribute 不能为空', 'min' => ':attribute 不能少于6个字符', 'max' => ':attribute 不能大于100个字符'], ['title' => '标题', 'abstract' => '摘要','body'=>'内容']);
        $write=null;
        $write=Articles::create(['title'=>$request->input('title'),'abstract'=>$request->input('abstract'),'item_fir'=>$request->input('item1_id'),'item_sec'=>$request->input('item2_id'),'body'=>$request->input('body'),'recommend'=>$request->input('recommend')]);
        if ($write != null) {
            if ((is_numeric($write) && $write == 1) || $write->exists == true) {
                return back()->with('msg',Config::get('options.CreateSucceed.Articles'));
            } else {
                return back()->with('msg',Config::get('options.CreateFailed.Articles'));
            }
        }else{
            return back()->with('msg',Config::get('options.DataError'));
        }
    }
    public function delete(Request $request){
        $write=null;
        if(is_numeric($request->input('id'))){
            $write=Articles::where('id','=',$request->input('id'))->update(['status'=>0]);
        }
        if ($write != null) {
            if ((is_numeric($write) && $write == 1) || $write->exists == true) {
                return back()->with('msg',Config::get('options.DeleteSucceed.Articles'));
            } else {
                return back()->with('msg',Config::get('options.DeleteFailed.Articles'));
            }
        }else{
            return back()->with('msg',Config::get('options.DataError'));
        }
    }
}
