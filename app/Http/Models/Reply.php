<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = 'reply';
    protected $fillable = ['article_id', 'reply_id', 'nickname', 'cont', 'type', 'status', 'email', 'token', 'reply_id'];
    public static $labelDict = [
        'id' => '评论ID',
        'article_id' => '文章ID',
        'reply_id' => '目标ID',
        'nickname' => '昵称',
        'cont' => '评论内容',
        'type' => '评论类型',     //1代表文章评论，2代表回复评论
        'status' => '评论状态',
        'email' => '评论邮箱',
        'created_at' => '创建时间',
        'updated_at' => '修改时间',
    ];

    //根据文章ID获得评论总数
    public static function count($id, $status)
    {
        $num = SELF::where('article_id', '=', $id)->where('status', '=', $status)->count();
        return $num;
    }

    //根据文章ID获得所有评论
    public static function getAll($id, $status, $cols)
    {
        $replies = SELF::where('article_id', '=', $id)->where('status', '=', $status)->get($cols);
        return $replies;
    }
    //根据评论的字段名获取字段值
    public static function getColVal($id,$colName){
        return SELF::where('id','=',$id)->first([$colName])->$colName;
    }
}
