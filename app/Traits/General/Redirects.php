<?php

namespace App\Traits\General;

use Illuminate\Http\Request;

trait Redirects{
    public function backWithError(Request $request, $message){
        return back()->withErrors([$message])->withInput($request->input());
    }
}