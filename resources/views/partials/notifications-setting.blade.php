<form action ="{{ route('dashboard.update-notifications') }}" method="POST">
@csrf
@method('PUT')
<table>
    <tr>
        <td><label for="enable_notifications">{{ $user->enable_notifications ? 'Disable ' : 'Enable '}} notifications</label></td>
        <td><input type="checkbox" id="enable_notifications" name="enable_notifications" value="1" /></td>
        <td><button type="submit"> Save </button></td>
    </tr>
</table>
</form>