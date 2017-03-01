@extends('back')
@section('title')
    {{\Illuminate\Support\Facades\Config::get('options.ArticlesManage')}}
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
        <td>已审评论</td>
        <td>待审评论</td>
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
                    <td><a href="{{url('reply/list')}}?article_id={{$article->id}}&status=1">{{\App\Http\Models\Reply::count($article->id,1)}}</a></td>
                    <td><a href="{{url('reply/list')}}?article_id={{$article->id}}&status=0">{{\App\Http\Models\Reply::count($article->id,0)}}</a></td>
                <td><a href="{{url('articles/edit')}}?id={{$article->id}}">修改</a> | <a onclick="return confirm('确定删除这篇文章么？')" href="{{url('articles/delete')}}?id={{$article->id}}">删除</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
