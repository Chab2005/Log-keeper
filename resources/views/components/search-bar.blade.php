@props([
    'placeholder' => 'Search...',
    'url' => '/create',
    'label' => 'Create new',
    'filter' => null,
    'emptyMessage' => 'No matches found.',
])

<div
    class="search-bar"
    @if ($filter)
        data-search-filter="{{ $filter }}"
        data-search-empty="{{ $emptyMessage }}"
    @endif
>
    <div class="search-bar__field">
        <svg class="search-bar__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="7"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text" class="search-bar__input" placeholder="{{ $placeholder }}">
    </div>

    <a href="{{ $url }}" class="search-bar__button" aria-label="{{ $label }}">
        <svg class="search-bar__button-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
    </a>
</div>
