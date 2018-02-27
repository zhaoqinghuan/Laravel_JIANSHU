{{--错误提示部分独立出来作为模块进行引入--}}
@if(count($errors) >0)
    <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif