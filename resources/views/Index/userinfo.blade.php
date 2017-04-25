@extends('blog')
@section('head')
    <link rel="stylesheet"
          href="{{asset(\Illuminate\Support\Facades\Config::get('options.public').'/css/blog/show.css')}}">
@endsection
@section('css')
    table tr td p{
        height:100%;
    }
@endsection
@section('contain')
    <div class="article table-responsive">
        <table>
            <p class="text-center lead">个人信息</p>
            <hr>
            <tr>
                <td rowspan="6" width="40%"><img src="{{asset(config('options.public')).'/img/cph.sml.jpg'}}" alt="" ></td>
                <td rowspan="6" width="10%"></td>
                <td><p class="lead">陈鹏欢，程序员，北京</p></td>
            </tr>
            <tr>
                <td><p class="lead">PHP、Python开发</p></td>
            </tr>
            <tr>
                <td><p class="lead">E-Mail：<a href="mailto:6898786@gmail.com">6898786@gmail.com</a></p></td>
            </tr>
            <tr>
                <td><p class="lead">QQ：1034478083</p></td>
            </tr>
            <tr>
                <td><p class="lead">GitHub：<a href="https://github.com/chenpenghuan">https://github.com/chenpenghuan</a></p></td>
            </tr>
            <tr>
                <td><p class="lead">CSDN：<a href="http://blog.csdn.net/chenpenghuan">http://blog.csdn.net/chenpenghuan</a></p></td>
            </tr>
        </table>
        <hr>
        <br>
        <div class="text-center">欢迎交流</div>
        <br>
        <!--
        <span>
        </span>
        -->
    </div>
    <div class="black"></div>
@endsection