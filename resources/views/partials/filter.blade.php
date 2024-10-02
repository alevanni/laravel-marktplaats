<form action="{{ route('categories.show')}}" method="GET">
    @csrf
    <table>
        <tr>
            <td> <label for="category">Filter by category:</label></td>
            <td><select name="category" id="category">
                    <option value=''>--- Reset Filter ---</option>
                    <option value='null'>Articles without categories</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select></td>
            <td><button type="submit">Filter</button></td>
        </tr>
    </table>

</form>