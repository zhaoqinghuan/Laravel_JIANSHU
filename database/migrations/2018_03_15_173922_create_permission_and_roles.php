<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreatePermissionAndRoles extends Migration
{
    public function up()
    {   //执行这个migrations时会执行的函数 php artisan migrate
        //创建表的时候使用Schema::create(); 更新表的时候使用Schema::table();
        //  创建角色表
        Schema::create('admin_roles', function (Blueprint $table) {
            $table->increments('id');//主键ID
            $table->string('name',30)->default('');//角色名
            $table->string('description',100)->default('');//描述
            $table->timestamps();//创建时间和最后修改时间
        });
        //  创建权限表
        Schema::create('admin_permissions', function (Blueprint $table) {
            $table->increments('id');//主键ID
            $table->string('name',30)->default('');         //权限名
            $table->string('description',100)->default(''); //描述
            $table->timestamps();//创建时间和最后修改时间
        });
        //  创建权限角色表
        Schema::create('admin_permission_role', function (Blueprint $table) {
            $table->increments('id');//主键ID
            $table->integer('role_id');//角色ID
            $table->integer('permission_id');//权限ID
            $table->timestamps();//创建时间和最后修改时间
        });
        //  创建用户角色表
        Schema::create('admin_role_user', function (Blueprint $table) {
            $table->increments('id');//主键ID
            $table->integer('role_id');//角色ID
            $table->integer('user_id');//用户ID
            $table->timestamps();//创建时间和最后修改时间
        });
    }
    public function down()
    {
        //回滚这个migrations时会执行的函数 php artisan migrate:rollback
        Schema::dropIfExists('admin_roles');
        Schema::dropIfExists('admin_permissions');
        Schema::dropIfExists('admin_permission_role');
        Schema::dropIfExists('admin_role_user');
    }
}
