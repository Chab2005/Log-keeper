@extends('layout.app')

@section('content')

    <section class="index-hero">
        <h1 class="index-hero__title">All Projects</h1>
    </section>

    <section class="index-toolbar">
        <x-search-bar
            placeholder="Query projects..."
            :url="route('project.create')"
            label="New project"
            filter=".index-grid"
            empty-message="No projects match your search."
        />
    </section>

    <section class="index-grid">
        @forelse ($projects as $project)
            <x-project-card
                :id="$project->id"
                :title="$project->name"
                :tags="$project->tags->pluck('name')->all()"
                :last-modified="$project->last_entry_at?->diffForHumans()"
            />
        @empty
            <p class="index-grid__empty">No projects yet.</p>
        @endforelse
    </section>

@endsection
