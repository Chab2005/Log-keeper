@props([
    'tags' => [],
])

<div class="tag-input" data-tag-input>
    @foreach ($tags as $tag)
        <span class="tag-input__chip">
            {{ $tag }}
            <button type="button" class="tag-input__remove" aria-label="Remove tag">&times;</button>
            <input type="hidden" name="tags[]" value="{{ $tag }}">
        </span>
    @endforeach

    <input type="text" class="tag-input__field" placeholder="Add new tag (press Enter)" data-tag-input-field>
</div>
