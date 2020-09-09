<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(20);
        return view('admin.pages.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $email = $request->input('email');
        $exist = User::where('email', $email)->first();
        $user = new User();
        $password = "";
        if(empty($exist)){
            $password = $request->input('password');

            if(empty($password)){
                $password = Str::random(8);
            }
            $user->name = $request->input('name');
            $user->uuid = uniqid('Ad', false);
            $user->email = $request->input('email');
            $user->password = bcrypt($password);
            $user->username = $request->input('username');
            $user->who = $request->input('who');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
            $user->dob = $request->input('dob');
            $user->active = true;
            $user->save();

            //send email to email
            //todo  send email to user

            return redirect()->route('user.index')->withMessage('New record added | '.$password);
        }else{
            return back()->withErrors(['error'=>'new email already exist'])->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('uuid', $id)->first();
        if(empty($user)){
            return back()->withErrors(['error'=>'Record not found']);
        }
        return view('admin.pages.users.edit')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('uuid', $id)->first();
        if(!empty($user)){
            $email = $request->input('email');

            if($user->email !== $email){
                //check if the email exist
                $exist = User::where('email', $email)->first();
                if(empty($exist)){
                    $user->name = $request->input('name');
                    $user->email = $email;
                    $user->who = $request->input('who');
                    $user->phone = $request->input('phone');
                    $user->address = $request->input('address');
                    $user->dob = $request->input('dob');
                }else{
                    return back()->withErrors(['error'=>'new email already exist']);
                }

            }else{
                $user->name = $request->input('name');
                $user->who = $request->input('who');
                $user->phone = $request->input('phone');
                $user->address = $request->input('address');
                $user->dob = $request->input('dob');
            }


            $user->update();

            return back()->withMessage('Record Updated');
        }
        return back()->withErrors(['error'=>'Record not found']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
