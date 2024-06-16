<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Cart;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        //original
        // return view('profile.edit', [
        //     'user' => $request->user(),
        // ]);

         //step count , newly added
         if(Auth::id()){
        $user = Auth::user();
        $userid = $user->id;
        $count = Cart::where('user_id', $userid)->count();
        }
        else{
            $count='';
        }

        return view('profile.edit', [
            'user' => $request->user(),
            'count' => $count
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // added new
        $user = $request->user();
        $request->user()->fill($request->validated());

            // save pics
            $image= $request->picture; //picture is name in db
            // store image data in image variable
            if($image){
                $imagename = time().'.'.$image->getClientOriginalExtension();
                // save image to public folder, use time() to have unique name for img
                $request->picture->move('profiles', $imagename);
    
                $user->picture = $imagename;
            }
        
        // end pic

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // $request->user()->save(); //original
        $user->save();
        // added compact count, remove later
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // idk if work, just added, delete pics if user delete acc
        // $image_path = public_path('profiles/'.$user->picture);
        // if(file_exists($image_path)){
        //     unlink($image_path);
        // }
        // end
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
