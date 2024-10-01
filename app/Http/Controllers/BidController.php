<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Bid;
use App\Http\Requests\StoreBidRequest;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBidRequest $request, Ad $ad)
    {  
         $user = Auth::user();
        
        if ($user == null) return redirect()->route('login', $ad->id); 

        if ($request->user()->cannot('create', $ad, Bid::class)) {
            abort(403);
        }
        $validated = $request->validated();
        $validated['user_id'] = $user->id;

        $ad->bids()->create($validated);

        return redirect()->route('ads.show', compact('ad'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
