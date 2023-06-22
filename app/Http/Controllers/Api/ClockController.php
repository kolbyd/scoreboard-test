<?php

namespace App\Http\Controllers\Api;

use App\Events\ClockStarted;
use App\Events\ClockStopped;
use App\Http\Controllers\Controller;
use App\Models\Game;
use Event;
use Illuminate\Http\Request;

class ClockController extends Controller
{
    public function startClock(Request $request)
    {
        $request->validate([
            'minutes' => 'required|integer',
            'seconds' => 'required|numeric|between:0,60'
        ]);
        Event::dispatch(new ClockStarted($request->get('minutes'), $request->get('seconds')));
    }

    public function stopClock(Request $request)
    {
        $request->validate([
            'minutes' => 'required|integer',
            'seconds' => 'required|numeric|between:0,60'
        ]);
        Event::dispatch(new ClockStopped($request->get('minutes'), $request->get('seconds')));

        Game::firstOrFail()->update(["clock" => "{$request->get('minutes')}:{$request->get('seconds')}"]);
    }
}
