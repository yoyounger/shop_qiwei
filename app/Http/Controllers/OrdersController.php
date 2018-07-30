<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderGoods;
use App\User;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['index']
        ]);
    }
    //订单列表
    public function index()
    {
        $shop_id = User::where('id',auth()->user()->id)->first();
        $orders = Order::where('shop_id',$shop_id->shop_id)->paginate(8);
        return view('Orders/index',compact('orders'));
    }
    //订单详情
    public function show(Order $order)
    {
        $order_goods = OrderGoods::where('order_id',$order->id)->paginate(8);
        return view('Orders/show',compact('order','order_goods'));
    }
    //发货
    public function send(Order $order)
    {
//        if ($order->status == 0){
//            return back()->with('danger','该订单未支付!');
//        }
        $order->update([
            'status'=>2
        ]);
        return redirect()->route('orders.index')->with('success','发货成功');
    }
    //取消订单
    public function giveup(Order $order)
    {
        $order->update([
            'status'=>-1
        ]);
        return redirect()->route('orders.index')->with('success','取消订单成功');
    }
    //订单统计
    public function CountOrder(Request $request)
    {
        //订单数量
        $user = User::where('id',auth()->user()->id)->first();
        $orders = Order::where('shop_id',$user->shop_id)->get();
        $day_count = 0;
        $month_count = 0;
        $total_count = 0;
        $month = 0;
        $day = 0;
        foreach ($orders as $order){
            $total_count ++;
            if (substr($order->created_at,0,7) == substr(date('Y-m',time()),0,7)){
                $month_count ++;
                if (substr($order->created_at,0,10) == substr(date('Y-m-d',time()),0,10)){
                    $day_count ++;
                }
            }
            //按指定月份查询
            if (substr($order->created_at,0,7) == substr($request->month,0,7)){
                $month ++;
            }
            //按指定日期查询
            if (substr($order->created_at,0,10) == substr($request->day,0,10)){
                $day ++;
            }
        }
        $month_date = $request->month;
        $day_date = $request->day;
        return view('Orders/CountOrder',compact('day_count','month_count','total_count','month','day','month_date','day_date'));
    }
}
