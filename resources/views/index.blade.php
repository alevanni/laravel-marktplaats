@extends('layouts.app')

@section('title', 'Marketplace')

@section('content')
<p>Hello {{ empty($user)? 'guest' : $user->full_name }}. This is the content for the page.</p>
<div>
   
    @foreach ($ads as $ad)
    @include('partials.card', ['ad' => $ad])
    @endforeach
</div>
@endsection