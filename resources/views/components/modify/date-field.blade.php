@props([
    'id',
    'name',
    'label',
    'value' => '',
])

<label class="edit-form__label" for="{{ $id }}">{{ $label }}</label>
<input id="{{ $id }}" name="{{ $name }}" type="date" class="edit-form__input" value="{{ $value }}">
