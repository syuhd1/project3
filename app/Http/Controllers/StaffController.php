<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\Staff;
use App\Models\Order;
use App\Models\Report;
use App\Models\Quotation;
use Barryvdh\DomPDF\Facade as Pdf;
use Carbon\Carbon;

class StaffController extends Controller
{
    public function view_category()
    {
        $identity = Auth::user();
        return view('staff.category', compact('identity'));
    }

    public function manage_product()
    {
        $identity = Auth::user();
        $product = Product::paginate(6);
        return view('staff.manage_product', compact('product', 'identity'));
    }

    public function add_product()
    {
        $identity = Auth::user();
        return view('staff.add_product', compact('identity'));
    }

    public function product_search(Request $request)
    {
        $identity = Auth::user();
        $search = $request->search;
        $product = Product::where('title', 'LIKE', '%'.$search.'%')
            ->orWhere('id', 'LIKE', '%'.$search.'%')
            ->orWhere('category', 'LIKE', '%'.$search.'%')
            ->orWhere('material', 'LIKE', '%'.$search.'%')
            ->paginate(6);
        return view('staff.manage_product', compact('product', 'identity'));
    }

    public function upload_product(Request $request)
    {
        $data = new Product;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->category = $request->category;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->material = $request->material;

        $image = $request->image;
        if ($image) {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('products', $imagename);
            $data->image = $imagename;
        }
        
        $data->save();

        toastr()->timeOut(5000)->closeButton()->addSuccess('Product added successfully');
        return redirect()->back();
    }

    public function update_product($id)
    {
        $identity = Auth::user();
        $data = Product::find($id);
        return view('staff.update_product', compact('data', 'identity'));
    }

    public function edit_product(Request $request, $id)
    {
        $data = Product::find($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->category = $request->category;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->material = $request->material;

        $image = $request->image;
        if ($image) {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('products', $imagename);
            $data->image = $imagename;
        }
        
        $data->save();

        toastr()->timeOut(5000)->closeButton()->addSuccess('Product updated successfully');
        return redirect('/staff/manage_product');
    }

    public function delete_product($id)
    {
        $data = Product::find($id);
        $image_path = public_path('products/'.$data->image);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $data->delete();

        toastr()->timeOut(5000)->closeButton()->addSuccess('Product deleted successfully');
        return redirect()->back();
    }

    public function manage_profile()
    {
        $identity = Auth::user();
        return view('staff.manage_profile', compact('identity'));
    }

    public function manage_order()
    {
        $identity = Auth::user();
        $data = Order::orderBy('created_at', 'desc')->paginate(6);
        return view('staff.manage_order', compact('data', 'identity'));
    }

    public function update_order(Request $request, $id)
    {
        $order = Order::find($id);
        $order->status = $request->status;
        $order->save();

        toastr()->timeOut(5000)->closeButton()->addSuccess('Order status updated successfully');
        return redirect()->back();
    }

    public function manage_staff()
    {
        $identity = Auth::user();
        $staff = Staff::paginate(6);
        return view('staff.manage_staff', compact('staff', 'identity'));
    }

    public function add_staff()
    {
        $identity = Auth::user();
        return view('staff.add_staff', compact('identity'));
    }

    public function upload_staff(Request $request)
    {
        $data = new Staff;
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->password = Hash::make($request->password);
        $data->start_date = $request->start_date;
        $data->department = $request->department;
        $data->acc_status = 'active';

        $image = $request->image;
        if ($image) {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('staffs', $imagename);
            $data->image = $imagename;
        }
        
        $data->save();

        toastr()->timeOut(5000)->closeButton()->addSuccess('Staff added successfully');
        return redirect()->back();
    }

    public function update_staff($id)
    {
        $data = Staff::find($id);
        return view('staff.update_staff', compact('data'));
    }

    public function edit_staff(Request $request, $id)
    {
        $data = Staff::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->department = $request->department;
        $data->acc_status = $request->acc_status;

        if (!empty($request->password)) {
            $data->password = Hash::make($request->password);
        }

        $image = $request->image;
        if ($image) {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('staffs', $imagename);
            $data->image = $imagename;
        }
        
        $data->save();

        toastr()->timeOut(5000)->closeButton()->addSuccess('Staff updated successfully');
        return redirect('/staff/manage_staff');
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

        return view('staff.manage_staff', compact('staff', 'identity'));
    }

    public function manage_quotation()
    {
        $identity = Auth::user();
        $data = Quotation::orderBy('created_at', 'desc')->paginate(6);
        return view('staff.manage_quotation', compact('data', 'identity'));
    }

    public function update_quotation($id)
    {
        $identity = Auth::user();
        $data = Quotation::find($id);
        $product = Product::all();
        return view('staff.update_quotation', compact('data','identity'));
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

    public function quotation_search(Request $request)
    {
        $identity = Auth::user();
        $search = $request->search;
        $quotation = Quotation::where('id', 'LIKE', '%'.$search.'%')
            ->orWhere('name', 'LIKE', '%'.$search.'%')
            ->orWhere('email', 'LIKE', '%'.$search.'%')
            ->orWhere('phone', 'LIKE', '%'.$search.'%')
            ->orWhere('created_at', 'LIKE', '%'.$search.'%')
            ->paginate(6);

        return view('staff.manage_quotation', compact('quotation', 'identity'));
    }

    public function generateReport()
    {
        $identity = Auth::guard('staff')->user(); // Adjust 'staff' as per your guard setup
        $data = Report::paginate(8);
        return view('staff.generate_report', compact('data', 'identity'));
    }

    public function printPdf(Request $request)
    {
        $identity = Auth::guard('staff')->user(); // Adjust 'staff' as per your guard setup
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
        
        $pdf = PDF::loadView('staff.print_report', compact('data'));
        return $pdf->download('report.pdf');
    }

    public function viewPdf($id)
    {
        $data = Report::find($id);

        $pdf = PDF::loadView('staff.print_report', compact('data'));
        return $pdf->stream('report.pdf');
    }

    public function print2(Request $request)
    {
        $orders = Order::all(); // Adjust logic as per your requirements

        $pdf = PDF::loadView('staff.print2', compact('orders'));
        return $pdf->download('testingreport.pdf');
    }
}

