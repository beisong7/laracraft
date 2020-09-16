<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Traits\Email\MailCart;
use Illuminate\Http\Request;

class MessageController extends MyController
{
    use MailCart;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('status');

        $messages = Message::orderBy('id','desc')->paginate(25);
        if(!empty($query)){
            if($query==='unread'){
                $messages = Message::orderBy('id','desc')->where('seen', false)->paginate(25);
            }
        }

        return view('admin.pages.message.index')
            ->with('allmessages', $messages);
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

    }

    public function contact_us(Request $request){
        //verify
        $encrypt = $request->input('summed');
        if(!empty($encrypt)){
            $verify = $request->input('verify');
            try{
                $encrypt = decrypt($encrypt);
            }catch (\Exception $e){

            }
            if(intval($encrypt)===intval($verify)){
                $message = new Message();
                $message->email = $request->input('email');
                $message->subject = $request->input('subject');
                $message->names = $request->input('name');
                $message->info = $request->input('message');
                $message->seen = false;
                $message->replied = false;
                $message->phone = $request->input('phone');
                $message->save();
            }
        }


        return back()->withMessage('Your message has been sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        if(!empty($message)){
            $message->seen = true;
            $message->update();
            return view('admin.pages.message.show')->with('message', $message);
        }

        return redirect()->route('message.index',['status'=>'unread']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }

    public function testEmail($name){
        return $this->testName($name);
    }
}
