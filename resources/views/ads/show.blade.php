@extends('layouts.app' )

@section('title', "$ad->title" )


@section('content')
<h1>{{$ad->title}}</h1>
<h2>Created by: {{$ad->user->full_name}}</h2>
<h3>{{$ad->price}} &#8364;</h3>
@foreach ($ad->categories as $category)
<span class='badge '>{{$category->name}}</span>
@endforeach
<p>{{ $ad->description}}</p>
<div class="bids">
     @if ( $user == null )
     <a href="{{route('login', $ad->id)}}">Login to bid on this ad</a>
     @else
     @if (!count($bids))
     <h1>Be the first one to bid!</h1>
     @else
     <h3>Make your bid here:</h3>
     @endif
     @include('partials.create-bid')
     @endif

     <a href="{{ route('messages.create') }}">Send a message about this ad</a>
     <ul>
     @foreach ( $bids as $bid)
     @include('partials.bid', [ 'bid' => $bid])
     @endforeach
     </ul>
     
</div>
@endsection