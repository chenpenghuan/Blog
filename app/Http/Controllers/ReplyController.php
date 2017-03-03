<?php

namespace App\Http\Controllers;

use App\Http\Models\Reply;
use App\Http\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class ReplyController extends CommenController
{
    private $email;

    public function list(Request $request)
    {
        if ($request->has(['article_id', 'status']) || is_numeric($request->input('article_id')) || in_array($request->input('status'), ['0', '1'])) {
            $replies = Reply::where('article_id', '=', $request->input('article_id'))->where('status', '=', $request->input('status'))->get(['id', 'article_id', 'reply_id', 'cont', 'created_at', 'updated_at', 'status']);
            return view('Reply.list', ['replies' => $replies]);
        }
    }

    public function add(Request $request)
    {
        $this->validate($request, ['nickname' => 'required|min:3|max:20', 'email' => 'required|email', 'cont' => 'required|max:1000'], ['required' => ':attribute 不能为空', 'min' => ':attribute 至少 :min 位', 'max' => ':attribute 最多 :max 位', 'email' => '请填写正确的邮箱地址'], ['nickname' => '昵称', 'cont' => '评论内容']);
        //email在没激活的状态下是否已有评论
        $notActive = Reply::where('status', '=', 3)->where('email', '=', $request->input('email'))->first(['id', 'updated_at']);
        if ($notActive != null) {
            $notActive = $notActive->toArray();
            //邮箱在没激活状态下已有评论且评论时间超过24小时，则更新上次评论
            if (time() - strtotime($notActive['updated_at']) > Config::get('options.EmailActiveUntil')) {
                $exist = true;  //确实存在已经过期的评论
            } else {
                return back()->with('msg', Config::get('options.EmailNotActive'));
            }
        }

        //email有没有评论记录
        $email_once = Reply::where('status', '!=', 3)->where('email', '=', $request->input('email'))->first();
        if ($email_once == null) {
            //邮箱没有评论记录
            $status = 3;
            $token = $this->getToken(16);
        } else {
            $status = 0;
            $token = null;
        }
        if($request->input('reply_id')==null){  //文章评论
            $data = ['article_id' => $request->input('id'), 'nickname' => $request->input('nickname'), 'email' => $request->input('email'), 'cont' => $request->input('cont'), 'status' => $status, 'token' => $token];
        }else{      //回复评论
            $data = ['article_id' => $request->input('id'), 'nickname' => $request->input('nickname'), 'email' => $request->input('email'), 'cont' => $request->input('cont'), 'status' => $status, 'token' => $token,'type'=>2,'reply_id'=>$request->input('reply_id')];
        }
        $write = null;
        if (isset($exist) && $exist == true) {
            $write = Reply::where('id', '=', $notActive['id'])->update($data);
        } else {
            $write = Reply::create($data);
        }
        if ($write != null) {
            if ((is_numeric($write) && $write == 1) || $write->exists == true) {
                //评论写入成功
                if ($status == 3) {     //邮箱没有评论记录
                    $this->email = $request->input('email');
                    Mail::send('Mail.mail', ['token' => $token, 'email' => $request->input('email')], function ($message) {
                        $message->subject('激活邮箱');
                        $message->to($this->email);
                    });
                    return back()->with('msg',Config::get('options.EmailNotExist'));
                } else {      //邮箱有评论记录
                    return back()->with('msg', Config::get('options.EmailExist'));
                }
            } else {
                //评论写入失败
                return back()->with('msg', Config::get('options.DataError'));
            }
        } else {
            return back()->with('msg', Config::get('options.DataError'));
        }
    }

    public function manage(Request $request)
    {
        $this->validate($request, ['act' => 'required|in:delete,pass,unpass', 'id' => 'required|integer'], ['required' => ':attribute 不能为空', 'in' => ':attribute 不合法', 'integer' => ':attribute 必须为正整数'], ['act' => '参数act', 'id' => '参数id']);
        $write = null;
        $db = Reply::where('id', '=', $request->input('id'));
        //各参数值对应status值
        $dic = ['delete' => 2, 'pass' => 1, 'unpass' => 0];
        $write = $db->update(['status' => $dic[$request->input('act')]]);
        if ($write != null) {
            if ((is_numeric($write) && $write == 1) || $write->exists == true) {
                //删除评论
                return back()->with('msg', $request->input('act') == 'delete' ? Config::get('options.DeleteSucceed.Replies') : Config::get('options.PassSucceed.Replies'));
            } else {
                //审核评论
                return back()->with('msg', $request->input('act') == 'delete' ? Config::get('options.DeleteFailed.Replies') : Config::get('options.PassFailed.Replies'));
            }
        } else {
            return back()->with('msg', Config::get('options.DataError'));
        }
    }

    public function emailactive(Request $request)
    {
        $count = Reply::where('email', '=', $request->input('email'))->where('token', '=', $request->input('token'))->count();
        if ($count > 0) {
            Reply::where('email', '=', $request->input('email'))->where('token', '=', $request->input('token'))->where('status', '=', 3)->update(['status' => 0]);
            return view('Mail.remind', ['msg' => Config::get('options.EmailActiveSuccess')]);
        }
    }

    private function getToken($length)
    {
        //生成一个包含 大写英文字母, 小写英文字母, 数字 的数组
        $arr = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));

        $str = '';
        $arr_len = count($arr);
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $arr_len - 1);
            $str .= $arr[$rand];
        }
        return $str;
    }
}
