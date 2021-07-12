@extends('layouts.common')
@section('title','Top')

@section('content')

{!! Form::open(['route' => 'viewchgdate']) !!}
    {{ csrf_field() }}
    {!! Form::select('yyyy', ['L' => 'Large', 'S' => 'Small']); !!}
    {!! Form::selectMonth('month'); !!}
    {!! Form::submit('Click Me!'); !!}
{!! Form::close() !!}

{{$tyear}}年{{$tmnth}}月の予約表

{!! Form::open(['route' => 'rsvin']) !!}
{{ csrf_field() }}
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
            $tinfo[$yo][$j] += array('year'=>$tyear, 'month'=>$tmnth, 'day'=>$i, 'youbi'=>$yoc[$yo]);
            $jrstinfo = json_encode($tinfo[$yo][$j] ?? null);
            $peri = str_rot13(base64_encode($jrstinfo));
            @endphp
            <td class="trna">{{Form::hidden('jrsi', $peri) }}{{$rinfo[$i][$j]->name ?? Form::submit('予約', ['class'=>'rbtn']);}}</td>
            <td class="trna">{{$rinfo[$i][$j]->sband ?? null}}</td>
            <td class="trbi">{{$rinfo[$i][$j]->biko ?? null}}</td>
            </tr>
        @endfor
    @endfor
</table>
{!! Form::close() !!}
<pre>
{!! var_dump($tinfo); !!}
</pre>
@endsection

<!--
-->
