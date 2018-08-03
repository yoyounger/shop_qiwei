<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Order;
use App\Models\OrderGoods;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MenusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['index']
        ]);
        $this->middleware('auth', [
            'expect'=>['CountMenu']
        ]);
    }

    //菜品列表
    public function index(Request $request)
    {

        //搜索分页
        $goods_name = $request->goods_name;
        $goods_pricemin = $request->goods_pricemin;
        $goods_pricemax = $request->goods_pricemax;
        $where = [
            ['shop_id', auth()->user()->id]
        ];
        if ($goods_name) {
            $where[] = ['goods_name', 'like', '%' . $goods_name . '%'];
        }
        if ($goods_pricemin) {
            $where[] = ['goods_price', '>=', $goods_pricemin];
        }
        if ($goods_pricemin) {
            $where[] = ['goods_price', '<=', $goods_pricemax];
        }
        $data = [
            'goods_name' => $goods_name,
            'goods_pricemin' => $goods_pricemin,
            'goods_pricemax' => $goods_pricemax,
        ];
        $menus = Menu::where($where)->paginate(6);
        return view('Menus/index', compact('menus', 'data'));
    }

    //菜品详情
    public function show(Menu $menu,Request $request)
    {
        //菜品销量
        $order_goods = OrderGoods::where('goods_id',$menu->id)->get();
        $day_count = 0;
        $total_count = 0;
        $month = 0;
        $day = 0;
        foreach ($order_goods as $order_good){
            //总销量
            $total_count +=$order_good->amount;
            //当日
            if (substr($order_good->created_at,0,10) == substr(date('Y-m-d',time()),0,10)){
                    $day_count +=$order_good->amount;;
            }

            //按指定月份查询
            if (substr($order_good->created_at,0,7) == substr($request->month,0,7)){
                $month +=$order_good->amount;;
            }
            //按指定日期查询
            if (substr($order_good->created_at,0,10) == substr($request->day,0,10)){
                $day +=$order_good->amount;;
            }
        }
        $month_date = $request->month;
        $day_date = $request->day;
        $categories = MenuCategory::where('shop_id', auth()->user()->shop_id)->get();
        return view('menus.show', compact('menu', 'categories','total_count','day_count','day','month','month_date','day_date'));
    }

    //菜品添加
    public function create()
    {
        $categories = MenuCategory::where('shop_id', auth()->user()->shop_id)->get();
        return view('Menus/create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'goods_name' => 'required|max:15',
            'goods_img' => 'required',
            'category_id' => 'required',
            'goods_price' => 'required',
        ], [
            'goods_name.required' => '菜名不能为空!',
            'goods_name.max' => '菜名不能超过十个字!',
            'category_id.required' => '分类名不能为空!',
            'goods_img.required' => '图片不能为空!',
            'goods_price.required' => '价格不能为空!',
        ]);
        Menu::create([
            'goods_name' => $request->goods_name,
            'goods_img' => $request->goods_img,
            'category_id' => $request->category_id,
            'goods_price' => $request->goods_price,
            'description' => $request->description??'暂无',
            'tips' => $request->tips??'暂无',
            'rating' => 0,
            'shop_id' => auth()->user()->shop_id,
            'month_sales' => 0,
            'rating_count' => 0,
            'satisfy_count' => 0,
            'satisfy_rate' => 0,
        ]);
        return redirect()->route('menus.index')->with('success', '添加成功!');
    }

    //修改菜品
    public function edit(Menu $menu)
    {

        $categories = MenuCategory::where('shop_id', auth()->user()->shop_id)->get();
        return view('menus.edit', compact('menu', 'categories'));
    }

    public function update(Menu $menu, Request $request)
    {
        $this->validate($request, [
            'goods_name' => 'required|max:15',
            'category_id' => 'required',
            'goods_price' => 'required',
        ], [
            'goods_name.required' => '菜名不能为空!',
            'goods_name.max' => '菜名不能超过十个字!',
            'category_id.required' => '分类名不能为空!',
            'goods_price.required' => '价格不能为空!',
        ]);
        $data = [
            'goods_name' => $request->goods_name,
            'category_id' => $request->category_id,
            'goods_price' => $request->goods_price,
            'description' => $request->description??'暂无',
            'tips' => $request->tips??'暂无',
        ];
        $img = $request->goods_img;
        if ($img) {
            $data['goods_img'] = $img;
        }
        $menu->update($data);
        return redirect()->route('menus.index')->with('success', '修改成功!');
    }

    //删除菜品
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success', '删除成功!');
    }

    //菜品销量统计
    public function CountMenu()
    {
        //销量排行统计
        $shop_id = User::where('id', auth()->user()->id)->first();
        $date = substr(date('Y-m-d', time()), 0, 10);
        $month = substr(date('Y-m', time()), 0, 7);
        //本月
        $menus_month = DB::select("select sum(amount) as num,goods_name as name,goods_img from order_goods where order_id in (select id from orders where shop_id={$shop_id->shop_id}) and created_at LIKE '{$month}%'  GROUP BY goods_id ORDER BY num DESC");
        //本日
        $menus_day = DB::select("select sum(amount) as num,goods_name as name,goods_img from order_goods where order_id in (select id from orders where shop_id={$shop_id->shop_id}) and created_at LIKE '{$date}%' GROUP BY goods_id ORDER BY num DESC");
        //累计销量
        $menus_total = DB::select("select sum(amount) as num,goods_name as name,goods_img from order_goods where order_id in (select id from orders where shop_id={$shop_id->shop_id}) GROUP BY goods_id ORDER BY num DESC");
        return view('Menus/countmenu', compact('menus_month', 'menus_day', 'menus_total'));
    }
}
