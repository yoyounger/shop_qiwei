<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventMember;
use App\Models\EventPrize;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    //抽奖活动列表
    public function index()
    {
        $events = Event::where('signup_end','>',time())->paginate(10);
        return view('Events/index',compact('events'));
    }
    //查看抽奖
    public function show(Event $event)
    {
        //已经报过名就不显示按钮
        $res = EventMember::where([['events_id',$event->id],['member_id',auth()->user()->id]])->first();
        //报名超出数量
        $num = EventMember::where('events_id',$event->id)->count();
        $count = Event::where('id',$event->id)->first();
        if ($num==$count->signup_num){
            $status = 1;
        }else{
            $status = 2;
        }
        $eventprizes = EventPrize::where('events_id',$event->id)->get();
        return view('Events/show',compact('event','eventprizes','res','status'));
    }
    //报名抽奖
    public function apply(Request $request)
    {
        EventMember::create([
            'events_id'=>$request->id,
            'member_id'=>auth()->user()->id,
        ]);
        return back()->with('success','报名成功!');
    }
    //查看抽奖结果
    public function result(Request $request)
    {
        $res = EventPrize::where([['events_id',$request->id],['member_id',auth()->user()->id]])->first();
        return  view('Events/result',compact('res'));
    }
}
