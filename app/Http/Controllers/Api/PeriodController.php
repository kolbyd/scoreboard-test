<?php

namespace App\Http\Controllers\Api;

use App\Events\PeriodUpdate;
use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function updatePeriod(Request $request)
    {
        $request->validate(['period' => 'required|integer|min:1']);

        Broadcast::event(new PeriodUpdate($request->get('period')))->toOthers();
        Game::firstOrFail()->update(["period" => $request->get('period')]);
    }
}
