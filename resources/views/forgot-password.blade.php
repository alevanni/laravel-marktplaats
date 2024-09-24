@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<h2>Reset your password:</h2>

<form action="{{ route('password.email') }}" method="POST">
    @csrf
    <table>
        <tr>
            <td><label for="email">E-mail</label></td>
            <td><input type="text" id="email" name="email" /></td>
        </tr>
        <tr>
            <td colspan="2"><button type="submit">Reset Password</button></td>
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