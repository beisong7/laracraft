<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Cart;
use App\Models\Customer;
use App\Traits\Email\MailCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends MyController
{
    use MailCart;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $payment_id)
    {
        $name = $request->input('full_name');
        $phone = $request->input('phone');
        $email = $request->input('email');

        $making_payment = $request->input('making_payment');

        $booking = new Booking();
        $booking->seen = false;
        $booking->handled = false;
        $booking->replied = false;
        $booking->email = $email;

        if(Auth::guard('customer')->check()){
            $booking->customer_id = Auth::guard('customer')->user()->uuid;
        }

        $booking->phone = $phone;
        $booking->name = $name;
        $booking->uuid = $this->generateId('BK', 25);
        $booking->save();

        //register customer if empty
        $customer = Customer::where('email', $email)->first();

        if(empty($customer)){
//            $customer = new Customer();
//            $customer->email = $email;
//            $customer->name = $name;
//            $customer->save();
        }

        $key = "my_cart_list";
        $cartItems = $request->session()->get($key);
        if(!empty($cartItems)){
            try{
                if(count($cartItems)>0){
                    foreach ($cartItems as $item){
                        $cart = new Cart();
                        $cart->book_uuid = $booking->uuid;
                        $cart->product_id = $item['uuid'];
                        $cart->qty = $item['qty'];
                        $cart->price = $item['price'];
                        $cart->total_price = $item['total_price'];
                        $cart->save();
                    }
                }

                //unload the session
                $request->session()->forget($key);

                //send email to email if exists
                if(!empty($email)){
                    $this->sendOrderMail($email, $booking);
//                    $this->productOrderMail($email, $booking);
                }

                $authCustomer = $request->user('customer');
                if(!empty($authCustomer)){

                }else{
                    return back()->withMessage("Your Order has been sent. Kindly Verify your payment from the email sent to $email.");
                }



            }catch (\Exception $e){
                return back()->withErrors(['errors'=>"Your Cart List is Empty >> $e->getMessage()"]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }

    public function shopping_list(Request $request){
        return view('pages.cart.index');
    }

    public function shopping_order(Request $request){

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        $phone = $request->input('phone');

        $uuid = $this->generateId('RaV3-', 45);


        return view('pages.cart.pre_order')->with(
            [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'phone' => $phone,
                'uuid' => $uuid,
            ]
        );
    }
}
