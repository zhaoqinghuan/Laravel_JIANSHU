@extends("layout.main")
{{--引入指定的视图模板--}}
@section("content")
    {{--指定将这一部分替换给视图模板中的content部分--}}
    {{--我的信息部分--}}
    <div class="col-sm-8">
        <blockquote>
            <p><img src="http://127.0.0.1:8000/storage/1/SzC3QpTvrN3RyIGfphiBzTxfZaDqfQgJq4wE23Rs.jpeg" alt="" class="img-rounded" style="border-radius:500px; height: 40px"> Kassandra Ankunding2
            </p>
            <footer>
                关注：4｜粉丝：0｜文章：9</footer>
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
                    <div class="blog-post" style="margin-top: 30px">
                        <p class=""><a href="/user/5">Kassandra Ankunding2</a> 1周前</p>
                        <p class=""><a href="/posts/58" >自动放大舒服的撒</a></p>
                        <p>我们坚持一个中国我们坚持一个中国我们坚持一个中国我们坚持一个中国我们坚持一个中国我们坚持一个中国我们...</p>
                    </div>
                </div>
                {{--关注模块--}}
                <div class="tab-pane" id="tab_2">
                    <div class="blog-post" style="margin-top: 30px">
                        <p class="">Jadyn Medhurst Jr.</p>
                        <p class="">关注：1 | 粉丝：1｜ 文章：0</p>
                        <div>
                            <button class="btn btn-default like-button" like-value="1" like-user="6" _token="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy" type="button">取消关注</button>
                        </div>
                    </div>
                </div>
                {{--粉丝模块--}}
                <div class="tab-pane" id="tab_3">
                    <div class="blog-post" style="margin-top: 30px">
                        <p class="">Jadyn Medhurst Jr.</p>
                        <p class="">关注：1 | 粉丝：1｜ 文章：0</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection