<tr>
    <td><label for="receiver">To:</label></td>
    <td>
        <select name="receiver_id" id="receiver" multiple>
            @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->full_name }}</option>
            @endforeach
        </select>
    </td>
</tr>