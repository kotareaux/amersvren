@extends('layouts.common')
@section('title','Top')

@section('content')
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
