<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\RemarkController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\EducatorController;
use App\Http\Controllers\DepartmentController;

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
    return redirect('dashboard');
});




Route::middleware('auth')->get('/analysis_list', [App\Http\Controllers\TestController::class, 'index']);
Route::middleware('auth')->get('/test', [App\Http\Controllers\TestController::class, 'index']);
Route::middleware('auth')->get('/print', [App\Http\Controllers\TestController::class, 'index']);
Route::middleware('auth')->get('/test/create', function(){
    return view('forms.test_create');
});

Route::middleware('auth')->post('/test', [App\Http\Controllers\TestController::class, 'store']);

Route::middleware('auth')->get('/test/show/{id}',[App\Http\Controllers\TestController::class, 'show']);


Route::middleware('auth')->get('/test/{id}',[App\Http\Controllers\TestController::class, 'create']);
Route::middleware('auth')->get('/test/create',[App\Http\Controllers\TestController::class, 'create']);

Route::middleware('auth')->post('/test/{id}',[App\Http\Controllers\TestController::class, 'update']);
Route::middleware('auth')->post('/edittest/{id}',[App\Http\Controllers\TestController::class, 'edit']);
Route::middleware('auth')->get('/analysis/',function(){
    return view('forms.analysis');
});

Route::middleware('auth')->post('/item/{id}',[App\Http\Controllers\ItemController::class, 'update']);

Route::middleware('auth')->post('/analysis', [App\Http\Controllers\RemarkController::class , 'store'])->name('analysis.store');

Route::middleware('auth')->get('/analysis/create/{id}',[App\Http\Controllers\RemarkController::class,'create']);
Route::middleware('auth')->post('/analysis/update',[App\Http\Controllers\RemarkController::class,'update']);

Route::middleware('auth')->get('/analysis/{id}', [App\Http\Controllers\RemarkController::class , 'show']);

Route::middleware('auth')->get('/print/show/{id}',[App\Http\Controllers\RemarkController::class,'show']);
Route::middleware('auth')->get('/showData/{id}',[App\Http\Controllers\RemarkController::class,'showData'])->name('show.data');
Route::middleware('auth')->get('/databank/show/{id}',[App\Http\Controllers\RemarkController::class,'show']);



Route::middleware('auth')->get('/educator/create', [App\Http\Controllers\EducatorController::class,'create'])->name('educator.create');

Route::middleware('auth')->get('/department/create', [App\Http\Controllers\DepartmentController::class,'create'])->name('department.create');
Route::middleware('auth')->get('/departments', [App\Http\Controllers\DepartmentController::class,'index'])->name('department.index');
Route::middleware('auth')->post('/department', [App\Http\Controllers\DepartmentController::class, 'store'])->name('department.register');
Route::middleware('auth')->get('/getfunction/{office}', [App\Http\Controllers\DepartmentController::class, 'getDepartmentsBy'])->name('department.getDepartment');


Route::middleware('auth')->get('/educators', [App\Http\Controllers\EducatorController::class, 'index'])->name('educator.index');
Route::middleware('auth')->post('/educator', [App\Http\Controllers\MainController::class, 'register'])->name('educator.register');
Route::middleware('auth')->post('/update-account/{id}', [App\Http\Controllers\MainController::class, 'update'])->name('account.update');

Route::middleware('auth')->get('/databank',function(){
    return view('forms.databank.show');
})->name('databank');
Route::middleware('auth')->get('/get-educators-department/{id}',[App\Http\Controllers\EducatorController::class, 'getDepartmentId'])->name('get-educator-department');
Route::middleware('auth')->get('/search/subject/{subject}',[App\Http\Controllers\ItemController::class, 'itemsBy']);


Route::middleware('auth')->get('/subjects-by/{department}', [App\Http\Controllers\SubjectController::class, 'subjectsBy'])->name('subjects-by-department');

Route::middleware('auth')->get('/account',function(){})->name('update-account');

Auth::routes([
   
]); 
Route::middleware('auth')->get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('main');   