@extends('layouts.common')
@section('additionalHead')
<style>div.hhlsk{text-align:left;font-size:18pt;margin-top:.75rem;margin-bottom:.5rem}select{font-size:14pt;padding:.25rem .5rem;margin:0 .25rem;background:linear-gradient(#fff,#ccc);border:1px;border-style:solid;border-color:#CCC;overflow:hidden}option{font-size:12pt}table{text-align:center;border-collapse:separate;border-spacing:0;overflow:hidden}@media screen and(max-width: 700px){table{min-width:100%}}th{padding:12px 20px;background:linear-gradient(#D00,#000);color:#efefef;font-weight:bold;text-shadow:.5px .5px 0 #000,-.5px -.5px 0 #000,-.5px .5px 0 #000,.5px -.5px 0 #000,0px .5px 0 #000,0-.5px 0 #000,-.5px 0 0 #000,.5px 0 0 #000;border-right-width:1px;border-right-style:groove;border-right-color:rgba(200,200,200,.7)}th:first-child{border-radius:7px 0px 0px 0px;-webkit-border-radius:7px 0px 0px 0px;-moz-border-radius:7px 0px 0px 0px}th:last-child{border-radius:0px 7px 0px 0px;-webkit-border-radius:0px 7px 0px 0px;-moz-border-radius:0px 7px 0px 0px;border-right-style:none}tr td{height:2rem;border-right-width:1px;border-right-style:solid;border-right-color:dodgerblue;border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:dodgerblue}.hi{border-left-width:1px;border-left-style:solid;border-left-color:dodgerblue}tr.Sat{background-color:#a0d8ef}tr.Sun{background-color:#ffc0cb}.trna{color:#0070e0;min-width:8rem}.trki{color:#0070e0;min-width:5rem}.trbi{text-align:left;min-width:16rem}input[type="submit"].rbtn{width:6rem}.acd-check{display:none}.acd-label{display:inline-block;padding-left:1rem;font-size:14pt}.acd-content{height:0;opacity:0;padding-left:2rem;visibility:hidden}</style>
<link rel="preload" href="/css/home.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="/css/home.css"></noscript>
@endsection
@section('title','Top')
@section('contents')
<div class="htle">
    {{$tyear}}年{{$tmnth}}月の予約表
</div>
<input id="acd-check1" class="acd-check" type="checkbox">
<label class="acd-label" for="acd-check1">練習室使用可能時間・場所（クリックで開閉）</label>
<div class="acd-content">
月〜金 17：00&#12316;21：00 第7練<br>
土曜日 12：00&#12316;17：00 第10練C<br>
　　　 17：00&#12316;21：00 第6練<br>
日曜日  9：00&#12316;19：00 第6練<br>
</div>
<div class="hhlsk">
{!! Form::open(['route' => 'viewtab']) !!}
    {{ csrf_field() }}
    {{"表示する表を変更："}}
    {!! Form::select('yyyy', $avly, $tyear); !!}
    {{"年"}}
    {!! Form::select('month', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12], $tmnth-1); !!}
    {{"月"}}
    {!! Form::submit('選択', ['class'=>'yhhb']); !!}
{!! Form::close() !!}
</div>
@endsection
@section('table')
@auth
つくる？
@endauth
@guest
準備中、あるいは予約表データが存在しません
@endguest
@endsection
