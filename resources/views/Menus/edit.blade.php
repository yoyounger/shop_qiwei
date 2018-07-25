@extends('default')
@section('css_files')
    <link rel="stylesheet" type="text/css" href="/upload/webuploader.css">
@stop
@section('js_files')
    <script type="text/javascript" src="/upload/webuploader.js"></script>
@stop
@section('contents')
    <h2>修改菜品</h2>
    @include('_errors')
    <br>
    <br>
    <form action="{{route('menus.update',[$menu])}}" method="post" enctype="multipart/form-data">
        <table class="table table-bordered">
            <tr>
                <td>名称</td>
                <td><input type="text" name="goods_name" class="form-control" value="{{$menu->goods_name}}" placeholder="必填"></td>
            </tr>
            <tr>
                <td>菜品分类</td>
                <td>
                    <select name="category_id" id="" class="form-control" >
                        <option value="">请选择</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}" @if($category->id == $menu->category_id) selected @endif>{{$category->name}}</option>
                            @endforeach
                    </select>
            </tr>
            <tr>
                <td>价格</td>
                <td>
                    <input type="number" name="goods_price" class="form-control" placeholder="必填" value="{{$menu->goods_price}}">
                </td>
            </tr>
            <tr>
                <td>商品图片</td>
                <td>  <input type="hidden" id="goods_img" name="goods_img">
                    <div id="uploader-demo">
                        <!--用来存放item-->
                        <div id="fileList" class="uploader-list"></div>
                        <div id="filePicker">选择图片</div>
                    </div>
                    <img id="img" src="{{$menu->goods_img}}" width="100px">
                </td>
            </tr>
            <tr>
                <td>描述</td>
                <td>
                    <input type="text" name="description" class="form-control" value="{{$menu->description}}" placeholder="可不填" >
                </td>
            </tr>
            <tr>
                <td>提示信息</td>
                <td>
                    <input type="text" name="tips" class="form-control" value="{{$menu->tips}}" placeholder="可不填">
                </td>
            </tr>

            <tr>
                <td></td>
                <td><button type="submit" class="btn btn-primary">保存</button></td>
            </tr>
            {{csrf_field()}}
            {{method_field('PATCH')}}
        </table>
    </form>
    @stop
@section('js')
    <script type="text/javascript">
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            //swf: BASE_URL + '/js/Uploader.swf',

            // 文件接收服务端。
            server: "{{route('shopImg')}}",

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            formData:{
                _token:"{{csrf_token()}}"
            }
        });
        uploader.on( 'uploadSuccess', function( file,response ) {
            $('#img').attr('src',response.filename);
            $('#goods_img').val(response.filename);
        });
    </script>
@stop