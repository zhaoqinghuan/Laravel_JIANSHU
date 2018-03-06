@extends("layout.main")
{{--引入指定的视图模板--}}
@section("content")
    {{--指定将这一部分替换给视图模板中的content部分--}}
    <div class="col-sm-8 blog-main">
        <form class="form-horizontal" action="/user/me/setting" method="POST" enctype="multipart/form-data">
            {{--CsrfToken--}}
            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-10">
                    <input class="form-control" name="name" type="text" value="{{ $user->name }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">头像</label>
                <div class="col-sm-2">
                    <input class=" file-loading preview_input" type="file" value="头像" style="width:220px" name="avatar">
                    <img  class="preview_img" src="{{ $user->avatar }}" alt="" class="img-rounded" style="border-radius:500px;">
                </div>
            </div>
            {{--引入错误提示信息--}}
            @include('layout.errors')
            <button type="submit" class="btn btn-default">修改</button>
        </form>
        <br>
    </div>
@endsection