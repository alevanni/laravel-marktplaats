<nav class="my-nav">
    <ul>
        <li><a href="{{ route('index') }}">All ads</a></li>
        @if ( empty($user) )
        <li><a href="{{ route('register') }}">Register</a></li>
        <li><a href="{{ route('login') }}">Login</a></li>
        @else 
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('users.logout') }}">Logout</a></li>
        @endif
        
    </ul>
</nav>