<?php

namespace App\Http\Controllers\Api;

use App\Events\ScoreUpdate;
use App\Http\Controllers\Controller;
use App\Models\Game;
use Broadcast;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function updateHomeScore(Request $request)
    {
        $request->validate([
            "score" => "required|integer"
        ]);

        $game = Game::firstOrFail();
        $game->update(["home_score" => $game->home_score + $request->get("score")]);
        Broadcast::event(new ScoreUpdate($game->visitor_score, $game->home_score));
    }

    public function updateVisitorScore(Request $request)
    {
        $request->validate([
            "score" => "required|integer"
        ]);

        $game = Game::firstOrFail();
        $game->update(["visitor_score" => $game->visitor_score + $request->get("score")]);
        Broadcast::event(new ScoreUpdate($game->visitor_score, $game->home_score));
    }
}
