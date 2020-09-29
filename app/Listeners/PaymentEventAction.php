<?php

namespace App\Listeners;

use App\Events\PaymentEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class PaymentEventAction
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PaymentEvent  $event
     * @return void
     */
    public function handle(PaymentEvent $event)
    {
//        dd($event->transaction_id, $event->payload);
        DB::table('transactions')
            ->where('uuid', $event->transaction_id)
            ->update($event->payload);
    }
}
