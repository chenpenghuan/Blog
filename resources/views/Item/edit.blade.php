@extends('back')
@section('title')
    修改菜单
@endsection
@section('contain')
    <form action="{{url('items/saveedit')}}" method="post">
        {{csrf_field()}}
        @if(\Illuminate\Support\Facades\Input::get('type')=='1')
            @foreach($itemInfo as $index => $cont)
                <div>
                    <label>{{\App\Http\Models\Items1::$labelDict[$index]}}</label>
                    @if(in_array($index,\App\Http\Models\Items1::$editAble))
                        <input type="text" name="{{$index}}" value="{{$cont}}">
                    @else
                        <span>{{$cont}}</span>
                    @endif
                </div>
            @endforeach
        @elseif(\Illuminate\Support\Facades\Input::get('type')=='2')
            <?php
            $items = \App\Http\Models\Items1::allItem();
            ?>
            @foreach($itemInfo as $index => $cont)
                <div>
                    <label for="">{{\App\Http\Models\Items2::$labelDict[$index]}}</label>
                    @if(in_array($index,\App\Http\Models\Items2::$editAble))
                        @if($index=='item1_id')
                            <select name="{{$index}}" id="" autocomplete="off">
                                @foreach($items as $item)
                                    @if(old($index)==null && $cont==$item['id'])
                                        <option selected="selected" value="{{$item['id']}}">{{$item['name']}}</option>
                                    @elseif(old($index)!=null && old($index)==$item['id'])
                                        <option selected="selected" value="{{$item['id']}}">{{$item['name']}}</option>
                                    @else
                                        <option value="{{$item['id']}}">{{$item['name']}}</option>
                                    @endif
                                @endforeach
                            </select>
                        @else
                            <input type="text" name="{{$index}}" value="{{old($index)?old($index):$cont}}">
                        @endif
                    @else
                        <span>{{$cont}}</span>
                    @endif
                </div>
            @endforeach
        @else
            <div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert">
                    ×
                </a>
                <strong>
                    {{\Illuminate\Support\Facades\Config::get('options.DataError')}}
                </strong>
            </div>
        @endif
        <input type="hidden" name="id" value="{{\Illuminate\Support\Facades\Input::get('id')}}">
        <input type="hidden" name="type" value="{{\Illuminate\Support\Facades\Input::get('type')}}">
        <input type="submit" onclick="return confirm('确定修改吗？')" value="提交">
    </form>
@endsection
