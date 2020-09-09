<?php

namespace App\Http\Middleware;

use App\Models\Booking;
use App\Models\Message;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            if(Auth::user()->who > 1){
                $messages = Message::where('seen', false)->get();
                $bookings = Booking::where('seen', false)->get();
                View::share('messages', $messages);
                View::share('bookings', $bookings);
                View::share('person', Auth::user());
                return $next($request);
            }
        }

        return redirect()->route('cms.signin');

    }
}
