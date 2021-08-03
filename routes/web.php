<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\TabvController;
use App\Http\Controllers\RsvController;
use App\Http\Controllers\HoniController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/view', 301);

/*
Route::get('/view', function () {
    $items = \DB::table('2021_4')->get();
    return view('index',[
        'db1'=>$items
    ]);
});
*/

Route::get('/view', [TabvController::class, 'sendDefDate']);

Route::post('/view', [TabvController::class, 'sendSelDate'])->name('viewchgdate');

Route::get('/reserve', [HoniController::class, 'gotoTop']);

Route::post('/reserve', function (Request $request) {
    return view('reserve', [
        'res'=>$request->jrsi
    ]);
})->name('rsvin');

Route::get('/send', [HoniController::class, 'gotoTop']);
Route::post('/send', [RsvController::class, 'sendRsv'])->name('rsvset');

