@auth
    <form method="POST" action="{{ route('logout') }}" class="site-header__auth-form">
        @csrf
        <button type="submit" class="site-header__auth" aria-label="Log out">
            <x-icons.log-out class="site-header__auth-icon" />
        </button>
    </form>
@else
    <a href="{{ route('login') }}" class="site-header__auth" aria-label="Log in">
        <x-icons.log-in class="site-header__auth-icon" />
    </a>
@endauth
