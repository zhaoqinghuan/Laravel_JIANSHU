<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlertPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //执行这个migrations时会执行的函数 php artisan migrate
        // 修改这个表的字段使用 table
        Schema::table('posts', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0);
            //  设置文章的状态 0未知，1通过，-1删除
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
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('status');
            //  如果出现回滚操作直接把当前字段删除
        });
    }
}
