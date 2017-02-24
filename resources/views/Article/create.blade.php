@extends('back')
@section('css')
    <script type="text/javascript" charset="utf-8"
            src="{{asset(\Illuminate\Support\Facades\Config::get('options.public').'/ueditor/ueditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8"
            src="{{asset(\Illuminate\Support\Facades\Config::get('options.public').'/ueditor/ueditor.all.min.js')}}"></script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8"
            src="{{asset(\Illuminate\Support\Facades\Config::get('options.public').'/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
@endsection
@section('title')
    创建文章
@endsection
@section('contain')

    <form action="{{url('articles/savecreate')}}" method="post">
        {{csrf_field()}}
        <div>
            <div>{{\App\Http\Models\Articles::$labelDict['title']}}：</div>
            <div><textarea name="title" style="width: 100%">{{old('title')}}</textarea></div>
        </div>
        <div>
            <div>{{\App\Http\Models\Articles::$labelDict['abstract']}}：</div>
            <div><textarea name="abstract" style="width: 100%">{{old('abstract')}}</textarea></div>
        </div>
        <div>
            <div>归属菜单：</div>
            <div style="border:1px #999999 solid;">
                <span>
                    <select name="item1_id" id="item1">
                    </select>
                </span>
                <span>
                    <select name="item2_id" id="item2">
                    </select>
                </span>
            </div>
        </div>
        <div>
            <div>是否推荐：</div>
            <div style="border:1px #999999 solid;">
                @if(old('recommend')=="0")
                    <span class="radio">
                        <label>
                        <input type="radio" name="recommend" id="optionsRadios1" value="1">是
                    </label>
                </span>
                    <span class="radio">
                    <label>
                        <input type="radio" name="recommend" id="optionsRadios2" value="0" checked>否
                    </label>
                </span>

                @else
                    <span class="radio">
                        <label>
                        <input type="radio" name="recommend" id="optionsRadios1" value="1" checked>是
                    </label>
                </span>
                    <span class="radio">
                    <label>
                        <input type="radio" name="recommend" id="optionsRadios2" value="0">否
                    </label>
                </span>
                @endif

            </div>
        </div>
        <div>
            <div>{{\App\Http\Models\Articles::$labelDict['body']}}：</div>
            <div>
                <script id="editor" name="body" type="text/plain"
                        style="width:100%;height:500px;">{!! old('body') !!}</script>
            </div>
        </div>
        <div>
            <input type="submit" value="提交">
        </div>
    </form>

    <script type="text/javascript">
        window.UEDITOR_HOME_URL = "{{asset(\Illuminate\Support\Facades\Config::get('options.public').'/ueditor/')}}";
        //实例化编辑器
        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
        var ue = UE.getEditor('editor');
    </script>
    <script>
        $(document).ready(function () {
            var items = JSON.parse('{!!json_encode(\app\Http\Controllers\CommenController::formatItems())!!}');
            $.each(items, function (k1, v1) {
                $('#item1').append("<option value=" + v1['id'] + ">" + v1['name'] + "</option>");
                if (k1 == 0) {
                    if (v1['item2'] != null) {
                        $.each(v1['item2'], function (k2, v2) {
                            $('#item2').append("<option value=" + v2['id'] + ">" + v2['name'] + "</option>");
                        });
                        $('#item2').show();
                    } else {
                        $('#item2').hide();
                    }
                }
            });
            $('#item1').change(function () {
                $.each(items, function (k1, v1) {
                    if ($('#item1').val() == v1['id']) {
                        if (v1['item2'] != null) {
                            $.each(v1['item2'], function (k2, v2) {
                                $('#item2').append("<option value=" + v2['id'] + ">" + v2['name'] + "</option>");
                            });
                            $('#item2').show();
                        } else {
                            $('#item2').hide();
                        }
                    }
                });
            });
        });
    </script>

@endsection