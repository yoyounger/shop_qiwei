@extends('default')
@section('contents')
    <h2>我的菜品分类</h2>

    <a class="btn btn-primary" href="{{route('menucategories.create')}}" style="float: right;margin: 20px"><span class="glyphicon glyphicon-plus"></span>&emsp;添加分类</a>

    <table class="table table-bordered" style="text-align: center">
        <tr>
            <th style="text-align: center">序号</th>
            <th style="text-align: center">分类名</th>
            <th style="text-align: center">默认菜品</th>
            <th style="text-align: center">描述</th>
            <th width="30%" style="text-align: center">操作</th>
        </tr>
        <?php $i=1?>
        @foreach($menucategories as $menucategory)
            <tr>
                <td>{{$i++}}</td>
                <td><a href="{{route('menucategories.show',[$menucategory])}}">{{$menucategory->name}}</a></td>
                <td>@if($menucategory->is_selected) <span class="glyphicon glyphicon-ok" style="color:green"></span> @else <span class="glyphicon glyphicon-remove" style="color:red"></span> @endif</td>
                <td>{{$menucategory->description}}</td>
                <td style="padding-left: 20px">
                    <div class="row">
                        <div class="col-xs-2">
                            <a href="{{route('menucategories.edit',[$menucategory])}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                        </div>

                        <div class="col-xs-2">
                            <form action="{{route('menucategories.destroy',[$menucategory])}}" method="post">
                                <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                            </form>
                        </div>

                        @if(!$menucategory->is_selected)
                        <div class="col-xs-2">
                            <form action="{{route('default')}}" method="post">
                                <input type="hidden" name="id" value="{{$menucategory->id}}">
                                <button type="submit" class="btn btn-info">设为默认</button>
                                {{ csrf_field() }}
                            </form>

                        </div>
                            @endif
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    {{$menucategories->links()}}
    @endsection