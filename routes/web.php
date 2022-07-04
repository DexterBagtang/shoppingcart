<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

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
Route::get('/',([ClientController::class,'home']));
Route::get('/shop',([ClientController::class, 'shop']));
Route::get('/cart',([ClientController::class, 'cart']));
Route::get('/addtocart/{id}',([ClientController::class, 'addtocart']));
Route::post('/updateqty/{id}',([ClientController::class, 'updateqty']));
Route::get('/removeitem/{id}',([ClientController::class, 'removeitem']));
Route::get('/checkout',([ClientController::class, 'checkout']));

Route::get('/login',([ClientController::class,'login']));
Route::post('/accessaccount',([ClientController::class,'accessaccount']));
Route::get('/logout',([ClientController::class,'logout']));

Route::get('/signup',([ClientController::class,'signup']));
Route::post('/register',([ClientController::class,'register']));

Route::get('/order',([ClientController::class,'order']));
Route::post('/postcheckout',([ClientController::class,'postcheckout']));
Route::get('/payment-success',([ClientController::class,'payment_success']));
Route::get('/viewpdforder/{id}',([PdfController::class,'view_pdf']));



Route::get('/admin',([ProductController::class,'products']));

Route::get('/addcategory',([CategoryController::class,'addcategory']));
Route::get('/categories',([CategoryController::class,'categories']));
Route::post('/savecategory',([CategoryController::class,'savecategory']));
Route::get('/editcategory/{id}',([CategoryController::class,'editcategory']));
Route::post('/updatecategory',([CategoryController::class,'updatecategory']));
Route::get('/deletecategory/{id}',([CategoryController::class,'deletecategory']));



Route::get('/addslider',([SliderController::class,'addslider']));
Route::get('/slider',([SliderController::class,'slider']));
Route::post('/saveslider',([SliderController::class,'saveslider']));
Route::get('/editslider/{id}',([SliderController::class,'editslider']));
Route::post('/updateslider',([SliderController::class,'updateslider']));
Route::get('/destroyslider/{id}',([SliderController::class,'destroyslider']));
Route::get('/activateslider/{id}',([SliderController::class,'activateslider']));
Route::get('/deactivateslider/{id}',([SliderController::class,'deactivateslider']));




Route::get('/addproduct',([ProductController::class,'addproduct']));
Route::get('/products',([ProductController::class,'products']));
Route::post('/saveproduct',([ProductController::class,'saveproduct']));
Route::get('/editproduct/{id}',([ProductController::class,'editproduct']));
Route::post('/updateproduct',([ProductController::class,'updateproduct']));
Route::get('/destroyproduct/{id}',([ProductController::class,'destroyproduct']));
Route::get('/activateproduct/{id}',([ProductController::class,'activateproduct']));
Route::get('/deactivateproduct/{id}',([ProductController::class,'deactivateproduct']));
Route::get('/viewproductcategory/{category_name}',([ProductController::class,'viewproductcategory']));









//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');
//
//require __DIR__.'/auth.php';
