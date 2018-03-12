@extends("layout.main")
{{--引入指定的视图模板--}}
@section("content")
    {{--指定将这一部分替换给视图模板中的content部分--}}
    {{--我的信息部分--}}
    <div class="col-sm-8">
        <blockquote>
            <p><img src="{{$user->avatar}}" alt="{{$user->name}}" class="img-rounded" style="border-radius:500px; height: 40px">
                {{$user->name}}
            </p>
            <footer>关注：{{$user->stars_count}}｜粉丝：{{$user->fans_count}}｜文章：{{$user->posts_count}}</footer>
            {{--将公共关注组件引入并传值 值是目标用户信息 用于传值的第二个参数是数组--}}
            @include('user.badges.like',['target_user'=>$user])
        </blockquote>
    </div>
    {{--文章，粉丝，关注模块--}}
    <div class="col-sm-8 blog-main">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
            </ul>
            <div class="tab-content">
                {{--文章模块--}}
                <div class="tab-pane active" id="tab_1">
                    @foreach($posts as $post)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class=""><a href="/user/{{$post->user->id}}"> {{$post->user->name}} </a> 创建于  {{$post->created_at->diffForHumans()}}</p>
                            <p class=""><a href="/posts/{{ $post->id }}" >{{ $post->title }}</a></p>
                        </div>
                    @endforeach
                </div>
                {{--关注模块--}}
                <div class="tab-pane" id="tab_2">
                    @foreach($susers as $suser)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class="">{{ $suser->name }}</p>
                            <p class="">关注：{{ $suser->stars_count }} | 粉丝：{{ $suser->fans_count }}｜ 文章：{{ $suser->posts_count }}</p>
                            {{--将公共关注组件引入并传值 值是目标用户信息 用于传值的第二个参数是数组--}}
                            @include('user.badges.like',['target_user'=>$suser])
                        </div>
                    @endforeach
                </div>
                {{--粉丝模块--}}
                <div class="tab-pane" id="tab_3">
                @foreach($fusers as $fuser)
                    <div class="blog-post" style="margin-top: 30px">
                        <p class="">{{ $fuser->name }}</p>
                        <p class="">关注：{{ $fuser->stars_count }} | 粉丝：{{ $fuser->fans_count }}｜ 文章：{{ $fuser->posts_count }}</p>
                        {{--将公共关注组件引入并传值 值是目标用户信息 用于传值的第二个参数是数组--}}
                        @include('user.badges.like',['target_user'=>$fuser ])
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection