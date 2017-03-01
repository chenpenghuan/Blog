<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table='reply';
    protected $fillable=['aim_id','cont','type','status'];
    public static $labelDict= [
        'id'=>'评论ID',
        'article_id'=>'文章ID',
        'aim_id'=>'目标ID',
        'cont'=>'评论内容',
        'created_at'=>'创建时间',
        'updated_at'=>'修改时间',
        'status'=>'评论状态'
    ];
    //根据文章ID获得评论总数
    public static function count($id,$status){
        $num=SELF::where('id','=',$id)->where('status','=',$status)->count();
        return $num;
    }
}
