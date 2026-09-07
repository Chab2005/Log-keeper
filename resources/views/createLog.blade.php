@extends('layout.app')

@section('content')

    <form method="POST" action="{{ route('logs.store', $project) }}" class="edit-form" novalidate>
        @csrf

        <div class="edit-form__actions">
            <a href="{{ route('projects.show', $project) }}" class="edit-form__button edit-form__button--cancel">
                Cancel
            </a>
            <button type="submit" class="edit-form__button edit-form__button--save">
                Save new log
            </button>
        </div>

        <div class="edit-form__field">
            <x-modify.title-field :maxlength="25" :value="old('title', '')" />
        </div>

        <div class="edit-form__field">
            <x-tag-input :tags="old('tags', [])" :required="true" />
        </div>

        <div class="edit-form__field">
            <x-modify.counted-textarea-field
                id="log-summary"
                name="summary"
                label="Summary"
                :maxlength="255"
                :value="old('summary', '')"
                placeholder="Write a short summary..."
                :required="true"
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
                :required="true"
            />
        </div>
    </form>

@endsection
