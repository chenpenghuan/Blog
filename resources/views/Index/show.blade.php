@extends('blog')


@section('head')
    <link rel="stylesheet"
          href="{{asset(\Illuminate\Support\Facades\Config::get('options.public').'/css/blog/show.css')}}">
    <script src="{{asset(\Illuminate\Support\Facades\Config::get('options.public').'/js/blog/show.js')}}"></script>

@endsection

@section('contain')
    <div class="article">
        <div class="detail">
            {!!$article->body!!}
        </div>
        <div class="text-right">{{$article->updated_at}}</div>
    </div>
@endsection
@section('reply')
    <div class="article" id="frm_after">
        <div class="gap-big"></div>
        @if(count($replies)>0)
            <p class="lead">评论：</p>
        @endif
        <hr>
        @for($m=1;$m<count($indexs);$m++)
            <div class="gap-small" style="margin:1em 0 1em 0"></div>
            <div class="reply" style="">
                <?php
                $cou = 0;
                ?>
                @for($n=$indexs[$m-1];$n<$indexs[$m];$n++)
                    <div class="text-left" style="width:{{100-1*$cou}}%;margin-left: {{1*$cou}}%;border-bottom: 1px dashed #ee9285;border-left: 5px solid #ee9285"><span
                                class="glyphicon glyphicon-user"></span><span>{{$replies[$n]['nickname']}}
                            ：</span>
                        @if($n!=$indexs[$m-1])
                            <div><font style="background: #ECECEC;margin-left: 2em">回复{{ \App\Http\Models\Reply::getNickName($replies[$n]['reply_id']) }}</font>：{{$replies[$n]['cont']}}</div>
                            @else

                            <div class="text-left" style="text-indent: 2em">
                                {{$replies[$n]['cont']}}
                            </div>
                        @endif
                        <div class="text-right">{{$replies[$n]['created_at']}}</div>
                        <div class="text-right reply_back" reply_id="{{$replies[$n]['id']}}">回复</div>

                    </div>
                    <?php
                    $cou++;
                    ?>
                @endfor
            </div>

        @endfor
    </div>
@endsection
@section('comment')
    <div class="article" id="frm">
        <div class="gap-big"></div>
        <div class="lead" id="frm_title">发表评论：</div>
        @if(count($errors)>0)
            <div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert">
                    &times;
                </a>
                <strong>{{$errors->all()[0]}}</strong>
            </div>
        @endif
        <form action="{{url('reply/add')}}?id={{$article->id}}" method="post">
            {{csrf_field()}}
            <div><label for="nickname">昵称：</label><input type="text" name="nickname"
                                                         value="{{old('nickname')}}">
                <button id="reset_frm" style="display: none" class="btn btn-success text-right" type="button">
                    取消回复
                </button>
            </div>
            <div><label for="email">邮箱：</label><input type="text" name="email" value="{{old('email')}}"></div>
            <div><label for="cont">内容：</label><textarea name="cont"
                                                        style="width: 100%">{{old('cont')}}</textarea></div>
            <div><input type="hidden" name="reply_id" id="reply_id"></div>
            <div>
                <button class="btn btn-submit btn-success">提交</button>
            </div>
        </form>
    </div>
@endsection
