<?php

namespace App\Http\Controllers;

use App\Http\Models\Items1;
use App\Http\Models\Items2;
use Illuminate\Http\Request;

class CommenController extends Controller
{
    public static function getItems()
    {
        $items1 = Items1::where('status', '=', 1)->orderBy('sort', 'asc')->get(['id', 'name', 'sort'])->toArray();
        $items1_ids = [];
        foreach ($items1 as $item1) {
            $items1_ids[] = $item1['id'];
        }
        $items2 = Items2::where('status', '=', 1)->whereIn('item1_id', $items1_ids)->orderBy('sort', 'asc')->get(['id', 'name', 'item1_id', 'sort'])->toArray();
        return ['items1' => $items1, 'items2' => $items2];
    }

    public static function formatItems()
    {
        $items = SELF::getItems();
        $items1 = $items['items1'];
        $items2 = $items['items2'];
        $items = [];
        foreach ($items1 as $item1) {
            foreach ($items2 as $item2) {
                if ($item1['id'] == $item2['item1_id']) {
                    $item1['item2'][] = ['id' => $item2['id'], 'name' => $item2['name']];
                }
            }
            $items[] = $item1;
        }
        return $items;
    }
}
