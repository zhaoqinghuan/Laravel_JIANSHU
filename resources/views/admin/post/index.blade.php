{{--使用extends关键字引入模板框架--}}
@extends("admin.layout.main")
{{--首页内容部分--}}
@section("content")
    <section class="content">
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">文章列表</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>文章标题</th>
                                <th>操作</th>
                            </tr>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id}}.</td>
                                <td>{{$post->title}}</td>
                                <td>
                                    <button type="button" class="btn btn-block btn-default post-audit"
                                            post-id="{{$post->id}}" post-action-status="1" >通过</button>
                                    <button type="button" class="btn btn-block btn-default post-audit"
                                            post-id="{{$post->id}}" post-action-status="-1" >拒绝</button>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{-- 分页--}}
                        {{$posts->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
