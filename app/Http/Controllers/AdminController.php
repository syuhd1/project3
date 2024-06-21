<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
//add every model here
use App\Models\Product;
use App\Models\Staff;
use App\Models\Order;
use App\Models\Report;
use App\Models\Quotation;


use Barryvdh\DomPDF\Facade\Pdf;
// use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class AdminController extends Controller
{
    //
    public function view_category()
    {
        $identity = Auth::user();
        return view('admin.category', compact('identity'));
        //under resource>view>admin>category.blade.php
    }

    public function manage_product()
    {
        $identity = Auth::user();
        //call product data from db, compact product is how to call it
        // $product = product::all(); //display all from db in 1 page
        //paginate limit to numbers of item per page
        $product = Product::paginate(6);
        return view('admin.manage_product',compact('product','identity'));
    }

    public function add_product()
    {
        $identity = Auth::user();
        return view('admin.add_product','identity');
    }

    public function product_search(Request $request)
    {
        $identity = Auth::user();
        $search = $request->search;
        $product = Product::where('title', 'LIKE', '%'.$search.'%')
        ->orWhere('id', 'LIKE', '%'.$search.'%')->orWhere('category', 'LIKE', '%'.$search.'%')
        ->orWhere('material', 'LIKE', '%'.$search.'%')->paginate(6);
        return view('admin.manage_product',compact('product','identity'));
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
        $identity = Auth::user();
        $data = Product::find($id);
        return view('admin.update_product',compact('data','identity'));
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
        $identity = Auth::user();
        return view('admin.manage_profile');
    }

    public function manage_order()
    {
        $identity = Auth::user();
        $data = Order::orderBy('created_at', 'desc')->paginate(6);
        return view('admin.manage_order', compact('data','identity'));
    }

    public function update_order(Request $request, $id)
    {
        $identity = Auth::user();
        $order = Order::find($id);
        $order->status = $request->status;
        $order->save();

        toastr()->timeOut(5000)->closeButton()->addSuccess('Order status updated successfully');
        return redirect()->back();
    }

// end order 

// start quotation
public function manage_quotation()
    {
        $identity = Auth::user();
        $data = Quotation::orderBy('created_at', 'desc')->paginate(6);
        return view('admin.manage_quotation', compact('data','identity'));
    }

    public function update_quotation($id)
    {
        $identity = Auth::user();
        $data = Quotation::find($id);
        return view('admin.update_quotation',compact('data','identity'));
    }

    public function upload_quotation(Request $request, $id)
    {
        $quote = Quotation::find($id);
        $addprice = $request->add_price;
        $quote->add_price = $addprice;
        $quote->total_price = ($addprice + $quote->product->price) * $quote->quantity;
        $quote->status = "Completed";
        $quote->save();

        toastr()->timeOut(5000)->closeButton()->addSuccess('Fee updated successfully');
        return redirect()->back();
    }

// end quotation
//start staff

    public function manage_staff()
    {
        $identity = Auth::user();
        $staff = Staff::paginate(6);
        return view('admin.manage_staff',compact('staff','identity'));
    }

    public function add_staff()
    {
        $identity = Auth::user();
        return view('admin.add_staff','identity');
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
        $identity = Auth::user();
        $data = Staff::find($id);
        return view('admin.update_staff', compact('data','identity'));
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
        $identity = Auth::user();
        $search = $request->search;
        $staff = Staff::where('name', 'LIKE', '%'.$search.'%')
            ->orWhere('address', 'LIKE', '%'.$search.'%')
            ->orWhere('phone', 'LIKE', '%'.$search.'%')
            ->orWhere('id', 'LIKE', '%'.$search.'%')
            ->paginate(6);

        return view('admin.manage_staff', compact('staff','identity'));
    }

// end staff manage

//generate report 

    public function generate_report()
    {
        $identity = Auth::user();
        $data = Report::paginate(8);
        return view('admin.generate_report', compact('data','identity'));
    }

    public function print_pdf(Request $request){

        // $data = Report::find($id);
        $identity = Auth::user();
        $timeline = $request->input('timeline');
        $query = Order::query();

        switch ($timeline) {
            case 'today':
                $query->whereDate('created_at', Carbon::today());
                break;
            case 'last_7_days':
                $query->whereDate('created_at', '>=', Carbon::now()->subDays(7));
                break;
            case 'this_month':
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
                break;
            case 'all_time':
            default:
                // No additional filtering
                break;
        }

        $data = $query->get();
        
        $pdf = Pdf::loadView('admin.print_report', compact('data'));
        return $pdf->download('report.pdf');

    }

    public function view_pdf($id)
    {
        $data = Report::find($id);

        $pdf = Pdf::loadView('admin.print_report', compact('data'));
        return $pdf->stream('report.pdf');
    }
//delete later
    public function print2(){
        $orders = Order::all();

        // $data = Order::query();

        // if ($request->has('month')) {
        //     $data->whereMonth('created_at', $request->month)
        //           ->whereYear('created_at', $request->year);
        // }

        // $orders = $data->get();

        // // Prepare data for the view
        // $data = [
        //     'orders' => $orders,
        //     'month' => $request->month,
        //     'year' => $request->year
        // ];

        $pdf = Pdf::loadView('admin.print2', compact('orders'));
        return $pdf->download('testingreport.pdf');

    }


    // public function print_pdf($id){

    //     $data = Order::find($id); // this for test on order page
        
    //     $pdf = Pdf::loadView('admin.print_report', compact('data'));
        
    //     return $pdf->download('report.pdf');
    // }

    /*
    public function add_category(Request $request){
        $category = cnew ;
        //assigning category model into this variable
    } */
}
