<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>奇味--商户端</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!--css-->
    @yield('css_files')
    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="/js/jquery-3.2.1.js"></script>

    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="/js/bootstrap.min.js"></script>
    <!--js-->
    @yield('js_files')
</head>
<body>

@include('_nav')

<div class="row container-fluid" >
    <div class="list-group col-xs-2" id="mya">
        <a href="{{route('CountMenu')}}" class="list-group-item">我的菜品销量</a>
        <a href="{{route('shows')}}" class="list-group-item">我的商铺信息</a>
        <a href="{{route('menucategories.index')}}" class="list-group-item">我的菜品分类</a>
        <a href="{{route('menus.index')}}" class="list-group-item">我的店铺菜品</a>
        <a href="{{route('orders.index')}}" class="list-group-item">我的店铺订单</a>
        <a href="{{route('activities.index')}}" class="list-group-item">平台相关活动</a>
    </div>
    <div class="col-xs-1">
    </div>
    <div class="col-xs-8">
        @include('_messages')
        @yield('contents')
    </div>

</div>

@yield('js')
<script>
    $(function () {
        $('#mya').on('click','a',function () {
            $(this).removeClass('list-group-item')
            $(this).addClass('list-group-item active')

        })
    })
</script>
@include('_footer')