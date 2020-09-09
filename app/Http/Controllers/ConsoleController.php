<?php

namespace App\Http\Controllers;


use App\Models\Booking;
use App\Models\Message;
use App\Models\Product;
use App\User;
use Illuminate\Http\Request;

class ConsoleController extends Controller
{
    //

    public function __construct()
    {

    }

    public function dashboard(){
        $products = Product::select(['id'])->get()->count();
        $booking = Booking::select(['id'])->get()->count();
        $message = Message::where('seen', false)->select(['id'])->get()->count();
        return view('admin.pages.dashboard.index')
            ->with('products', $products)
            ->with('booking', $booking)
            ->with('message', $message)
            ->with('admin', count(User::select(['id'])->where('who', '>', 1)->get()));
    }
}
