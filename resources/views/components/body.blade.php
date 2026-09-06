@props(['title' => null])

<section class="auth-body">
    @isset($title)
        <h1 class="auth-body__title">{{ $title }}</h1>
    @endisset

    <div class="auth-body__content">
        {{ $slot }}
    </div>
</section>
