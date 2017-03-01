<?php

namespace App\Http\Controllers;

use App\Http\Models\Reply;
use App\Http\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ReplyController extends CommenController
{
    public function list(Request $request){
        if ($request->has(['article_id','status']) || is_numeric($request->input('article_id')) || in_array($request->input('status'),['0','1'])){
            $replies=Reply::where('article_id','=',$request->input('article_id'))->where('status','=',$request->input('status'))->get(['id','article_id','aim_id','cont','created_at','updated_at','status']);
            return view('Reply.list',['replies'=>$replies]);
        }
    }

    public function add(Request $request){
    }

    public function manage(Request $request){
        $this->validate($request,['act'=>'required|in:delete,pass,unpass','id'=>'required|integer'],['required'=>':attribute 不能为空','in'=>':attribute 不合法','integer'=>':attribute 必须为正整数'],['act'=>'参数act','id'=>'参数id']);
        $write=null;
        $db=Reply::where('id','=',$request->input('id'));
        //各参数值对应status值
        $dic=['delete'=>2,'pass'=>1,'unpass'=>0];
        $write=$db->update(['status'=>$dic[$request->input('act')]]);
        if ($write != null) {
            if ((is_numeric($write) && $write == 1) || $write->exists == true) {
                //删除评论
                return back()->with('msg',$request->input('act')=='delete'?Config::get('options.DeleteSucceed.Replies'):Config::get('options.PassSucceed.Replies'));
            } else {
                //审核评论
                return back()->with('msg',$request->input('act')=='delete'?Config::get('options.DeleteFailed.Replies'):Config::get('options.PassFailed.Replies'));
            }
        }else{
            return back()->with('msg',Config::get('options.DataError'));
        }
    }
}
