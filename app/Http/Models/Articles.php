<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{    //指定表名
    protected $table = 'articles';
    //指定id
    protected $primaryKey = 'id';
    //允许批量赋值的字段
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'item_sec',
        'item_fir',
        'abstract',
        'user_id',
        'recommend'];
    public static $labelDict = [
        'id' => 'ID',
        'title' => '标题',
        'abstract'=>'摘要',
        'recommend' => '推荐',
        'created_at' => '创建时间',
        'updated_at' => '修改时间',
        'body'=>'内容',
    ];
    //根据文章id获得文章标题
    public static function getArticleTitle($id){
        $title=SELF::where('id','=',$id)->first(['title']);
        return $title->title;
    }
}
