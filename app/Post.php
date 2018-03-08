<?php
namespace App;
use App\Model;
//引入LaravelScout扩展类
use Laravel\Scout\Searchable;
//默认指定Xxxs表
class Post extends Model
{
    //将Searchable引入到当前类
    use Searchable;
    //定义索引中的type值
    public function searchableAs()
    {
        return "post";
    }
    //定义有哪些字段需要被进行搜索
    public function toSearchableArray()
    {
        return [
            'title'=>$this->title,
            'content'=>$this->content,
        ];
    }

    //赞模块的一对一关联操作(当前用户是否已经点赞)
    public function zan($user_id){
        return $this->hasOne(\App\Zan::class)->where('user_id',$user_id);
    }
    //赞模块的一对多关联操作(当前有多少用户已经点赞)
    public function zans(){
        return $this->hasMany(\App\Zan::class);
    }
    //手动指定表
    //protected $table = "xxxx";
    //指定不可以使用数组注入哪些字段
    //protected $guarded = [];
    //指定可以使用数组注入哪些字段
    //protected $fillable = ['title','content'];
    //做关联操作
    public function user(){
        //使用一对一模型关联将当前文章表中的创建用户和用户信息表中的对应用户做关联
        //  一般默认第二个参数就是当前表中的字段名 第三个参数就是关联的表的主键名
        return $this->belongsTo('App\User','user_id','id');
    }
    //评论模块做关联操作模型
    public function comments(){
        //使用一对多模型关联 并按照时间顺序降序排列
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }
}