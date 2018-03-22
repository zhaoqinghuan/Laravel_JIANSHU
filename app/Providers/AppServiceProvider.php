<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);


        //专题模块使用视图合成器进行页面数据加载
        \View::composer('layout.sidebar', function($view){
            //第一个参数是专题模块需要使用视图合成器进行加载数据显示的模板位置
            //第二个参数是需要进行展示的数据
            $topics = \App\Topic::all();//获取Topics表中的所有数据
            $view->with('topics', $topics);//将数据传递给视图
        });

        //  创建DB_Listen

        \DB::listen(function($query){
            //  因为Laravel默认使用的是PDO来封装数据库操作 PDO在SQl操作的时候存在一个预处理
            $sql = $query->sql;// 提取SQL
            $bindings = $query->bindings;// 提取bindings
            $time = $query->time;// 提取SQL执行的时间单位毫秒
            if ($time > 10) {
                //  将执行时间大于10毫秒的sql存入日志 对其进行优化
                \Log::debug(var_export(compact('sql','bindings','time'),true));//以字符串形式将结果存入log日志文件中
                //  var_export 将结果以字符串形式打印 第一个参数打印数据本身 第二个参数 是否不在当前页面打印出来 默认为false
                //  这个结果被存入到\storage\logs\laravel.log中
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
