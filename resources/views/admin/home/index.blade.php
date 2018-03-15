{{--使用extends关键字引入模板框架--}}
@extends("admin.layout.main")
{{--首页内容部分--}}
@section("content")
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                欢迎,这是首页
            </div>
        </div>
    </section>
@endsection
