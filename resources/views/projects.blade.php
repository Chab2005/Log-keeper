@extends('layout.app')

@section('content')

    <section class="project-hero">
        <h1 class="project-hero__title">{{ $project['title'] }}</h1>
        <p class="project-hero__subtitle">{{ $project['subtitle'] }}</p>
    </section>

    <section class="project-toolbar">
        <x-search-bar
            placeholder="Search logs..."
            :url="route('logs.create')"
            label="New entry"
        />
    </section>

    <section class="project-log-list">
        @foreach ($entries as $entry)
            <x-log-entry
                :id="$entry['id']"
                :title="$entry['title']"
                :timestamp="$entry['timestamp']"
                :description="$entry['summary']"
                :tags="$entry['tags']"
            />
        @endforeach
    </section>

@endsection
