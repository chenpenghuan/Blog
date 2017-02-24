@extends('blog')


@section('head')
    <link rel="stylesheet" href="{{asset(\Illuminate\Support\Facades\Config::get('options.public').'/css/blog/show.css')}}">
@endsection

@section('contain')
    <div class="article">
        <div class="detail">
            {!!$article->body!!}
        </div>
        <div class="text-right">{{$article->updated_at}}</div>
    </div>
    <div class="black"></div>
@endsection