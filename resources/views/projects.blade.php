@extends('layout.app')

@section('content')

    <section class="project-hero">
        <h1 class="project-hero__title">{{ $project->name }}</h1>
        <p class="project-hero__subtitle">{{ $project->summary }}</p>
    </section>

    <section class="project-toolbar">
        <x-search-bar
            placeholder="Search logs..."
            :url="route('logs.create', $project)"
            label="New entry"
            filter=".project-log-list"
            empty-message="No entries match your search."
        />
    </section>

    <section class="project-log-list">
        @forelse ($project->entries as $entry)
            <x-log-entry
                :id="$entry->id"
                :title="$entry->title"
                :timestamp="$entry->date?->format('Y-m-d')"
                :description="$entry->summary"
                :tags="$entry->tags->pluck('name')->all()"
            />
        @empty
            <p class="project-log-list__empty">No entries yet.</p>
        @endforelse
    </section>

@endsection
