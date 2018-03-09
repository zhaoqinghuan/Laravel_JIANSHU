<?php
namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable{
    protected $fillable =[
        'name','email','password'
    ];
    //  用户的文章列表
    public function posts(){
        //一个用户有多篇文章用hasMany 第一个参数关联对象的命名空间 第二个参数关联表的外键 第三个参数当前表的主键
        return $this->hasMany(\App\Post::class,'user_id','id');
    }
    //  关注我的模型
    public function fan(){
        //一个用户有多个粉丝用hasMany 第一个参数关联对象的命名空间 第二个参数关联表的外键 第三个参数当前表的主键
        return $this->hasMany(\App\Fan::class,'star_id','id');
    }
    //  我关注的模型
    public function star(){
        //一个用户关注多个用户用hasMany 第一个参数关联对象的命名空间 第二个参数关联表的外键 第三个参数当前表的主键
        return $this->hasMany(\App\Fan::class,'fan_id','id');
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
        return $this->fan()->where('fan_id',$uid)->count();
    }
    //  当前用户是否关注了UID
    public function hasStar($uid){
        //在fans表里查询一条star_id=uid的数据
        return $this->fan()->where('star_id',$uid)->count();
    }
}