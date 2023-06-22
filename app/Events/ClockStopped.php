<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClockStopped implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

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
        return 'clock.stopped';
    }

    public function broadcastOn(): Channel
    {
        return new Channel('clock');
    }
}
