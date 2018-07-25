<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MenuCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['index']
        ]);
    }
    //菜品分类列表
    public function index()
    {
        $shop_id = auth()->user()->shop_id;
        $menucategories = MenuCategory::where('shop_id', $shop_id)->paginate(10);
        return view('MenuCategories/index', compact('menucategories'));
    }

    //添加分类
    public function create()
    {
        return view('MenuCategories/create');
    }

    public function store(Request $request)
    {
        $type_accumulation = uniqid();
        $shop_id = auth()->user()->shop_id;
        //判断有无勾选
        if ($request->is_selected) {
            //勾选则为1
            $is_selected = $request->is_selected;
            //另外一个为1的为零
            $row = MenuCategory::where([
                ['shop_id', '=', $shop_id],
                ['is_selected', '=', '1'],
            ])->first();
            if ($row) {
                $row->update([
                    'is_selected' => 0,
                ]);
            }
        } else {
            //第一个菜品判断有无默认菜品,有就添加时候为否
            $res = MenuCategory::where('shop_id', $shop_id)->sum('is_selected');
            if ($res == 0) {
                $is_selected = 1;
            } else {
                $is_selected = 0;
            }
        }
        $this->validate($request, [
            'name' => 'required|max:10',
        ], [
            'name.required' => '分类名不能为空!',
            'name.max' => '分类名不能超过10字!',
        ]);
        MenuCategory::create([
            'name' => $request->name,
            'type_accumulation' => $type_accumulation,
            'is_selected' => $is_selected,
            'description' => $request->description??'暂无',
            'shop_id' => $shop_id,
        ]);
        return redirect()->route('menucategories.index')->with('success', '添加成功!');
    }

    //修改菜品分类
    public function edit(MenuCategory $menucategory)
    {
        return view('menucategories.edit', compact('menucategory'));
    }

    public function update(MenuCategory $menucategory,Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:10',
        ], [
            'name.required' => '分类名不能为空!',
            'name.max' => '分类名不能超过10字!',
        ]);
        $menucategory->update([
            'name' => $request->name,
            'description' => $request->description??'暂无',
        ]);
        return redirect()->route('menucategories.index')->with('success', '修改成功!');
    }
    //删除菜品分类
    public function destroy(MenuCategory $menucategory)
    {
        if ($menucategory->is_selected == 1){
            return back()->with('danger','默认分类不能删除!!')->withInput();
        }
        //判断分类是否有菜品,不能删除
        $res = Menu::where('category_id',$menucategory->id)->first();
        if ($res){
            return back()->with('danger','该分类有菜品不能删除!请先删除分类下的菜品!');
        }
        $menucategory->delete();
        return redirect()->route('menucategories.index')->with('success', '删除成功!');
    }
    //设为默认
    public function default(Request $request)
    {
        //另外一个为零
        $shop_id = auth()->user()->shop_id;
        $row = MenuCategory::where([
            ['shop_id', '=', $shop_id],
            ['is_selected', '=', '1'],
        ])->first();
        if ($row) {
            $row->update([
                'is_selected' => 0,
            ]);
        }
        MenuCategory::where('id',$request->id)->first()->update([
            'is_selected'=>1,
        ]);

        return redirect()->route('menucategories.index')->with('success', '设置成功!');
    }
    //查看指定分类下的所有菜品
    public function show(MenuCategory $menucategory,Request $request)
    {
        //菜品分类导航栏
        $shop_id = auth()->user()->shop_id;
        $menucategories = MenuCategory::where('shop_id', $shop_id)->get();

        //搜索分页
        $goods_name = $request->goods_name;
        $goods_pricemin = $request->goods_pricemin;
        $goods_pricemax = $request->goods_pricemax;
        $where = [
            ['category_id',$menucategory->id]
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
        if (!$menus){
            return back()->with('danger','该分类无菜品!');
        }
        return view('menucategories.show',[
            'menus'=>$menus,
            'menucategories'=>$menucategories,
            'data'=>$data,
            'category'=>$menucategory,
        ]);
    }

}
