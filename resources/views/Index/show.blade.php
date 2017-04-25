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
        <?php $floor=1;?>
        @foreach($replies as $id => $reply)
            <div class="gap-small" style="margin:1em 0 1em 0"></div>
            <div class="reply" style="">

                <div class="text-left" style="border: 1px dashed #ee9285;padding: 5px;">
                @if(count($reply)>0)
                    <!--有父级评论-->
                        @for($i=0;$i<count($reply);$i++)
                            <div>
                                <div class=""
                                     style="border: 1px dashed #E2E2E2;width: {{100-($i+1)*0.5}}%;margin-left: {{($i+1)*0.5}}%">
                                    <div>
                                        <div style="float: left;width: 95%;">
                                            <span class="glyphicon glyphicon-user"></span><span>{{\App\Http\Models\Reply::getColVal($reply[$i],'nickname')}}
                                                ：</span>
                                        </div>
                                        <div style="float: right;width: 5%;">
                                            {{$i+1}}楼
                                        </div>
                                    </div>
                                    <div class="text-left" style="text-indent: 2em">
                                        {{\App\Http\Models\Reply::getColVal($reply[$i],'cont')}}
                                    </div>
                                    <div class="text-right">{{\App\Http\Models\Reply::getColVal($reply[$i],'created_at')}}</div>
                                    <div class="text-right reply_back" reply_id="{{$reply[$i]}}">回复</div>
                                </div>
                            </div>
                        @endfor
                    @endif
                    <div>
                        <div style="float: left;width: 95%;">
                            <span class="glyphicon glyphicon-user"></span><span>{{\App\Http\Models\Reply::getColVal($id,'nickname')}}
                                ：</span>
                        </div>
                        <div style="float: right;width: 5%;">
                            {{$floor}}楼
                        </div>
                    </div>
                    <!--
                    <span class="glyphicon glyphicon-user"></span><span>{{\App\Http\Models\Reply::getColVal($id,'nickname')}}
                        ：</span>{{$id}}
                    -->
                    <div class="text-left" style="text-indent: 2em">
                        {{\App\Http\Models\Reply::getColVal($id,'cont')}}
                    </div>
                    <div class="text-right">{{\App\Http\Models\Reply::getColVal($id,'created_at')}}</div>
                    <div class="text-right reply_back" reply_id="{{$id}}">回复</div>
                </div>
            </div>
            <?php $floor++; ?>
        @endforeach
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
