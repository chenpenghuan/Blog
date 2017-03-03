<?php
/**
 * Created by PhpStorm.
 * User: cph
 * Date: 2017/2/23
 * Time: 22:30
 */
return [
    //博客标题
    'BlogTitle'=>'拾荒少年',
    //public目录路径
    'public'=>'/public',
    //菜单名称
    'Account'=>'统计报告',
    'ItemsManage'=>'菜单管理',
    'ArticlesManage'=>'文章管理',
    'RepliesManage'=>'评论管理',
    'LoginTitle'=>'欢迎登陆',

    'EmailExist'=> '评论发表成功，待博主审核',
    'EmailActiveUntil'=>86400,      //邮箱验证链接24小时时效
    'EmailNotExist'=>'您的邮箱不曾登陆过本博客，我们已将验证链接发送到您的邮箱，请先进登陆邮箱进行验证，验证链接时效为24小时，24小时后该验证链接与评论记录都将被清除（每个邮箱只需在首次登陆的时候验证即可）',
    'EmailActiveSuccess'=>'您的邮箱激活成功，下次评论已不再需要激活邮箱，您的本次评论已推送给博主！',
    'EmailNotActive'=>'您的邮箱上次评论后仍未通过验证，请先登陆您的邮箱点击验证链接进行验证',
    //中间件验证出错时的报错信息
    'LoginTimeOut'=>'登陆超时，请重新登陆',
    //控制器验证出错是的报错信息
    'LoginError'=>'登录失败，请检查账号密码',
    //后台账号
    'UserName'=>'admin',
    //后台账号密码
    'PassWord'=>'4d668681c05d9f102d989b09cc10512e',

    'CreateSucceed'=>['Items'=>'菜单创建成功','Articles'=>'文章创建成功'],
    'CreateFailed'=>['Items'=>'菜单创建失败','Articles'=>'文章创建失败'],
    'DeleteSucceed'=>['Items'=>'菜单删除成功','Articles'=>'文章删除成功','Replies'=>'评论删除成功'],
    'DeleteFailed'=>['Items'=>'菜单删除失败','Articles'=>'文章删除失败','Replies'=>'评论删除失败'],
    'EditSucceed'=>['Items'=>'菜单修改成功','Articles'=>'文章修改成功'],
    //审核评论
    'PassSucceed'=>['Replies'=>'评论审核成功'],
    'PassFailed'=>['Replies'=>'评论审核失败'],

    'DataError'=>'数据错误，请返回重试',
];