@extends('default')
@section('contents')
    @include('_errors')
    <h2>本店订单统计</h2>
    <br>
    <span>今日销量:{{$day_count}}</span>
    <span style="margin-left:300px">本月销量:{{$menu->month_sales}}</span>
    <span style="float: right">累计销量:{{$total_count}}</span>
    <br>
    <br>
    <table class="table table-bordered" style="text-align: center">
        <tr>
            <th style="text-align: center"></th>
            <th style="text-align: center">统计操作</th>
            <th style="text-align: center">统计数量</th>
        </tr>
        <tr>
            <td>按具体日期统计</td>
            <td>
                <form action="{{route('menus.show',[$menu])}}" method="get">
                    <input type="date" name="day" style="height: 34px" value="{{$day_date}}">
                    <button type="submit" class="btn btn-success">统计</button>
            </td>
            <td>{{$day}}</td>
        </tr>
        <tr>
            <td>按月份统计</td>
            <td>
                <input type="month" name="month" style="height: 34px" value="{{$month_date}}">
                <button type="submit" class="btn btn-success">统计</button>

                </form>
            </td>
            <td>{{$month}}</td>
        </tr>
    </table>
    <br>
    <h2>菜品详情</h2>
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