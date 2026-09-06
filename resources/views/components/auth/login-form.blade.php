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
</x-auth.form>
