@extends('default')
@section('contents')
    <h2>本店菜品销量统计</h2>
    <br>
    <br>
    <div class="row">
        <div class="col-lg-4">
            <table class="table table-bordered" style="text-align: center">
                <tr>
                    <th colspan="4">今日销量</th>
                </tr>
                <tr>
                    <td>序号</td>
                    <td>菜品名字</td>
                    <td>菜品图片</td>
                    <td>销量</td>
                </tr>
                <?php $i=1?>
                @foreach($menus_day as $menu)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$menu->name}}</td>
                        <td><img src="{{$menu->goods_img}}" alt="" width="50px"></td>
                        <td>{{$menu->num}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="col-lg-4">
            <table class="table table-bordered" style="text-align: center">
                <tr>
                    <th colspan="4">本月销量</th>
                </tr>
                <tr>
                    <td>序号</td>
                    <td>菜品名字</td>
                    <td>菜品图片</td>
                    <td>销量</td>
                </tr>
                <?php $i=1?>
                @foreach($menus_month as $menu)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$menu->name}}</td>
                    <td><img src="{{$menu->goods_img}}" alt="" width="50px"></td>
                    <td>{{$menu->num}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="col-lg-4">
            <table class="table table-bordered" style="text-align: center">
                <tr>
                    <th colspan="4">累计销量</th>
                </tr>
                <tr>
                    <td>序号</td>
                    <td>菜品名字</td>
                    <td>菜品图片</td>
                    <td>销量</td>
                </tr>
                <?php $i=1?>
                @foreach($menus_total as $menu)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$menu->name}}</td>
                        <td><img src="{{$menu->goods_img}}" alt="" width="50px"></td>
                        <td>{{$menu->num}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop