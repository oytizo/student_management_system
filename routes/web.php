<?php

use App\Http\Controllers\Backend\Teacher\teacherController;
use App\Http\Controllers\frontend\teacher\studentController;
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
    return view('frontend.teacher.teacher');
})->middleware(['auth'])->name('teacher_feed');

Route::group(['prefix'=>'/student_feed'],function(){
    Route::group(['prefix'=>'/view'],function(){
        Route::get('/studentview',[teacherController::class,'index'])->name('view')->middleware(['auth']);
       
    });

});

Route::group(['prefix'=>'/admin'],function(){
    Route::group(['prefix'=>'/teacher-view'],function(){
        Route::get('/teacherview',[teacherController::class,'index'])->name('teacherview')->middleware(['myauth']);
        Route::get('/addteacherview',[teacherController::class,'addteacherview'])->name('addteacherview')->middleware(['myauth']);
        Route::post('/addteacher',[teacherController::class,'store'])->name('addteacher')->middleware(['myauth']);
        Route::get('/editteacher/{id}',[teacherController::class,'edit'])->name('editteacher')->middleware(['myauth']);
        Route::post('/updateteacher/{id}',[teacherController::class,'update'])->name('updateteacher')->middleware(['myauth']);
        Route::get('/deleteteacher/{id}',[teacherController::class,'destroy'])->name('deleteteacher')->middleware(['myauth']);
    });

});

Route::group(['prefix'=>'/admin'],function(){
    Route::group(['prefix'=>'/student-view'],function(){
        Route::get('/studentview',[studentController::class,'index'])->name('studentview')->middleware(['myauth']);
    });

});

Route::group(['prefix'=>'/teacher_feed'],function(){
    Route::group(['prefix'=>'/teacher-dashboard'],function(){
        Route::get('/addstudent',[studentController::class,'index'])->name('addstudent')->middleware(['auth']);
        Route::get('/viewstudent',[studentController::class,'view'])->name('viewstudent')->middleware(['auth']);
        Route::post('/storestudent',[studentController::class,'store'])->name('storestudent')->middleware(['auth']);
        Route::post('/updatestudent/{id}',[studentController::class,'update1'])->name('updatestudent')->middleware(['auth']);
        Route::get('/editstudent/{id}',[studentController::class,'edit'])->name('editstudent')->middleware(['auth']);
        Route::get('/deletestudent/{id}',[studentController::class,'destroy'])->name('deletestudent')->middleware(['auth']);
    });

});

require __DIR__.'/auth.php';
