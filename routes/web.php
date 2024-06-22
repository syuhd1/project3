<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//add
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AdminOrStaffController;

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
// profile
route::get('manage_profile', [AdminController::class,'manage_profile'])->middleware(['auth','admin']);
route::get('manage_order', [AdminController::class,'manage_order'])->middleware(['auth','admin'])->name('manage_order');
Route::post('update_order/{id}', [AdminController::class,'update_order'])->middleware(['auth','admin']);
// mng staff
route::get('manage_staff', [AdminController::class,'manage_staff'])->middleware(['auth','admin']);
route::get('add_staff', [AdminController::class,'add_staff'])->middleware(['auth','admin']);
route::post('upload_staff', [AdminController::class,'upload_staff'])->middleware(['auth','admin']);
route::get('update_staff/{id}', [AdminController::class,'update_staff'])->middleware(['auth','admin']);
route::post('edit_staff/{id}', [AdminController::class,'edit_staff'])->middleware(['auth','admin']);
route::get('delete_staff/{id}', [AdminController::class,'delete_staff'])->middleware(['auth','admin']);
route::get('staff_search', [AdminController::class,'staff_search'])->middleware(['auth','admin']);
//quote
route::get('manage_quotation', [AdminController::class,'manage_quotation'])->middleware(['auth','admin'])->name('manage_quotation');
route::get('add_quotation', [AdminController::class,'add_quotation'])->middleware(['auth','admin']);
route::post('upload_quotation/{id}', [AdminController::class,'upload_quotation'])->middleware(['auth','admin']);
route::get('update_quotation/{id}', [AdminController::class,'update_quotation'])->middleware(['auth','admin']);
route::post('edit_quotation/{id}', [AdminController::class,'edit_quotation'])->middleware(['auth','admin']);
route::get('delete_quotation/{id}', [AdminController::class,'delete_quotation'])->middleware(['auth','admin']);
route::get('quotation_search', [AdminController::class,'quotation_search'])->middleware(['auth','admin']);
//report
route::get('generate_report', [AdminController::class,'generate_report'])->middleware(['auth','admin'])->name('generate_report');
route::get('print_pdf', [AdminController::class,'print_pdf'])->middleware(['auth','admin']);
// route::get('print_pdf/{id}', [AdminController::class,'print_pdf'])->middleware(['auth','admin']);
// route::get('view_pdf/{id}', [AdminController::class,'print_pdf'])->middleware(['auth','admin']);
// test, delete later below
route::get('print2', [AdminController::class,'print2'])->middleware(['auth','admin']);


// ///////////test for staff , add 28/5 auth //////////////
route::get('staff/dashboard', [HomeController::class,'index2'])->middleware(['auth', 'staff']);

// //////////////////home links //////////////////
route::get('product_details/{id}', [HomeController::class,'product_details']);
route::get('add_cart/{id}', [HomeController::class,'add_cart'])->middleware(['auth', 'verified']); //for direct add cart homee
route::post('add_cart2/{id}', [HomeController::class,'add_cart2'])->middleware(['auth', 'verified']);  //user login
// route::get('add_cart/{id}/{color}/{size}/{quantity}', [HomeController::class,'add_cart'])->middleware(['auth', 'verified']); //for direct add cart homee

// quotation
route::post('request_quote/{id}', [HomeController::class,'request_quote'])->middleware(['auth', 'verified'])->name('request_quote');
route::post('send_quote/{id}', [HomeController::class,'send_quote'])->middleware(['auth', 'verified']);
route::get('add_custom_cart/{id}', [HomeController::class,'add_custom_cart'])->middleware(['auth', 'verified']);  //user login
// 
route::get('home_search', [HomeController::class,'home_search'])->middleware(['auth','verified']);

route::get('mycart', [HomeController::class,'mycart'])->middleware(['auth', 'verified']);; 

route::get('delete_cart/{id}', [HomeController::class,'delete_cart'])->middleware(['auth','verified']);
route::post('update_cart/{id}', [HomeController::class,'update_cart'])->middleware(['auth','verified'])->name('update_cart');
route::get('checkout/{id}/{price}', [HomeController::class,'checkout'])->middleware(['auth','verified']);
route::get('confirm_order/{id}', [HomeController::class,'confirm_order'])->middleware(['auth','verified'])->name('confirm_order');
// changed from post to get , test



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

///////////////shared route
// Route::middleware(['auth', 'admin_or_staff'])->group(function () {
//     // Route::get('admin/dashboard', [HomeController::class, 'index']);

//     Route::get('view_category', [AdminController::class, 'view_category']);
//     Route::get('manage_product', [AdminController::class, 'manage_product']);
//     Route::get('add_product', [AdminController::class, 'add_product']);
//     Route::post('upload_product', [AdminController::class, 'upload_product']);
//     Route::get('update_product/{id}', [AdminController::class, 'update_product']);
//     Route::post('edit_product/{id}', [AdminController::class, 'edit_product']);
//     Route::get('delete_product/{id}', [AdminController::class, 'delete_product']);
//     Route::get('product_search', [AdminController::class, 'product_search']);
//     Route::get('manage_profile', [AdminController::class, 'manage_profile']);
//     Route::get('manage_order', [AdminController::class, 'manage_order']);
//     Route::post('update_order/{id}', [AdminController::class, 'update_order']);
//     Route::get('manage_staff', [AdminController::class, 'manage_staff']);
//     Route::get('add_staff', [AdminController::class, 'add_staff']);
//     Route::post('upload_staff', [AdminController::class, 'upload_staff']);
//     Route::get('update_staff/{id}', [AdminController::class, 'update_staff']);
//     Route::post('edit_staff/{id}', [AdminController::class, 'edit_staff']);
//     Route::get('delete_staff/{id}', [AdminController::class, 'delete_staff']);
//     Route::get('staff_search', [AdminController::class, 'staff_search']);
//     Route::get('manage_quotation', [AdminController::class, 'manage_quotation']);
//     Route::get('add_quotation', [AdminController::class, 'add_quotation']);
//     Route::post('upload_quotation/{id}', [AdminController::class, 'upload_quotation']);
//     Route::get('update_quotation/{id}', [AdminController::class, 'update_quotation']);
//     Route::post('edit_quotation/{id}', [AdminController::class, 'edit_quotation']);
//     Route::get('delete_quotation/{id}', [AdminController::class, 'delete_quotation']);
//     Route::get('quotation_search', [AdminController::class, 'quotation_search']);
//     Route::get('generate_report', [AdminController::class, 'generate_report']);
//     Route::get('print_pdf', [AdminController::class, 'print_pdf']);
//     Route::get('view_pdf/{id}', [AdminController::class, 'print_pdf']);
//     Route::get('print2', [AdminController::class, 'print2']);
// });


//// staff lm
// Route::get('staff/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'staff'])->name('staff.dashboard');
Route::get('staff/view_category', [StaffController::class, 'view_category'])->middleware(['auth', 'staff']);
Route::get('staff/manage_product', [StaffController::class, 'manage_product'])->middleware(['auth', 'staff']);
Route::get('staff/add_product', [StaffController::class, 'add_product'])->middleware(['auth', 'staff']);
Route::post('staff/upload_product', [StaffController::class, 'upload_product'])->middleware(['auth', 'staff']);
Route::get('staff/update_product/{id}', [StaffController::class, 'update_product'])->middleware(['auth', 'staff']);
Route::post('staff/edit_product/{id}', [StaffController::class, 'edit_product'])->middleware(['auth', 'staff']);
Route::get('staff/delete_product/{id}', [StaffController::class, 'delete_product'])->middleware(['auth', 'staff']);
Route::get('staff/product_search', [StaffController::class, 'product_search'])->middleware(['auth', 'staff']);
Route::get('staff/manage_profile', [StaffController::class, 'manage_profile'])->middleware(['auth', 'staff']);
Route::get('staff/manage_order', [StaffController::class, 'manage_order'])->middleware(['auth', 'staff'])->name('staff.manage_order');
Route::post('staff/update_order/{id}', [StaffController::class, 'update_order'])->middleware(['auth', 'staff']);
Route::get('staff/manage_staff', [StaffController::class, 'manage_staff'])->middleware(['auth', 'staff']);
Route::get('staff/add_staff', [StaffController::class, 'add_staff'])->middleware(['auth', 'staff']);
Route::post('staff/upload_staff', [StaffController::class, 'upload_staff'])->middleware(['auth', 'staff']);
Route::get('staff/update_staff/{id}', [StaffController::class, 'update_staff'])->middleware(['auth', 'staff']);
Route::post('staff/edit_staff/{id}', [StaffController::class, 'edit_staff'])->middleware(['auth', 'staff']);
Route::get('staff/delete_staff/{id}', [StaffController::class, 'delete_staff'])->middleware(['auth', 'staff']);
Route::get('staff/staff_search', [StaffController::class, 'staff_search'])->middleware(['auth', 'staff']);
Route::get('staff/manage_quotation', [StaffController::class, 'manage_quotation'])->middleware(['auth', 'staff'])->name('staff.manage_quotation');
Route::get('staff/add_quotation', [StaffController::class, 'add_quotation'])->middleware(['auth', 'staff']);
Route::post('staff/upload_quotation/{id}', [StaffController::class, 'upload_quotation'])->middleware(['auth', 'staff']);
Route::get('staff/update_quotation/{id}', [StaffController::class, 'update_quotation'])->middleware(['auth', 'staff']);
Route::post('staff/edit_quotation/{id}', [StaffController::class, 'edit_quotation'])->middleware(['auth', 'staff']);
Route::get('staff/delete_quotation/{id}', [StaffController::class, 'delete_quotation'])->middleware(['auth', 'staff']);
Route::get('staff/quotation_search', [StaffController::class, 'quotation_search'])->middleware(['auth', 'staff']);
Route::get('staff/generate_report', [StaffController::class, 'generate_report'])->middleware(['auth', 'staff'])->name('staff.generate_report');
Route::get('staff/print_pdf', [StaffController::class, 'print_pdf'])->middleware(['auth', 'staff']);
Route::get('staff/print2', [StaffController::class, 'print2'])->middleware(['auth', 'staff']);