<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/view', [HoniController::class, 'sendDefDate']);

Route::post('/view', [HoniController::class, 'sendSelDate'])->name('viewchgdate');

Route::post('/reserve', function () {
    echo "ss";
})->name('rsvin');
