@extends('layout.app')

@section('content')

    <form method="POST" action="{{ route('project.store') }}" class="edit-form" novalidate>
        @csrf

        <div class="edit-form__actions">
            <a href="{{ url('/') }}" class="edit-form__button edit-form__button--cancel">
                Cancel
            </a>
            <button type="submit" class="edit-form__button edit-form__button--save">
                Save new project
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
                id="project-subtitle"
                name="subtitle"
                label="Subtitle"
                :maxlength="50"
                :value="old('subtitle', '')"
                placeholder="Write a short subtitle..."
                :required="true"
            />
        </div>
    </form>

@endsection
