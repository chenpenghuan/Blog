@extends('back')
@section('title')
    {{\Illuminate\Support\Facades\Config::get('options.RepliesManage')}}
@endsection
@section('contain')
    <table class="table table-bordered">
        <tr>
            <td>{{\App\Http\Models\Reply::$labelDict['id']}}</td>
            <td>文章标题</td>
            <td>{{\App\Http\Models\Reply::$labelDict['reply_id']}}</td>
            <td>{{\App\Http\Models\Reply::$labelDict['cont']}}</td>
            <td>{{\App\Http\Models\Reply::$labelDict['created_at']}}</td>
            <td>管理</td>
        </tr>
    @foreach($replies as $reply)
        <tr>
            <td>{{$reply->id}}</td>
            <td>{{\App\Http\Models\Articles::getArticleTitle($reply->article_id)}}</td>
            <td>{{$reply->reply_id}}</td>
            <td>{{$reply->cont}}</td>
            <td>{{$reply->created_at}}</td>
            <td><a href="{{url('reply/manage')}}?act=delete&id={{$reply->id}}">删除</a>/<a href="{{url('reply/manage')}}?act={{$reply->status==1?'unpass':'pass'}}&id={{$reply->id}}">{{$reply->status==1?'禁止':'通过'}}</a></td>
        </tr>

    @endforeach
    </table>
@endsection