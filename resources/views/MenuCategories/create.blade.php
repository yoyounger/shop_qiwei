@extends('default')
@section('contents')
    <h2>添加菜品分类</h2>
    @include('_errors')
    <br>
    <br>
    <form action="{{route('menucategories.store')}}" method="post">
        <table class="table table-bordered">
            <tr>
                <td>菜品分类名</td>
                <td><input type="text" name="name" class="form-control" value="{{old('name')}}"></td>
            </tr>

            <tr>
                <td>是否默认菜品</td>
                <td>
                     <input type="checkbox" value="1" name="is_selected" id="yes">&emsp;
                    <label for="yes"><span style="color: red">("✔"为是,否则为否)</span></label>
                </td>
            </tr>
            <tr>
                <td>描述</td>
                <td><input type="text" name="description" class="form-control" value="{{old('description')}}"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="btn btn-primary">提交</button></td>
            </tr>
            {{csrf_field()}}
        </table>
    </form>
    @stop