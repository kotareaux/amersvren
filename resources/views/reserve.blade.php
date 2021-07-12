@extends('layouts.common')
@section('title','予約情報入力')

@section('content')
<div class="roya">
<div class='htle'>予約フォーム</div>
<div class="rehi">
    <span class="srehi">予約日：{{$res["year"]}}/{{$res["month"]}}/{{$res["day"]}} ({{$res["youbi"]}}) {{$res["time"]}}</span>
</div>
<form action="send.php" method='post' class="renai">
{!! Form::open(['route' => 'rsvset']) !!}
    {{ csrf_field() }}
<div class="reki">予約者／バンド名:</div>
<input type="text" name="name" placeholder="予約者／バンド名" required><br>
<div class="reki">種類:<br>
<label><input type="radio" name="kind" value="0">個人練</label>
<label><input type="radio" name="kind" value="1" required>バンド練</label></div>
<div class="reki">備考:</div>
<input type="text" name="biko" placeholder="備考"><br>
<div class="reki reke">
<span class="rekel">※予約は、練習規約をよく読んで<br>正しく申請してください。</span>
<span class="reker"><button type="submit" class="yhhb" name="res" value='{$rres}'>確定</button></span>
</div>
{!! Form::close() !!}
@endsection
