@extends('layouts.app')

@section('title', 'New Ad')

@section('content')
<h2>Create a new ad</h2>
<form action="" method="POST">
@csrf
<table>
    <tr>
        <td><label for="title">Title</label></td>
        <td><input type="text" id="title" name="title" /></td>
    </tr>
    <tr>
        <td><label for="description">Description</label></td>
        <td><textarea type="text" id="description" name="description" rows="20" cols="50" ></textarea></td>
    </tr>
    <tr>
        <td><label for="price">Price</label></td>
        <td><input type="number" min="0.00" max="10000.00" step="0.01" name="price"/> &#8364;</td>
    </tr>
    <tr>
            <td colspan="2"><button type="submit">Save</button></td>
    </tr>
</table>
</form>
@if ($errors->any())
    <div >
        <ul class="validation-errors">
            @foreach ($errors->all() as $error)
                <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection