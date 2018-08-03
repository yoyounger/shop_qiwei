<!--导航条-->
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">当味小外</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{route('shops.index')}}"><span class="glyphicon glyphicon-tree-conifer"></span>&emsp;首页 <span
                                class="sr-only">(current)</span></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                @guest
                <li><a href="{{route('login')}}"><span class="glyphicon glyphicon-user"></span>&emsp;登录</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">欢迎您 ! {{auth()->user()->name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('shows')}}"><span class="glyphicon glyphicon-paperclip"></span>&emsp;个人商铺中心</a></li>
                        <li><a href="{{route('setdata')}}"><span class="glyphicon glyphicon-erase"></span>&emsp;修改资料</a></li>
                        <li><a href="{{route('reset')}}"><span class="glyphicon glyphicon-scissors"></span>&emsp;修改密码</a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="{{route('logout')}}"><span class="glyphicon glyphicon-off"></span>&emsp;安全退出</a>
                        </li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<!--导航条-->