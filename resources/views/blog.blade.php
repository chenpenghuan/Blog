<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>{{\Illuminate\Support\Facades\Config::get('options.BlogTitle')}}</title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet"
          href="{{asset(\Illuminate\Support\Facades\Config::get('options.public').'/css/blog/commen.css')}}">
    <link rel="shortcut icon" href="favorite.ico" type="image/x-icon" />
    @section('head')
    @show
    <style>
        @if(userAgent($_SERVER['HTTP_USER_AGENT'])=='desktop')
            .article {
            padding: 2% 4% 2% 4%;
        }

        body {
            margin: 0 auto;
            margin-top: 5%;
            width: 80%;
            padding: 5%;
        }

        @else
            .article {
            padding: 1% 2% 1% 2%;
        }

        body {
            margin: 0 auto;
            padding-bottom: 3%;
        }
        @endif
        @section('css')
        @show
    </style>
</head>
<body>
<script>
</script>
@if(Session::has('msg'))
    <script>
        alert('{{Session::get('msg')}}');
    </script>
@endif
<div class="head">

</div>
<div class="main">
    <div class="items">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="example-navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{url('index/index')}}">推荐</a>
                        </li>
                        <?php $items = \App\Http\Controllers\CommenController::formatItems(); ?>
                        @foreach($items as $item)
                            @if(isset($item['item2']))
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        {{$item['name']}} <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach($item['item2'] as $item2)
                                            <li>
                                                <a href="{{url('index/list')}}?type=2&firid={{$item['id']}}&secid={{$item2['id']}}">{{$item2['name']}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li>
                                    <a href="{{url('index/list')}}?type=1&firid={{$item['id']}}">{{$item['name']}}</a>
                                </li>
                            @endif

                        @endforeach
                        <li><a href="{{url('index/userinfo')}}">关于博主</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="black"></div>
    <div class="contain">
        @section('contain')
        @show
        @section('reply')
        @show
        @section('comment')

        @show
    </div>
    <div class="black"></div>

    <div class="end text-center">
        @section('end')
            Developed By <a href="{{url('index/userinfo')}}">Chen Penghuan</a> | Powered By <a
                    href="https://laravel.com/">Laravel</a>
        @show
    </div>
    <div class="leave"></div>
</div>
</body>
</html>