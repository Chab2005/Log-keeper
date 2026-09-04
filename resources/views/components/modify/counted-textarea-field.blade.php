@props([
    'id',
    'name',
    'label',
    'maxlength',
    'value' => '',
    'placeholder' => '',
    'large' => false,
])

<div class="edit-form__label-row">
    <label class="edit-form__label" for="{{ $id }}">{{ $label }}</label>
    <span class="edit-form__counter" data-counter-for="{{ $id }}" data-max="{{ $maxlength }}">{{ mb_strlen($value) }} / {{ $maxlength }}</span>
</div>
<textarea
    id="{{ $id }}"
    name="{{ $name }}"
    class="edit-form__textarea @if($large) edit-form__textarea--large @endif"
    maxlength="{{ $maxlength }}"
    rows="{{ $large ? 10 : 3 }}"
    data-autogrow
    placeholder="{{ $placeholder }}"
>{{ $value }}</textarea>
