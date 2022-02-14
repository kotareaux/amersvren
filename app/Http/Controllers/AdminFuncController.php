<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminFuncController extends Controller
{
    public function setDefTab(Request $request){
        $path = base_path('.env');
        $tym = $request->tym;
        $atym = json_decode(base64_decode(str_rot13($tym)));
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
            'DEFY=' . config('app.DEFY'),
            'DEFY=' . $atym[0],
            file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
            'DEFM=' . config('app.DEFM'),
            'DEFM=' . $atym[1],
            file_get_contents($path)
            ));
            echo('done');
        }else{
            die('error');
        }
    }
}
