<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaytmController;
use App\Http\Controllers\User\MainController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\WorkshopController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,"home"])->name('homepage');

Route::get('/course/{slug}',[HomeController::class,"viewCourse"])->name('home.course.view');

Route::get('/forgot-password',[HomeController::class,'forgotPassword'])->name('forgot.password');

Route::middleware('auth')->group(function () {

    Route::post('/enroll-course',[EnrollController::class,'add'])->name('enroll');

    Route::get('/enroll-course',[EnrollController::class,"viewEnroll"])->name('get.enroll');

    Route::post('/drop-enroll',[EnrollController::class,"dropEnroll"])->name('drop.enroll');

    Route::post('/change-password',[MainController::class,'changePassword'])->name('change.password');

    Route::post('/checkout',[EnrollController::class,'checkout'])->name('checkout');

    Route::post('/pay',[EnrollController::class,'payDues'])->name('pay.dues');

    Route::post('/workshop-payment',[WorkshopController::class,'pay'])->name('workshop.paytm.payment');
    Route::post('/workshop-paytm-callback',[WorkshopController::class,'paytmcallback'])->name('workshop.paytm.callback');
    // Route::get('payment',[PaytmController::class,'paytmPurchase'])->name('paytm.purchase');


    Route::get('payment/{id}',[PaytmController::class,'pay'])->name('paytm.payment');
    Route::post('paytm-callback',[PaytmController::class,'paytmcallback'])->name('paytm.callback');
    Route::get('payment',[PaytmController::class,'paytmPurchase'])->name('paytm.purchase');

    Route::post('update-profile-image',[UserController::class,"updateDp"])->name('update.dp');
    Route::post('update-details',[UserController::class,"updateDetails"])->name('update.details');

});



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
    Route::get('/payments',[AdminController::class,"duePayments"])->name('admin.due.payments');

    Route::get('/back-dues',[AdminController::class,"backDues"])->name('admin.back.due');
    Route::post('/update-status',[AdminController::class,"backDuesStatus"])->name('admin.back.due.update');
    Route::post('/update-dues-amount',[AdminController::class,"updateDuesAmount"])->name('admin.back.due.amount');

    Route::get('/courses',[CourseController::class,"viewCourse"])->name('view.courses');
    Route::get('/add-course',[CourseController::class,"addCourse"])->name('add.course.view');
    Route::post('/add-course',[CourseController::class,"storeCourse"])->name('add.course');
    Route::get('/edit-course/{id}',[CourseController::class,"edit"])->name('edit.course.view');
    Route::post('/edit-course',[CourseController::class,"updateCourse"])->name('update.course');
    Route::delete('/drop-course',[CourseController::class,"dropCourse"])->name('drop.course');

    Route::get('/students',[AdminController::class,"students"])->name('admin.students');
    Route::post('/delete',[AdminController::class,"deleteStudent"])->name('delete.student');
    // Route::get('/filter',[AdminController::class,"students"])->name('view.user.filter');

    Route::get('/payment-settings',[AdminController::class,"paymentSetting"])->name('payment.setting.view');
    Route::post('/payment-settings',[AdminController::class,"paymentSettingStore"])->name('payment.setting');

    Route::get('/settings',[SiteSettingController::class,"viewSetting"])->name('setting.view');
    // Route::post('/settings',[SiteSettingController::class,"update"])->name('setting.update');

    Route::get('/workshop',[WorkshopController::class,"index"])->name('admin.workshop.view');
    Route::get('/workshop-create',[WorkshopController::class,"create"])->name('admin.workshop.create.view');
    Route::post('/workshop-create',[WorkshopController::class,"store"])->name('admin.workshop.create.store');
    Route::post('/workshop-delete',[WorkshopController::class,"delete"])->name('admin.drop.workshop');
    Route::get('/workshop-enrolled',[WorkshopController::class,"enrolled_student"])->name('admin.workshop.enrolled');

    Route::post('/update-admin-details',[SiteSettingController::class,"updateAdminDetails"])->name('update.admin.details');
    Route::post('/change-password',[SiteSettingController::class,"changePassword"])->name('change.password');

    Route::post('/update-site-details',[SiteSettingController::class,"updateDetails"])->name('update.site.details');
    Route::post('/update-logo',[SiteSettingController::class,"logo"])->name('update.site.logo');
    Route::post('/update-favicon',[SiteSettingController::class,"updateFavicon"])->name('update.site.favicon');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/new-desgin', function () {
    return view('admin2.index');
});

require __DIR__.'/auth.php';
