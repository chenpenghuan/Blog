@extends('blog')
@section('head')
    <link rel="stylesheet"
          href="{{asset(\Illuminate\Support\Facades\Config::get('options.public').'/css/blog/index.css')}}">
@endsection
@section('contain')
    @if(count($articles)==0)
        <div class="alert alert-warning">
            <a href="#" class="close" data-dismiss="alert">
                &times;
            </a>
            <strong>此标题下无文章</strong>
        </div>
    @endif
    @foreach($articles as $article)
        <div class="article">
            <div class="title">
                <a href="{{url('index/show')}}?id={{$article->id}}">{{$article->title}}</a>
            </div>
            <div class="abstract">
                {{$article->abstract}}
            </div>
            <div class="article_date text-right">
                {{$article->updated_at}}
            </div>
        </div>
        <div class="black"></div>
    @endforeach
@endsection

