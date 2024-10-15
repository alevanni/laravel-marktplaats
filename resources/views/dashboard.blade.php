@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div>
  <h2>Hello {{ empty($user)? 'guest' : $user->full_name }}. This is your personal area.</h2>
  @include('partials.dashboard-list', ['user' => $user])
</div>
<div>
  <h3>{{$user->full_name}}'s ads:</h3>
  @foreach ($ads as $ad)
  @include('partials.dashboard-card', ['ad' => $ad])
  @endforeach
</div>
@endsection