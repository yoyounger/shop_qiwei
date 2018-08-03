@extends('default')
@section('contents')

   <h2>抽奖结果</h2>
   @if(isset($res))
    <div style="text-align: center;color: red
"><h3>恭喜你中奖啦!奖品:{{$res->name}};数量:1</h3></div>
    @else
       <div style="text-align: center;color: red
"><h3>很遗憾您与奖品擦肩而过!</h3></div>
    @endif
@endsection