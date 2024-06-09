<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
//add every model here
use App\Models\Product;
use App\Models\Staff;

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
        //call product data from db, compact product is how to call it
        // $product = product::all(); //display all from db in 1 page
        //paginate limit to numbers of item per page
        $product = product::paginate(6);
        return view('admin.manage_product',compact('product'));
    }

    public function add_product()
    {
        return view('admin.add_product');
    }

    public function product_search(Request $request)
    {
        $search = $request->search;
        $product = Product::where('title', 'LIKE', '%'.$search.'%')
        ->orWhere('id', 'LIKE', '%'.$search.'%')->orWhere('category', 'LIKE', '%'.$search.'%')
        ->orWhere('material', 'LIKE', '%'.$search.'%')->paginate(6);
        return view('admin.manage_product',compact('product'));
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

    public function update_product($id)
    {
        $data = Product::find($id);
        return view('admin.update_product',compact('data'));
    }

    public function edit_product(Request $request, $id){
        
        $data = Product::find($id);
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
        toastr()->timeOut(5000)->closeButton()->addSuccess('Product updated successfully');
        return redirect('/manage_product');
    }

    public function delete_product($id)
    {
        $data = Product::find($id);
        // delete img public folder for deleted item
        $image_path = public_path('products/'.$data->image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $data->delete();
        //display message, 5000 for 5 seconds, add success means green color
        toastr()->timeOut(5000)->closeButton()->addSuccess('Product deleted successfully');
        
        return redirect()->back();
        // return view('admin.delete_product');
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
        $staff = Staff::paginate(6);
        return view('admin.manage_staff',compact('staff'));
    }

    public function add_staff()
    {
        return view('admin.add_staff');
    }

    public function upload_staff(Request $request)
    {
        // return view('');
        $data= new Staff;
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->password = Hash::make($request->password);
        $data->start_date = $request->start_date;
        // $data->end_date = $request->end_date;
        $data->department = $request->department;
        $data->acc_status = 'active';
        $image= $request->image;
        // store image data in image variable
        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            // save image to public folder, use time() to have unique name for img
            $request->image->move('staffs', $imagename);

            $data->image = $imagename;
        }
        
        $data->save();

        //display message, 5000 for 5 seconds, add success means green color
        toastr()->timeOut(5000)->closeButton()->addSuccess('Staff added successfully');
        return redirect()->back();
        
    }

    public function update_staff($id)
    {
        $data = Staff::find($id);
        return view('admin.update_staff', compact('data'));
    }

    public function edit_staff(Request $request, $id)
    {
        $data = Staff::find($id);
        
        // $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        // $data->password = Hash::make($request->password);
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->department = $request->department;
        $data->acc_status = $request->acc_status;

        if (!empty($request->password)) {
            // If password is not empty, update it
            $data->password = Hash::make($request->password);
        }

        $image= $request->image;
        // store image data in image variable
        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            // save image to public folder, use time() to have unique name for img
            $request->image->move('staffs', $imagename);

            $data->image = $imagename;
        }
        
        $data->save();

        //display message, 5000 for 5 seconds, add success means green color
        toastr()->timeOut(5000)->closeButton()->addSuccess('Staff updated successfully');
        return redirect('/manage_staff');
    }

    public function delete_staff($id)
    {
        $data = Staff::find($id);
        $data->delete();

        toastr()->timeOut(5000)->closeButton()->addSuccess('Staff deleted successfully');
        return redirect()->back();
    }

    public function staff_search(Request $request)
    {
        $search = $request->search;
        $staff = Staff::where('name', 'LIKE', '%'.$search.'%')
            ->orWhere('address', 'LIKE', '%'.$search.'%')
            ->orWhere('phone', 'LIKE', '%'.$search.'%')
            ->orWhere('id', 'LIKE', '%'.$search.'%')
            ->paginate(6);

        return view('admin.manage_staff', compact('staff'));
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
