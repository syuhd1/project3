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

    public function manage_product()
    {
        return view('admin.manage_product');
    }

    public function manage_profile()
    {
        return view('admin.manage_profile');
    }

    public function manage_order()
    {
        return view('admin.manage_order');
    }

    public function manage_staff()
    {
        return view('admin.manage_staff');
    }

    public function manage_report()
    {
        return view('admin.manage_report');
    }
    /*
    public function add_category(Request $request){
        $category = cnew ;
        //assigning category model into this variable
    } */
}
