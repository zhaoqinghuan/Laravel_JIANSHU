<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
//  引入User表的模型文件
use App\User;
class UserController extends Controller
{
    //  个人中心页面
    public function show(User $user){//模型绑定
        //  传递个人信息      包含关注，粉丝，文章数
        $user = User::withCount(['stars','fans','posts'])->find($user->id);
            //使用User类的WithCount方法查询关注粉丝文章数的总数 查询id = $user->id这个用户的;
        //  个人文章列表      按照创建时间取前十条。
        $posts = $user->posts()->orderBy('created_at','desc')->take(10)->get();
            //使用User类的自定义方法（posts）按照时间顺序查询倒序的前十条
        //  个人关注列表      包括关注用户的关注，粉丝，文章数
        $stars = $user->stars;//应用user类中的stars方法查询当前用户的所有关注
        $susers = User::whereIn('id',$stars->pluck('star_id'))->withCount(['stars','fans','posts'])->get();
            //使用User类的个人信息查询方法查询ID = 当前用户的关注ID的人的关注 粉丝 文章数 总数信息
        //  个人粉丝列表      包括粉丝用户的关注，粉丝，文章数
        $fans = $user->fans;//应用user类中的fans方法查询当前用户的所有粉丝
        $fusers = User::whereIn('id',$fans->pluck('fan_id'))->withCount(['stars','fans','posts'])->get();
            //使用User类的个人信息查询方法查询ID = 当前用户的粉丝ID的人的关注 粉丝 文章数 总数信息
        return view('user.show',compact('user','posts','susers','fusers'));//输出信息
    }
    //添加关注
    public function fan(User $user){//模型绑定
        //获取当前用户
        $me = \Auth::user();
        //当前用户调用添加关注模型方法 参数为目标用户ID
        \App\Fan::firstOrCreate(['fan_id' => $me->id, 'star_id' => $user->id]);
        return [
            'error' => 0,
            'msg' => ''
        ];
    }
    //取消关注
    public function unfan(User $user){//模型绑定
        //获取当前用户
        $me = \Auth::user();
        //当前用户调用取消关注模型方法 参数为目标用户ID
        \App\Fan::where('fan_id', $me->id)->where('star_id', $user->id)->delete();
        return [
            'error' => 0,
            'msg' => ''
        ];
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