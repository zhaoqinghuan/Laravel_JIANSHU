<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;
//所有模型的基类这里定义的参数在所有的模型文件中都起作用 前提所有模型继承这个模型基类
class Model extends BaseModel
{
    //指定不可以使用数组注入哪些字段为空
    protected $guarded = [];

}
