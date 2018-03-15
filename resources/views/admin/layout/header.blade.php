{{--公共头部--}}
<header class="main-header">
    <a href="/adminlte/index2.html" class="logo">
        <span class="logo-mini"></span>
        <span class="logo-lg">后台管理</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="/adminlte/#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="/adminlte/#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">当前登录的用户是：</span>
                        {{-- 修改后台当前登录用户的用户名 --}}
                        <span class="hidden-xs">{{\Auth::guard("admin")->user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-footer">
                            <div class="pull-right">
                                {{-- 登出按钮 --}}
                                <a href="/admin/logout" class="btn btn-default btn-flat">登出</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>