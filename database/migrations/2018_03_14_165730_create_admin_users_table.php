<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUsersTable extends Migration
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
        //  使用admin_users做为数据库表名 模型文件的名称应该为AdminUser
        Schema::create('admin_users', function (Blueprint $table) {
            $table->increments('id');//主键ID
            $table->string('name',30);//账户
            $table->string('password',100);//密码
            $table->timestamps();//创建时间和最后修改时间
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
        Schema::dropIfExists('admin_users');
    }
}
