@props([
    'value' => '',
    'maxlength' => null,
])

@if($maxlength)
    <div class="edit-form__label-row">
        <label class="edit-form__label" for="log-title">Title</label>
        <span class="edit-form__counter" data-counter-for="log-title" data-max="{{ $maxlength }}">{{ mb_strlen($value) }} / {{ $maxlength }}</span>
    </div>
@else
    <label class="edit-form__label" for="log-title">Title</label>
@endif
<input
    id="log-title"
    name="title"
    type="text"
    @class([
        'edit-form__input',
        'edit-form__input--title',
        'edit-form__input--error' => $errors->has('title'),
    ])
    value="{{ $value }}"
    @if($maxlength) maxlength="{{ $maxlength }}" @endif
    placeholder="Enter log title..."
>
