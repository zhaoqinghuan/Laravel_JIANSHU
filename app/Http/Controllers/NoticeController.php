<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
//  绑定模型
use App\Notice;
class NoticeController extends Controller
{
    //  通知列表展示
    public function index(){
        //  查询当前用户所接受到的通知
        $user = \Auth::user();
        //  关联模型中查询当前用户接收到的通知
        $notices = $user->notices;
        return view('notice.index',compact('notices'));
    }
}
