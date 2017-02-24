@extends('back')
@section('title')
    创建菜单
    @endsection
@section('contain')
    <form action="{{url('items/savecreate')}}" method="post">
        {{csrf_field()}}
        <div>
            <label>菜单类型</label>
            <select name="type" id="type">
                @if(old('type')==2)
                    <option value="1">一级菜单</option>
                    <option selected="selected" value="2">二级菜单</option>
                    @else
                <option selected="selected" value="1">一级菜单</option>
                <option value="2">二级菜单</option>
                    @endif
            </select>
        </div>
        @foreach(\App\Http\Models\Items2::$editAble as $col)
            @if($col=='item1_id')
                <div id="{{$col}}" style="display: none">
                    @else
                        <div id="{{$col}}">
                            @endif
                            <label for="{{$col}}">{{\App\Http\Models\Items2::$labelDict[$col]}}</label>
                            @if($col=='item1_id')
                                <?php $items = \App\Http\Models\Items1::allItem(); ?>
                                <select name="{{$col}}" id="" autocomplete="off">
                                    @foreach($items as $item)
                                        <option value="{{$item['id']}}" {{old($col)==$item['id']?'selected="selected"':''}}>{{$item['name']}}</option>
                                    @endforeach
                                </select>
                            @else
                                <input name="{{$col}}" type="text" value="{{old($col)}}">
                            @endif
                        </div>
                        @endforeach
                        <input type="submit" value="提交">
    </form>
    <script>
        $("#type").change(function () {
            change();
        });
        $(document).ready(function(){
            change();
        });
        //当所选菜单类型是二级菜单时，显示菜单归属的下拉框
        function change() {
            if ($("#type").val() == '2') {
                $("#item1_id").css("display", "block");
            } else {
                $("#item1_id").css("display", "none");
            }
        }
    </script>
@endsection
