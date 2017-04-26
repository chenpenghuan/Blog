<?php

namespace App\Http\Controllers;

use App\Http\Models\Reply;
use App\Http\Models\Articles;
use App\Http\Models\Items1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CommenController;

class IndexController extends CommenController
{
    /**
     * 首页
     * @return void
     */
    public function index()
    {
        $articles = Articles::where('status', '=', 1)->where('recommend', '=', 1)->get(['id', 'title', 'abstract', 'updated_at']);
        return view('Index/index', ['articles' => $articles]);
    }

    public function userinfo()
    {
        return Response::view('Index/userinfo')->setCache(array('public' => 1));
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
            return Response::view('Index.error')->setCache(array('public' => 1));
        }
        $articles = $articles->get(['id', 'title', 'abstract', 'updated_at']);
        return view('Index.list', ['articles' => $articles]);
    }

    public function show(Request $request)
    {
        if ($request->has('id') && is_numeric($request->input('id'))) {
            $article = Articles::where('id', '=', $request->input('id'))->where('status', '=', 1)->first(['id', 'body', 'updated_at']);
            if(!empty($article)){
                return view('Index.show', ['article' => $article, 'replies' => $this->getReplies($article_id = $request->input('id'))]);
            }
        }
        return view('Index.error');
    }


    /**
     * 根据文章ID获取所有评论
     * @param int $article_id
     * @return array
     */
    public function getReplies($article_id = 1)
    {
        //查出所有的回复
        $result = [];
        $replies = Reply::where('article_id', '=', $article_id)->where('status', '=', 1)->get(['id'])->toArray();
        foreach ($replies as $reply) {
            $tmp = $this->getParents($reply['id'], $reply['id']);
            foreach ($tmp as $k => $v) {
                //var_dump($v);
                sort($v);
                $result[$k] = $v;
            }
        }
        return $result;
        //var_dump($this->getParents(7,7));
    }

    public function getParents($childId, $id, &$result = [])
    {//根据当前评论id递归获取所有父级评论id
        $parent = Reply::where('id', '=', $id)->where('status', '=', 1)->first(['reply_id']);
        if ($parent != null) {
            $parent = $parent->toArray();
        }
        if (empty($parent) == false) {//如果父级回复不为空
            if (empty($result) || (!isset($result[$childId]))) {//如果没有父级评论，或者最子评论不在数组中，则初始化数组并加入父级评论
                $result[$childId] = [];
            }
            if ($parent['reply_id'] != null) {
                $result[$childId][] = intval($parent['reply_id']);
            }
            $this->getParents($childId, $parent['reply_id'], $result);
        }
        return $result;
    }
}