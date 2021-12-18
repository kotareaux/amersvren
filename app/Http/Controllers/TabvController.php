<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AvlTime;
use App\Models\ActivTab;
use App\Models\DefD;
use App\Models\Reserve;

//use App\Models\ActivTab;
//use Illuminate\Support\Facades\DB;

class TabvController extends Controller
{
    //選択された年・月を表表示に送る
    public function sendSelDate (Request $request){
        $yyyy = $request->yyyy;
        $mm = $request->month+1;
        $altab = ActivTab::where([
            ['yyyy', $yyyy],
            ['mm', $mm],
        ])->exists();
        $avly = [];
        $ravly = ActivTab::groupBy('yyyy')->get(['yyyy'])->toArray();
        foreach ($ravly as $row){
            $avly[$row['yyyy']] = $row['yyyy'];
        }
        if($altab){
            $atim = $this->getaTime($yyyy, $mm);
            $rsinf = $this->getRsv($yyyy, $mm);
            return view('index', [
                'avly' => $avly,
                'tyear' => $yyyy,
                'tmnth' => $mm,
                'tinfo' => $atim,
                'rinfo' => $rsinf
            ]);
        }else{
            return view('index_notab', [
                'avly' => $avly,
                'tyear' => $yyyy,
                'tmnth' => $mm,
            ]);
        }
    }

    public function sendDefDate (){
        if(Auth::check()){
            $defa = DefD::first();  //管理者モードの場合はformanageのdefay,defam参照
        }else{
            $defa = [
                "defay" => idate('Y'),
                "defam" => idate('m')
            ];
        }

        $yyyy = $defa['defay'];
        $mm = $defa['defam'];
        //sendseldateからコピ
        $altab = ActivTab::where([
            ['yyyy', $yyyy],
            ['mm', $mm],
        ])->exists();
        $avly = [];
        $ravly = ActivTab::groupBy('yyyy')->get(['yyyy'])->toArray();
        foreach ($ravly as $row){
            $avly[$row['yyyy']] = $row['yyyy'];
        }
        if($altab){
            $atim = $this->getaTime($yyyy, $mm);
            $rsinf = $this->getRsv($yyyy, $mm);
            return view('index', [
                'avly' => $avly,
                'tyear' => $yyyy,
                'tmnth' => $mm,
                'tinfo' => $atim,
                'rinfo' => $rsinf
            ]);
        }else{
            return view('index_notab', [
                'avly' => $avly,
                'tyear' => $yyyy,
                'tmnth' => $mm,
            ]);
        }

    }

    public function getaTime ($yyyy, $mm){
        $kekka = [];
        $ravlt = AvlTime::where([['yyyy', $yyyy], ['mm', $mm]])->get()->toArray();
        foreach ($ravlt as $row){
            $kekka[$row["dayid"]][$row["timeid"]] = $row;
        }
        return $kekka;
    }

    public function getRsv ($yyyy, $mm){
        $kekka = [];
        $kind = array("個人練", "バンド練", "使用不可");
        $rsvdb = Reserve::where([['yyyy', $yyyy], ['mm', $mm]])->get(['date', 'time', 'band', 'name', 'biko'])->toArray();
        foreach ($rsvdb as $row){
            $kekka[$row['date']][$row['time']] = $row;
            $kekka[$row['date']][$row['time']]['sband'] = $kind[$kekka[$row['date']][$row['time']]['band']];
        }
        return $kekka;
    }
}
