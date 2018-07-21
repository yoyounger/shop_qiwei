@extends('default')
@section('contents')
    <h2>修改个人资料</h2>
    @include('_errors')
    <br>
    <br>
    <form action="{{route('mydata')}}" method="post" enctype="multipart/form-data">
        <table class="table table-bordered">

            <tr>
                <td>用户名</td>
                <td>
                    <input type="text" name="name" class="form-control" value="{{$user->name}}">
                </td>
            </tr>
            <tr>
                <td>邮箱</td>
                <td>
                    <input type="text" name="email" class="form-control" value="{{$user->email}}">
                </td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="btn btn-primary">保存</button></td>
            </tr>
            {{csrf_field()}}
        </table>
    </form>
    @stop