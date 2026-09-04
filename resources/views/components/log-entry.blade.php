@props([
    'id',
    'title',
    'timestamp' => null,
    'description' => null,
    'tags' => [],
])

<a href="{{ route('logs.show', $id) }}" class="log-entry" data-search-item data-search-title="{{ $title }}">
    <div class="log-entry__header">
        <h3 class="log-entry__title">{{ $title }}</h3>
        @if ($timestamp)
            <span class="log-entry__timestamp">{{ $timestamp }}</span>
        @endif
    </div>

    @if ($description)
        <p class="log-entry__description">{{ $description }}</p>
    @endif

    @if (!empty($tags))
        <div class="log-entry__tags">
            @foreach ($tags as $tag)
                <span class="log-entry__tag">#{{ $tag }}</span>
            @endforeach
        </div>
    @endif
</a>
