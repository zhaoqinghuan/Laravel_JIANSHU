<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
//引入模型绑定的topic模型
use App\Topic;
class TopicController extends Controller
{
    //创建专题展示方法
    public function show(Topic $topic){//模型绑定
        //  传递当前专题的名称及当前专题下的文章数
        $topic = Topic::withCount('postTopics')->find($topic->id);
        //  传递当前专题下按时间倒序排列的十条文章
        $posts = $topic->posts()->orderBy('created_at', 'desc')->with(['user'])->take(10)->get();
        //  传递当前登录用户的未投稿文章
        $myposts = \App\Post::authorBy(\Auth::id())->topicNotBy($topic->id)->get();
        return view('topic.show',compact('topic','posts','myposts'));
    }

    //创建专题投稿方法
    public function submit(Topic $topic){//模型绑定
        //验证
        $this->validate(\request(),[
            'post_ids'=>'required|array'
        ],[
            'post_ids.required' => '提交内容必须填写',
            'post_ids.array' => '提交内容格式无法验证',
        ]);
        //逻辑
        $post_ids = \request('post_ids');
            //  获取页面提交的参数
        $topic_id = $topic->id;
            //  获取当前主题ID
        foreach ($post_ids as $post_id){
            //  循环拿出页面提交过来的数据
            \App\PostTopic::firstOrCreate(compact('post_id','topic_id'));
            //  进行数据查找或创建 若数据表中已经有了不进行操作
        }
        //渲染
        return back();
            //  页面跳回
    }
}
