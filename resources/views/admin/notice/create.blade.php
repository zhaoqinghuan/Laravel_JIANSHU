@extends("admin.layout.main"){{--引入公共部分主框架--}}
@section("content")
    {{-- 通知新增页内容部分 --}}
    <section class="content">
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">增加通知</h3>
                        </div>
                        <form role="form" action="/admin/notices" method="POST">
                            {{-- CSRF--}}
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">标题</label>
                                    <input type="text" class="form-control" name="title">
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">内容</label>
                                    <textarea class="form-control" name="content"></textarea>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection