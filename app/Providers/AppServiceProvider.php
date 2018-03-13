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
