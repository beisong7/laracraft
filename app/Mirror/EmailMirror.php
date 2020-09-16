<?php

namespace App\Mirror;

use App\Traits\Email\MailCart;

class EmailMirror {
    use MailCart;

    public function mirror($email, $booking){
        $this->sendOrderMail($email, $booking);
    }
}