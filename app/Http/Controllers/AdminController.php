<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

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

    public function add_product()
    {
        return view('admin.add_product');
    }

    public function upload_product(Request $request)
    {
        // return view('');
        $data= new Product;
        $data->title= $request->title;
        $data->description= $request->description;
        $data->category= $request->category;
        $data->price= $request->price;
        $data->quantity= $request->quantity;
        $data->material= $request->material;

        $image= $request->image;
        // store image data in image variable
        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            // save image to public folder, use time() to have unique name for img
            $request->image->move('products', $imagename);

            $data->image = $imagename;
        }
        
        $data->save();

        //display message, 5000 for 5 seconds, add success means green color
        toastr()->timeOut(5000)->closeButton()->addSuccess('Product added successfully');
        return redirect()->back();
        
    }

    public function update_product()
    {
        return view('admin.update_product');
    }

    public function delete_product()
    {
        return view('admin.delete_product');
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
