@props([
    'title' => 'Not found',
    'message' => 'We could not find what you were looking for.',
    'linkUrl' => '/',
    'linkLabel' => 'Back to all projects',
])

<section class="not-found">
    <span class="not-found__code">404</span>
    <h1 class="not-found__title">{{ $title }}</h1>
    <p class="not-found__message">{{ $message }}</p>
    <a href="{{ $linkUrl }}" class="not-found__link">{{ $linkLabel }}</a>
</section>
