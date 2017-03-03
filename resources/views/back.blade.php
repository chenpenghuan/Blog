<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>
        @section('title')
            统计报告
        @show
    </title>
    <link rel="stylesheet" href="https://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    @section('head')
    @show
    @section('css')
    @show
</head>
<body>
<div class="head">
</div>
<div class="main">
    <div class="nav">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div>
                    <a class="navbar-brand" href="#">{{\Illuminate\Support\Facades\Config::get('options.Account')}}</a>
                </div>
                <div>
                    <a class="navbar-brand"
                       href="{{url('items/list')}}">{{\Illuminate\Support\Facades\Config::get('options.ItemsManage')}}</a>
                </div>
                <div>
                    <a class="navbar-brand"
                       href="{{url('articles/list')}}">{{\Illuminate\Support\Facades\Config::get('options.ArticlesManage')}}</a>
                </div>
                <div class="navbar-brand" style="color:blue;float: right">{{Session::get('username')}}</div>
            </div>
        </nav>
    </div>
    <div class="body">
        @if(count($errors)>0)
            <div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert">
                    &times;
                </a>
                <strong>{{$errors->all()[0]}}</strong>
            </div>
        @endif
        @if(Session::has('msg'))
            <div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert">
                    ×
                </a>
                <strong>
                    {{Session::get('msg')}}
                </strong>
            </div>
        @endif
        @section('contain')
            主体内容区域
        @show

    </div>
    <div class="foot">
        <p class="text-center">页面底部</p>
    </div>
</div>
</body>
</html>
