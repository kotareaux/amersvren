<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/{key}', function () {
    return $key;
})->name('honi');

Route::get('/tes', function () {
    $items = \DB::table('2021_4')->get();
    return view('index',[
        'db1'=>$items
    ]);
});
