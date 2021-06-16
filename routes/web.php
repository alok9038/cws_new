<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaytmController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,"home"])->name('homepage');

Route::get('/course/{slug}/{id}',[HomeController::class,"viewCourse"])->name('home.course.view');

Route::middleware('auth')->group(function () {

    // Route::get('/payment',[CartController::class,"payment"])->name('payment.view');
    // Route::post('/payment',[CartController::class,"payment"])->name('payment');

    Route::post('/enroll-course',[EnrollController::class,'add'])->name('enroll');

    Route::get('/enroll-course',[EnrollController::class,"viewEnroll"])->name('get.enroll');

    Route::post('/checkout',[EnrollController::class,'checkout'])->name('checkout');

});

Route::get('payment/{id}',[PaytmController::class,'pay'])->name('paytm.payment');
Route::post('paytm-callback',[PaytmController::class,'paytmcallback'])->name('paytm.callback');
Route::get('payment',[PaytmController::class,'paytmPurchase'])->name('paytm.purchase');


Route::prefix('user')->middleware('auth')->group(function () {
    Route::get('/course', function () {
        return view('home.user.myCourse');
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
