<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Traits\Email\MailCart;
use App\Traits\General\Redirects;
use App\Traits\General\Utility;
use App\Traits\General\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends MyController
{
    use Redirects, MailCart, Uuid;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function register(Request $request){


        $email = $request->input('email');

        if(empty($email)){
            return $this->backWithError($request, "Email is required");
        }

        $exist = Customer::where('email', $email)->first();

        if(!empty($exist)){
            return $this->backWithError($request, "An account already exist with $email");
        }

        $password = $request->input('password');
        $password2 = $request->input('password2');

        if(strlen($password) < 8){
            return $this->backWithError($request, "Password length too short");
        }

        if($password!==$password2){
            return $this->backWithError($request, "Password mismatch. Try again.");
        }

        $customer = new Customer();
        $customer->first_name = $request->input('first_name');
        $customer->last_name = $request->input('last_name');
        $customer->uuid = $this->setUuid();
        $customer->email = $request->input('email');
        $customer->password = bcrypt($password);
        $customer->phone = $request->input('phone');
        $customer->active = false;
        $customer->reset_token = $this->makeToken(40);
        $customer->save();

        //send welcome email
        //$this->welcome($customer);
        $this->sendWelcomeMail($customer->email, $customer->name, $customer->reset_token);

        $msg = "Account created Successfully. An email has been sent to you. Please activate your account from the email.";
        return redirect()->route('contact.login')->withMessage($msg);

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function activate($token){
        $customer = Customer::where('reset_token', $token)->where('active', false)->first();
        if(!empty($customer)){
            $customer->active = true;
            $customer->reset_token = "";
            $customer->update();
            return redirect()->route('contact.entry')->withMessage('Email verified and account activated');
        }
        return redirect()->route('home');
    }

    public function authenticate(Request $request){
        //todo signin logic

        $remember = $request->input('remember')==='on'?true:false;
        if(Auth::guard('customer')->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')], $remember)){
            return redirect()->route('home');
        }else{
            return back()->withErrors(array('username'=>'Invalid Credentials Given!'))->withInput($request->input());
        }
    }

    public function mailReset(){
        return view('pages.auth.reset_pass');
    }

    public function mailResetPass(Request $request){
        $email = $request->input('email');
        $msg = "success";
        if(!empty($email)){
            $msg = "Password reset procedure has been sent to $email";
            $customer = Customer::where('email', $email)->first();
            if(!empty($customer)){
                //check customer status
                if($customer->active){
                    $customer->reset_token = $this->makeToken(50);
                    $customer->reset_timer = time()+(60*60*24);
                    $customer->update();
                    //send email
                    $this->sendClientPasswordReset($customer->email, $customer->name, $customer->reset_token);
                    //$this->customerPasswordResetMail($customer);
                }else{
                    $msg = "Your account has not been activated. An email has been sent to $email to activate your account";

                    //send email
                    $this->sendWelcomeMail($customer->email, $customer->name, $customer->reset_token);

                    //$this->customerPasswordResetMail($customer);
                }
            }
        }

        return redirect()->route('client.request_password')->withMessage($msg);

    }

    public function PasswordReset($email, $token){
        $customer = Customer::where('email', $email)->where('reset_token', $token)->where('reset_timer', '>', time())->first();
        if(!empty($customer)){
            return view('pages.auth.fix_pass')->with('secret', encrypt($customer->uuid));
        }
    }

    public function resetAccForgotPass(Request $request, $secret){
        try{
            $uuid = decrypt($secret);
            $customer = Customer::where('uuid', $uuid)->where('active', true)->where('reset_timer', '>', time())->first();
            if(!empty($customer)){
                $password = $request->input('password');

                $password2 = $request->input('password2');

                if(strlen($password) < 8){
                    return $this->backWithError($request, "Password length too short");
                }

                if($password!==$password2){
                    return $this->backWithError($request, "Password mismatch. Try again.");
                }

                $customer->password = bcrypt($password);
                $customer->reset_timer = time();
                $customer->update();

                $msg = "Password reset successful";
                return redirect()->route('contact.login')->withMessage($msg);
            }

            return redirect()->route('contact.login');
        }catch (\Exception $e){
            return redirect()->route('contact.login');
        }
    }

    public function listCustomers(Request $request){
        $customers = Customer::where('active', true)->paginate(30);

        if($request->input('type')==='disabled'){
            $customers = Customer::where('active', false)->paginate(30);
        }

        return view('admin.pages.customer.index')->with(['customers'=>$customers]);
    }

    public function toggleStatus($uuid){
        $customer = Customer::where('uuid', $uuid)->first();
        if(!empty($customer)){
            $action = null;
            $action = $customer->active?false:true;
            $customer->active = $action;
            $msg = "";
            if($customer->active){
                $msg = "Customer activated";
            }else{
                $msg = "Customer deactivated";
            }
            $customer->update();

            return back()->withMessage($msg);
        }
        return back()->withErrors(['Customer not found']);
    }

}
