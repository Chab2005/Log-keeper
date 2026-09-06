@props([
    'action',
    'heading',
    'submit',
])

<form method="POST" action="{{ $action }}" class="auth-form">
    @csrf

    <p class="auth-form__heading">{{ $heading }}</p>

    {{ $slot }}

    <button type="submit" class="auth-form__submit">{{ $submit }}</button>
</form>
