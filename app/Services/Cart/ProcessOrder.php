<?php

namespace App\Services\Cart;

use App\Models\Booking;
use App\Models\Cart;
use App\Models\Customer;
use App\Traits\Email\MailCart;
use App\Traits\General\Utility;
use App\Traits\General\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProcessOrder{
    use Utility, MailCart, Uuid;

    protected $emailMirror;

    public function prepareOrder($transaction, $payment_id){

        $name = $transaction->first_name." ".$transaction->last_name;
        $phone = $transaction->phone;
        $email = $transaction->email;

        $cus_id = null;
        if(Auth::guard('customer')->check()){
            $cus_id = Auth::guard('customer')->user()->uuid;
        }

        $booking = Booking::create(
            [
                'seen'=> false,
                'handled'=> false,
                'replied'=> false,
                'email'=> $email,
                'customer_id'=>$cus_id,
                'transaction_id'=>$transaction->uuid,
                'phone' => $phone,
                'name' => $name,
                'uuid' => "BK-".$this->setUuid(),
            ]
        );

        DB::beginTransaction();
        DB::table('payments')
            ->where('uuid', $payment_id)
            ->update([
                'order_id'=>$booking->uuid
            ]);

        DB::table('transactions')
            ->where('uuid', $transaction->uuid)
            ->update([
                'cart_id'=>$booking->uuid,
            ]);


        $key = "my_cart_list";
        $cartItems = session($key);

//        $cartItems = $request->session()->get($key);
        if(!empty($cartItems)){
            if(count($cartItems)>0){
                foreach ($cartItems as $item){
                    $cart = Cart::create(
                        [
                            'book_uuid' => $booking->uuid,
                            'product_id' => $item['uuid'],
                            'qty' => $item['qty'],
                            'price' => $item['price'],
                            'total_price' => $item['total_price'],
                        ]
                    );
                }
            }
        }
        DB::commit();
    }

    public function completeOrder($transaction, $payment_id){

        $name = $transaction->first_name." ".$transaction->last_name;
        $phone = $transaction->phone;
        $email = $transaction->email;

        $cus_id = null;
        if(Auth::guard('customer')->check()){
            $cus_id = Auth::guard('customer')->user()->uuid;
        }

        DB::beginTransaction();

        $booking = Booking::create(
            [
                'seen'=> false,
                'handled'=> false,
                'replied'=> false,
                'email'=> $email,
                'customer_id'=>$cus_id,
                'phone' => $phone,
                'name' => $name,
                'uuid' => "BK-".$this->setUuid(),
            ]
        );

        DB::table('payments')
            ->where('uuid', $payment_id)
            ->update([
                'order_id'=>$booking->uuid
            ]);

        DB::table('transactions')
            ->where('uuid', $transaction->uuid)
            ->update([
                'cart_id'=>$booking->uuid,
            ]);



        //register customer if empty
        $customer = Customer::where('email', $email)->first();

        if(empty($customer)){
//            $customer = new Customer();
//            $customer->email = $email;
//            $customer->name = $name;
//            $customer->save();
        }

        $key = "my_cart_list";
        $cartItems = session($key);

//        $cartItems = $request->session()->get($key);
        if(!empty($cartItems)){
            if(count($cartItems)>0){
                foreach ($cartItems as $item){
                    $cart = Cart::create(
                        [
                            'book_uuid' => $booking->uuid,
                            'product_id' => $item['uuid'],
                            'qty' => $item['qty'],
                            'price' => $item['price'],
                            'total_price' => $item['total_price'],
                        ]
                    );
                }
            }

            //unload the session
            session()->forget($key);

            //send email to email if exists
            if(!empty($email)){

                $this->sendOrderMail($email, $booking);
//                    $this->productOrderMail($email, $booking);
            }

            DB::commit();

            $authCustomer = Auth::guard('customer')->user();
            if(!empty($authCustomer)){
                return redirect()->route('cart')->withMessage('Your order has been completed successfully. Check your email for details.');
            }else{
                return redirect()->route('cart')->withMessage('Your order has been completed successfully. Check your email for details.');
            }

        }

        return redirect()->route('cart')->withErrors(['Your cart might me empty. Contact us if you just made a payment.']);

    }
}