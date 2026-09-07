@props([
    'tags' => [],
    'name' => 'tags',
    'label' => 'Tags',
    'required' => false,
])

@php($hasError = $errors->has($name) || $errors->has($name . '.*'))

<label class="edit-form__label">
    {{ $label }}@if ($required)<span class="edit-form__required" aria-hidden="true">*</span>@endif
</label>

<div @class(['tag-input', 'tag-input--error' => $hasError]) data-tag-input>
    @foreach ($tags as $tag)
        <span class="tag-input__chip">
            {{ $tag }}
            <button type="button" class="tag-input__remove" aria-label="Remove tag">&times;</button>
            <input type="hidden" name="tags[]" value="{{ $tag }}">
        </span>
    @endforeach

    <input type="text" class="tag-input__field" placeholder="Add new tag (press Enter)" data-tag-input-field>
</div>

<x-modify.field-error :name="$name" />
<x-modify.field-error :name="$name . '.*'" />
