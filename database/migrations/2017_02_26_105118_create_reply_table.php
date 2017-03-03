<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Reply extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reply', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('article_id');
            $table->integer('reply_id');
            $table->text('cont')->default('');
            //评论类型，1代表文章评论，2代表回复评论
            $table->tinyInteger('type')->default(1);
            //评论状态，1代表通过审核，0代表待审核，2代表删除，3代表邮箱没有记录
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reply');
    }
}
