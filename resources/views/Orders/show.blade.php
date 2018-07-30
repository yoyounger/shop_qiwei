@extends('default')
@section('contents')
    <h2>订单详情</h2>
    <br>
    <br>
    <div>
        <span style="font-size: 20px;">订单编号:{{$order->sn}}</span>
        <span style="float: right;font-size: 20px;">创建订单时间:{{substr($order->created_at,0,16)}}</span>
    </div>

    <br>
    <table class="table table-bordered" style="text-align: center;">
        <tr>
            <th style="text-align: center">客户姓名</th>
            <th style="text-align: center">客户电话</th>
            <th style="text-align: center">收货地址</th>
        </tr>
        <tr>
            <td>{{$order->name}}</td>
            <td>{{$order->tel}}</td>
            <td>{{$order->province.$order->city.$order->county.$order->address}}</td>
        </tr>
    </table>
        <table class="table table-bordered"  style="text-align: center;">
            <tr>
                <th style="text-align: center">商品ID</th>
                <th style="text-align: center">商品名称</th>
                <th style="text-align: center">商品图片</th>
                <th style="text-align: center">商品单价</th>
                <th style="text-align: center">订单数量</th>
            </tr>
            @foreach($order_goods as $order_good)
            <tr>
                <td>{{$order_good->goods_id}}</td>
                <td>{{$order_good->goods_name}}</td>
                <td><img src="{{$order_good->goods_img}}" alt=""></td>
                <td>{{$order_good->goods_price}}</td>
                <td>{{$order_good->amount}}</td>
            </tr>
                @endforeach
        </table>
    <div style="float: right">
        <h3>订单状态:@if($order->status == 0) 待支付 @elseif($order->status == 1)待发货@elseif($order->status == -1)已取消@elseif($order->status == 2)待确认@elseif($order->status == 3)完成@endif</h3>
        <h3>共计金额:{{$order->total}}元</h3>

    </div>

    @stop