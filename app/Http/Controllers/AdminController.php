<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function view_category()
    {
        return view('admin.category');
        //under resource>view>admin>category.blade.php
    }
    /*
    public function add_category(Request $request){
        $category = cnew ;
        //assigning category model into this variable
    } */
}
