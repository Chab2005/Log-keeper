@props([
    'id',
    'name',
    'label',
    'maxlength',
    'value' => '',
    'placeholder' => '',
    'large' => false,
    'required' => false,
])

<div class="edit-form__label-row">
    <label class="edit-form__label" for="{{ $id }}">
        {{ $label }}@if ($required)<span class="edit-form__required" aria-hidden="true">*</span>@endif
    </label>
    <span class="edit-form__counter" data-counter-for="{{ $id }}" data-max="{{ $maxlength }}">{{ mb_strlen($value) }} / {{ $maxlength }}</span>
</div>
<textarea
    id="{{ $id }}"
    name="{{ $name }}"
    @class([
        'edit-form__textarea',
        'edit-form__textarea--large' => $large,
        'edit-form__textarea--error' => $errors->has($name),
    ])
    maxlength="{{ $maxlength }}"
    rows="{{ $large ? 10 : 3 }}"
    data-autogrow
    placeholder="{{ $placeholder }}"
    @required($required)
    aria-invalid="{{ $errors->has($name) ? 'true' : 'false' }}"
>{{ $value }}</textarea>

<x-modify.field-error :name="$name" />
