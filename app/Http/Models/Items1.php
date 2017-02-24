<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Items1 extends Model
{
    protected $table='items1';
    protected $fillable=['name','sort','status'];
    public static $labelDict= [
        'name'=>'菜单名称',
        'id'=>'菜单ID',
        'sort'=>'菜单排序',
        'created_at'=>'创建时间',
        'updated_at'=>'修改时间',
        'status'=>'菜单状态'
    ];
    public static $editAble=['name','sort'];
    public static function itemName($itemId){
        return SELF::where('id','=',$itemId)->first(['name'])->toArray()['name'];
    }
    public static function allItem(){
        return SELF::where('status','=',1)->get(['id','name'])->toArray();
    }
}
