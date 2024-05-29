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
Route::get('/', [HomeController::class,'home']);
/*Route::get('/', function () {
    return view('home.index');
}); */

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//add 28/5 //admin auth
route::get('admin/dashboard', [HomeController::class,'index'])->middleware(['auth','admin']);

//test for staff , add 28/5 auth
route::get('staff/dashboard', [HomeController::class,'index2'])->middleware(['auth', 'staff']);

//admin
route::get('view_category', [AdminController::class,'view_category'])->middleware(['auth','admin']);
//view_category on 2nd part after class is function on the controller