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



Route::middleware('auth')->get('/test', [App\Http\Controllers\TestController::class, 'index']);
Route::middleware('auth')->get('/analysis_list', [App\Http\Controllers\TestController::class, 'index']);
Route::middleware('auth')->get('/print', [App\Http\Controllers\TestController::class, 'index']);
Route::middleware('auth')->get('/databank', [App\Http\Controllers\TestController::class, 'index']);
Route::middleware('auth')->get('/test/create', function(){
    return view('forms.test_create');
});

Route::middleware('auth')->post('/test', [App\Http\Controllers\TestController::class, 'store']);

Route::middleware('auth')->get('/test/show/{id}',[App\Http\Controllers\TestController::class, 'show']);


Route::middleware('auth')->get('/test/{id}',[App\Http\Controllers\TestController::class, 'create']);
Route::middleware('auth')->post('/test/{id}',[App\Http\Controllers\TestController::class, 'update']);
Route::middleware('auth')->post('/edittest/{id}',[App\Http\Controllers\TestController::class, 'edit']);
Route::middleware('auth')->get('/analysis/',function(){
    return view('forms.analysis');
});

Route::middleware('auth')->post('/item/{id}',[App\Http\Controllers\ItemController::class, 'update']);

Route::middleware('auth')->post('/analysis', [App\Http\Controllers\RemarkController::class , 'store']);


Route::middleware('auth')->get('/analysis/create/{id}',[App\Http\Controllers\RemarkController::class,'create']);
Route::middleware('auth')->post('/analysis/update',[App\Http\Controllers\RemarkController::class,'update']);

Route::middleware('auth')->get('/analysis/{id}', [App\Http\Controllers\RemarkController::class , 'show']);

Route::middleware('auth')->get('/print/show/{id}',[App\Http\Controllers\RemarkController::class,'show']);
Route::middleware('auth')->get('/databank/show/{id}',[App\Http\Controllers\RemarkController::class,'show']);
Auth::routes([
    'verify' => true
]); 
Route::middleware('auth')->get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('main');   