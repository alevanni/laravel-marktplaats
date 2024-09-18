@extends('layouts.app')

@section('title', 'Marketplace')

@section('content')
<p>Hello {{ empty($user)? 'guest' : $user->full_name }}. This is the content for the page.</p>
@endsection