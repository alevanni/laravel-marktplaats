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

use function PHPUnit\Framework\isEmpty;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $ads = Ad::with('user', 'categories')->where('active', 1)->orderBy('created_at', 'desc')->paginate(20);

        $categories = Category::all();

        return view('index', compact('user', 'ads', 'categories'));
    }
    /**
     * Display the search results.
     */
    public function search(Request $request) {
        
       $user = Auth::user();
       $categories = Category::all();

       $keyword = $request->keyword;

       $ads = Ad::whereAny(['title', 'description'], 'like', '%'.$keyword.'%')->where('active', 1)->orderBy('updated_at', 'desc')->orderBy('priority', 'desc')->paginate(20);

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
        
        $validated['priority'] = isset($request['priority']) ?: 0;
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
        if ($request->priority === null) {
            $ad->timestamps = false; // it only gets updated when we pay
        }
        else $validated['priority'] = 1;

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
