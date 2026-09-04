@props([
    'id',
    'name',
    'label',
    'options' => [],
    'selected' => null,
    'placeholder' => null,
])

<label class="edit-form__label" for="{{ $id }}">{{ $label }}</label>
<select id="{{ $id }}" name="{{ $name }}" class="edit-form__select">
    @if ($placeholder)
        <option value="" disabled @selected($selected === null || $selected === '')>{{ $placeholder }}</option>
    @endif
    @foreach ($options as $value => $optionLabel)
        <option value="{{ $value }}" @selected((string) $selected === (string) $value)>{{ $optionLabel }}</option>
    @endforeach
</select>
