<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;

class HoniController extends Controller
{

    public function genhtml ($s) {
        return new HtmlString($s);
    }

    public function gotoTop(){
        return redirect('view');
    }

    public function funu (){
        return 'ふぬふぬ';
    }
}
