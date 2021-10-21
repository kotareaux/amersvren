@extends('layouts.common')
@section('title','予約情報入力')
@php
    $scres = json_decode(base64_decode(str_rot13($res)));
@endphp
@section('content')
<div class="roya">
@auth
<div class='htle'>使用不可にする</div>
@endauth
@guest
<div class='htle'>予約フォーム</div>
@endguest
<div class="rehi">
	<span class="srehi">日時：{{$scres->yyyy}}/{{$scres->mm}}/{{$scres->day}} ({{$scres->youbi}}) {{$scres->timename}}
    <span class="srehit">({{$scres->starttime}}～{{$scres->endtime}})</span></span>
</div>
{!! Form::open(['route' => 'rsvset', 'class' => 'renai']) !!}
{{ csrf_field() }}
@guest
<div class="reki">
    {!! Form::label('name', '予約者orバンド名:') !!}
</div>
{!! Form::text('name', null, ['id'=>'name', 'placeholder'=>'予約者orバンド名', 'required'=>'required']) !!}
<div class="reki">
{!! Form::label('kind', '種類:') !!}<br>
{!! Form::radio('kind', '0', false, ['id'=>'kind0']) !!}{!! Form::label('kind0', '個人練') !!}
{!! Form::radio('kind', '1', false, ['id'=>'kind1', 'required'=>'required']) !!}{!! Form::label('kind1', 'バンド練') !!}
</div>
@endguest
<div class="reki">備考:</div>
{!! Form::text('biko', null, ['id'=>'name', 'placeholder'=>'備考']) !!}
<div class="reki reke">
@guest
<span class="rekel">※予約は、練習規約をよく読んで<br>正しく申請してください。</span>
@endguest
{{Form::hidden('res', $res) }}
<span class="reker">{{Form::submit('確定', ['class'=>'yhhb', 'name'=>'resb',])}}</span>
</div>
{!! Form::close() !!}
<a href="{{ url('/view') }}"><i>予約一覧へ戻る</i></a>
@endsection
