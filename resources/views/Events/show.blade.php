@extends('default')
@section('contents')
    <h2>抽奖活动详情</h2>
    <br>
    <br>
    <br>
    <table class="table table-bordered">
        <tr>
            <td>活动名称</td>
            <td>
                {{$event->title}}
            </td>
        </tr>
        <tr>
            <td>人数限制</td>
            <td>
                {{$event->signup_num}}
            </td>
        </tr>
        <tr>
            <td>报名开始时间</td>
            <td>
                {{date('Y-m-d H:i:s',$event->signup_start)}}
            </td>
        </tr>
        <tr>
            <td>报名结束时间</td>
            <td>
                {{date('Y-m-d H:i:s',$event->signup_end)}}
            </td>
        </tr>
        <tr>
            <td>开奖时间</td>
            <td>
                {{$event->prize_date}}
            </td>
        </tr>
        <tr>
            <td>活动详情</td>
            <td>
                {!! $event->content !!}
            </td>
        </tr>
        <tr>
            <td>是否开奖</td>
            <td>   {{$event->is_prize?'已开奖':'未开奖'}}

            </td>
        </tr>
    </table>
    <table class="table table-bordered" style="text-align: center">
        <tr>
            <th style="text-align: center">奖品名称</th>
            <th style="text-align: center">奖品详情</th>
        </tr>
        @foreach($eventprizes as $eventprize)
            <tr>
                <td>{{$eventprize->name}}</td>
                <td>{{$eventprize->description}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2">
                @if($res)
                   <span style="font-weight: bold;color: red">您已经报名该抽奖活动!!!</span>
                @elseif($status==1)
                    <span style="font-weight: bold;color: red">该活动报名已满,请关注其他的抽奖活动!!!</span>
                    @else
                <a href="{{route('apply',[$event->id])}}" class="btn btn-success">我要报名</a>
            @endif
            </td>
        </tr>
    </table>
@stop