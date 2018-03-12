{{--创建用于关注和取消关注的公共页面模板组件--}}
{{--如果当前登录用户的ID不等于当前登录用户的ID才显示这个关注部分--}}
@if($target_user->id!=\Auth::id())
    <div>
        {{--如果当前用户已经关注了目标用户则显示取消关注按钮--}}
        @if($target_user->hasFan(\Auth::id()))
            <button class="btn btn-default like-button" like-value="1" like-user="{{$target_user->id}}" _token="{{csrf_token()}}" type="button">取消关注</button>
        @else
            <button class="btn btn-default like-button" like-value="0" like-user="{{$target_user->id}}" _token="{{csrf_token()}}" type="button">关注</button>
        @endif
    </div>
@endif