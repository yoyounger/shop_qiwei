<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ShopsController extends Controller
{
    //商户主页
    public function index()
    {
        return view('Shops/index');
    }
    //查看商铺详细信息
    public function show(Shop $shop){
        $categories = ShopCategory::all();
        $user = User::where('shop_id','=',$shop->id)->first();
        return view('Shops/show',compact('shop','user','categories'));
    }
    //商家注册
    public function create()
    {
        $categories = ShopCategory::all();
        return view('Shops/create',compact('categories'));
    }
    public function store(Request $request)
    {
        if ($request->repassword!=$request->password){
            return back()->with('danger','密码必须和确认密码一致!')->withInput();
        }
        $this->validate($request,[
            'name'=>'required|max:10',
            'email'=>'required',
            'password'=>'required|min:6',
            'repassword'=>'required|min:6',
            'shop_category_id'=>'required',
            'shop_name'=>'required|max:10',
            'shop_img'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',
        ],[
            'name.required'=>'账户名不能为空!',
            'name.max'=>'账户名不能超过10字!',
            'email.required'=>'账户邮箱不能为空!',
            'password.required'=>'账户密码不能为空!',
            'password.min'=>'账户密码不能少于6位!',
            'repassword.required'=>'账户确认密码不能为空!',
            'repassword.min'=>'账户确认密码不能少于6位!',
            'shop_category_id.required'=>'店铺分类不能为空!',
            'shop_name.required'=>'店铺名称不能为空!',
            'shop_name.max'=>'店铺名称不能超过10字!',
            'shop_img.required'=>'店铺图片不能为空!',
            'start_send.required'=>'起送金额不能为空!',
            'send_cost.required'=>'配送费不能为空!',
        ]);
        DB::transaction(function () use($request) {
            $brand = $request->brand??0;
            $on_time = $request->on_time??0;
            $fengniao = $request->fengniao??0;
            $bao = $request->bao??0;
            $piao = $request->piao??0;
            $zhun = $request->zhun??0;
            $notice = $request->notice??'暂无';
            $discount = $request->discount??'暂无';
            //创建商家信息
            $shop_img = $request->file('shop_img')->store('public/shop_img');
            $shop_img = Storage::url($shop_img);

            $shop = Shop::create([
                'shop_category_id' => $request->shop_category_id,
                'shop_name' => $request->shop_name,
                'shop_img' => url($shop_img),
                'shop_rating' => 0,
                'brand' => $brand,
                'on_time' => $on_time,
                'fengniao' => $fengniao,
                'bao' => $bao,
                'piao' => $piao,
                'zhun' => $zhun,
                'start_send' => $request->start_send,
                'send_cost' => $request->send_cost,
                'notice' => $notice,
                'discount' => $discount,
                'status' => 0,
            ]);
            $shop_id = $shop->id;
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'status' => 1,
                'shop_id' => $shop_id,
            ]);
        });
        return redirect()->route('shops.show',compact('request'))->with('success','注册成功!请等待进一步审核!');
    }
    //修改商户信息
    public function edit(Shop $shop){
        $categories = ShopCategory::all();
        $user = User::where('shop_id','=',$shop->id)->first();
        return view('Shops/edit',compact('shop','user','categories'));
    }
    public function update(Shop $shop,User $user,Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:10',
            'email'=>'required',
            'shop_category_id'=>'required',
            'shop_name'=>'required|max:10',
            'start_send'=>'required',
            'send_cost'=>'required',
        ],[
            'name.required'=>'账户名不能为空!',
            'name.max'=>'账户名不能超过10字!',
            'email.required'=>'账户邮箱不能为空!',
            'shop_category_id.required'=>'店铺分类不能为空!',
            'shop_name.required'=>'店铺名称不能为空!',
            'shop_name.max'=>'店铺名称不能超过10字!',
            'start_send.required'=>'起送金额不能为空!',
            'send_cost.required'=>'配送费不能为空!',
        ]);
        $brand = $request->brand??0;
        $on_time = $request->on_time??0;
        $fengniao = $request->fengniao??0;
        $bao = $request->bao??0;
        $piao = $request->piao??0;
        $zhun = $request->zhun??0;
        $notice = $request->notice??'暂无';
        $discount = $request->discount??'暂无';
        $status2 = $request->status2??0;
        //修改商家信息
        $data = [
            'shop_category_id'=>$request->shop_category_id,
            'shop_name'=>$request->shop_name,
            'shop_rating'=>$request->shop_rating,
            'brand'=>$brand,
            'on_time'=>$on_time,
            'fengniao'=>$fengniao,
            'bao'=>$bao,
            'piao'=>$piao,
            'zhun'=>$zhun,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'notice'=>$notice,
            'discount'=>$discount,
            'status'=>$request->status,
        ];
        $shop_img =  $request->file('shop_img');
        if ($shop_img){
            $data['shop_img'] = $shop_img->store('public/shop_img');
        }
        $shop->update($data);
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'status'=>$request->status2,
        ]);
        return redirect()->route('shops.show')->with('success','修改成功!');
    }
    //删除商铺
    public function destroy(Shop $shop)
    {
        User::where('shop_id','=',$shop->id)->delete();
        $shop->delete();
        return redirect()->route('shops.show')->with('success','删除成功!');
    }

}
