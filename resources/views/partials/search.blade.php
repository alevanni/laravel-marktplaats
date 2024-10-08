<form action="{{ route('index.search') }}" method="GET">
    @csrf
    <table>
        <tr>
            <td> <label for="keyword">Search by keyword:</label></td>
            <td><input type="text" name="keyword" id="keyword" required/></td>
            <td><button type="submit">Search</button></td>
        </tr>
    </table>

</form>