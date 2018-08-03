@extends('default')
@section('contents')

   <h2>抽奖活动</h2>

    <table class="table table-bordered table-hover" style="text-align: center">
        <tr>
            <th style="text-align: center">编号</th>
            <th style="text-align: center">活动名称</th>
            <th style="text-align: center">是否开奖</th>
            <th style="text-align: center">人数限制</th>
            <th style="text-align: center">开始时间</th>
            <th style="text-align: center">结束时间</th>
            <th style="text-align: center">操作</th>
        </tr>
        @foreach($events as $event)
        <tr>
            <td>{{$event->id}}</td>
            <td>{{$event->title}}</td>
            <td>
                {{$event->is_prize?'已开奖':'未开奖'}}
            </td>
            <td>{{$event->signup_num}}</td>
            <td>{{date('Y-m-d H:i',$event->signup_start)}}</td>
            <td>{{date('Y-m-d H:i',$event->signup_end)}}</td>
            <td>
                @if(!$event->is_prize)
                <div class="row">

                        <a href="{{route('events.show',[$event])}}" class="btn btn-info">查看活动详情</a>

                    @else

                            <a href="{{route('result',[$event])}}" class="btn btn-warning">查看抽奖结果</a>

                    @endif
                    </div>
            </td>

        </tr>
            @endforeach
    </table>
@endsection