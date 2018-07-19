@extends('default')
@section('contents')
    <h2>商家信息详情</h2>
    <br>
    <br>
        <table class="table table-bordered">
            <tr>
                <td colspan="2" style="text-align: center;font-size: 20px;font-weight: bold">账户相关</td>
            </tr>
            <tr>
                <td>用户名</td>
                <td>{{$user->name}}</td>
            </tr>
            <tr>
                <td>邮箱</td>
                <td>
                    {{$user->email}}
                </td>
            </tr>
            <tr>
                <td>账户审核</td>
                <td>
                    @if($user->status2) <span class="glyphicon glyphicon-ok" style="color:green"></span> @else <span class="glyphicon glyphicon-remove" style="color:red"></span> @endif &emsp;
                    ("✔"为启用,否则待审核)
                </td>
            </tr>

            <tr>
                <td colspan="2" style="text-align: center;font-size: 20px;font-weight: bold">店铺信息</td>
            </tr>
            <tr>
                <td>商家名称</td>
                <td>{{$shop->shop_name}}</td>
            </tr>
            <tr>
                <td>店铺分类</td>
                <td>{{$shop->shopcatgory->name}}
            </tr>
            <tr>
                <td>店铺图片</td>
                <td>
                    <img src="{{\Illuminate\Support\Facades\Storage::url($shop->shop_img)}}" alt="" width="50px">
                </td>
            </tr>
            <tr>
                <td>评分</td>
                <td>
                   {{$shop->shop_rating}}星
                </td>
            </tr>
            <tr>
                <td>是否品牌</td>
                <td>
                   @if($shop->brand) <span class="glyphicon glyphicon-ok" style="color:green"></span> @else <span class="glyphicon glyphicon-remove" style="color:red"></span> @endif &emsp;
                   ("✔"为是,否则不是)
                </td>
            </tr>
            <tr>
                <td>是否准时送达</td>
                <td>
                    @if($shop->on_time) <span class="glyphicon glyphicon-ok" style="color:green"></span> @else <span class="glyphicon glyphicon-remove" style="color:red"></span> @endif &emsp;
                    ("✔"为是,否则不是)
                </td>
            </tr>
            <tr>
                <td>是否蜂鸟配送</td>
                <td>
                    @if($shop->fengniao) <span class="glyphicon glyphicon-ok" style="color:green"></span> @else <span class="glyphicon glyphicon-remove" style="color:red"></span> @endif &emsp;
                    ("✔"为是,否则不是)
                </td>
            </tr>
            <tr>
                <td>是否保标记</td>
                <td>
                    @if($shop->bao) <span class="glyphicon glyphicon-ok" style="color:green"></span> @else <span class="glyphicon glyphicon-remove" style="color:red"></span> @endif &emsp;
                    ("✔"为是,否则不是)
            </tr>
            <tr>
                <td>是否票标记</td>
                <td>
                    @if($shop->piao) <span class="glyphicon glyphicon-ok" style="color:green"></span> @else <span class="glyphicon glyphicon-remove" style="color:red"></span> @endif &emsp;
                    ("✔"为是,否则不是)
                </td>
            </tr>
            <tr>
                <td>是否准标记</td>
                <td>
                    @if($shop->zhun) <span class="glyphicon glyphicon-ok" style="color:green"></span> @else <span class="glyphicon glyphicon-remove" style="color:red"></span> @endif &emsp;
                    ("✔"为是,否则不是)
                </td>
            </tr>
            <tr>
                <td>起送金额</td>
                <td>
                    {{$shop->start_send}}元
                </td>
            </tr>
            <tr>
                <td>配送费</td>
                <td>
                    {{$shop->send_cost}}元
                </td>
            </tr>
            <tr>
                <td>店公告</td>
                <td>
                    {{$shop->notice}}
                </td>
            </tr>
            <tr>
                <td>优惠信息</td>
                <td>
                   {{$shop->discount}}
                </td>
            </tr>
            <tr>
                <td>审核</td>
                <td>
                    @if($shop->status == 1) 正常 @elseif($shop->status == 0) 未审核 @else 禁用 @endif
                </td>
            </tr>
        </table>
@stop