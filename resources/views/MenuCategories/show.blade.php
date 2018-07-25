@extends('default')
@section('contents')
    <ul class="nav nav-tabs" id="myul">
        @foreach($menucategories as $menucategory)
        <li role="presentation"><a href="{{route('menucategories.show',[$menucategory])}}" aria-haspopup="true" aria-expanded="false" @if($menucategory->id==$category->id)class="btn btn-success btn-sm active" @endif>{{$menucategory->name}}</a></li>
        @endforeach
    </ul>
    <a class="btn btn-primary" href="{{route('menus.create')}}" style="float: right;margin: 20px"><span class="glyphicon glyphicon-plus"></span>&emsp;添加菜品</a>
    <br>
    <div class="row">
        <form action="{{route('menucategories.show',[$category])}}" method="get">
            <div class="col-xs-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="菜名" name="goods_name">
                </div>
            </div>
            <div class="col-xs-2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="最低价格" name="goods_pricemin">
                </div>
            </div>
            <div class="col-xs-2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="最高价格" name="goods_pricemax">
                </div>
            </div>
            <div class="col-xs-2">
                <span class="input-group-btn">
                     <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
            {{csrf_field()}}
        </form>
    </div>
    <table class="table table-bordered" style="text-align: center">
        <tr>
            <th style="text-align: center">序号</th>
            <th style="text-align: center">菜名</th>
            <th style="text-align: center">评分</th>
            <th style="text-align: center">菜品分类</th>
            <th style="text-align: center">价格</th>
            <th style="text-align: center">月销量</th>
            <th style="text-align: center">提示信息</th>
            <th style="text-align: center">图片</th>
            <th style="text-align: center">操作</th>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>{{$menu->id}}</td>
                <td>{{$menu->goods_name}}</td>
                <td>{{$menu->rating}}</td>
                <td>{{$menu->category->name}}</td>
                <td>{{$menu->goods_price}}元</td>
                <td>{{$menu->month_sales}}</td>
                <td>{{$menu->tips}}</td>
                <td><img src="{{$menu->goods_img}}" alt="" style="width: 50px"></td>
                <td>
                    <div class="row">
                        <div class="col-xs-2">
                            <a href="{{route('menus.show',[$menu])}}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>
                        </div>
                        <div class="col-xs-2" style="margin-left: 5px">
                            <a href="{{route('menus.edit',[$menu])}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                        </div>
                        <div class="col-xs-2" style="margin-left: 5px">
                            <form action="{{route('menus.destroy',[$menu])}}" method="post">
                                <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
    </table>
    {{$menus->appends($data)->links()}}
@stop
