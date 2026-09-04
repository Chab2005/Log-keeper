@extends('layout.app')

@section('content')

    <form method="POST" action="{{ route('logs.store') }}" class="edit-form">
        @csrf

        @if ($errors->any())
            <div class="edit-form__errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="edit-form__actions">
            <a href="{{ url('/') }}" class="edit-form__button edit-form__button--cancel">
                Cancel
            </a>
            <button type="submit" class="edit-form__button edit-form__button--save">
                Save new log
            </button>
        </div>

        <div class="edit-form__field">
            <x-modify.title-field :value="old('title', '')" />
        </div>

        <div class="edit-form__field">
            <x-modify.select-field
                id="log-project"
                name="project_id"
                label="Project"
                :options="$projects->pluck('name', 'id')"
                :selected="old('project_id')"
                placeholder="Select a project"
            />
        </div>

        <div class="edit-form__field">
            <x-modify.date-field
                id="log-date"
                name="date"
                label="Date"
                :value="old('date', now()->format('Y-m-d'))"
            />
        </div>

        <div class="edit-form__field">
            <label class="edit-form__label">Tags</label>
            <x-tag-input :tags="old('tags', [])" />
        </div>

        <div class="edit-form__field">
            <x-modify.counted-textarea-field
                id="log-summary"
                name="summary"
                label="Summary"
                :maxlength="255"
                :value="old('summary', '')"
                placeholder="Write a short summary..."
            />
        </div>

        <div class="edit-form__field">
            <x-modify.counted-textarea-field
                id="log-description"
                name="description"
                label="Description"
                :maxlength="1024"
                :value="old('description', '')"
                placeholder="Write a detailed description..."
                :large="true"
            />
        </div>
    </form>

@endsection
