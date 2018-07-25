@extends('default')
@section('contents')
    <h2>相关活动</h2>
    <table class="table table-bordered table-hover" style="text-align: center">
        <tr>
            <th style="text-align: center">ID</th>
            <th style="text-align: center">活动标题</th>
            <th style="text-align: center">开始时间</th>
            <th style="text-align: center">结束时间</th>
            <th style="text-align: center">查看</th>
        </tr>
        @foreach($activities as $activity)
        <tr>
            <td>{{$activity->id}}</td>
            <td>{{$activity->title}}</td>
            <td>{{substr($activity->start_time,0,16)}}</td>
            <td>{{substr($activity->end_time,0,16)}}</td>
            <td>
                        <a href="{{route('activities.show',[$activity])}}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>
            </td>
        </tr>
            @endforeach
    </table>
    @endsection