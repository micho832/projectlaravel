<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/login',[AuthController::class,'doLogin']);

Route::group(['prefix'=>'chatting'],function (){
  Route::get('/',[\App\Http\Controllers\Api\ChatsApiController::class,'getChats']);
  Route::get('/{uid}/messages',[\App\Http\Controllers\Api\ChatsApiController::class,'getMessages']);
  Route::post('/{uid}/send',[\App\Http\Controllers\Api\ChatsApiController::class,'sendMessages']);
});

Route::group(['prefix'=>'categories'],function (){
    Route::get('/',[\App\Http\Controllers\Api\CategoryController::class,'index']);
    Route::get('/{cid}/products',[\App\Http\Controllers\Api\CategoryController::class,'getCatProduct']);
});

Route::group(['prefix'=>'products'],function (){
    Route::get('/{pid}/details',[\App\Http\Controllers\Api\ProductController::class,'productDatails']);

});

