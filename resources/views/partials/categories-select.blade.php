<tr>
    <td><label for="category">Category (optional):</label></td>
    <td>
        <select name="category[]" id="category" multiple>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </td>
</tr>