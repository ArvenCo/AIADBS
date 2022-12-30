<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\RemarkController;
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

Route::middleware('auth')->get('/', function () {
    return view('main');
});



Route::middleware('auth')->get('/tests', [App\Http\Controllers\TestController::class, 'index']);
Route::middleware('auth')->get('/test/create', function(){
    return view('forms.test_create');
});

Route::middleware('auth')->post('/test', [App\Http\Controllers\TestController::class, 'store']);

Route::middleware('auth')->get('/analysis',function(){
    return view('forms.analysis');
});

Route::middleware('auth')->post('/analysis', [App\Http\Controllers\RemarkController::class , 'store']);


Route::middleware('auth')->get('/analysis/create/{id}',[App\Http\Controllers\RemarkController::class,'create']);

Auth::routes(); 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('main');   