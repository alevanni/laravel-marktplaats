@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div>
  <h2>Hello {{ empty($user)? 'guest' : $user->full_name }}. This is your personal area.</h2>
  <ul>
    <li><a href="{{ route('ads.create')}}">
        <button>New Ad</button>
      </a></li>
    <li>
      <a href="{{ route('messages.create') }}">
      <button>Send Message</button>
      </a>
    </li>

  </ul>
</div>
<div>
  <h3>{{$user->full_name}}'s ads:</h3>
  @foreach ($ads as $ad)
  @include('partials.dashboard-card', ['ad' => $ad])
  @endforeach
</div>
@endsection