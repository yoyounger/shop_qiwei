@extends('default')
@section('contents')
    <h2>菜品详情</h2>
    @include('_errors')
    <br>
    <br>
        <table class="table table-bordered">
            <tr>
                <td style="font-weight: bold">名称</td>
                <td>{{$menu->goods_name}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold">菜品分类</td>
                <td>{{$menu->category->name}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold">价格</td>
                <td>{{$menu->goods_price}}元</td>
            </tr>
            <tr>
                <td style="font-weight: bold">商品图片</td>
                <td><img src="{{$menu->goods_img}}" alt="" width="100px"></td>
            </tr>
            <tr>
                <td style="font-weight: bold">评分</td>
                <td>{{$menu->rating}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold">月销量</td>
                <td>{{$menu->month_sales}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold">评分数量</td>
                <td>{{$menu->rating_count}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold">满意度数量</td>
                <td>{{$menu->satisfy_count}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold">满意度评分</td>
                <td>{{$menu->satisfy_rate}}</td>
            <tr>
                <td style="font-weight: bold">描述</td>
                <td>{{$menu->description}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold">提示信息</td>
                <td>{{$menu->tips}}</td>
            </tr>
        </table>
    @stop