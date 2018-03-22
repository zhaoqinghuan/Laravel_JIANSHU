<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //执行这个migrations时会执行的函数 php artisan migrate
        //创建表的时候使用Schema::create(); 更新表的时候使用Schema::table();
        //  创建信息通知表
        Schema::create('notices', function (Blueprint $table) {
            $table->increments('id');   //主键ID
            $table->string('title',50)->default('');   //通知标题
            $table->string('content',1000)->default('');   //通知内容
            $table->timestamps();   //创建时间&更新时间
        });
        //  创建信息浏览信息表
        Schema::create('user_notice', function (Blueprint $table) {
            $table->increments('id');   //主键ID
            $table->integer('user_id')->default(0);     //用户ID 对应用户表主键ID
            $table->integer('notice_id')->default(0);   //通知ID 对应通知表的主键ID
            $table->timestamps();   //创建时间&更新时间
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //回滚这个migrations时会执行的函数 php artisan migrate:rollback
        Schema::dropIfExists('notices');
        Schema::dropIfExists('user_notice');
    }
}
