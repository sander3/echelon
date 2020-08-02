<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class BroadcastEvent implements ShouldBroadcastNow
{
    use SerializesModels;

    public $userId;
    public $eventName;
    public $payload;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(int $userId, string $eventName, array $payload)
    {
        $this->userId = $userId;
        $this->eventName = $eventName;
        $this->payload = $payload;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('user.'.$this->userId);
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return $this->eventName;
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return $this->payload;
    }
}
