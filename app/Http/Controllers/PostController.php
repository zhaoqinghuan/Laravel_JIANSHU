<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
//引入模型文件
use App\Post;
use App\Comment;
use App\Zan;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    //列表页面
    public function index(){
        //按照时间顺序将所有的文章查询出来
        //$posts = Post::orderby('created_at','desc')->get();
        //按照时间顺序将所有的文章查询出来并进行分页
        $posts = Post::orderby('created_at','desc')
            ->withCount(['comments','zans'])->paginate(10);
        return view("post/index",compact('posts'));
    }

    //赞
    public function zan(Post $post){
        $param = [
            'user_id' => \Auth::id(),   //当前登录的用户ID
            'post_id' => $post->id,     //当前操作的文章ID
        ];

        Zan::firstOrCreate($param);//使用Zan模型调用firstOrCreate操作
                //firstOrCreate() 如果存在这个数据就查找出来 如果不存在这个数据就创建这个数据

        return back();
    }

    //取消赞
    public function unzan(Post $post){
        //直接调用关联模型将数据删除
        $post->zan(\Auth::id())->delete();
        return back();
    }
    //详情页面
    public function show(Post $post){//因为这里在路由文件中已经进行过绑定模型的操作所以直接写回调的方法即刻
        $post->load('comments');//应用预加载进行评论查询
        return view("post/show",compact('post'));
    }

    //评论逻辑
    public function comment(Post $post){
        //验证
        $this->validate(\request(),[
            'content'=>'required|min:3'
        ],[
            'content.required' => '评论内容必须填写',
            'content.min' => '评论内容至少需要3个字符',
        ]);
        //逻辑
        $comment = new Comment();//实例化comment模型类
        $comment->user_id = \Auth::id();//获取当前登录的用户ID
        $comment->content = \request('content');//获取提交过来的内容
        $post->comments()->save($comment);  //调用save方法直接进行保存
        //渲染
        return back();//直接返回之前页面
    }
    //创建页面
    public function create(){
        return view("post/create");
    }
    //创建逻辑
    public function store(){
        //验证表单提交数据第一个参数是需要验证的数据可以为数组 第二个参数是验证条件 第三个参数是错误信息
        $this->validate(\request(),[
            'title' => 'required|string|max:100|min:10',
            'content' => 'required|string|min:10',
        ],[
            'title.min'=>'文章标题过短',
            'title.max'=>'文章标题过长',
            'title.required'=>'文章标题必须填写',
            'content.required'=>'文章内容必须填写',
            'content.min'=>'文章内容过短',

        ]);
        //获取所有请求过来的对象信息
        //dd(\request()->all());
        //获取当前登录的用户ID信息
        $user_id = \Auth::id();
        //存储传递过来的参数以及当前登录的用户信息
        $params = array_merge(request(['title','content']),compact('user_id'));
        $post = Post::create($params);
        //数据存储完成后页面重定向到文章列表页
        return redirect("/posts");
    }
    //编辑页面
    public function edit(Post $post){
        return view("post/edit",compact('post'));
    }
    //编辑逻辑
    public function update(Post $post){
        //验证
        //  表单输入验证
        $this->validate(\request(),[
            'title' => 'required|string|max:100|min:10',
            'content' => 'required|string|min:10',
        ],[
            'title.min'=>'文章标题过短',
            'title.max'=>'文章标题过长',
            'title.required'=>'文章标题必须填写',
            'content.required'=>'文章内容必须填写',
            'content.min'=>'文章内容过短',

        ]);
        //  权限验证 第一个参数对应当前的操作 第二个参数对应当前编辑的参数
        $this->authorize('update',$post);
        //逻辑
        $post->title = \request('title');
        $post->content = \request('content');
        $post->save();
        //渲染 跳转到文章详情页面
        return redirect("/posts/{$post->id}");
    }
    //删除逻辑
    public function delete(Post $post){
        //验证
        //  权限验证 第一个参数对应当前的操作 第二个参数对应当前编辑的参数
        $this->authorize('delete',$post);
        //逻辑
        $post->delete();
        //渲染 跳转到文章列表页
        return redirect('/posts');
    }

    //图片上传的方法
    public function imageUpload(Request $request){
        //调用图片上传的方法 "上传图片的输入框名为wangEditorH5File  将图重命名为md5格式的当前时间戳"
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time().rand(000,999)));
        return asset('storage/'.$path);
    }
}
