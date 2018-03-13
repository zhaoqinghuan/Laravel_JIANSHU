<?php
namespace App;
use App\Model;
//引入LaravelScout扩展类
use Laravel\Scout\Searchable;
// 引入Builder扩展类
use Illuminate\Database\Eloquent\Builder;
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
    //  创建文章和专题表的关联模型
    public function postTopics(){
        //文章和专题的关联关系是是个一对多的关联关系 故使用hasMany()方法
        return $this->hasMany(\App\PostTopic::class, 'post_id');
    }
    //  不属于某个专题的文章
    public function scopeTopicNotBy(Builder $query, $topic_id){
        //Scope模型的命名必须为 scopeXxxx
        //第一个参数必须是builder模型 第二个参数为专题ID
        return $query->doesntHave('postTopics', 'and', function($q) use ($topic_id) {
            //使用doesntHave方法来查询 第一个参数必须为一个关系模型 第二个参数是and或者or
            //第三个参数为一个回调函数及对这个模型的判断有哪些条件
            //在模型方法的函数使用一个参数必须使用use()将参数传入
            $q->where("topic_id", $topic_id);
            //因为我们需要传递的是文章不在专题中所以在这里要把文章在专题中的数据都查出来
        });
    }

    //  属于当前作者的Scope模型
    public function scopeAuthorBy(Builder $query, $user_id){
        //Scope模型的命名必须为 scopeXxxx
        //第一个参数必须是builder模型 第二个参数为传递进来的作者ID
        return $query->where('user_id', $user_id);
        //返回一个builder模型的查询结果集为文章表的user_id = 传进来的某个用户的ID
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