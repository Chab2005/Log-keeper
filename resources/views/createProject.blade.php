@extends('layout.app')

@section('content')

    <form method="POST" action="{{ route('project.store') }}" class="edit-form">
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
                Save new project
            </button>
        </div>

        <div class="edit-form__field">
            <x-modify.title-field :maxlength="25" :value="old('title', '')" />
        </div>

        <div class="edit-form__field">
            <label class="edit-form__label">Tags</label>
            <x-tag-input :tags="old('tags', [])" />
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
