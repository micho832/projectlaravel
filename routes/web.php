<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;

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

//route login
Route::group(['prefix'=>'login'],function (){

    Route::get('/',[AuthController::class,"getLoginView"])->name('login');
    Route::post('/',[AuthController::class,"doLogin"]);
});
//route register
Route::group(['prefix'=>'register'],function (){

    Route::get('/',[AuthController::class,"getRegisterView"]);
    Route::post('/',[AuthController::class,"doRegister"]);
});
//route logout
Route::get('/logout',[AuthController::class,"doLogout"]);
//route contact-us
Route::group(['prefix'=>'contact-us'],function (){
    Route::get('/',[ContactController::class,"getContactView"])->name('contact-us');
    Route::post('/',[ContactController::class,"saveFeedback"]);
});
//route cart
Route::group(['prefix'=>'shopping-cart'],function (){
   Route::get('/',[\App\Http\Controllers\CartController::class,"index"]);
   Route::post('/delete',[\App\Http\Controllers\CartController::class,"deleteItemFromCart"]);
   Route::post('/delete-all',[\App\Http\Controllers\CartController::class,"deleteCart"]);

});
//route add to cart
Route::group(['prefix'=>'/'],function (){
    Route::get('/home',[\App\Http\Controllers\HomeController::class,"index"]);
    Route::post('/home',[\App\Http\Controllers\HomeController::class,"addToCaret"]);

});


Route::group(['prefix'=>'tests'],function (){
    Route::get('/upload-file',[TestController::class,"getUploadView"]);
    Route::post('/upload-file',[TestController::class,"doUpload"]);

});



//route is admin
Route::group(['prefix'=>'/admin','middleware'=>['isAdmin','auth']],function (){
    Route::get('/',[\App\Http\Controllers\Dashboard\IndexDashboardController::class,"index"]);
    Route::get('/users',[\App\Http\Controllers\Dashboard\UserDashboardController::class,"index"]);
    Route::get('/logout',[\App\Http\Controllers\Dashboard\IndexDashboardController::class,"doLogout"]);


});
//route home
Route::group(['prefix'=>'home'],function (){
    Route::get('/',[\App\Http\Controllers\HomeController::class,"getHomeView"])->name('home');

});
//route email verification
Route::get('/sendmail',[\App\Http\Controllers\MailController::class,'sendMail']);





