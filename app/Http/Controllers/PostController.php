<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class PostController extends Controller
{
    //列表页面
    public function index(){
        $posts = [
            [
                'title'=>'this is title One',
            ],
            [
                'title'=>'this is title Two',
            ],
            [
                'title'=>'this is title Three',
            ]
        ];
        return view("post/index",compact('posts'));
    }
    //详情页面
    public function show(){
        $post = [
            'title'     =>  'this is title',
            'isShow'   =>  false
        ];
        return view("post/show",compact('post'));
    }
    //创建页面
    public function create(){
        return view("post/create");
    }
    //创建逻辑
    public function store(){

    }
    //编辑页面
    public function edit(){
        return view("post/edit");
    }
    //编辑逻辑
    public function update(){

    }
    //删除逻辑
    public function delete(){

    }
}
