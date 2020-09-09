<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Product;
use App\Models\Review;
use App\Models\WishList;
use App\Traits\General\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerActionController extends Controller
{
    use Utility;
    //
    public function __construct()
    {
        $this->middleware('customer');
    }

    public function account(){
        return view('pages.profile.dashboard');
    }

    public function profile(){
        return view('pages.profile.me');
    }


    public function removeFromWishList(){

    }

    public function editProfile(){

    }

    public function updateProfile(){

    }

    public function myWishList(Request $request){
        $user = $request->user('customer');
        $wishes = WishList::orderBy('id', 'desc')->where('active', true)->where('customer_id', $user->uuid)->paginate(15);
        return view('pages.profile.wishlist')->with(['wishes'=>$wishes]);
    }

    public function customerLogout(Request $request){
        Auth::guard('customer')->logout();
        return redirect()->route('contact.entry');
    }

    public function addWish(Request $request, $prod_id){
        $user = $request->user('customer');
        $product = Product::where('active', true)->where('uuid', $prod_id)->first();
        if(!empty($product)){
            //check if exist
            $exist = WishList::where('product_key', $prod_id)->first();
            if(!empty($exist)){
                return response()->json(['message'=>'Already Added', 'success'=>true], 200);
            }
            $wish = new WishList();
            $wish->active = true;
            $wish->uuid = $this->getId('WsL-', 30);
            $wish->product_key = $prod_id;
            $wish->email = $user->email;
            $wish->customer_id = $user->uuid;
            $wish->save();
            return response()->json(['message'=>'Added to wish list', 'success'=>true], 200);
        }

        return response()->json(['error'=>'Item not found'], 500);
    }

    public function popWish(Request $request, $uuid){
        $user = $request->user('customer');
        $exist = WishList::where('uuid', $uuid)->where('customer_id', $user->uuid)->first();

        if(!empty($exist)){
            $exist->delete();
            return back()->withMessage('Wish Item Removed');
        }

        return back();
    }

    public function orders(Request $request){
        $user = $request->user('customer');
        $bookings = Booking::orderBy('id', 'desc')->where('customer_id', $user->uuid)->orWhere('email', $user->email)->paginate(15);
        return view('pages.profile.orders.index')->with(['bookings'=>$bookings]);
    }

    public function dropOrder(Request $request, $uuid){
        $user = $request->user('customer');
        $order = Booking::where('customer_id', $user->uuid)->orWhere('email', $user->email)->where('uuid', $uuid)->first();
        if(!empty($order)){
            //do the do
            $order->cancled = true;
            $order->update();
            return back()->withMessage('Your Order has been canceled.');
        }
        return back()->withMessage('Could not complete');
    }

    public function viewOrder(Request $request, $uuid){
        $user = $request->user('customer');
        $booking = Booking::where('customer_id', $user->uuid)->orWhere('email', $user->email)->where('uuid', $uuid)->first();

        if(!empty($booking)){
            //do the do
            return view('pages.profile.orders.show')->with(['booking'=>$booking]);
        }
        return back()->withMessage('Could not find such.');
    }

    public function viewReview(Request $request){
        $user = $request->user('customer');
        $reviews = Review::where('customer_id', $user->uuid)->orWhere('email', $user->email)->paginate(15);

//        return $reviews;

        if(!empty($reviews)){
            //do the do
            return view('pages.profile.reviews')->with(['reviews'=>$reviews]);
        }
        return back()->withMessage('Could not find such.');
    }

}
