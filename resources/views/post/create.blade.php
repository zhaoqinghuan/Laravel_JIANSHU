@extends("layout.main");
{{--引入指定的视图模板--}}
@section("content")
    {{--指定将这一部分替换给视图模板中的content部分--}}
    <div class="col-sm-8 blog-main">
            <form action="/posts" method="POST">
                {{--Csrf Token 防止跨站伪造请求攻击--}}
                {{csrf_field()}}
                <div class="form-group">
                    <label>标题</label>
                    <input name="title" type="text" class="form-control" placeholder="这里是标题">
                </div>
                <div class="form-group">
                    <label>内容</label>
                    <textarea id="content"  style="height:400px;max-height:500px;" name="content" class="form-control" placeholder="这里是内容"></textarea>
                </div>
                {{--引入错误信息提示模块--}}
                @include('layout.errors');
                <button type="submit" class="btn btn-default">提交</button>
            </form>
            <br>
        </div>
@endsection