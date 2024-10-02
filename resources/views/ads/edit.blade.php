@extends('layouts.app')

@section('title', 'Edit Ad')

@section('content')
<h2>Edit your ad</h2>
<form action="{{ route('ads.update', [$ad->id] ) }}" method="POST">
    @csrf
    @method('PUT')
    <table>
        <tr>
            <td><label for="title">Title</label></td>
            <td><input type="text" id="title" name="title" value="{{ $ad->title }}" /></td>
        </tr>
        <tr>
            <td><label for="description">Description</label></td>
            <td><textarea type="text" id="description" name="description" rows="20" cols="50">{{ $ad->description }}</textarea></td>
        </tr>
        <tr>
            <td><label for="price">Price</label></td>
            <td><input type="number" min="0.00" max="10000.00" step="0.01" name="price" value="{{ $ad->price }}" /> &#8364;</td>
        </tr>
        @include('partials.categories-select')
        <tr>
            <td colspan="2"><button type="submit">Save</button></td>
        </tr>
    </table>
</form>
@if ($errors->any())
<div>
    <ul class="validation-errors">
        @foreach ($errors->all() as $error)
        <li class="error">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endsection