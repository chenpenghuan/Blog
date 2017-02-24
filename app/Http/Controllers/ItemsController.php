<?php

namespace App\Http\Controllers;

use App\Http\Models\Items1;
use App\Http\Models\Items2;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Config;

class ItemsController extends CommenController
{
    public function list()
    {
        $items = SELF::getItems();
        return view('Item.list', ['items1' => $items['items1'], 'items2' => $items['items2']]);
    }

    public function edit(Request $request)
    {
        if ($request->has(['type', 'id']) && in_array($request->input('type'), ['1', '2']) && is_numeric($request->input('id'))) {
            if ($request->input('type') == '1') {
                $itemInfo = Items1::where('status', '=', 1)->where('id', '=', $request->input('id'))->first(['id', 'name', 'sort'])->toArray();
                return view('Item.edit', ['itemInfo' => $itemInfo]);
            } elseif ($request->input('type') == '2') {
                $itemInfo = Items2::where('status', '=', 1)->where('id', '=', $request->input('id'))->first(['id', 'name', 'sort', 'item1_id'])->toArray();
                return view('Item.edit', ['itemInfo' => $itemInfo]);
            } else {
                return view('Item.error');
            }
        }
    }

    public function create()
    {
        return view('Item.create');
    }

    public function savecreate(Request $request)
    {
        $this->validate($request, ['type' => 'required|between:1,2', 'name' => 'required|min:2|max:30','sort'=>'required|integer'], ['required' => ':attribute 不能为空', 'min' => ':attribute 不能少于2个字符', 'max' => ':attribute 不能大于30个字符','integer'=>':attribute 必须为整数'], ['type' => '菜单类型', 'name' => '菜单名称','sort'=>'菜单排序']);
        $write=null;
        if ($request->input('type') == '1') {
            $write = Items1::create(['name' => $request->input('name'), 'sort' => $request->input('sort')]);
        }

        if ($request->input('type') == '2') {
            $write = Items2::create(['name' => $request->input('name'), 'sort' => $request->input('sort'), 'item1_id' => $request->input('item1_id')]);
        }
        if ($write != null) {
            if ((is_numeric($write) && $write == 1) || $write->exists == true) {
                return back()->with('msg',Config::get('options.CreateSucceed.Items'));
            } else {
                return back()->with('msg',Config::get('options.CreateFailed.Items'));
            }
        }
    }

    public function saveedit(Request $request)
    {
        $this->validate($request, ['type' => 'required|between:1,2', 'name' => 'required|min:2|max:30','sort'=>'required|integer'], ['required' => ':attribute 不能为空', 'min' => ':attribute 不能少于2个字符', 'max' => ':attribute 不能大于30个字符','integer'=>':attribute 必须为整数'], ['type' => '菜单类型', 'name' => '菜单名称','sort'=>'菜单排序']);
        $write=null;
        if ($request->input('type') == '1') {
            $write = Items1::where('status', '=', 1)->where('id', '=', $request->input('id'))->update(['name' => $request->input('name'), 'sort' => $request->input('sort')]);
        } else {
            $write = Items2::where('status', '=', 1)->where('id', '=', $request->input('id'))->update(['name' => $request->input('name'), 'sort' => $request->input('sort'), 'item1_id' => $request->input('item1_id')]);
        }
        if ($write != null) {
            if ((is_numeric($write) && $write == 1) || $write->exists == true) {
                return back()->with('msg',Config::get('options.EditSucceed.Items'));
            } else {
                return back()->with('msg',Config::get('options.EditFailed.Items'));
            }
        }
    }

    public function delete(Request $request){
        $write=null;
        if ($request->input('type') == '1') {
            $write = Items1::where('id', '=', $request->input('id'))->update(['status' => 0]);
        }
        if ($request->input('type') == '2') {
            $write = Items2::where('id', '=', $request->input('id'))->update(['status' => 0]);
        }
        if ($write != null) {
            if ((is_numeric($write) && $write == 1) || $write->exists == true) {
                return back()->with('msg',Config::get('options.DeleteSucceed.Items'));
            } else {
                return back()->with('msg',Config::get('options.DeleteFailed.Items'));
            }
        }else{
            return back()->with('msg',Config::get('options.DataError'));
        }
    }
}
