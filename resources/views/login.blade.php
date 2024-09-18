@extends('layouts.app')

@section('title', 'Register')

@section('content')
<h2>Create your account</h2>

<form action="{{ route('users.login') }}" method="POST">
    @csrf
    <table>

        <tr>
            <td><label for="email">E-mail</label></td>
            <td><input type="text" id="email" name="email" /></td>
        </tr>
        <tr>
            <td><label for="password">Password</label></td>
            <td><input type="text" id="password" name="password" /></td>
        </tr>
        <tr>
            <td colspan="2"><button type="submit">Login</button></td>
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