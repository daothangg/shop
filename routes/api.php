<?php

use App\Http\Controllers\auth\authController;
use App\Http\Controllers\frontend\CategoryController;
use App\Http\Controllers\frontend\HomepageController;
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
Route::post('/auth/login',[authController::class,'loginUser']);


Route::post('/auth/register',[authController::class,'register']);
// Route::get('/api/user',[authController::class,'register']);
Route::group(['middleware'=>['auth:sanctum']],function () {
   Route::get('/user',function(Request $request){
    return $request->user();
   });
   Route::post('/UpdateUser',[authController::class,'UpdateUser']);
   Route::post('/auth/logout',function(Request $request){
    auth()->user()->tokens()->delete();
    return [
        'message'=>'Tonkens Revoked'
    ];
   });

});
//frontend data
Route::get('/getHomeData',[HomepageController::class,'getHomeData']);
Route::get('/getHeaderCategoriesData',[HomepageController::class,'getcategoriesData']);