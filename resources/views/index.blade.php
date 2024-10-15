@extends('layouts.app')

@section('title', 'Marketplace')

@section('content')
<p>Hello {{ empty($user)? 'guest' : $user->full_name }}. This is the content for the page.</p>
<div>
    @include('partials.filter')
    @include('partials.search')
    @foreach ($ads as $ad)
    @include('partials.card', ['user' => $user , 'ad' => $ad])
    @endforeach
</div>
{{ $ads->links() }}
@endsection