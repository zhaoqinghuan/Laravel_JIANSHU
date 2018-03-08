@extends("layout.main")
{{--引入指定的视图模板--}}
@section("content")

    {{--指定将这一部分替换给视图模板中的content部分--}}
        <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <div style="display:inline-flex">
                    <h2 class="blog-post-title">{{$post->title}}</h2>
                        {{--对编辑按钮做权限验证--}}
                        @can('update',$post)
                            <a style="margin: auto"  href="/posts/{{$post->id}}/edit">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>
                        @endcan
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        {{--对删除按钮做权限验证--}}
                        @can('delete',$post)
                            <a style="margin: auto"  href="/posts/{{$post->id}}/delete">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </a>
                        @endcan
                </div>
                <p class="blog-post-meta">{{$post->created_at->toFormattedDateString()}}
                    <a href="#">{{ $post->user->name }}</a></p>
                {{--{!! !!}方法的作用是过滤HTMl标签后进行展示 --}}
                <p>{!! $post->content !!}</p>
                <div>
                    {{-- 赞模块 --}}
                    @if($post->zan(\Auth::id())->exists())
                    <a href="/posts/{{$post->id}}/unzan" type="button" class="btn btn-default btn-lg">取消赞</a>
                    @else
                    <a href="/posts/{{$post->id}}/zan" type="button" class="btn btn-primary btn-lg">赞</a>
                    @endif
                </div>
            </div>
            {{-- 评论展示 --}}
            <div class="panel panel-default">
                <div class="panel-heading">评论</div>
                <ul class="list-group">
                    {{-- 这里轮询的数据来源是控制器中的预加载数据 --}}
                    @foreach($post->comments as $comment)
                    <li class="list-group-item">
                        <h5>{{ $comment->created_at }} by {{ $comment->user->name }}</h5>
                        <div>
                            {{ $comment->content }}
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            {{-- 发表评论 --}}
            <div class="panel panel-default">
                <div class="panel-heading">发表评论</div>
                <ul class="list-group">
                    <form action="/posts/{{$post->id}}/comment" method="post">
                        {{ csrf_field() }}
                        <li class="list-group-item">
                            <textarea name="content" class="form-control" rows="10"></textarea>
                            @include('layout.errors')
                            <button class="btn btn-default" type="submit">提交</button>
                        </li>
                    </form>
                </ul>
            </div>

        </div>
@endsection
