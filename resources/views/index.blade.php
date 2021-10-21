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
{!! Form::open(['route' => 'viewchgdate']) !!}
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
<table class='rhyo'>
<tr><th>日付</th><th>時間帯</th><th class='tyo'>予約者</th><th class='tyo'>種類</th><th class='tbi'>備考</th></tr>
    @for ($i = 1; $i <= date('t', strtotime($tyear.'-'.$tmnth)); $i++)
        @php
            $yo = date('w', mktime(0, 0, 0, $tmnth, $i, $tyear));
            $tpy = count($tinfo[$yo]);
            $yos = date('D', mktime(0, 0, 0, $tmnth, $i, $tyear));
            $yoc = array("日", "月", "火", "水", "木", "金", "土");
        @endphp
        @for ($j = 0; $j < $tpy; $j++)
            <tr class={{$yos}}>
            @if($j==0)
                <td rowspan="{{$tpy}}" class="hi">{{$i}}({{$yoc[$yo]}})</td>
            @endif
            <td>{{$tinfo[$yo][$j]["timename"]}}</td>
            @php
            $rtinfo = $tinfo[$yo][$j];
            $rtinfo += array('day'=>$i, 'youbi'=>$yoc[$yo]);
            $jrstinfo = json_encode($rtinfo ?? null);
            $peri = str_rot13(base64_encode($jrstinfo));
            @endphp
            {!! Form::open(['route' => 'rsvin']) !!}
            {{ csrf_field() }}
            {{Form::hidden('jrsi', $peri)}}
            @auth
            <td class="trna">{{$rinfo[$i][$j]['name'] ?? Form::submit('使用不可に', ['class'=>'rbtn']);}}</td>
            @endauth
            @guest
            <td class="trna">{{$rinfo[$i][$j]['name'] ?? Form::submit('予約', ['class'=>'rbtn']);}}</td>
            @endguest
            <td class="trki">{{$rinfo[$i][$j]['sband'] ?? null}}</td>
            <td class="trbi">{{$rinfo[$i][$j]['biko'] ?? null}}</td>
            </tr>
            {!! Form::close() !!}
        @endfor
    @endfor
</table>
@endsection

