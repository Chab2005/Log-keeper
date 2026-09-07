@props([
    'name',
])

@error($name)
    <p class="edit-form__error">{{ $message }}</p>
@enderror
