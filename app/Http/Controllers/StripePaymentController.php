<?php
      
namespace App\Http\Controllers;
       
use Stripe;
use Session;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse; 
use Illuminate\Support\Facades\Auth;


use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
       
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($value): View
    {
        return view('home.stripe', compact('value'));
    }
      
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $request, $value): RedirectResponse
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      
        Stripe\Charge::create ([
                // "amount" => 10 * 100,
                "amount" => $value * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Stripe Test Payment" 
        ]);
    
            // if(Auth::id()){
            //     $user = Auth::user()->name;
            //     $userid = $user->id;
            //     $count = Cart::where('user_id', $userid)->count();
            //     }
            // else{
            //     $count='';
            // }
    
            // $name = $request->name;
            // $phone = $request->phone;
            // $address = $request->address;
            // $price = $request->price;
            // $paymentmethod = $request->paymentmethod;
            // shipmethod = $request->shipmethod;
            // $address = $request->address;

            // if (!Auth::check()) {
            //     return redirect()->route('login')->with('error', 'Please log in to continue');
            // }

            $name = Auth::user()->name;
            $phone = Auth::user()->phone;
            $address = Auth::user()->address;
            $remarks = $request->remarks;


            $userid = Auth::user()->id;
            $cart = Cart::where('user_id', $userid)->get();
    
            // foreach($cart as $carts){
            //     // $order = new Order;
            //     // $order->name =$name;
            //     // $order->phone =$phone;
            //     // $order->address =$address;
    
            //     // same as above, just direct request t
            //     $order = new Order;
            //     $order->name =$request->name;
            //     $order->phone =$request->phone;
            //     $order->address =$request->address;
            //     // end of above, comment later

            //     $order->user_id = $userid;
    
            //     $order->product_id = $carts->product_id;
            //     $order->quantity = $carts->quantity;
            //     $order->color = $carts->color;
            //     $order->size = $carts->size;
            //     $order->total_price = $value;

            //     // $order->total_price = $carts->product->price * $carts->quantity;
            //     $order->payment_method = "Stripe Payment";
            //     // $order->remarks = $request->remarks;


            //     // $order->price = $carts->price;
            //     // $order->price = $carts->product->price * $carts->quantity;
    
            //     $order->save();
            // }
            // $removecart = Cart::where('user_id', $userid)->get();
            // foreach ($removecart as $remove){
            //     $data = Cart::find($remove->id);
            //     $data->delete();
            // }
            
            // toastr()->timeOut(5000)->closeButton()->addSuccess('Order has been placed successfully');
    
            // return redirect()->route('home');
        
                
        return back()->with('success', 'Payment has been successful');
    }
    // catch (\Exception $e) {
    //     return back()->with('error', $e->getMessage());
    // }
}