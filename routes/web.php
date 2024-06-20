<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//add
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StripePaymentController;

/*
Route::get('/', function () {
    return view('welcome');
}); */

//add 29/5 - home screen template
Route::get('/', [HomeController::class,'home'])->name('home');
/*Route::get('/', function () {
    return view('home.index');
}); */

//below added trying to fix the below, may remove
Route::get('dashboard', [HomeController::class,'login_home'])->middleware(['auth','verified'])->name('dashboard');

Route::get('myorders', [HomeController::class,'myorders'])->middleware(['auth','verified']);

// Route::get('/dashboard', function () {
//     return redirect()->route('home'); //redirect to home instead of dashboard
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', function () {  //above og code
//     return view('home.index'); //redirect to home instead of dashboard
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//add 28/5 //admin auth
route::get('admin/dashboard', [HomeController::class,'index'])->middleware(['auth','admin']);
//admin
//view_category on 2nd part after class is function on the controller
route::get('view_category', [AdminController::class,'view_category'])->middleware(['auth','admin']);
route::get('manage_product', [AdminController::class,'manage_product'])->middleware(['auth','admin']);
route::get('add_product', [AdminController::class,'add_product'])->middleware(['auth','admin']);
//add product post form
route::post('upload_product', [AdminController::class,'upload_product'])->middleware(['auth','admin']);
route::get('update_product/{id}', [AdminController::class,'update_product'])->middleware(['auth','admin']);
route::post('edit_product/{id}', [AdminController::class,'edit_product'])->middleware(['auth','admin']);
route::get('delete_product/{id}', [AdminController::class,'delete_product'])->middleware(['auth','admin']);
route::get('product_search', [AdminController::class,'product_search'])->middleware(['auth','admin']);

route::get('manage_profile', [AdminController::class,'manage_profile'])->middleware(['auth','admin']);
route::get('manage_order', [AdminController::class,'manage_order'])->middleware(['auth','admin']);
Route::post('update_order/{id}', [AdminController::class,'update_order'])->middleware(['auth','admin']);

route::get('manage_staff', [AdminController::class,'manage_staff'])->middleware(['auth','admin']);
route::get('add_staff', [AdminController::class,'add_staff'])->middleware(['auth','admin']);
route::post('upload_staff', [AdminController::class,'upload_staff'])->middleware(['auth','admin']);
route::get('update_staff/{id}', [AdminController::class,'update_staff'])->middleware(['auth','admin']);
route::post('edit_staff/{id}', [AdminController::class,'edit_staff'])->middleware(['auth','admin']);
route::get('delete_staff/{id}', [AdminController::class,'delete_staff'])->middleware(['auth','admin']);
route::get('staff_search', [AdminController::class,'staff_search'])->middleware(['auth','admin']);

//report
route::get('generate_report', [AdminController::class,'generate_report'])->middleware(['auth','admin']);
route::get('print_pdf/{id}', [AdminController::class,'print_pdf'])->middleware(['auth','admin']);
route::get('view_pdf/{id}', [AdminController::class,'print_pdf'])->middleware(['auth','admin']);
// test, delete later below
route::get('print2', [AdminController::class,'print2'])->middleware(['auth','admin']);



//test for staff , add 28/5 auth
route::get('staff/dashboard', [HomeController::class,'index2'])->middleware(['auth', 'staff']);

//home links
route::get('product_details/{id}', [HomeController::class,'product_details']);
route::get('add_cart/{id}', [HomeController::class,'add_cart'])->middleware(['auth', 'verified']); //for direct add cart homee
route::post('add_cart2/{id}', [HomeController::class,'add_cart2'])->middleware(['auth', 'verified']);  //user login
// route::get('add_cart/{id}/{color}/{size}/{quantity}', [HomeController::class,'add_cart'])->middleware(['auth', 'verified']); //for direct add cart homee
route::post('request_quote/{id}', [HomeController::class,'request_quote'])->middleware(['auth', 'verified'])->name('request_quote');
route::post('send_quote/{id}', [HomeController::class,'send_quote'])->middleware(['auth', 'verified']);



route::get('home_search', [HomeController::class,'home_search'])->middleware(['auth','verified']);

route::get('mycart', [HomeController::class,'mycart'])->middleware(['auth', 'verified']);; 

route::get('delete_cart/{id}', [HomeController::class,'delete_cart'])->middleware(['auth','verified']);
route::post('update_cart/{id}', [HomeController::class,'update_cart'])->middleware(['auth','verified'])->name('update_cart');
route::get('checkout/{id}/{price}', [HomeController::class,'checkout'])->middleware(['auth','verified']);
route::post('confirm_order/{id}', [HomeController::class,'confirm_order'])->middleware(['auth','verified'])->name('confirm_order');

// stripe

//l11 way
// Route::controller(StripePaymentController::class)->group(function(){
//     Route::get('stripe/{value}', 'index');
//     Route::post('stripe/{value}', 'stripe')->name('stripe.post');
// });

// l9 old
Route::controller(HomeController::class)->group(function(){

    Route::get('stripe/{value}', 'stripe');

    Route::post('stripe/{value}', 'stripePost')->name('stripe.post');

});
