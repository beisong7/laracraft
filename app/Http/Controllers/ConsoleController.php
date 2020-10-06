<?php

namespace App\Http\Controllers;


use App\Models\Booking;
use App\Models\Message;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Transaction;
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

        //all transactions
        $transactions = Transaction::select([
            'amount',
            'status',
            'completed',
        ]);

        //all
        $allTrans = $transactions->get()->count();

        //completed
        $compTrans = $transactions->where('completed', true)->get()->count();

        //successful
        $succTrans = $transactions->where('status', 'success')->get()->count();

        //revenue
        $revenue = Payment::where('status', true)->select(['amount','status'])->get()->sum('amount');

        //admin count
        $adminCount = User::select(['id'])->where('who', '>', 1)->get()->count();


        //
        return view('admin.pages.dashboard.index')
            ->with([
                'products'=>$products,
                'booking'=>$booking,
                'message'=>$message,
                'admin'=>$adminCount,
                'allTrans'=>$allTrans,
                'compTrans'=>$compTrans,
                'succTrans'=>$succTrans,
                'revenue'=>$revenue,
            ]);
    }
}
