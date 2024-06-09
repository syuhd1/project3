<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//add
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

/*
Route::get('/', function () {
    return view('welcome');
}); */

//add 29/5 - home screen template
Route::get('/', [HomeController::class,'home'])->name('home');
/*Route::get('/', function () {
    return view('home.index');
}); */

Route::get('/dashboard', function () {
    return redirect()->route('home'); //redirect to home instead of dashboard
})->middleware(['auth', 'verified'])->name('dashboard');

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

route::get('manage_staff', [AdminController::class,'manage_staff'])->middleware(['auth','admin']);
route::get('add_staff', [AdminController::class,'add_staff'])->middleware(['auth','admin']);
route::post('upload_staff', [AdminController::class,'upload_staff'])->middleware(['auth','admin']);
route::get('update_staff/{id}', [AdminController::class,'update_staff'])->middleware(['auth','admin']);
route::post('edit_staff/{id}', [AdminController::class,'edit_staff'])->middleware(['auth','admin']);
route::get('delete_staff/{id}', [AdminController::class,'delete_staff'])->middleware(['auth','admin']);
route::get('staff_search', [AdminController::class,'staff_search'])->middleware(['auth','admin']);

route::get('manage_report', [AdminController::class,'manage_report'])->middleware(['auth','admin']);

//test for staff , add 28/5 auth
route::get('staff/dashboard', [HomeController::class,'index2'])->middleware(['auth', 'staff']);

//home links
route::get('product_details/{id}', [HomeController::class,'product_details']);

