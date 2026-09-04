/**
 * Client-side title filtering for pages that render a search bar above a list.
 *
 * Wiring (all via data attributes, no per-page JS):
 *   - The search bar opts in with `data-search-filter="<css selector>"` pointing
 *     at the container that holds the filterable list.
 *   - Optional `data-search-empty="<message>"` overrides the "no matches" text.
 *   - Each filterable item inside that container carries `data-search-item` and
 *     `data-search-title="<title>"` (the string the query is matched against).
 */

const HIDDEN_CLASS = 'search-filter-hidden';
const DEFAULT_EMPTY_MESSAGE = 'No matches found.';

interface SearchFilter {
    input: HTMLInputElement;
    target: HTMLElement;
    emptyState: HTMLElement;
}

function normalize(value: string): string {
    return value.trim().toLowerCase();
}

function getItems(target: HTMLElement): HTMLElement[] {
    return Array.from(target.querySelectorAll<HTMLElement>('[data-search-item]'));
}

function getItemTitle(item: HTMLElement): string {
    return normalize(item.dataset.searchTitle ?? item.textContent ?? '');
}

function createEmptyState(message: string): HTMLParagraphElement {
    const element = document.createElement('p');
    element.className = 'search-filter__empty';
    element.textContent = message;
    element.hidden = true;

    return element;
}

function applyFilter({ input, target, emptyState }: SearchFilter): void {
    const query = normalize(input.value);
    let visibleCount = 0;

    getItems(target).forEach((item) => {
        const matches = query === '' || getItemTitle(item).includes(query);
        item.classList.toggle(HIDDEN_CLASS, !matches);

        if (matches) {
            visibleCount += 1;
        }
    });

    emptyState.hidden = query === '' || visibleCount > 0;
}

function initSearchFilter(bar: HTMLElement): void {
    const targetSelector = bar.dataset.searchFilter;
    if (!targetSelector) {
        return;
    }

    const input = bar.querySelector<HTMLInputElement>('.search-bar__input');
    const target = document.querySelector<HTMLElement>(targetSelector);
    if (!input || !target) {
        return;
    }

    const emptyState = createEmptyState(bar.dataset.searchEmpty ?? DEFAULT_EMPTY_MESSAGE);
    target.append(emptyState);

    const filter: SearchFilter = { input, target, emptyState };
    input.addEventListener('input', () => applyFilter(filter));
    applyFilter(filter);
}

export function initSearchFilters(): void {
    document.querySelectorAll<HTMLElement>('[data-search-filter]').forEach(initSearchFilter);
}
