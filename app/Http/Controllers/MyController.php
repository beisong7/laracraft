<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    //

    public function passwordResetMail($user){
        $view = view('email.reset_password')
            ->with("email", $user->email)
            ->with("token", $user->token);

        $this->sendMails($user->email, $view, env('APP_NAME', 'Hi').' - Password Reset');
    }

    public function customerPasswordResetMail($customer){
        $view = view('email.customer_password')
            ->with("email", $customer->email)
            ->with("token", $customer->reset_token);

        $this->sendMails($customer->email, $view, env('APP_NAME', 'Hi').' - Password Reset');
    }

    public function welcome($customer){
        $view = view('email.welcome')
            ->with("email", $customer->email)
            ->with("names", $customer->name)
            ->with("token", $customer->reset_token);

        $this->sendMails($customer->email, $view, 'Welcome to '. env('APP_NAME', ''));
    }

    public function productOrderMail($email, $booking){
        $view = view('email.order')->with('booking', $booking);
        $this->sendMails($email, $view, 'Your Order with '.env('APP_NAME', ''));
    }

    public function sendMails($mail, $htmlContent, $title){

        $to = $mail;
        $sender = "noreply@".env('SITE_DOMAIN', '');

        $separator = md5(time());
        $eol = "\r\n";

        $subject = $title;

        $fromMail = env('APP_NAME', '')." <$sender>";

        $headersMail = '';

        $headersMail .= "Reply-To:" . $fromMail . "\r\n";
        $headersMail .= "Return-Path: ". $fromMail ."\r\n";
        $headersMail .= 'From: ' . $fromMail . "\r\n";
        $headersMail .= "Organization: ".env('APP_NAME', '')." \r\n";

        $headersMail .= 'MIME-Version: 1.0' . "\r\n";

        $headersMail .= "X-Priority: 3\r\n";
        $headersMail .= "X-Mailer: PHP". phpversion() ."\r\n" ;
        $headersMail .=  "Content-Type: text/html; charset=ISO-8859-1; boundary=\"" . $separator . "\"" . $eol;
//        $headersMail .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";

        $headersMail .= 'Content-Transfer-Encoding: 7bit' . "\r\n";



//        @mail($to,$subject, $htmlContent, $headersMail, $sender);
        @mail($to,$subject,$htmlContent,$headersMail, "-f ". $sender);

    }

    public function makeToken($val){
        $token = "";
        $codes = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codes .= "-_";
        $codes .= "abcdefghijklmnopqrstuvwxyz";
        $codes .= "0123456789";
        $max = strlen($codes);
        for($i=0; $i < $val; $i++){
            $token.= $codes[random_int(0, $max-1)];
        }
        return $token;
    }

    public function generateId($prefix, $int){
        $token = "";
        $codes = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codes .= "-_";
        $codes .= "abcdefghijklmnopqrstuvwxyz";
        $codes .= "0123456789";
        $max = strlen($codes);
        for($i=0; $i < $int; $i++){
            $token.= $codes[random_int(0, $max-1)];
        }
        return $prefix.$token.uniqid("", false);
    }
}
