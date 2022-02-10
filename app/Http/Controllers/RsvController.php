<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reserve;

class RsvController extends Controller
{
    public function sendRsv(Request $request){
        $resinput = $request->only(['name', 'kind', 'biko', 'res']);
        $srestime = json_decode(base64_decode(str_rot13($resinput['res'])),true);
        extract($srestime);
        /*
            array(4) {
            ["name"]=>
            string(1) "a"
            ["kind"]=>
            string(1) "0"
            ["biko"]=>
            NULL
            ["res"]=>
            string(176) "rlW5rKy5VwblZQVkYPWgoFV6AFjvMTS5nJDvBwLfVaEcoJIcMPV6ZPjvp3EupaE0nJ1yVwbvZGp6ZQNvYPWyozE0nJ1yVwbvZGx6ZQNvYPW0nJ1yozSgMFV6Vyk1AGV0MSk1AGZ0LFVfVzEurFV6ZFjvrJ91LzxvBvWpqGH3ZJLvsD=="
            }
            object(stdClass)#281 (9) {
            ["yyyy"]=>
            int(2021)
            ["mm"]=>
            int(5)
            ["dayid"]=>
            int(6)
            ["timeid"]=>
            int(0)
            ["starttime"]=>
            string(5) "17:00"
            ["endtime"]=>
            string(5) "19:00"
            ["timename"]=>
            string(6) "前半"
            ["day"]=>
            int(1)
            ["youbi"]=>
            string(3) "土"
            }
        */


        #重複確認
        if($dateOrTime==0){
            for($i=0; $i<(int)$tpy; $i++){
                $aru = Reserve::where([
                    ['yyyy', $yyyy],
                    ['mm', $mm],
                    ['date', $day],
                    ['time', $i]
                ])->exists();
                if($aru){
                    break;
                }
            }
        }elseif($dateOrTime==1){
            $aru = Reserve::where([
                ['yyyy', $yyyy],
                ['mm', $mm],
                ['date', $day],
                ['time', $timeid]
            ])->exists();
        }else{
            header('Refresh: 5; URL=/');
            die('エラー：内部エラーが発生しました。<br>5秒後にトップへ戻ります。');
        }


        if($aru){
            header('Refresh: 5; URL=/');
            die('エラー：予約データが重複しています。<br>5秒後にトップへ戻ります。');
        }else{
            if (Auth::check()){
            #insert 使用不可
                if($dateOrTime==0){
                    for($i=0; $i<(int)$tpy; $i++){
                        $ins = Reserve::insert(
                            [
                                'yyyy' => $yyyy,
                                'mm' => $mm,
                                'date' => $day,
                                'time' => $i,
                                'band' => 2,
                                'name' => '',
                                'biko' => $resinput['biko'],
                            ]
                        );
                    }
                }elseif($dateOrTime==1){
                    $ins = Reserve::insert(
                        [
                            'yyyy' => $yyyy,
                            'mm' => $mm,
                            'date' => $day,
                            'time' => $timeid,
                            'band' => 2,
                            'name' => '',
                            'biko' => $resinput['biko'],
                        ]
                    );
                }
            }else{
            #insert 予約
                $ins = Reserve::insert(
                    [
                        'yyyy' => $yyyy,
                        'mm' => $mm,
                        'date' => $day,
                        'time' => $timeid,
                        'band' => $resinput['kind'],
                        'name' => $resinput['name'],
                        'biko' => $resinput['biko'],
                    ]
                );
            }

            if($ins){
                header('Refresh: 5; URL=/');
                if(Auth::check()){
                    echo('設定が完了しました。<br>5秒後にトップへ戻ります。<br><a href="/">あるいはここからトップへ</a>');
                }else{
                    echo('予約が完了しました。<br>5秒後にトップへ戻ります。<br><a href="/">あるいはここからトップへ</a>');
                }
            }else{
                header('Refresh: 5; URL=/');
                die('エラー：データの登録に失敗しました。<br>5秒後にトップへ戻ります。');
            }
        }


        #insert into availabletime (yyyy, mm, dayid, timeid, starttime, endtime, timename) select yyyy, '6' as mm, dayid, timeid, starttime, endtime, timename from availabletime where mm = '5';

    }
}
