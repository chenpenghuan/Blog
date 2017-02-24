@extends('back')
@section('title')
    文章管理
@endsection
@section('contain')
    <table class="table table-bordered">
        <caption class="text-center">文章列表</caption>
        <thead>
        <?php $arr = ['id', 'title', 'abstract', 'recommend', 'created_at', 'updated_at']; ?>
        @foreach(\App\Http\Models\Articles::$labelDict as $index => $label)
            @if(in_array($index,$arr))
                <td>
                    {{$label}}
                </td>
            @endif
        @endforeach
        <td>管理/<a href=""><a href="{{url('articles/create')}}">新建</a></a></td>
        </thead>
        <tbody>

        @foreach($articles as $article)
            <tr>
                @foreach(array_keys(\App\Http\Models\Articles::$labelDict) as $index)
                    @if(in_array($index,$arr))
                        <td>
                            {{$article->$index}}
                        </td>
                    @endif
                @endforeach
                <td><a href="{{url('articles/edit')}}?id={{$article->id}}">修改</a> | <a onclick="return confirm('确定删除这篇文章么？')" href="{{url('articles/delete')}}?id={{$article->id}}">删除</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
