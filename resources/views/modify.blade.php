@extends('layout.app')

@section('content')

    <form method="POST" action="{{ route('logs.update', $entry['id']) }}" class="edit-form">
        @csrf

        <div class="edit-form__actions">
            <a href="{{ route('logs.show', $entry['id']) }}" class="edit-form__button edit-form__button--cancel">
                Cancel
            </a>
            <button type="submit" class="edit-form__button edit-form__button--save">
                Save Changes
            </button>
        </div>

        <div class="edit-form__field">
            <x-modify.title-field :value="$entry['title']" />
        </div>

        <div class="edit-form__field">
            <label class="edit-form__label">Tags</label>
            <x-tag-input :tags="$entry['tags']" />
        </div>

        <div class="edit-form__field">
            <x-modify.counted-textarea-field
                id="log-summary"
                name="summary"
                label="Summary"
                :maxlength="255"
                :value="$entry['summary']"
                placeholder="Write a short summary..."
            />
        </div>

        <div class="edit-form__field">
            <x-modify.counted-textarea-field
                id="log-description"
                name="description"
                label="Description"
                :maxlength="1024"
                :value="$entry['description']"
                placeholder="Write a detailed description..."
                :large="true"
            />
        </div>
    </form>

@endsection
