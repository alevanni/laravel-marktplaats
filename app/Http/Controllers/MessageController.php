<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user == null) return redirect()->route('login');

        $receivedMessages = Message::where('receiver_id', $user->id)->with('sender')->get();

        $sentMessages = Message::where('sender_id', $user->id)->with('receiver')->get();

        return view('messages.index', compact('user', 'receivedMessages', 'sentMessages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        if ($user == null) return redirect()->route('login');

        $users = User::where('id', '!=', $user->id)->get();

        return view('messages.create', compact('user', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request)
    {
        $user = Auth::user();

        if ($user == null) return redirect()->route('login');

        $validated = $request->validated();
        $validated['sender_id'] = $user->id;
        Message::create($validated);
        return redirect()->route('messages.index');
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
