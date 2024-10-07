<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaundryController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function (){
    Route::post("/auth/register" , 'Register')->name('register');
    Route::post("/auth/verify-email" , 'VerifyEmail')->name('verify.email');
    Route::post("/auth/send-verify-email" , 'SendVerifyEmail')->name('send.verify.email');
    Route::post("/auth/add-password" , 'AddPassword')->name('add.password');
    Route::post("/auth/add-information" , 'AddInformation')->name('add.information');
    Route::post("/auth/login" , 'Login')->name('login');
});

Route::middleware('auth:sanctum')->group(function (){

    Route::controller(AuthController::class)->group(function (){
        Route::post("/auth/logout", 'Logout')->name('logout');
    });

    Route::controller(UserController::class)->group(function (){
        Route::get("/user/show", 'Show')->name('Show');
        Route::put("/user/edit", 'Edit')->name('Edit');
        Route::get("/user/profile", 'Profile')->name('Profile');
    });

    Route::controller(ShopController::class)->group(function (){
        Route::put("/shop/create", 'Create')->name('create.shop');
        Route::get("/shop/show", 'Show')->name('show.shop');
        Route::get("/shop/all", 'All')->name('all.shop');
    });

    Route::controller(VoucherController::class)->group(function (){
        Route::put("/voucher/create", 'Create')->name('create.voucher');
        Route::get("/voucher/show", 'Show')->name('show.voucher');
        Route::get("/voucher/all", 'All')->name('all.voucher');
    });

    Route::controller(TopUpController::class)->group(function (){
        Route::put("/shop/top-up", 'TopUp')->name('top.up');
    });


    Route::middleware('type:shop')->group(function () {

        Route::controller(ShopController::class)->group(function (){
            Route::put("/shop/edit", 'Edit')->name('edit.shop');
            Route::put("/shop/delete", 'Delete')->name('delete.shop');
        });

        Route::controller(LaundryController::class)->group(function (){
            Route::post("/laundry/create", 'Create')->name('create.laundry');
            Route::put("/laundry/edit", 'Edit')->name('edit.laundry');
            Route::delete("/laundry/delete", 'Delete')->name('delete.laundry');
            Route::get("/laundry/show", 'Show')->name('show.laundry');
            Route::get("/laundry/all", 'All')->name('all.laundry');
        });

        Route::controller(VoucherController::class)->group(function (){
            Route::put("/voucher/edit", 'Edit')->name('edit.voucher');
            Route::delete("/voucher/delete", 'Delete')->name('delete.voucher');
        });

    });

});
