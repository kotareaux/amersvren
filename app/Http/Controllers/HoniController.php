<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AvlTime;
use App\Models\DefD;
use Illuminate\Support\HtmlString;

//use App\Models\ActivTab;
//use Illuminate\Support\Facades\DB;

class HoniController extends Controller
{
    //選択された年・月を表表示に送る
    public function sendSelDate (Request $request){
        echo ($request->size);
        echo ($request->month);
        $this->drawTable([1900, 12]);
        return view('index');
    }

    public function sendDefDate (){
        $defa = DefD::first();
        $yyyy = $defa['defay'];
        $mm = $defa['defam'];
        $ttbid = $yyyy."_".$mm;
        $atim = $this->getaTime($ttbid);
        $rsinf = $this->getRsv($ttbid);
        return view('index', [
            'tyear' => $yyyy,
            'tmnth' => $mm,
            'tinfo' => $atim,
            'rinfo' => $rsinf
        ]);
    }


    public function funu (){

    }

    public function getaTime ($ttbid){
        $kekka = [];
        $ravlt = AvlTime::where('targettable',  $ttbid)->get()->toArray();
        foreach ($ravlt as $row){
            $kekka[$row["dayid"]][$row["timeid"]] = $row;
        }
        return $kekka;
    }

    public function getRsv ($ttbid){
        $kekka = [];
        $kind = array("個人練", "バンド練", "使用不可");
        $rsvdb = \DB::table($ttbid)->get()->toArray();
        foreach ($rsvdb as $row){
            $kekka[$row->date][$row->time] = $row;
            $kekka[$row->date][$row->time]->sband = $kind[$kekka[$row->date][$row->time]->band];
        }
        return $kekka;
    }

    public function genhtml ($s) {
        return new HtmlString($s);
    }
}
