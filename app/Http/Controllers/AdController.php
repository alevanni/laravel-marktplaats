<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAdRequest;
use App\Models\Ad;
use App\Http\Requests\UpdateAdRequest;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return view('index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $user = Auth::user();
        if ($user == null) return redirect()->route('login');

        else {
            return view('ads.create', compact('user'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdRequest $request)
    {
        //dd($request);
        $user = Auth::user();

        if ($user == null) return redirect()->route('login');

        $validated = $request->validated();
        $validated['user_id'] = $user->id;
        $validated['priority'] = 0;
        Ad::create($validated);

        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ad $ad)
    {
        return view('ads.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ad $ad)
    {
        $user = Auth::user();
        if ($user == null) return redirect()->route('login');

        return view('ads.edit', compact('user', 'ad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdRequest $request, Ad $ad)
    {
        /*$user = Auth::user();

        if ($user == null) return redirect()->route('login');*/
        if ($request->user()->cannot('update', $ad)) {
            abort(403);
        }

        $validated = $request->validated();
        $ad->timestamps = false;
        $ad->update($validated);

        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
