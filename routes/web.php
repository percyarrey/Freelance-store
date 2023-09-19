<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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


use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/* VERIFY EMAIL */
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


/* DEFUALT ROUTE*/


Route::get('/',[HomeController::class,'index']);

Route::get('/products/{product}',[HomeController::class,'show']);

Route::get('/products',[HomeController::class,'products']);

Route::get('/contact',  function(){
    return view('home.contact');
}); 
Route::get('/trackorder',  function(){
    return view('home.trackorder.index');
});

Route::get('/dashboard', function () {

    return view('dashboard');
})->middleware(['auth:sanctum', 'verified'])->name('dashboard');

        /* LOGIN ROUTE */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

        /* ADMIN ROUTE */
    Route::get('/redirect',[HomeController::class,'redirect']);

    /*manage category */
    Route::get('/category',[AdminController::class,'category']);
    Route::post('/addcategory',[AdminController::class,'addcategory']);
    Route::delete('/category/{category}',[AdminController::class,'destroycategory']);

    /* manage products */
    Route::get('/addproduct',[AdminController::class,'addproduct']);
    Route::get('/editproducts',[AdminController::class,'editproducts']);
    Route::get('/editproducts/{product}/edit',[AdminController::class,'editproduct']);

    Route::put('/createproduct',[AdminController::class,'createproduct']);
    Route::put('/editproducts/{product}/edit',[AdminController::class,'updateproduct']);

    
    Route::delete('/editproducts/{product}',[AdminController::class,'destroyproduct']);

        /* HOME ROUTE */
    /* manage carts */
    Route::get('/cart',[HomeController::class,'cart']);
    Route::post('/cart/{product}',[HomeController::class,'crudcart']);
    Route::delete('/cart/{cart}',[HomeController::class,'destroycart']);

    /* manage orders */
    Route::get('/orderdetail/{order}',[AdminController::class,'orderdetail']);
    Route::put('/orderdetail/{order}',[AdminController::class,'orderstatus']);
    Route::post('/order',[HomeController::class,'createorder']);
    Route::delete('/orderdetail/{order}',[AdminController::class,'destroyorder']);

    /* checkout */
    Route::get('/checkout/{order}',[HomeController::class,'checkout']);

    Route::post('/pdf/{order}', [HomeController::class, 'generatePdf'])->name('order.pdf');

        /* TRACK ORDER */
    Route::post('/trackorder',[HomeController::class,'trackorder']);    


        /* RECENT ORDERS */
    Route::get('/recentorder',[HomeController::class,'recentorder']);

    Route::post('/recentorder/{order}',[HomeController::class,'recenttrack']);
});

/*  buynow */
Route::get('/buynow/{product}',[HomeController::class,'buynow']);

