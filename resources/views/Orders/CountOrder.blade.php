@extends('default')
@section('contents')
    <h2>本店订单统计</h2>
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
                <form action="{{route('CountOrder')}}" method="get">
                    <input type="date" name="day" style="height: 34px" value="{{$day_date}}">
                    <button type="submit" class="btn btn-success">统计</button>
            </td>
            <td>{{$day}}</td>
        </tr>
        <tr>
            <td>按月份统计</td>
            <td>
                {{--<form action="{{route('CountOrder')}}" method="get">--}}
                    <input type="month" name="month" style="height: 34px" value="{{$month_date}}">
                    <button type="submit" class="btn btn-success">统计</button>

                </form>
            </td>
            <td>{{$month}}</td>
        </tr>
    </table>
    <br>
    <br>
    <span>今日订单:{{$day_count}}</span>
    <span style="margin-left:300px">本月订单:{{$month_count}}</span>
    <span style="float: right">累计订单:{{$total_count}}</span>
@stop