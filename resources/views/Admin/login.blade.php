<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{\Illuminate\Support\Facades\Config::get('options.LoginTitle')}}</title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

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
<form action="{{url('admin/login')}}" method="post">
    {{csrf_field()}}
    <div>
        账号：<input type="text" name="username">
    </div>
    <div>
        密码：<input type="password" name="password">
    </div>
    <div>
        验证码：<input type="text" name="captcha"><img id="captcha" src="/captcha/">
    </div>
    <div>
        <input type="submit" value="提交">
    </div>
</form>
<script>
    $("#captcha").click(function () {
        $('#captcha').attr('src','/captcha/'+Math.random())
    });
</script>
</body>
</html>
