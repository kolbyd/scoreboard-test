<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Game::get());
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return response()->json([
            'success' => 'Game found successfully.',
            'data' => Game::firstOrFail()
        ]);
    }
}
