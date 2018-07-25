<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['index']
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
            ['shop_id',auth()->user()->id]
        ];
        if ($goods_name){
            $where[] = ['goods_name','like','%'.$goods_name.'%'];
        }
        if ($goods_pricemin){
            $where[] = ['goods_price','>=',$goods_pricemin];
        }
        if ($goods_pricemin){
            $where[] = ['goods_price','<=',$goods_pricemax];
        }
        $data = [
            'goods_name'=>$goods_name,
            'goods_pricemin'=>$goods_pricemin,
            'goods_pricemax'=>$goods_pricemax,
        ];
        $menus = Menu::where($where)->paginate(1);
        return view('Menus/index',compact('menus','data'));
    }
    //菜品详情
    public function show(Menu $menu)
    {
        $categories = MenuCategory::where('shop_id',auth()->user()->shop_id)->get();
        return view('menus.show',compact('menu','categories'));
    }
    //菜品添加
    public function create()
    {
        $categories = MenuCategory::where('shop_id',auth()->user()->shop_id)->get();
        return view('Menus/create',compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'goods_name'=>'required|max:15',
            'goods_img'=>'required',
            'category_id'=>'required',
            'goods_price'=>'required',
        ],[
            'goods_name.required'=>'菜名不能为空!',
            'goods_name.max'=>'菜名不能超过十个字!',
            'category_id.required'=>'分类名不能为空!',
            'goods_img.required'=>'图片不能为空!',
            'goods_price.required'=>'价格不能为空!',
        ]);
        Menu::create([
            'goods_name'=>$request->goods_name,
            'goods_img'=>$request->goods_img,
            'category_id'=>$request->category_id,
            'goods_price'=>$request->goods_price,
            'description'=>$request->description??'暂无',
            'tips'=>$request->tips??'暂无',
            'rating'=>0,
            'shop_id'=>auth()->user()->shop_id,
            'month_sales'=>0,
            'rating_count'=>0,
            'satisfy_count'=>0,
            'satisfy_rate'=>0,
        ]);
        return redirect()->route('menus.index')->with('success','添加成功!');
    }
    //修改菜品
    public function edit(Menu $menu)
    {

        $categories = MenuCategory::where('shop_id',auth()->user()->shop_id)->get();
        return view('menus.edit',compact('menu','categories'));
    }

    public function update(Menu $menu,Request $request)
    {
        $this->validate($request,[
            'goods_name'=>'required|max:15',
            'category_id'=>'required',
            'goods_price'=>'required',
        ],[
            'goods_name.required'=>'菜名不能为空!',
            'goods_name.max'=>'菜名不能超过十个字!',
            'category_id.required'=>'分类名不能为空!',
            'goods_price.required'=>'价格不能为空!',
        ]);
        $data = [
            'goods_name'=>$request->goods_name,
            'category_id'=>$request->category_id,
            'goods_price'=>$request->goods_price,
            'description'=>$request->description??'暂无',
            'tips'=>$request->tips??'暂无',
        ];
        $img = $request->goods_img;
        if ($img){
            $data['goods_img'] = $img;
        }
        $menu->update($data);
        return redirect()->route('menus.index')->with('success','修改成功!');
    }
    //删除菜品
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success','删除成功!');
    }
}