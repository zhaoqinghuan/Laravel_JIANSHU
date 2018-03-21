<?php
namespace App\Admin\Controllers;
use Illuminate\Http\Request;
class TopicController extends Controller
{
    //  专题列表页
    public function index(){
        //将所有的专题查出来不分页展示
        $topics = \App\Topic::all();
        return view('admin.topic.index',compact('topics'));
    }
    //  专题创建页
    public function create(){
        return view('admin.topic.create');
    }
    //  专题创建行为
    public function store(){
        //  验证
        $this->validate(\request(),[
            'name'=>'required|string'
        ]);
        //  渲染
        \App\Topic::create(['name'=>\request('name')]);
        //  逻辑
        return redirect('/admin/topics');
    }
    //  专题删除行为
    public function destroy(\App\Topic $topic){
        //因为资源类型的delete方法有参数绑定故需要模型绑定
        $topic->delete();
        return [
            'error' => 0,
            'msg' => '',
        ];
    }
}