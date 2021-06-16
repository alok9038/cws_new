<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,"home"])->name('homepage');

Route::get('/course/{slug}/{id}',[HomeController::class,"viewCourse"])->name('home.course.view');

Route::prefix('user')->middleware('auth')->group(function () {
    Route::get('/course', function () {
        return view('home.user.myCourse');
    });

    Route::get('/enroll', function () {
        return view('home.enroll');
    });

    Route::get('/', function () {
        return view('home.user.index');
    })->name('user.dashboard');
});

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/',[AdminController::class,"index"])->name('admin.dashboard');

    Route::get('/courses',[CourseController::class,"viewCourse"])->name('view.courses');

    Route::get('/add-course',[CourseController::class,"addCourse"])->name('add.course.view');
    Route::post('/add-course',[CourseController::class,"storeCourse"])->name('add.course');

    Route::delete('/drop-course',[CourseController::class,"dropCourse"])->name('drop.course');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
