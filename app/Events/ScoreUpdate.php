<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ScoreUpdate implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private int $visitor;
    private int $home;

    /**
     * Create a new event instance.
     */
    public function __construct(int $visitor_score, int $home_score)
    {
        $this->visitor = $visitor_score;
        $this->home = $home_score;
    }

    public function broadcastWith()
    {
        return ["visitor_score" => $this->visitor, "home_score" => $this->home];
    }

    public function broadcastAs()
    {
        return "score.update";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        return new Channel('score');
    }
}
