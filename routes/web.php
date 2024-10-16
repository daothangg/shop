<?php

use App\Http\Controllers\auth\authController;
use App\Http\Controllers\frontend\HomepageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
    // return redirect('admin/dashboard');
});
Route::get('/admin', function () {
    return redirect('admin/dashboard');
});
// Route::get('/createAdmin',[AuthController::class,'createCustomer']);
Route::get('/login', function () {
    return view('auth/signin');
});
Route::post('/login_user',[authController::class,'loginUser']);

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});
Route::get('/apiDocs', function () {
    return view('apiDocs');
});
