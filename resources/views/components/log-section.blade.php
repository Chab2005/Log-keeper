@props([
    'heading',
    'text',
])

@php
    $paragraphs = collect(explode("\n\n", trim($text)))->filter();
@endphp

<section class="log-section">
    <h3 class="log-section__heading">{{ $heading }}</h3>
    <div class="log-section__body">
        @foreach ($paragraphs as $paragraph)
            <p class="log-section__text">{{ $paragraph }}</p>
        @endforeach
    </div>
</section>
