<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Product;
use App\Models\Cart;

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
        
        //step count cart
        if(Auth::id()){
            $user = Auth::user();
        $userid = $user->id;
        $count = Cart::where('user_id', $userid)->count();
        }
        else{
            $count='';
        }
        
    return view('home.index', compact('product','count'));
    }

    public function login_home(){
        $product = Product::all();

        if(Auth::id()){
            $user = Auth::user();
        $userid = $user->id;
        $count = Cart::where('user_id', $userid)->count();
        }
        else{
            $count='';
        }
    return view('home.index', compact('product','count'));
    }

    public function product_details($id){

        // $product = Product::all();
        $data = Product::find($id);
        
        //step count cart
        if(Auth::id()){
            $user = Auth::user();
        $userid = $user->id;
        $count = Cart::where('user_id', $userid)->count();
        }
        else{
            $count='';
        }

        return view('home.product_details', compact('data','count'));
    }

    public function add_cart($id){
        $product_id = $id;
        $user = Auth::user(); //user logged in only, get user data , store in $user
        $user_id = $user->id; //store in id user_id
        
        $existedcart = Cart::where('user_id', $user_id)
        ->where('product_id', $product_id)
        // ->where('color',$color)
        // ->where('size', $size)
        ->first();

        if ($existedcart) {
            $existedcart->quantity += 1;
            $existedcart->save();
        } else {
            $data = new Cart;
            $data->user_id = $user_id;
            $data->product_id = $product_id;
            // $data->color = $color;
            // $data->size = $size;
            $data->quantity = 1; // Default quantity to 1
            $data->save();
        }

        // $data = new Cart;
        // $data->user_id = $user_id;
        // $data->product_id = $product_id;
        // $data->save();

        toastr()->timeOut(5000)->closeButton()->addSuccess('Product added to cart successfully');

        return redirect()->back();
    }

    public function mycart(){

        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
            $cart = Cart::where('user_id', $userid)->get();
        }
        else{
            $count='';
        }

        return view('home.mycart', compact('count', 'cart'));
    }

    public function update_cart(Request $request, $id)
    {
        $data = Cart::find($id);
        if ($data) {
            $data->quantity = $request->input('quantity');
            $data->save();
        }
        return redirect()->back();
    }

    public function delete_cart($id)
    {
        $data = Cart::find($id);
        $data->delete();

        // toastr()->timeOut(5000)->closeButton()->addSuccess('Item removed successfully');
        return redirect()->back();
    }

}
