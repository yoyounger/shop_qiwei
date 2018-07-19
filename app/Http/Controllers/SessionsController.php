<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SessionsController extends Controller
{
    //登录页面
    public function login()
    {
        return view('Sessions/login');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
            'captcha'=>'required|captcha',
        ],[
            'name.required'=>'账户名不能为空!',
            'password.required'=>'密码不能为空!',
            'captcha.required'=>'验证码不能为空!',
           'captcha.captcha'=>'验证码错误!'
        ]);
        $name = $request->name;
        $user = User::where('name',$name)->select('status','shop_id')->first();
        $shop_status = Shop::where('id',$user->shop_id)->select('status')->first();
        if (! $user->status || !$shop_status  ) {
            return back()->with('danger', '账户审核中!尚不能登录!')->withInput();
        }elseif (Auth::attempt([
            'name'=>$request->name,
            'password'=>$request->password,
        ],$request->remember)){
                return redirect()->route('shops.index')->with('success','登录成功!');

        }else{
            return back()->with('danger','用户名或密码错误!')->withInput();
        }
    }
    //注销
    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login')->with('success','注销成功!');
    }
    //修改密码
    public function reset()
    {
        return view('Sessions/password');
    }

    public function password(Request $request)
    {
        $this->validate($request,[
            'oldpassword'=>'required',
            'newpassword'=>'required|min:6',
        ],[
            'oldpassword.required'=>'旧密码不能为空!',
            'newpassword.required'=>'新密码不能为空!',
            'newpassword.min'=>'新密码至少6位!',
        ]);
        if ($request->newpassword !=$request->repassword){
            return back()->with('danger','新密码与确认密码不匹配!')->withInput();
        }
        if ($request->newpassword ==$request->oldpassword){
            return back()->with('danger','新密码不能与旧密码相同!')->withInput();
        }
        $id = auth()->user()->id;
        //查询密码
        $res = User::where('id',$id)->select('password')->first();
        if (!Hash::check($request->oldpassword,$res->password)){
            return back()->with('danger','旧密码错误!')->withInput();
        }else{
            User::where('id',$id)->update(['password'=>bcrypt($request->newpassword)]);
            //修改成功注销
            Auth::logout();
            return redirect()->route('shops.index')->with('success','修改密码成功!请重新登录!');
        }
    }
}
