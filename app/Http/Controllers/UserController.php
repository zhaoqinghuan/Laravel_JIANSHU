<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
//  引入User表的模型文件
use App\User;
class UserController extends Controller
{
    //  个人中心页面
    public function show(){
        return view('user.show');
    }
    //添加关注
    public function fan(){

    }
    //取消关注
    public function unfan(){

    }
    //  个人设置行为
    public function settingStore(Request $request){
        //验证
        $this->validate(\request(),[
            'name'      =>  'required|min:3',
        ],[
            'name.required'=>'账户名必须填写',
            'name.min'=>'账户名最短填写三位',
        ]);
        //逻辑
        //  取提交过来的name数据
        $name = \request('name');
        //  取当前登录的用户数据
        $user = \Auth::user();
        //判断当前登录的用户是否和正在修改的用户是同一人
        if($name != $user->name){
            //判断新name是否已经被注册
            if(User::where('name',$name)->count() >0 ){
                return back()->withErrors('该用户名已被注册');
            }
            $user->name = $name;
        }
        //判断当前是否上传了头像
        if($request->file('avatar')){
            //保存用户头像使用当前用户的id作为名称
            $path = $request->file('avatar')->storePublicly($user->id);
            $user->avatar = "/storage/".$path;
        }
        $user->save();
        //渲染
        return back();
    }
    //  个人设置页面
    public function setting(){
        //获取当前登录人信息并传给视图
        $user = \Auth::user();
        return view('user.setting',compact('user'));
    }
}