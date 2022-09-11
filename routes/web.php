<?php

use App\Http\Controllers\Backend\Teacher\teacherController;
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

Route::get('/admin', function () {
    return view('backend.index');
})->middleware(['myauth'])->name('admin');

Route::get('/student_feed', function () {
    return view('frontend.student.student');
})->middleware(['auth'])->name('student_feed');

Route::get('/teacher_feed', function () {
    return view('frontend.student.student');
})->middleware(['auth'])->name('teacher_feed');

Route::group(['prefix'=>'/student_feed'],function(){
    Route::group(['prefix'=>'/view'],function(){
        Route::get('/studentview',[teacherController::class,'index'])->name('view')->middleware(['auth']);
       
    });

});

Route::group(['prefix'=>'/admin'],function(){
    Route::group(['prefix'=>'/teacher-view'],function(){
        Route::get('/teacherview',[teacherController::class,'index'])->name('teacherview')->middleware(['auth']);
        Route::get('/addteacherview',[teacherController::class,'addteacherview'])->name('addteacherview')->middleware(['auth']);
        Route::post('/addteacher',[teacherController::class,'store'])->name('addteacher')->middleware(['auth']);
        Route::get('/editteacher/{id}',[teacherController::class,'edit'])->name('editteacher')->middleware(['auth']);
        Route::post('/updateteacher/{id}',[teacherController::class,'update'])->name('updateteacher')->middleware(['auth']);
        Route::get('/deleteteacher/{id}',[teacherController::class,'destroy'])->name('deleteteacher')->middleware(['auth']);
    });

});

require __DIR__.'/auth.php';
