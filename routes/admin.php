<?php
use App\Http\Controllers\Admin\attributeController;
use App\Http\Controllers\Admin\attributeValueController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\colorController;
use App\Http\Controllers\Admin\dashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\profileController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\sizeController;
use Illuminate\Support\Facades\Route;




Route::get('/dashboard', function () {
    return view('admin/index');
});
Route::get('/profile',[profileController::class,'index']);
Route::post('/saveProfile', [ProfileController::class, 'store']);
Route::get('/home_Banner',[HomeBannerController::class,'index']);
Route::post('/updateHomeBanner',[HomeBannerController::class, 'store']);
Route::get('/deleteData/{id?}/{table?}',action: [dashboardController::class, 'deleteData']);
Route::get('/manage_size',[sizeController::class,'index']);
Route::post('/updateManageSize',[sizeController::class, 'store']);
Route::get('/manage_color',[ColorController::class,'index']);
Route::post('/updateManageColor',[colorController::class, 'store']);
//attribute
Route::get('/attribute_name',[attributeController::class,'index_attribute_name']);
Route::post('/update_attribute_name',[attributeController::class, 'store_attribute_name']);
Route::get('/category',[CategoryController::class,'index']);
Route::post('/updateCategory',[CategoryController::class, 'store']);
//attribute_value
Route::get('/attribute_value',[attributeController::class,'index_attribute_value']);
Route::post('/update_attribute_value',[attributeController::class, 'store_attribute_value']);
Route::get('/category_attribute',[CategoryController::class,'index_category_attribute']);
Route::post('/update_category_attribute',[CategoryController::class, 'store_category_attribute']);
//brand
Route::get('/brand',[BrandController::class,'index']);
Route::post('/updateBrand',[BrandController::class, 'store']);
Route::get('/product',[ProductController::class,'index']);
Route::get('/manage_product/{id?}',[ProductController::class,'view_product']);
Route::post('/updateProduct',[ProductController::class, 'store']);
Route::post('/removeAttrId',[ProductController::class, 'removeAttrId']);
// Route::get('/updateProduct',[ProductController::class, 'store']);

Route::post('/getAttributes',[ProductController::class, 'getAttributes']);