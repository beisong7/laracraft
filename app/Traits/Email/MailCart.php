<?php

namespace App\Traits\Email;

use App\Services\EmailServices;

trait MailCart{

    protected $emailService;

    function __construct(EmailServices $services)
    {
        $this->emailService = $services;
    }

    public function prepAdminInvite($email, $name){
        $this->emailService->view = "email.admin_invite";
        $this->emailService->reciever = $email;
        $this->emailService->sender = "noreply@winnersdurumi.org";
        $this->emailService->subject = "Winners Durumi Portal Invite";
        $this->emailService->title = "Winners Durumi";
        $this->emailService->receiverTitle = $name;
        $data = [
            "link" => "#",
            "name" => $name
        ];
        $this->emailService->data = $data;
        $this->emailService->sendEmail();
    }

    public function sendOrderMail($email, $booking, $name=""){

        $this->emailService->view = "email.order";
        $this->emailService->reciever = $email;
        $this->emailService->sender = env('SITE_EMAIL', '');
        $this->emailService->subject = 'Your Order with '.env('APP_NAME', 'E-commerce');
        $this->emailService->title = env('APP_NAME', 'Email');
        $this->emailService->receiverTitle = $name;
        $data = [
            "link" => route('view.order', $booking->uuid)
        ];
        $this->emailService->data = $data;
        $this->emailService->sendEmail();
    }

    public function sendWelcomeMail($email, $name, $token=""){

        $this->emailService->view = "email.welcome";
        $this->emailService->reciever = $email;
        $this->emailService->sender = env('SITE_EMAIL', '');
        $this->emailService->subject = "Your account with ".env('APP_NAME', 'E-commerce');
        $this->emailService->title = env('APP_NAME', 'Email');
        $this->emailService->receiverTitle = $name;
        $data = [
            "link" => route('account.activate', $token),
            "names" => $name
        ];
        $this->emailService->data = $data;
        $this->emailService->sendEmail();
    }

    public function sendAdminPasswordReset($email, $name, $token){

        $this->emailService->view = "email.reset_password";
        $this->emailService->reciever = $email;
        $this->emailService->sender = env('SITE_EMAIL', '');
        $this->emailService->subject = "Your account with ".env('APP_NAME', 'E-commerce');
        $this->emailService->title = env('APP_NAME', 'Email');
        $this->emailService->receiverTitle = $name;
        $data = [
            "link" => route('update.password', [$email, $token])
        ];
        $this->emailService->data = $data;
        $this->emailService->sendEmail();
    }

    public function sendClientPasswordReset($email, $name, $token){

        $this->emailService->view = "email.customer_password";
        $this->emailService->reciever = $email;
        $this->emailService->sender = env('SITE_EMAIL', '');
        $this->emailService->subject = "Your account with ".env('APP_NAME', 'E-commerce');
        $this->emailService->title = env('APP_NAME', 'Email');
        $this->emailService->receiverTitle = $name;
        $data = [
            "link" => route('client.reset_pass_page', [$email, $token])
        ];
        $this->emailService->data = $data;
        $this->emailService->sendEmail();
    }

    public function passwordReset($email, $name){
        $this->emailService->view = "email.admin_invite";
        $this->emailService->reciever = $email;
        $this->emailService->sender = "noreply@winnersdurumi";
        $this->emailService->subject = "Winners Durumi Portal Invite";
        $this->emailService->title = "Winners Durumi";
        $this->emailService->receiverTitle = $name;
        $data = [
            "link" => "#",
            "name" => $name
        ];
        $this->emailService->data = $data;

        $this->emailService->sendEmail();
    }

    public function testName(){
        $named = $this->emailService->aname = "Benjamin";
        dd($named);
    }
}