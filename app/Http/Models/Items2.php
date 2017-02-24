<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Items2 extends Model
{
    protected $table='items2';
    protected $fillable=['name','sort','item1_id','status'];
    public static $labelDict= [
        'name'=>'菜单名称',
        'id'=>'菜单ID',
        'sort'=>'菜单排序',
        'created_at'=>'创建时间',
        'updated_at'=>'修改时间',
        'item1_id'=>'归属菜单',
        'status'=>'菜单状态'
    ];
    public static $editAble=['name','sort','item1_id'];
}
