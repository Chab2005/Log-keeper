@props([
    'id',
    'tags' => [],
    'lastModified' => null,
    'title' => 'Untitled Project',
])

<a href="{{ route('projects.show', $id) }}" class="project-card" data-search-item data-search-title="{{ $title }}">
    <div class="project-card__header">
        <span class="project-card__id">ID: {{ $id }}</span>
        <h1 class="project-card__title">{{ $title }}</h1>
    </div>

    <div class="project-card__footer">
        <div class="project-card__tags">
            @foreach ($tags as $tag)
                <span class="project-card__tag">{{ $tag }}</span>
            @endforeach
        </div>

        <div class="project-card__status">
            <span class="project-card__dot @unless ($lastModified) project-card__dot--empty @endunless"></span>
            <span class="project-card__last-modified">{{ $lastModified ? "Last entry: {$lastModified}" : 'No entries yet' }}</span>
        </div>
    </div>
</a>
