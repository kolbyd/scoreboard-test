<?php

namespace App\Http\Controllers\Api;

use App\Events\ShotsUpdate;
use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;

class ShotsController extends Controller
{
    public function updateHomeShots(Request $request)
    {
        $request->validate([
            "shots" => "required|integer"
        ]);

        $game = Game::firstOrFail();
        $game->update(["home_shots" => $game->home_shots + $request->get("shots")]);
        Broadcast::event(new ShotsUpdate($game->visitor_shots, $game->home_shots));
    }

    public function updateVisitorShots(Request $request)
    {
        $request->validate([
            "shots" => "required|integer"
        ]);

        $game = Game::firstOrFail();
        $game->update(["visitor_shots" => $game->visitor_shots + $request->get("shots")]);
        Broadcast::event(new ShotsUpdate($game->visitor_shots, $game->home_shots));
    }
}
