<div class="message">
    <table>
        <tr>
            <td> {{ $message->sender_id === $user->id ? 'To: ' . $message -> receiver -> full_name : 'From: ' . $message -> sender -> full_name }}</td>
        </tr>

        <tr>
            <td class="message-body">{{ $message -> body }}</td>
        </tr>
    </table>
</div>