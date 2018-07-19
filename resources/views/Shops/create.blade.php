@extends('default')
@section('contents')
    <h2>注册</h2>
    @include('_errors')
    <br>
    <br>
    <form action="{{route('shops.store')}}" method="post" enctype="multipart/form-data">
        <table class="table table-bordered">
            <tr>
                <td colspan="2" style="text-align: center;font-size: 20px;font-weight: bold">账户相关</td>
            </tr>
            <tr>
                <td>用户名</td>
                <td>
                    <input type="text" name="name" class="form-control" placeholder="必填" value="{{old('name')}}">
                </td>
            </tr>
            <tr>
                <td>邮箱</td>
                <td>
                    <input type="text" name="email" class="form-control" placeholder="必填" value="{{old('email')}}">
                </td>
            </tr>
            <tr>
                <td>密码</td>
                <td>
                    <input type="password" name="password" class="form-control" placeholder="必填" value="{{old('password')}}">
                </td>
            </tr>
            <tr>
                <td>确认密码</td>
                <td>
                    <input type="password" name="repassword" class="form-control" placeholder="必填">
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;font-size: 20px;font-weight: bold">店铺信息</td>
            </tr>
            <tr>
                <td>商家名称</td>
                <td><input type="text" name="shop_name" class="form-control" placeholder="必填" value="{{old('shop_name')}}"></td>
            </tr>
            <tr>
                <td>店铺分类</td>
                <td>
                    <select name="shop_category_id" id="" class="form-control" >
                        <option value="">请选择</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                    </select>
            </tr>
            <tr>
                <td>店铺图片</td>
                <td>
                    <input type="file" name="shop_img"><span style="color: red">(必填)</span>
                </td>
            </tr>
            {{--<tr>--}}
                {{--<td>评分</td>--}}
                {{--<td>--}}
                    {{--<input type="number" name="shop_rating" class="form-control" value="2">--}}
                {{--</td>--}}
            {{--</tr>--}}
            <tr>
                <td>是否品牌</td>
                <td>
                    <input type="checkbox" value="1" name="brand" id="brand">&emsp;
                    <label for="brand"><span style="color: red">("✔"为是,否则不是)</span></label>
                </td>
            </tr>
            <tr>
                <td>是否准时送达</td>
                <td>
                    <input type="checkbox" value="1" name="on_time" id="on_time">&emsp;
                    <label for="on_time"><span style="color: red">("✔"为是,否则不是)</span></label>
                </td>
            </tr>
            <tr>
                <td>是否蜂鸟配送</td>
                <td>
                    <input type="checkbox" value="1" name="fengniao" id="fengniao">&emsp;
                    <label for="fengniao"><span style="color: red">("✔"为是,否则不是)</span></label>
                </td>
            </tr>
            <tr>
                <td>是否保标记</td>
                <td>
                    <input type="checkbox" value="1" name="bao" id="bao">&emsp;
                    <label for="bao"><span style="color: red">("✔"为是,否则不是)</span></label>
                </td>
            </tr>
            <tr>
                <td>是否票标记</td>
                <td>
                    <input type="checkbox" value="1" name="piao" id="piao">&emsp;
                    <label for="piao"><span style="color: red">("✔"为是,否则不是)</span></label>
                </td>
            </tr>
            <tr>
                <td>是否准标记</td>
                <td>
                    <input type="checkbox" value="1" name="zhun" id="zhun">&emsp;
                    <label for="zhun"><span style="color: red">("✔"为是,否则不是)</span></label>
                </td>
            </tr>
            <tr>
                <td>起送金额</td>
                <td>
                    <input type="number" name="start_send" class="form-control" placeholder="必填" value="{{old('start_send')}}">
                </td>
            </tr>
            <tr>
                <td>配送费</td>
                <td>
                    <input type="number" name="send_cost" class="form-control" placeholder="必填" value="{{old('send_cost')}}">
                </td>
            </tr>
            <tr>
                <td>店公告</td>
                <td>
                    <input type="text" name="notice" class="form-control" placeholder="可不填" value="{{old('notice')}}">
                </td>
            </tr>
            <tr>
                <td>优惠信息</td>
                <td>
                    <input type="text" name="discount" class="form-control" placeholder="可不填" value="{{old('discount')}}">
                </td>
            </tr>
            {{--<tr>--}}
                {{--<td>店铺审核</td>--}}
                {{--<td>--}}
                    {{--<input type="radio" name="status" value="1" id="radio1" checked><label for="radio1">正常</label>--}}
                    {{--<input type="radio" name="status" value="0" id="radio2"><label for="radio2">待审核</label>--}}
                    {{--<input type="radio" name="status" value="-1" id="radio3"><label for="radio3">禁用</label>--}}
                {{--</td>--}}
            {{--</tr>--}}

            <tr>
                <td></td>
                <td><button type="submit" class="btn btn-success">注册</button></td>
            </tr>
            {{csrf_field()}}
        </table>
    </form>
    @stop