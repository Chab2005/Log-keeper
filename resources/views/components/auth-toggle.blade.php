@props([
    // State that decides which icon is shown.
    // TODO: wire this to the real auth check once the backend exists.
    'authenticated' => true,
])

@if ($authenticated)
    <a href="{{ route('login') }}" class="site-header__auth" aria-label="Log in">
        <x-icons.log-in class="site-header__auth-icon" />
    </a>
@else
    <a href="{{ route('login') }}" class="site-header__auth" aria-label="Log out">
        <x-icons.log-out class="site-header__auth-icon" />
    </a>
@endif
