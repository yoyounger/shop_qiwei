<?php

namespace App\Http\Controllers;

use App\Models\Activity;

class ActivitiesController extends Controller
{
    //活动列表
    public function index()
    {
        $time = time();
        $activities = Activity::where('end_time','>=',date('Y-m-d H:i:s',$time))->paginate(5);
        return view('Activities/index',compact('activities'));
    }

    public function show(Activity $activity)
    {
        return view('Activities/show',compact('activity'));
    }
}
