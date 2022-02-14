<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DefTab;

class AdminFuncController extends Controller
{
    public function setDefTab(Request $request){
        $tym = $request->tym;
        $atym = json_decode(base64_decode(str_rot13($tym)));
        $setDef = DefTab::where('id', 1)->update([
            'defay' => $atym[0],
            'defam' => $atym[1]
        ]);
        if($setDef){
            header('Refresh: 5; URL=/');
            echo('設定が完了しました。<br>5秒後にトップへ戻ります。<br><a href="/">あるいはここからトップへ</a>');
        }else{
            header('Refresh: 5; URL=/');
            die('エラー：データの登録に失敗しました。<br>5秒後にトップへ戻ります。');
        }
    }
}
