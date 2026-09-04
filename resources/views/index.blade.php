@extends('layout.app')

@section('content')

    <section class="index-hero">
        <h1 class="index-hero__title">All Logs</h1>
    </section>

    <section class="index-toolbar">
        <x-search-bar
            placeholder="Query projects..."
            :url="route('project.create')"
            label="New project"
        />
    </section>

    <section class="index-grid">
        @foreach ($projects as $project)
            <x-project-card
                :id="$project['id']"
                :title="$project['title']"
                :tags="$project['tags']"
                :last-modified="$project['lastModified']"
            />
        @endforeach
    </section>

@endsection
