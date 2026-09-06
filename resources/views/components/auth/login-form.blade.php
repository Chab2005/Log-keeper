<x-auth.form :action="route('login.store')" heading="Login" submit="Login">
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

    <x-slot:footer>
        No account, register <a href="{{ route('register') }}" class="auth-form__link">here</a>
    </x-slot:footer>
</x-auth.form>
