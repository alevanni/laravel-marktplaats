<form action="{{ route('bids.store', $ad->id)}}" method="POST">
    @csrf
   
    <table>
        <tr>
            <td><label for="amount">Amount</label></td>
            <td><input type="number" min="0.00" max="10000.00" step="0.01" name="amount" value="{{ old('amount') }}" /> &#8364;</td>
        </tr>
        <tr>
            <td colspan="2"><button type="submit">Confirm</button></td>
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