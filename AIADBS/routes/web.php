<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\RemarkController;
use App\Http\Controllers\ItemController;
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

Route::middleware('verified')->get('/', function () {
    return view('main');
});



Route::middleware('verified')->get('/test', [App\Http\Controllers\TestController::class, 'index']);
Route::middleware('verified')->get('/analysis_list', [App\Http\Controllers\TestController::class, 'index']);
Route::middleware('verified')->get('/print', [App\Http\Controllers\TestController::class, 'index']);
Route::middleware('verified')->get('/test/create', function(){
    return view('forms.test_create');
});

Route::middleware('verified')->post('/test', [App\Http\Controllers\TestController::class, 'store']);

Route::middleware('verified')->get('/test/show/{id}',[App\Http\Controllers\TestController::class, 'show']);


Route::middleware('verified')->get('/test/{id}',[App\Http\Controllers\TestController::class, 'create']);
Route::middleware('verified')->post('/test/{id}',[App\Http\Controllers\TestController::class, 'update']);
Route::middleware('verified')->post('/edittest/{id}',[App\Http\Controllers\TestController::class, 'edit']);
Route::middleware('verified')->get('/analysis/',function(){
    return view('forms.analysis');
});

Route::middleware('verified')->post('/item/{id}',[App\Http\Controllers\ItemController::class, 'update']);

Route::middleware('verified')->post('/analysis', [App\Http\Controllers\RemarkController::class , 'store']);


Route::middleware('verified')->get('/analysis/create/{id}',[App\Http\Controllers\RemarkController::class,'create']);
Route::middleware('verified')->post('/analysis/update',[App\Http\Controllers\RemarkController::class,'update']);

Route::middleware('verified')->get('/analysis/{id}', [App\Http\Controllers\RemarkController::class , 'show']);

Route::middleware('verified')->get('/print/show/{id}',[App\Http\Controllers\RemarkController::class,'show']);

Auth::routes([
    'verify' => true
]); 
Route::middleware('verified')->get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('main');   