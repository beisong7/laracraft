<?php

namespace App\Http\Controllers;

use App\Traits\Email\MailCart;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends MyController
{
    use MailCart;
    public function signingin(){
        return view('admin.auth.login');
    }

    public function authenticate(Request $request){
        //todo signin logic

        $remember = $request->input('remember')==='on'?true:false;
        if(Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')], $remember)){
            return redirect(route('cms.dashboard'));
        }else{
            return back()->withErrors(array('username'=>'Invalid Credentials Given!'))->withInput($request->input());
        }
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect(route('cms.signin'));
    }

    public function mailReset(){
        return view('admin.auth.forgot_password');
    }

    public function mailResetPass(Request $request){
        //check if email exist
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if(!empty($user)){
            //send email to user
            $token = $this->makeToken(150);

            //set  with 5hrs  lifespan
            $cd = time() + (60 * 60 * 5 );

            $user->reset_timer = $cd;
            $user->reset_token = $token;
            $user->update();

//            $this->passwordResetMail($user);
            $this->sendAdminPasswordReset($user->email, $user->first_name, $user->reset_token);

            //send password reset mail to user

        }

        return back()->withMessage("An email sent to $email. Use the link to reset your password");
    }

    public function PasswordReset($email, $token){
        $user = User::where('email', $email)->where('reset_token', $token)->first();
        if(!empty($user)){
//            return $user;
            if($user->reset_timer > time()){
                return view('admin.auth.reset_password')->with('user', $user);
            }else{
                return redirect()->route('home');
            }
        }else{
            return redirect()->route('home');
        }
    }

    public function resetAccForgotPass(Request $request, $uuid, $token){
        $pass = $request->input('password');
        $pass_confirm = $request->input('confirm_password');



        if(empty($pass)){
            return back()->withErrors(array('error'=>'Password cannot be empty'));
        }

        if(empty($uuid)){
            return back()->withErrors(array('error'=>''));
        }



        if($pass===$pass_confirm){
            $user = User::where('uuid', $uuid)->where('reset_token', $token)->first();

            if(empty($user)){
                return back()->withErrors(array('error'=>'User not found'));
            }

            $user->reset_token = 0;
            $user->reset_timer = 0;
            $user->password = bcrypt($pass);
            $user->update();

            return redirect()->route('cms.signin')->withMessage('Password Reset Successful');
        }

        return back()->withErrors(array('error'=>'Password mismatch'));
    }
}
