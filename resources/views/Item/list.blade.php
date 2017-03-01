@extends('back')
@section('title')
    菜单管理
@endsection
@section('contain')
    <table class="table table-bordered">
        <tr>
            <td>ID</td>
            <th>菜单</th>
            <th>排序</th>
            <th>管理/<a href="{{url('items/create')}}">创建</a></th>
        </tr>
        @foreach($items1 as $item1)
            <tr>
                <td>{{$item1['id']}}</td>
                <td>{{$item1['name']}}</td>
                <td>{{$item1['sort']}}</td>
                <td><a href="{{url('items/edit')}}?type=1&id={{$item1['id']}}">修改</a>|<a
                            onclick="return confirm('确认删除该菜单吗？')" href="{{url('items/delete')}}?type=1&id={{$item1['id']}}">删除</a></td>
            </tr>
            @foreach($items2 as $item2)
                @if($item2['item1_id']==$item1['id'])
                    <tr>
                        <td>{{$item2['id']}}</td>
                        <td>|--{{$item2['name']}}</td>
                        <td>{{$item2['sort']}}</td>
                        <td><a href="{{url('items/edit')}}?type=2&id={{$item2['id']}}">修改</a>|<a onclick="return confirm('确定删除该菜单吗？')" href="{{url('items/delete')}}?type=2&id={{$item2['id']}}">删除</a>
                        </td>
                    </tr>
                @endif
            @endforeach
        @endforeach
    </table>
@endsection