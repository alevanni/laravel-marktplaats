<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAdRequest;
use App\Models\Ad;
use App\Http\Requests\UpdateAdRequest;
use App\Models\Bid;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $ads = Ad::with('user', 'categories')->where('active', 1)->orderBy('created_at', 'desc')->paginate(3);

        $categories = Category::all();

        return view('index', compact('user', 'ads', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $user = Auth::user();

        if ($user == null) return redirect()->route('login');

        $categories = Category::all();

        return view('ads.create', compact('user', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdRequest $request)
    {
        $user = Auth::user();

        if ($user == null) return redirect()->route('login');
        // is this useless?
        if ($request->user()->cannot('create', Ad::class)) {
            abort(403);
        }

        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;
        $validated['priority'] = 0;
        $validated['active'] = 1;

        $ad = Ad::create($validated);
        if ($request['category'] !== null) {
            $ad->categories()->attach($request['category']);
        }
        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ad $ad)
    {
        $user = Auth::user();

        $bids = Bid::where('ad_id', $ad->id)->with('user')->orderBy('amount', 'desc')->get();

        return view('ads.show', compact('user', 'ad', 'bids'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Ad $ad)
    {
        $user = Auth::user();

        if ($user == null) return redirect()->route('login');

        if ($request->user()->cannot('update', $ad)) {
            abort(403);
        }
        $categories = Category::whereDoesntHave('ads', function (Builder $query) use ($ad) {
            $query->where('ad_id', $ad->id);
        })->get();
        return view('ads.edit', compact('user', 'ad', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdRequest $request, Ad $ad)
    {
        $user = Auth::user();

        if ($user == null) return redirect()->route('login');

        if ($request->user()->cannot('update', $ad)) {
            abort(403);
        }

        $validated = $request->validated();
        $ad->timestamps = false;
        $ad->update($validated);

        $ad->categories()->attach($request['category']);

        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Ad $ad)
    {

        $user = Auth::user();

        if ($user == null) return redirect()->route('login');

        if ($request->user()->cannot('delete', $ad)) {
            abort(403);
        }

        $ad->delete();
        return redirect('dashboard');
    }
}
