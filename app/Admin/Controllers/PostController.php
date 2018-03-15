<?php
namespace App\Admin\Controllers;

//  模型引入
use \App\Post;
class PostController extends Controller{

    //  文章审核页面
    public function index(){
        $posts = Post::withoutGlobalScope('avaiable')->where('status',0)
            ->orderBy('created_at','desc')->paginate(10);
        /*
          因为这个方法同样继承了POST模型 但是在这里不能只显示status字段非0的数据
          所以在这里post使用withoutGlobalScope方法来过滤掉这个scope函数
        */
        return view('admin.post.index',compact('posts'));
    }
    //  文章审核操作
    public function status(Post $post){//模型绑定
        //  验证
        $this->validate(request(), [
            "status" => 'required|in:1,-1',
        ]);
        //  逻辑
        $post->status = request('status');//将当前文章的statu赋值给status
        $post->save();//执行保存操作
        //  渲染
        return [
            'error' => 0,
            'msg' => ''
        ];
    }
}