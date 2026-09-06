<form method="POST" action="{{ route('login.store') }}" class="auth-form">
    @csrf

    <x-auth.text-field
        name="login"
        label="Username / Email"
        placeholder="you@example.com"
        :value="old('login')"
        autocomplete="username"
        :autofocus="true"
    />

    <x-auth.text-field
        name="password"
        label="Password"
        type="password"
        placeholder="••••••••••••"
        autocomplete="current-password"
    />

    <button type="submit" class="auth-form__submit">Login</button>
</form>
