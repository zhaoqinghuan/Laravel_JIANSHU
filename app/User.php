<?php
namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable{
    protected $fillable =[
        'name','email','password'
    ];
    //  用户收到的通知
    public function notices(){
        //  因为一个用户收到多个通知 一个通知同时对应多个用户 所以是多对多的关系
        // belongsToMany 第一个参数是关联模型的模型文件 第二个参数是关联关系对应的数据表
        // 第三个参数是当前模型主键在关联表中的外键 第四个参数是关联模型文件对应表在关联关系表中的主键
        return $this->belongsToMany(\App\Notice::class,'user_notice',
            'user_id','notice_id')->withPivot(['user_id','notice_id']);
    }
    //  用户增加通知
    public function addNotices($notices){// 传进来一个notices对象
        //  直接调用对象notices对象执行一个通知添加的方法
        return $this->notices()->save($notices);
    }

    //  用户的文章列表
    public function posts(){
        //一个用户有多篇文章用hasMany 第一个参数关联对象的命名空间 第二个参数关联表的外键 第三个参数当前表的主键
        return $this->hasMany(\App\Post::class, 'user_id', 'id');
    }
    //  关注我的模型
    public function fans(){
        //一个用户有多个粉丝用hasMany 第一个参数关联对象的命名空间 第二个参数关联表的外键 第三个参数当前表的主键
        return $this->hasMany(\App\Fan::class, 'star_id', 'id');
    }
    //  我关注的模型
    public function stars(){
        //一个用户关注多个用户用hasMany 第一个参数关联对象的命名空间 第二个参数关联表的外键 第三个参数当前表的主键
        return $this->hasMany(\App\Fan::class, 'fan_id', 'id');
    }
    //  关注某人操作
    public function doFan($uid){
        $fan = new \App\Fan();
        $fan->star_id = $uid;
        //在我关注的人的模型中添加一条记录
        return $this->star()->save($fan);
    }
    //  取消关注
    public function doUnFan($uid){
        $fan = new \App\Fan();
        $fan->star_id = $uid;
        //在我关注的人的模型中删除一条记录
        return $this->star()->delete($fan);
    }
    //  当前用户是否被UID关注
    public function hasFan($uid){
        //在fans表里查询一条fan_id=$uid的数据
        return $this->fans()->where('fan_id', $uid)->count();
    }
    //  当前用户是否关注了UID
    public function hasStar($uid){
        //在fans表里查询一条star_id=uid的数据
        return $this->fan()->where('star_id',$uid)->count();
    }
}