<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Quotation;

use Stripe;
use Session;

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

      
        $color = $request->color;
        $size = $request->size;
        $quantity = $request->quantity;
        // $quote_id =

        $existedcart = Cart::where('user_id', $user_id)
        ->where('product_id', $product_id)
        ->where('color', $color)
        ->where('size', $size)
        ->where('quote_id', null) ///added so custom cart
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
            // bellow commented
            $data->base_price = $product->price;
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
        if($data->quote_id !== null){
            $quote = Quotation::find($data->quote_id);
            //mark that this one has quotation, so change status if remove from cart, use in history/myorder
            $quote->status = "Completed";
            $quote->save();
        }
        $data->delete();

        toastr()->timeOut(5000)->closeButton()->addSuccess('Item has been removed from cart'); //previously commented
        return redirect()->back();
    }

    public function checkout(Request $request,$id){
        // $cart = Cart::find($id);
        // $cart = Cart::all();
        // $product = Product::find($id);

        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
            $cart = Cart::where('user_id', $userid)->get();
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
        $delivery_method = $request->delivery_method;
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
            $order->quote_id = $carts->quote_id;
            $order->quantity = $carts->quantity;
            $order->color = $carts->color;
            $order->size = $carts->size;
            $order->price = $carts->base_price;
            $order->total_price = $carts->total_price;

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
    public function request_quote(Request $request, $id){
        $product_id = $id;
        $product = Product::find($id);

        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
            $cart = Cart::where('user_id', $userid)->get();
            }
        else{
            $count='';
        }
        // $price = $request->price;

        $color = $request->color;
        $size = $request->size;
        $quantity = $request->quantity;
        $price = $product->price;
        
        // $quote = new Quotation();
        // $quote->user_id = $userid;
        // $quote->product_id = $product_id;
        // $quote->base_price = $price;
        // $quote->save();
        
        return view('home.request_quote', compact('count', 'cart', 'price','product','color','size','quantity'));

    }

    public function send_quote(Request $request, $id){
        $product = Product::find($id);
        $product_id = $id;

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

        $value = $request->value;
        $price = $request->price;
        // $paymentmethod = $request->paymentmethod;
        // shipmethod = $request->shipmethod;
        // $address = $request->address;

        $userid = Auth::user()->id;
        // $cart = Cart::where('user_id', $userid)->get();

            $quote = new Quotation;
            $quote->name =$name;
            $quote->phone =$phone;
            $quote->address =$address;

            $quote->user_id = $userid;
            $quote->product_id = $product_id;

            $quote->quantity = $request->quantity;
            $quote->color = $request->color;
            $quote->size = $request->size;
            $quote->base_price = $product->price;

            $quote->description = $request->description;
            $quote->deadline = $request->deadline;

            $reference = $request->reference;

            if($reference){
                $oriname = $reference->getClientOriginalName();
                $extension = $reference->getClientOriginalExtension();
                $refname = time() . '_' . $oriname;
                // save image to public folder, use time() to have unique name for img
                $request->reference->move('references', $refname);
    
                $quote->reference = $refname;
            }

            $quote->save();
        
        toastr()->timeOut(5000)->closeButton()->addSuccess('Request has been sent successfully');

        return redirect()->route('home');
    }

    public function add_custom_cart($id){
        $quote_id = $id;

         // below commented ===
         $quote = Quotation::find($id);
         $product_id = $quote->product_id;
        
        $user = Auth::user(); //user logged in only, get user data , store in $user
        $user_id = $user->id; //store in id user_id

        // $existedcart = Cart::where('user_id', $user_id)
        // ->where('product_id', $product_id)
        // ->where('color', $color)
        // ->where('size', $size)
        // ->first();

        // if ($existedcart) {
        //     $existedcart->quantity += $quantity;
        //     // $existedcart->quantity += 1; //original

        //     // below is commented ====
        //     $existedcart->total_price = $existedcart->quantity * $product->price;

        //     $existedcart->save();
        // } else {
            $data = new Cart;
            $data->user_id = $user_id;
            $data->product_id = $product_id;
            $data->quote_id = $quote_id;
            $data->color = $quote->color;
            $data->size = $quote->size;
            $data->quantity = $quote->quantity; // Default quantity to 1
            $data->base_price = $quote->base_price + $quote->add_price;
            $data->total_price = ($quote->base_price + $quote->add_price) * $quote->quantity;
            $data->save();
        // }
        

        toastr()->timeOut(5000)->closeButton()->addSuccess('Product added to cart successfully');
        //mark that this one has quotation, so change status if remove from cart, use in history/myorder
        $quote->status = "Completed - Added to Cart";
        $quote->save();

        return redirect()->back();
    }
    
    // end quote

    public function myorders(){

        $user = Auth::user()->id;
       
        $count = Cart::where('user_id', $user)->get()->count();

        $order = Order::where('user_id', $user)->orderBy('created_at', 'desc')->paginate(6);

        $quote = Quotation::where('user_id', $user)->orderBy('created_at', 'desc')->paginate(6);

        return view('home.order', compact('count','order','quote'));
    }

    // stripe
    public function stripe($value)
    {

        return view('home.stripe', compact('value'));

    }

    public function stripePost(Request $request, $value)
    {
        // try{
            \Log::info('Stripe Request Data:', $request->all()); // Log request data
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            Stripe\Charge::create ([

                "amount" => $value * 100,

                "currency" => "usd",

                "source" => $request->stripeToken,

                "description" => "Test payment from itsolutionstuff.com." 

            ]);

             $name = Auth::user()->name;
            $phone = Auth::user()->phone;
            $address = Auth::user()->address;
            //     $name = $request->name;
            // $phone = $request->phone;
            // $address = $request->address;
            $remarks = $request->remarks;
            $delivery_method = $request->delivery_method;

            $userid = Auth::user()->id;
            $cart = Cart::where('user_id', $userid)->get();

            foreach($cart as $carts) {
                $order = new Order;
                $order->name = $name;
                $order->phone = $phone;
                $order->address = $address;
                $order->user_id = $userid;
                $order->product_id = $carts->product_id;

                if ($carts->quote_id !== null) {
                    $order->quote_id = $carts->quote_id;
                }

                $order->quantity = $carts->quantity;
                $order->color = $carts->color;
                $order->size = $carts->size;
                $order->delivery_method = $delivery_method;
                $order->price = $carts->base_price;
                $order->total_price = $carts->total_price;
                $order->payment_method = "Stripe Payment";
                $order->remarks = $remarks;

                $order->save();
            }

            $removecart = Cart::where('user_id', $userid)->get();
            foreach ($removecart as $remove) {
                $data = Cart::find($remove->id);
                $data->delete();
            }

            return back()->with('success', 'Payment has been successful');
            // toastr()->timeOut(5000)->closeButton()->addSuccess('Order has been placed successfully');
            // return redirect()->back();
        // } catch (\Exception $e) {
        //     \Log::error('Stripe Payment Error:', ['error' => $e->getMessage()]);
        //     return redirect()->back()->withErrors('Payment failed. Please try again.');
        // }
    }
}

    

