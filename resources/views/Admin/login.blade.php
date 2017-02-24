<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 表单控件大小</title>
    <link rel="stylesheet" href="https://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
        <input type="submit" value="提交">
    </div>

</form>
</body>
</html>
