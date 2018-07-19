@extends('default')
@section('contents')
    <h1>商家登录</h1>
    @include('_errors')
    <br>
    <br>
    <br>
    <form action="{{route('login')}}" method="post">
        <div class="form-group">
            <label for="">账户名</label>
            <input type="text" name="name" placeholder="账户名" class="form-control" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="">密码</label>
            <input type="password" name="password" placeholder="密码" class="form-control" value="{{old('password')}}">
        </div>
        <div class="form-group">
            <label for="">验证码</label>
        <input id="captcha" class="form-control" name="captcha" >
        <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default?'+Math.random()" title="点击图片重新获取验证码">
        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="remember"> 记住我</label>
        </div>
        {{csrf_field()}}
        <button class="btn btn-info btn-block">登录</button>
    </form>
@stop