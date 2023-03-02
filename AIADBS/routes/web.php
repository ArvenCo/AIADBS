<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\RemarkController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\EducatorController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnswerController;

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




Route::middleware('auth')->get('/analysis_list', [TestController::class, 'index']);
Route::middleware('auth')->get('/test', [TestController::class, 'index']);
Route::middleware('auth')->get('/print', [TestController::class, 'index']);
Route::middleware('auth')->get('/test/create', function(){
    return view('forms.test_create');
});

Route::middleware('auth')->post('/test', [TestController::class, 'store']);

Route::middleware('auth')->get('/test/show/{id}',[TestController::class, 'show']);


Route::middleware('auth')->get('/test/{id}',[TestController::class, 'create']);
Route::middleware('auth')->get('/test/create',[TestController::class, 'create']);

Route::middleware('auth')->post('/test/{id}',[TestController::class, 'update']);
Route::middleware('auth')->post('/edittest/{id}',[TestController::class, 'edit']);
Route::middleware('auth')->get('/analysis/',function(){
    return view('forms.analysis');
});

Route::middleware('auth')->post('/item/{id}',[ItemController::class, 'update']);

Route::middleware('auth')->post('/analysis', [RemarkController::class , 'store'])->name('analysis.store');

Route::middleware('auth')->get('/analysis/create/{id}',[RemarkController::class,'create']);
Route::middleware('auth')->post('/analysis/update',[RemarkController::class,'update']);

Route::middleware('auth')->get('/analysis/{id}', [RemarkController::class , 'show']);

Route::middleware('auth')->get('/print/show/{id}',[RemarkController::class,'show']);
Route::middleware('auth')->get('/showData/{id}',[RemarkController::class,'showData'])->name('show.data');
Route::middleware('auth')->get('/databank/show/{id}',[RemarkController::class,'show']);



Route::middleware('auth')->get('/educator/create', [EducatorController::class,'create'])->name('educator.create');

Route::middleware('auth')->get('/department/create', [DepartmentController::class,'create'])->name('department.create');
Route::middleware('auth')->get('/department/show/{id}', [DepartmentController::class,'show'])->name('department.show');
Route::middleware('auth')->get('/departments', [DepartmentController::class,'index'])->name('department.index');
Route::middleware('auth')->post('/department', [DepartmentController::class, 'store'])->name('department.register');
Route::middleware('auth')->get('/getfunction/{office}', [DepartmentController::class, 'getDepartmentsBy'])->name('department.getDepartment');

Route::middleware('auth')->get('/educators', [EducatorController::class, 'index'])->name('educator.index');
Route::middleware('auth')->post('/educator', [MainController::class, 'register'])->name('educator.register');
Route::middleware('auth')->post('/update-account/{id}', [MainController::class, 'update'])->name('account.update');

Route::middleware('auth')->get('/databank',function(){
    return view('forms.databank.show');
})->name('databank');
Route::middleware('auth')->get('/get-educators-department/{id}',[EducatorController::class, 'getDepartmentId'])->name('get-educator-department');
Route::middleware('auth')->get('/search/subject/{subject}',[ItemController::class, 'itemsBy']);

Route::group(['middleware' => 'auth', 'prefix' => 'subject'],function(){
    Route::get('show/{department}', [SubjectController::class, 'subjectsBy']);
    Route::post('store', [SubjectController::class, 'store']);
    Route::post('destroy', [SubjectController::class, 'destroy']);
        
});

Route::prefix('answer')->middleware('auth')->group(function () {
    Route::post('store', [AnswerController::class, 'store']);
    // Route::get('create/{id}', [AnswerController::class, 'create']);
    
    
    
});

Route::prefix('items')->group(function () {
    Route::get('/index/{id}', [ItemController::class, 'index'])->name('items.index');
});
Route::middleware('auth')->get('/subjects-by/{department}', [SubjectController::class, 'subjectsBy'])->name('subjects-by-department');

Route::middleware('auth')->get('/account',function(){})->name('update-account');


Route::middleware('auth')->post('/trashed',[TrashController::class, 'store']);
Route::middleware('auth')->get('/user/show/{id}', [EducatorController::class, 'show']);
Auth::routes([
   
]); 
Route::middleware('auth')->get('/dashboard', [HomeController::class, 'index'])->name('main');   