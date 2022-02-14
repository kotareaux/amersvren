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
            $request->session()->flash('toastr', config('toastr.defset'));
            return redirect('/view');
        }else{
            $request->session()->flash('toastr', config('toastr.error'));
            return redirect('/view');
        }
    }
}
