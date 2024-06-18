<?php
      
namespace App\Http\Controllers;
       
use Stripe;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
       
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
                "currency" => "myr",
                "source" => $request->stripeToken,
                "description" => "Stripe Test Payment" 
        ]);
                
        return back()->with('success', 'Payment has been successful');
    }
    // catch (\Exception $e) {
    //     return back()->with('error', $e->getMessage());
    // }
}