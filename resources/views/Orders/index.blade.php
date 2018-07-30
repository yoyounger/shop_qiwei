@extends('default')
@section('contents')
    <h2>本店订单</h2>
    <br>
    <br>
    <a href="{{route('CountOrder')}}" class="btn btn-success">本店订单统计</a>
    <table class="table table-bordered" style="text-align: center">
        <tr>
            <th style="text-align: center">订单编号</th>
            <th style="text-align: center">客户姓名</th>
            <th style="text-align: center">电话</th>
            <th style="text-align: center">地址</th>
            <th style="text-align: center">总价</th>
            <th style="text-align: center">订单状态</th>
            <th style="text-align: center">操作</th>
        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{$order->sn}}</td>
                <td>{{$order->name}}</td>
                <td>{{$order->tel}}</td>
                <td>{{$order->address}}</td>
                <td>{{$order->total}}元</td>
                <td>@if($order->status == 0) 待支付 @elseif($order->status == 1)待发货@elseif($order->status == -1)已取消@elseif($order->status == 2)待确认@elseif($order->status == 3)完成@endif</td>
                <td>
                    <div class="row">
                        <div class="col-xs-2">
                            <a href="{{route('orders.show',[$order])}}" class="btn btn-info">查看</a>
                        </div>
                        @if($order->status != 2 && $order->status != 3 &&$order->status != -1)
                        <div class="col-xs-2" style="margin-left: 5px">
                            <a href="{{route('send',[$order])}}" class="btn btn-warning">发货</a>
                        </div>

                        <div class="col-xs-2" style="margin-left: 5px">
                            <a href="{{route('giveup',[$order])}}" class="btn btn-danger">取消订单</a>
                        </div>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
    </table>
    {{$orders->links()}}
@stop