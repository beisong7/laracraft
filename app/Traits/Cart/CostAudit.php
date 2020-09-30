<?php

namespace App\Traits\Cart;

trait CostAudit{

    public function costMatchWith($cost){
        $cost = intval($cost);
        $key = "my_cart_list";
        $cartItems = session($key);
        if(!empty($cartItems)) {
            if (count($cartItems) > 0) {
                $price = 0;
                foreach ($cartItems as $item) {
                    $price += intval($item['total_price']);
                }

                if($cost===$price){
                    return true;
                }
            }
        }
        return false;
    }
}