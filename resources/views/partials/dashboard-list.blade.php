<ul>
    <li><a href="{{ route('ads.create')}}">
        <button>New Ad</button>
      </a></li>
    <li>
      <a href="{{ route('messages.create') }}">
      <button>Send Message</button>
      </a>
    </li>
    <li>
      Your notifications are: {{ $user->enable_notifications ? 'enabled' : 'disabled'}} @include('partials.notifications-setting', ['user' => $user])
    </li>

  </ul>