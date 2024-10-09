@extends('layouts.app')

@section('title', 'New Message')

@section('content')
<h2>Send a new message</h2>
<form action="{{ route('messages.store')}}" method="POST">
    @csrf
    <table>
        @include('partials.users-select')
        <tr>
            <td><label for="body">Write your message here</label></td>
            <td><textarea type="text" id="body" name="body" rows="20" cols="50"></textarea></td>
        </tr>


        <tr>
            <td colspan="2"><button type="submit">Send</button></td>
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