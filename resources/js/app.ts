import { initSearchFilters } from './modules/search-filter';

function autoGrow(textarea: HTMLTextAreaElement): void {
    textarea.style.height = 'auto';
    textarea.style.height = `${textarea.scrollHeight}px`;
}

function initAutoGrowTextareas(): void {
    document.querySelectorAll<HTMLTextAreaElement>('textarea[data-autogrow]').forEach((textarea) => {
        autoGrow(textarea);
        textarea.addEventListener('input', () => autoGrow(textarea));
    });
}

function initCharacterCounters(): void {
    document.querySelectorAll<HTMLElement>('[data-counter-for]').forEach((counter) => {
        const targetId = counter.dataset.counterFor;
        const max = counter.dataset.max;
        if (!targetId || !max) {
            return;
        }

        const field = document.getElementById(targetId) as HTMLTextAreaElement | HTMLInputElement | null;
        if (!field) {
            return;
        }

        const update = () => {
            counter.textContent = `${field.value.length} / ${max}`;
        };

        update();
        field.addEventListener('input', update);
    });
}

function createTagChip(value: string): HTMLSpanElement {
    const chip = document.createElement('span');
    chip.className = 'tag-input__chip';
    chip.append(`${value} `);

    const removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.className = 'tag-input__remove';
    removeButton.setAttribute('aria-label', 'Remove tag');
    removeButton.innerHTML = '&times;';
    removeButton.addEventListener('click', () => chip.remove());
    chip.append(removeButton);

    const hidden = document.createElement('input');
    hidden.type = 'hidden';
    hidden.name = 'tags[]';
    hidden.value = value;
    chip.append(hidden);

    return chip;
}

function initTagInputs(): void {
    document.querySelectorAll<HTMLElement>('[data-tag-input]').forEach((container) => {
        const field = container.querySelector<HTMLInputElement>('[data-tag-input-field]');
        if (!field) {
            return;
        }

        container.querySelectorAll<HTMLButtonElement>('.tag-input__remove').forEach((button) => {
            button.addEventListener('click', () => button.closest('.tag-input__chip')?.remove());
        });

        field.addEventListener('keydown', (event) => {
            if (event.key !== 'Enter') {
                return;
            }

            event.preventDefault();

            const value = field.value.trim();
            if (!value) {
                return;
            }

            container.insertBefore(createTagChip(value), field);
            field.value = '';
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initAutoGrowTextareas();
    initCharacterCounters();
    initTagInputs();
    initSearchFilters();
});
