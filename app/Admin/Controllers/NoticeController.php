<?php
namespace App\Admin\Controllers;
use Illuminate\Http\Request;
class NoticeController extends Controller
{
    //  通知列表页
    public function index(){
        //将所有的通知查出来不分页展示
        $notices = \App\Notice::all();
        return view('admin.notice.index',compact('notices'));
    }
    //  通知创建页
    public function create(){
        return view('admin.notice.create');
    }
    //  通知创建行为
    public function store(){
        //  验证
        $this->validate(\request(),[
            'title'=>'required|string',
            'content' =>'required|string'
        ]);
        //  逻辑
        $notice = \App\Notice::create(\request(['title','content']));
            //  调用内容分发的任务注入
            dispatch(new \App\Jobs\SeedMessage($notice));

        //  渲染
        return redirect('/admin/notices');
    }
}