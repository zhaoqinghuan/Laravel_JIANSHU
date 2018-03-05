<?php

namespace App\Policies;
//引入关联的模型
use App\User;
use App\Post;

use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    //  自定义文章更新的策略方法 在方法中引入两个关联模型
    public function update(User $user,Post $post){
        return $user->id == $post->user_id;
    }
    //  自定义文章删除的策略方法 在方法中引入两个关联的模型
    public function delete(User $user,Post $post){
        return $user->id == $post->user_id;
    }
}
