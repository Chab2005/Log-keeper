@extends('layout.app')

@section('content')

    <form method="POST" action="{{ route('logs.create') }}" class="edit-form">
        @csrf

        <div class="edit-form__actions">
            <a href="{{ url('/') }}" class="edit-form__button edit-form__button--cancel">
                Cancel
            </a>
            <button type="submit" class="edit-form__button edit-form__button--save">
                Save new log
            </button>
        </div>

        <div class="edit-form__field">
            <x-modify.title-field />
        </div>

        <div class="edit-form__field">
            <label class="edit-form__label">Tags</label>
            <x-tag-input />
        </div>

        <div class="edit-form__field">
            <x-modify.counted-textarea-field
                id="log-summary"
                name="summary"
                label="Summary"
                :maxlength="255"
                placeholder="Write a short summary..."
            />
        </div>

        <div class="edit-form__field">
            <x-modify.counted-textarea-field
                id="log-description"
                name="description"
                label="Description"
                :maxlength="1024"
                placeholder="Write a detailed description..."
                :large="true"
            />
        </div>
    </form>

@endsection
