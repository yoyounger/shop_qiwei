@extends('default')
@section('contents')
    <h2>修改菜品</h2>
    @include('_errors')
    <br>
    <br>
    <form action="{{route('menus.update',[$menu])}}" method="post" enctype="multipart/form-data">
        <table class="table table-bordered">
            <tr>
                <td>名称</td>
                <td><input type="text" name="goods_name" class="form-control" value="{{$menu->goods_name}}" placeholder="必填"></td>
            </tr>
            <tr>
                <td>菜品分类</td>
                <td>
                    <select name="category_id" id="" class="form-control" >
                        <option value="">请选择</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}" @if($category->id == $menu->category_id) selected @endif>{{$category->name}}</option>
                            @endforeach
                    </select>
            </tr>
            <tr>
                <td>价格</td>
                <td>
                    <input type="number" name="goods_price" class="form-control" placeholder="必填" value="{{$menu->goods_price}}">
                </td>
            </tr>
            <tr>
                <td>商品图片</td>
                <td>
                    <input type="file" name="goods_img" >
                    <img src="{{$menu->goods_img}}" alt="" width="100px">
                </td>
            </tr>
            <tr>
                <td>描述</td>
                <td>
                    <input type="text" name="description" class="form-control" value="{{$menu->description}}" placeholder="可不填" >
                </td>
            </tr>
            <tr>
                <td>提示信息</td>
                <td>
                    <input type="text" name="tips" class="form-control" value="{{$menu->tips}}" placeholder="可不填">
                </td>
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