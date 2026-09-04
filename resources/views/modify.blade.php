@extends('layout.app')

@section('content')

    <form method="POST" action="{{ route('logs.update', $entry->id) }}" class="edit-form">
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
            <label class="edit-form__label">Tags</label>
            <x-tag-input :tags="old('tags', $entry->tags->pluck('name')->all())" />
        </div>

        <div class="edit-form__field">
            <x-modify.counted-textarea-field
                id="log-summary"
                name="summary"
                label="Summary"
                :maxlength="255"
                :value="old('summary', $entry->summary ?? '')"
                placeholder="Write a short summary..."
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
            />
        </div>
    </form>

@endsection
