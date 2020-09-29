<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
    //
    public function migrate($action){
        if($action==="migrate"){
            try{
                Artisan::call("$action",[
                    '--path' => 'database/migrations',
                    '--force' => true,
                ]);
                return ["$action completed"];
            }catch (\Exception $e){
                return ['failed - '.$e->getMessage()];
            }

        }

        if($action==="optimize:clear"){
            try{
                Artisan::call("$action");
                return ["$action completed"];
            }catch (\Exception $e){
                return ['failed - '.$e->getMessage()];
            }

        }

        if($action==="event:clear"){
            try{
                Artisan::call("$action");
                return ["$action completed"];
            }catch (\Exception $e){
                return ['failed - '.$e->getMessage()];
            }

        }

        if($action==="event:cache"){
            try{
                Artisan::call("$action");
                return ["$action completed"];
            }catch (\Exception $e){
                return ['failed - '.$e->getMessage()];
            }

        }
        return ["unknown call"];
    }

    public function seed($action){
        if($action==="seed"){
            $email = env('SITE_EMAIL', '');
            $user = User::where('email', $email)->first();
            if(empty($user)){
                $user = new User();
                $user->name = 'Administrator';
                $user->uuid = uniqid('Ad', false);
                $user->email = $email;
                $user->password = bcrypt('password');
                $user->username = 'admin';
                $user->who = 4;

                $user->save();
                return ['Seed Completed'];
            }else{
                return ['user already exist'];
            }
        }
        return ["unknown call"];
    }
}
