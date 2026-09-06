@props([
    'name',
    'label',
    'type' => 'text',
    'value' => '',
    'placeholder' => null,
    'autocomplete' => null,
    'autofocus' => false,
])

<div class="auth-field">
    <label class="auth-field__label" for="{{ $name }}">{{ $label }}</label>

    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ $value }}"
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
        @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
        @if ($autofocus) autofocus @endif
        @class([
            'auth-field__input',
            'auth-field__input--error' => $errors->has($name),
        ])
    >

    @error($name)
        <p class="auth-field__error">{{ $message }}</p>
    @enderror
</div>
