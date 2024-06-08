<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    //add 28/ //route to admin dash
    public function index(){
        return view('admin.index');
    }
    //route to staff dash
    public function index2(){
        return view('staff.index2');
    }
    //29/5 homepage
    public function home(){
        $product = Product::all();

        return view('home.index', compact('product'));
    }
}
