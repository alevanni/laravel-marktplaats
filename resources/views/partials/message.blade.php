<div class="message">
    <table>
        <tr>
            <td> {{ $message->sender_id === $user->id ? 'To: ' . $message -> receiver -> full_name : 'From: ' . $message -> sender -> full_name }}</td>
            <td> On: {{ $message->created_at }}</td>
        </tr>

        <tr>
            <td class="message-body" colspan="2"> {{ $message -> body }}</td>
        </tr>
    </table>
</div>