<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/','IndexController@index');
Route::any('/admin/login','AdminController@login');
Route::get('/admin/logout','AdminController@logout');

//模块管理
Route::group(['prefix'=>'items','middleware'=>'checklogin'],function(){
    Route::get('list','ItemsController@list');
    Route::get('edit','ItemsController@edit');
    Route::get('create','ItemsController@create');
    Route::any('savecreate','ItemsController@savecreate');
    Route::any('saveedit','ItemsController@saveedit');
    Route::get('delete','ItemsController@delete');
});

//文章模块
Route::group(['prefix'=>'articles','middleware'=>'checklogin'],function (){
    Route::get('list','ArticlesController@list');
    Route::get('edit','ArticlesController@edit');
    Route::get('create','ArticlesController@create');
    Route::any('savecreate','ArticlesController@savecreate');
    Route::any('saveedit','ArticlesController@saveedit');
    Route::get('delete','ArticlesController@delete');
});

//评论模块
Route::group(['prefix'=>'reply'],function (){
    Route::get('list','ReplyController@list');
    Route::any('add','ReplyController@add');
    //Route::get('show','ReplyController@show');
    Route::get('manage','ReplyController@manage');
    //Route::get('count','ReplyController@count');
    Route::get('emailactive','ReplyController@emailactive');
});

//展示模块
Route::group(['prefix'=>'index'],function (){
    Route::get('index','IndexController@index');
    Route::get('userinfo','IndexController@userinfo');
    Route::get('list','IndexController@list');
    Route::get('recommend','IndexController@recommend');
    Route::get('show','IndexController@show');
    Route::get('test','IndexController@test');
});

