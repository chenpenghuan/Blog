/**
 * Created by cph on 2017/3/2.
 */
;$(document).ready(function () {
    $(".reply_back").each(function(){
        WriteReplyNums($(this).attr("reply_id"))
    });
    $(".reply_back").click(function () {
        $("#frm").insertAfter($(this));
        //alert($(this).attr('reply_id'));
        $("#reply_id").val($(this).attr('reply_id'));
        $("#frm_title").text("");
        $("#reset_frm").css("display","");
    });
    $("#reset_frm").click(function () {
        $("#frm").insertAfter($("#frm_after"));
        $("#reply_id").val("");
        $("#frm_title").text("发表评论：");
        $("#reset_frm").css("display","none");
    });
});
function WriteReplyNums(reply_id){
    $.post("getRepliesNums",{reply_id:reply_id},function(result){//接口返回的子评论总数
        $(".reply_back").each(function(){
            if($(this).attr("reply_id")==reply_id){
                $(this).text("回复("+result+")");
            }
        });
    });
};
