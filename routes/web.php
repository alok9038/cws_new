<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaytmController;
use App\Http\Controllers\User\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,"home"])->name('homepage');

Route::get('/course/{slug}/{id}',[HomeController::class,"viewCourse"])->name('home.course.view');

Route::get('/forgot-password',[HomeController::class,'forgotPassword'])->name('forgot.password');

Route::middleware('auth')->group(function () {

    Route::post('/enroll-course',[EnrollController::class,'add'])->name('enroll');

    Route::get('/enroll-course',[EnrollController::class,"viewEnroll"])->name('get.enroll');

    Route::post('/drop-enroll',[EnrollController::class,"dropEnroll"])->name('drop.enroll');

    Route::post('/change-password',[MainController::class,'changePassword'])->name('change.password');

    Route::post('/checkout',[EnrollController::class,'checkout'])->name('checkout');

    Route::post('/pay',[EnrollController::class,'payDues'])->name('pay.dues');

});

Route::get('payment/{id}',[PaytmController::class,'pay'])->name('paytm.payment');
Route::post('paytm-callback',[PaytmController::class,'paytmcallback'])->name('paytm.callback');
Route::get('payment',[PaytmController::class,'paytmPurchase'])->name('paytm.purchase');


Route::prefix('user')->middleware('auth')->group(function () {

    Route::get('/',[MainController::class,"index"])->name('user.dashboard');

    Route::get('/setting',[MainController::class,"setting"])->name('user.setting');

    Route::get('/course',[MainController::class,"course"])->name('user.course');

    Route::get('/payments',[MainController::class,"payment"])->name('user.payments');
    Route::get('/payments/{course}/{id}',[MainController::class,"paymentRecords"])->name('user.payment.record');
});

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/',[AdminController::class,"index"])->name('admin.dashboard');

    Route::get('/earning',[AdminController::class,"earning"])->name('admin.earning');
    Route::get('/due-payments',[AdminController::class,"duePayments"])->name('admin.due.payments');

    Route::get('/courses',[CourseController::class,"viewCourse"])->name('view.courses');
    Route::get('/add-course',[CourseController::class,"addCourse"])->name('add.course.view');
    Route::post('/add-course',[CourseController::class,"storeCourse"])->name('add.course');
    Route::delete('/drop-course',[CourseController::class,"dropCourse"])->name('drop.course');

    Route::get('/students',[AdminController::class,"students"])->name('admin.students');
    Route::get('/filter',[AdminController::class,"students"])->name('view.user.filter');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
