<?php

namespace App\Events;

use App\Models\Transaction;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PaymentEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $transaction_id;
    public $payload;

    /**
     * Create a new event instance.
     *
     * PaymentEvent constructor.
     * @param $transaction_id
     * @param $payload
     */
    public function __construct($transaction_id, $payload)
    {
        $this->transaction_id = $transaction_id;
        $this->payload = $payload;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
