<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserve;

class RsvController extends Controller
{
    public function sendRsv(Request $request){
        $resinput = $request->only(['name', 'kind', 'biko', 'res']);
        $srestime = json_decode(base64_decode(str_rot13($resinput['res'])));
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
        #使える表への予約かどうか

        #重複確認
        $aru = Reserve::where([
                ['yyyy', $srestime->yyyy],
                ['mm', $srestime->mm],
                ['date', $srestime->day],
                ['time', $srestime->timeid]
            ])->exists();

        if($aru){
            header('Refresh: 5; URL=/');
            die('エラー：予約データが重複しています。<br>5秒後にトップへ戻ります。');
        }else{
            #insert
            $ins = Reserve::insert(
                [
                    'yyyy' => $srestime->yyyy,
                    'mm' => $srestime->mm,
                    'date' => $srestime->day,
                    'time' => $srestime->timeid,
                    'band' => $resinput['kind'],
                    'name' => $resinput['name'],
                    'biko' => $resinput['biko'],
                ]
            );
            if($ins){
                header('Refresh: 5; URL=/');
                echo('予約が完了しました。<br>5秒後にトップへ戻ります。<br><a href="/">あるいはここからトップへ</a>');
            }else{
                header('Refresh: 5; URL=/');
                die('エラー：データの登録に失敗しました。<br>5秒後にトップへ戻ります。');
            }
        }


        #insert into availabletime (yyyy, mm, dayid, timeid, starttime, endtime, timename) select yyyy, '6' as mm, dayid, timeid, starttime, endtime, timename from availabletime where mm = '5';
        #insert into reserves のとき、使用不可のnameは''にする

    }
}
