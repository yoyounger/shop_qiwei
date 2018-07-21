@extends('default')
@section('contents')
    <h2>修改菜品分类</h2>
    @include('_errors')
    <br>
    <br>
    <form action="{{route('menucategories.update',[$menucategory])}}" method="post">
        <table class="table table-bordered">
            <tr>
                <td>菜品分类名</td>
                <td><input type="text" name="name" class="form-control" value="{{$menucategory->name}}"></td>
            </tr>
            <tr>
                <td>描述</td>
                <td><input type="text" name="description" class="form-control" value="{{$menucategory->description}}"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="btn btn-primary">保存</button></td>
            </tr>
            {{csrf_field()}}
            {{method_field('PATCH')}}
        </table>
    </form>
    @stop