<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;

class HomeController extends Controller
{
    //add 28/ //route to admin dash
    public function index(){

        $user = User::where('usertype', 'user')->get()->count();
        $product = Product::all()->count();
        $order = Order::all()->count();
        $delivered = Order::where('status', 'completed')->get()->count();

        
        return view('admin.index', compact('user', 'product','order','delivered'));
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

    
    public function home_search(Request $request)
    {
        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
            $cart = Cart::where('user_id', $userid)->paginate(6);
        }
        else{
            $count='';
        }

        $search = $request->search;
        $product = Product::where('title', 'LIKE', '%'.$search.'%')
        ->orWhere('category', 'LIKE', '%'.$search.'%')
        ->orWhere('material', 'LIKE', '%'.$search.'%')
        ->paginate(12);
        
        return view('home.search',compact('product','count'));
    }
//home add cart
public function add_cart($id){
    $product_id = $id;
    
    $user = Auth::user(); //user logged in only, get user data , store in $user
    $user_id = $user->id; //store in id user_id

    // $color = $request->input('color');
    // $size = $request->input('size');
    // $quantity = $request->input('quantity',1); //default qunat 1
    
    // $color = $request->color;
    // $size = $request->size;
    // $quantity = $request->quantity;

    $existedcart = Cart::where('user_id', $user_id)
    ->where('product_id', $product_id)
    // ->where('color', $color)
    // ->where('size', $size)
    ->first();

    if ($existedcart) {
        // $existedcart->quantity += $quantity;
        $existedcart->quantity += 1; //original
        $existedcart->save();
    } else {
        $data = new Cart;
        $data->user_id = $user_id;
        $data->product_id = $product_id;
        // $data->color = $color;
        // $data->size = $size;
        $data->quantity = 1; // Default quantity to 1
        // $data->total_price = $value;
        $data->save();
    }

    toastr()->timeOut(5000)->closeButton()->addSuccess('Product added to cart successfully');

    return redirect()->back();
}
//product details add_cart
    public function add_cart2(Request $request, $id){
        $product_id = $id;

         // below commented ===
         $product = Product::find($id);
        
        $user = Auth::user(); //user logged in only, get user data , store in $user
        $user_id = $user->id; //store in id user_id

        // $color = $request->input('color');
        // $size = $request->input('size');
        // $quantity = $request->input('quantity',1); //default qunat 1
        
        $color = $request->color;
        $size = $request->size;
        $quantity = $request->quantity;


        $existedcart = Cart::where('user_id', $user_id)
        ->where('product_id', $product_id)
        ->where('color', $color)
        ->where('size', $size)
        ->first();

        if ($existedcart) {
            $existedcart->quantity += $quantity;
            // $existedcart->quantity += 1; //original

            // below is commented ====
            $existedcart->total_price = $existedcart->quantity * $product->price;

            $existedcart->save();
        } else {
            $data = new Cart;
            $data->user_id = $user_id;
            $data->product_id = $product_id;
            $data->color = $color;
            $data->size = $size;
            $data->quantity = $quantity; // Default quantity to 1
            $data->total_price = $product->price * $quantity;
            $data->save();
        }

        toastr()->timeOut(5000)->closeButton()->addSuccess('Product added to cart successfully');

        return redirect()->back();
    }

    public function mycart(){

        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
            $cart = Cart::where('user_id', $userid)->orderBy('created_at', 'desc')->paginate(6);
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

        toastr()->timeOut(5000)->closeButton()->addSuccess('Item has been removed from cart'); //previously commented
        return redirect()->back();
    }

    public function checkout(Request $request,$id){
        $cart = Cart::find($id);

        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
            }
        else{
            $count='';
        }
        $price = $request->price;
        // toastr()->timeOut(5000)->closeButton()->addSuccess('Item removed successfully');
        return view('home.checkout',compact('cart','count','price'));
    }

    public function confirm_order(Request $request, $id){
        $cart = Cart::find($id);

        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
            }
        else{
            $count='';
        }

        $name = $request->name;
        $phone = $request->phone;
        $address = $request->address;
        $price = $request->price;
        // $paymentmethod = $request->paymentmethod;
        // shipmethod = $request->shipmethod;
        // $address = $request->address;


        $userid = Auth::user()->id;
        $cart = Cart::where('user_id', $userid)->get();

        foreach($cart as $carts){
            $order = new Order;
            $order->name =$name;
            $order->phone =$phone;
            $order->address =$address;

            $order->user_id = $userid;

            $order->product_id = $carts->product_id;
            $order->quantity = $carts->quantity;
            $order->color = $carts->color;
            $order->size = $carts->size;
            // $order->price = $carts->price;
            $order->price = $carts->product->price * $carts->quantity;

            $order->save();
        }
        $removecart = Cart::where('user_id', $userid)->get();
        foreach ($removecart as $remove){
            $data = Cart::find($remove->id);
            $data->delete();
        }
        
        toastr()->timeOut(5000)->closeButton()->addSuccess('Order has been placed successfully');

        return redirect()->route('home');
    }

    //quotation
    public function request_quote(){

        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
            }
        else{
            $count='';
        }

    }

    
    public function myorders(){

        $user = Auth::user()->id;
       
        $count = Cart::where('user_id', $user)->get()->count();

        $order = Order::where('user_id', $user)->orderBy('created_at', 'desc')->paginate(6);

        return view('home.order', compact('count','order'));
    }

}
