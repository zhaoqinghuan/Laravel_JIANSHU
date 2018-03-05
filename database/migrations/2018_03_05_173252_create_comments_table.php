<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {//执行这个migrations时会执行的函数 php artisan migrate
        //创建表的时候使用Schema::create(); 更新表的时候使用Schema::table();
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');   //主键ID
            $table->integer('user_id')->default(0); //评论人
            $table->integer('post_id')->default(0); //评论所属文章
            $table->text('content');    //评论内容
            $table->timestamps();   //创建时间&更新时间
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {//回滚这个migrations时会执行的函数 php artisan migrate:rollback
        Schema::dropIfExists('comments');
    }
}
