@extends('default')
@section('contents')
    <div class="jumbotron">
        <h1>欢迎入驻奇味外卖!</h1>

        <p>
            @guest
            <a class="btn btn-success btn-lg" href="{{route('shops.create')}}" role="button">我要开店!!!</a>
            @endguest
            @auth
            <button class="btn btn-success btn-lg">更多功能敬请期待!!!</button>
            @endauth
        </p>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="" alt="">
                <div class="caption">
                    <h3>Thumbnail label</h3>
                    <p>...</p>
                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="" alt="">
                <div class="caption">
                    <h3>Thumbnail label</h3>
                    <p>...</p>
                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="" alt="">
                <div class="caption">
                    <h3>Thumbnail label</h3>
                    <p>...</p>
                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                </div>
            </div>
        </div>
    </div>


    <div>© 2016 Company, Inc.</div>
@stop