@extends('layouts.app')

@section('title', 'Messages')

@section('content')
<div>
    <a href="{{ route('messages.create') }}">
        <button>Send Message</button>
    </a>

    <h2>Received messages</h2>
    <div>
        @foreach ($receivedMessages as $receivedMessage)
        @include('partials.message', ['message' => $receivedMessage])
        @endforeach
    </div>
    <h2>Sent messages</h2>
    <div>
        @foreach ($sentMessages as $sentMessage)
        @include('partials.message', ['message' => $sentMessage])
        @endforeach
    </div>
</div>

@endsection