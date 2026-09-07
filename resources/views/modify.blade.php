@extends('layout.app')

@section('content')

    <form method="POST" action="{{ route('logs.update', $entry->id) }}" class="edit-form" novalidate>
        @csrf

        <div class="edit-form__actions">
            <a href="{{ route('logs.show', $entry->id) }}" class="edit-form__button edit-form__button--cancel">
                Cancel
            </a>
            <button type="submit" class="edit-form__button edit-form__button--save">
                Save Changes
            </button>
        </div>

        <div class="edit-form__field">
            <x-modify.title-field :maxlength="25" :value="old('title', $entry->title)" />
        </div>

        <div class="edit-form__field">
            <x-tag-input :tags="old('tags', $entry->tags->pluck('name')->all())" :required="true" />
        </div>

        <div class="edit-form__field">
            <x-modify.counted-textarea-field
                id="log-summary"
                name="summary"
                label="Summary"
                :maxlength="255"
                :value="old('summary', $entry->summary ?? '')"
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
                :value="old('description', $entry->description ?? '')"
                placeholder="Write a detailed description..."
                :large="true"
                :required="true"
            />
        </div>
    </form>

@endsection
