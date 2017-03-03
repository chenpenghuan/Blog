<?php

namespace App\Http\Controllers;

use App\Http\Models\Articles;
use App\Http\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexController extends CommenController
{
    private $tmp;
    public function index()
    {
        $articles = Articles::where('status', '=', 1)->where('recommend', '=', 1)->get(['id', 'title', 'abstract', 'updated_at']);
        return view('Index/index', ['articles' => $articles]);
    }

    public function userinfo()
    {
        return view('Index/userinfo');
    }

    public function list(Request $request)
    {
        if ($request->has(['type', 'firid']) && in_array($request->input('type'), ['1', '2']) && is_numeric($request->input('firid'))) {
            $articles = Articles::where('status', '=', 1)->where('item_fir', '=', $request->input('firid'));
            if ($request->has('secid') && is_numeric($request->input('secid'))) {
                $articles = $articles->where('item_sec', '=', $request->input('secid'));
            } else {
                $articles = $articles->where('item_sec', '=', null);
            }
        } else {
            return view('Index.error');
        }
        $articles = $articles->get(['id', 'title', 'abstract', 'updated_at']);
        return view('Index.list', ['articles' => $articles]);
    }

    public function show(Request $request)
    {
        if ($request->has('id') && is_numeric($request->input('id'))) {
            $article = Articles::where('id', '=', $request->input('id'))->first(['id', 'body', 'updated_at']);
            $this->getRepliesBack();
            $replies=$this->tmp;
            $indexs=[];
            foreach ($replies as $index => $reply){
                if($reply['reply_id']==null){
                    $indexs[]=$index;     //所有父级评论的ID
                }
            }
            $indexs[]=count($replies);
            return view('Index.show', ['article' => $article, 'replies' => $replies,'indexs'=>$indexs]);
        } else {
            return view('Index.error');
        }
    }


    //根据评论ID取回复数据
    private function getRepliesBack($reply_id=null)
    {
        $tmp = Reply::where('reply_id', '=', $reply_id)->where('status', '=', 1)->get(['id', 'reply_id','nickname','cont','created_at'])->toArray();
        foreach ($tmp as $v){
            $this->tmp[] = $v;
            $this->getRepliesBack($reply_id =$v['id']);
        }
    }
}
