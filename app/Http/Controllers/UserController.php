<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Mail\RegistrationSuccess;
use App\Models\User;
use App\Models\Ad;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $user = Auth::user();
        $ads = Ad::whereBelongsTo($user)->with('categories')->orderBy('created_at', 'desc')->orderBy('active', 'desc')->get();
        return view('dashboard', compact('user', 'ads'));
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
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['remember_token'] =  Str::random(10);
        $validated['email_verified_at'] = now();
        $user = User::create($validated);
        Mail::to($user)->send(new RegistrationSuccess($user));
        //dd($user->full_name);
        return redirect()->route('login');
        //dd($validated);
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
