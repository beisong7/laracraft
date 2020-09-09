<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\CategoryGroup;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Monitor
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
        $categories = Category::where('active', true)->take(5)->get();
        $groups = CategoryGroup::where('active', true)->get();
        $cartItems = $request->session()->get('my_cart_list');
        View::share('categories', $categories);
        View::share('groups', $groups);
        if(!empty($cartItems)){
            View::share('cartItems', $cartItems);
        }

        if(Auth::guard('customer')->check()){

            $person = Auth::guard('customer')->user();
            View::share('person', $person);

        }
        return $next($request);
    }
}
