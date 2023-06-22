<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ShotsUpdate implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private int $visitor;
    private int $home;

    /**
     * Create a new event instance.
     */
    public function __construct(int $visitor_shots, int $home_shots)
    {
        $this->visitor = $visitor_shots;
        $this->home = $home_shots;
    }

    public function broadcastWith()
    {
        return ["visitor_shots" => $this->visitor, "home_shots" => $this->home];
    }

    public function broadcastAs()
    {
        return "shots.update";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        return new Channel('shots');
    }
}
