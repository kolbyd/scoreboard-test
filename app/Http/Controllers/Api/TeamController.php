<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['success' => 'Teams found!', 'data' => Team::get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'name' => 'required|string',
            'logo' => 'url'
        ]);

        $team = Team::create([
            'identifier' => $request->get('identifier'),
            'full_name' => $request->get('name'),
            'logo_url' => $request->get('url')
        ]);

        return response()->json(['success' => 'Team created!', 'data' => $team]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $team = Team::findOrFail($id);

        return response()->json(['success' => 'Team found!', 'data' => $team]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
