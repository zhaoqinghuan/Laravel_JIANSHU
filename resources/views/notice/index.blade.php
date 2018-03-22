@extends("layout.main")
{{--引入指定的视图模板--}}
@section("content")
    {{--展示当前用户收到的系统通知--}}
    <div class="col-sm-8 blog-main">
        @foreach($notices as $notice)
        <div class="blog-post">
            <p class="blog-post-meta">{{$notice->title}}</p>
            <p>{{$notice->content}}</p>
        </div>
            @endforeach
    </div>
@endsection