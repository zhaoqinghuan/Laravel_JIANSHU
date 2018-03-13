<?php
namespace App;
//  修改模型文件的基类
use App\Model;

class Topic extends Model
{
    //  获取当前专题下的文章
    public function posts(){
        //  文章和专题的关系是多对多 用belongsToMany
        return $this->belongsToMany(\App\Post::class,'post_topics','topic_id','post_id');
        //  belongsToMany 第一个参数是模型 第二个参数是对应关系的表 第三个参数是表的主键 第四个参数是表和模型之间的关联ID
    }

    //  获取当前专题下的文章数
    public function postTopics(){
        //  当前专题下的文章是一对多关系 用hasMany
        return $this->hasMany(\App\PostTopic::class,'topic_id','id');
        //
    }
}
