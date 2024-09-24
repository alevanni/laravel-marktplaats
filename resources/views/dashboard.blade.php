@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h2>Hello {{ empty($user)? 'guest' : $user->full_name }}. This is your personal area.</h2>
<a href="{{ route('ads.create')}}">
  <button>New Ad</button>
</a>
<div>
    <h3>{{$user->full_name}}'s ads:</h3>
    @foreach ($ads as $ad)
    @include('partials.card', ['ad' => $ad])
    @endforeach
</div>
@endsection