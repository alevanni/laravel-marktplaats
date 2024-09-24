@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')

<form action="{{ route('password.update')}}" method="POST">
    @csrf
<table>
    <tr>
        <td><label for="email">E-mail</label></td>
        <td><input type="text" id="email" name="email" /></td>
    </tr>
    <tr>
            <td><label for="password">New Password</label></td>
            <td><input type="text" id="password" name="password" /></td>
    </tr>
    <tr>
            <td><label for="password-confirmation">Confirm Password</label></td>
            <td><input type="text" id="password-confirmation" name="password_confirmation" /></td>
    </tr>
    <tr>
        <input type="hidden" id="token" name="token" value="{{$token}}"/>
    </tr>
    <tr>
            <td colspan="2"><button type="submit">Submit</button></td>
    </tr>
</table>
</form>

<div>
@if ($errors->any())
    <div >
        <ul class="validation-errors">
            @foreach ($errors->all() as $error)
                <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
</div>
@endsection