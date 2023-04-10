<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EducatorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RemarkController;
use App\Http\Controllers\SetController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TrashController;



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

Route::middleware(['auth'])->group(function () {
    Route::prefix('set')->group(function () {
        Route::post('store', [SetController::class, 'store']);
    });
    
});


Route::middleware('auth')->get('/analysis_list', [TestController::class, 'index']);
Route::middleware('auth')->get('/test', [TestController::class, 'index']);
Route::middleware('auth')->get('/print', [TestController::class, 'index']);
Route::middleware('auth')->get('/test/create', function(){
    return view('forms.test_create');
});

Route::middleware('auth')->post('/test', [TestController::class, 'store']);

Route::middleware('auth')->get('/test/show/{id}',[TestController::class, 'show']);


Route::middleware('auth')->get('/test/{id}',[SetController::class, 'create']);
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

Route::middleware(['auth'])->group(function(){

    Route::prefix('analysis')->group(function () {
        Route::get('edit/{id}', function($id){
            return view('forms.analysis_edit', ['test_id' => $id]);
        })->name('analysis.edit');
    });

    Route::prefix('courses')->group(function () {

       
        Route::get('index',[CourseController::class,'index']);
        Route::get('show',[CourseController::class,'show']);
        Route::post('store',[CourseController::class,'store']);
        Route::post('destroy',[CourseController::class,'destroy']);
    });

    Route::prefix('department')->group(function () {
        Route::post('show',[DepartmentController::class,'show']);
        Route::post('update',[DepartmentController::class,'update']);

         Route::get('show/course',[DepartmentController::class,'byCourse']);
    });

    Route::prefix('educator')->group(function(){
        Route::post('retrieve/{id}',[EducatorController::class, 'retrieveIt']);
        Route::get('edit',[EducatorController::class, 'show']);
        Route::post('update',[EducatorController::class, 'update']);
        Route::get('show',[EducatorController::class, 'show']);
    });

    Route::prefix('user')->group(function () {
        Route::post('subjects/save',[MainController::class, 'saveSubjects']);
        Route::get('subjects',[MainController::class, 'getSubjects']);
    });
    
    Route::prefix('sets')->group(function () {
        Route::get('index',[SetController::class, 'index']);
    });
    
    Route::prefix('subjects')->group(function () {
        Route::get('show',[SubjectController::class, 'show']);
    });

    Route::prefix('remarks')->group(function () {
        Route::get('edit',[RemarkController::class, 'edit']);
    });
});
Route::middleware('auth')->get('/print/show/{id}',[RemarkController::class,'show']);
Route::middleware('auth')->get('/showData/{id}',[RemarkController::class,'showData'])->name('show.data');
Route::middleware('auth')->get('/databank/show/{id}',[RemarkController::class,'show']);


Route::middleware('auth')->get('/educator/create', [EducatorController::class,'create'])->name('educator.create');

Route::middleware('auth')->get('/department/create', [DepartmentController::class,'create'])->name('department.create');
Route::middleware('auth')->get('/department/show', [DepartmentController::class,'show'])->name('department.show');
Route::middleware('auth')->get('/departments', [DepartmentController::class,'index'])->name('department.index');
Route::middleware('auth')->post('/department', [DepartmentController::class, 'store'])->name('department.register');
Route::middleware('auth')->get('/getfunction/{office}', [DepartmentController::class, 'getDepartmentsBy'])->name('department.getDepartment');

Route::middleware('auth')->get('/register-user', [EducatorController::class, 'index'])->name('educator.index');
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
    Route::get('create/{id}', [AnswerController::class, 'create']);
});

Route::prefix('items')->group(function () {
    Route::get('/index/{id}', [ItemController::class, 'index'])->name('items.index');
});
Route::middleware('auth')->get('/subjects-by/{department}', [SubjectController::class, 'subjectsBy'])->name('subjects-by-department');

Route::middleware('auth')->get('/account',function(){})->name('update-account');


Route::middleware('auth')->post('/trashed',[TrashController::class, 'store']);
Auth::routes([
   
]); 
Route::middleware('auth')->get('/dashboard', [HomeController::class, 'index'])->name('main');   