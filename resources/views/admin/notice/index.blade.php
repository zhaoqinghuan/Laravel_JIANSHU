@extends("admin.layout.main"){{--引入公共部分主框架--}}
@section("content")
    {{-- 通知列表页内容部分 --}}
    <section class="content">
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">通知列表</h3>
                    </div>
                    <a type="button" class="btn " href="/admin/notices/create">增加通知</a>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>通知名称</th>
                                <th>操作</th>
                            </tr>
                            @foreach($notices as $notice)
                            <tr>
                                <td>{{$notice->id}}</td>
                                <td>{{$notice->title}}</td>
                                <td></td>
                            </tr>
                                @endforeach
                            </tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection