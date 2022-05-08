<?php

use App\Http\Controllers\PersonController;
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
    return view('person');
});
Route::get('person',[PersonController::class,'index']);
Route::get('person/{id}',[PersonController::class,'detail']);
Route::post('person',[PersonController::class,'store']);
Route::put('person/{id}',[PersonController::class,'update']);
Route::delete('person/{id}',[PersonController::class,'delete']);
