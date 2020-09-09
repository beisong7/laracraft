<?php

namespace App\Http\Controllers;


use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('status');

        $bookings = Booking::orderBy('id','desc')->paginate(25);
        if(!empty($query)){
            if($query==='unread'){
                $bookings = Booking::orderBy('id','desc')->where('seen', false)->paginate(25);
            }
        }

        return view('admin.pages.booking.index')->with('allbookings', $bookings);
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
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        if(!empty($booking)){
            $booking->seen = true;
            $booking->update();
            return view('admin.pages.booking.show')->with('booking', $booking);
        }

        return redirect()->route('message.index',['status'=>'unread']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function contact_us(Request $request){

    }

    public function preview($uuid){
        $booking = Booking::whereUuid($uuid)->first();
        if(!empty($booking)){
            return view('pages.cart.booking')->with('booking', $booking);
        }

        return redirect()->route('home');
    }

    public function startPayment(Request $request){

    }
}
