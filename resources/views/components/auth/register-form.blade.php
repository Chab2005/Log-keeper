<x-auth.form :action="route('register.store')" heading="Register" submit="Register">
    <x-auth.text-field
        name="name"
        label="Name"
        placeholder="Ada Lovelace"
        :value="old('name')"
        autocomplete="name"
        :autofocus="true"
    />

    <x-auth.text-field
        name="username"
        label="Username"
        placeholder="ada"
        :value="old('username')"
        autocomplete="username"
    />

    <x-auth.text-field
        name="email"
        label="Email"
        type="email"
        placeholder="you@example.com"
        :value="old('email')"
        autocomplete="email"
    />

    <x-auth.text-field
        name="password"
        label="Password"
        type="password"
        placeholder="••••••••••••"
        autocomplete="new-password"
    />
</x-auth.form>
