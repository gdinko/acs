<?php

namespace Gdinko\Acs\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CarrierAcsTrackingEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $tracking;

    public $account;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $tracking, string $account)
    {
        $this->tracking = $tracking;

        $this->account = $account;
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
