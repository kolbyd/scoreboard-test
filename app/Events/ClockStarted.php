<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class ClockStarted implements ShouldBroadcastNow
{
    private int $minutes;
    private int $seconds;
    /**
     * Create a new channel instance.
     */
    public function __construct(int $minutes, int $seconds)
    {
        $this->minutes = $minutes;
        $this->seconds = $seconds;
    }

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return ['minutes' => $this->minutes, 'seconds' => $this->seconds];
    }

    public function broadcastAs(): string
    {
        return 'clock.started';
    }

    public function broadcastOn(): Channel
    {
        return new Channel('clock');
    }
}
