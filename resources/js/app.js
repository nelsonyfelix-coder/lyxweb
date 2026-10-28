const menuButton = document.querySelector('.menu-toggle');
const navigation = document.querySelector('.site-nav');

if (menuButton && navigation) {
    menuButton.addEventListener('click', () => {
        const open = menuButton.getAttribute('aria-expanded') !== 'true';
        menuButton.setAttribute('aria-expanded', String(open));
        menuButton.setAttribute('aria-label', open ? 'Close navigation' : 'Open navigation');
        navigation.classList.toggle('is-open', open);
    });

    navigation.addEventListener('click', (event) => {
        if (event.target instanceof Element && event.target.closest('a')) {
            menuButton.setAttribute('aria-expanded', 'false');
            menuButton.setAttribute('aria-label', 'Open navigation');
            navigation.classList.remove('is-open');
        }
    });
}

const filterButtons = document.querySelectorAll('[data-project-filter]');
const projectCards = document.querySelectorAll('[data-project-card]');

filterButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const category = button.dataset.projectFilter;

        filterButtons.forEach((filter) => {
            const active = filter === button;
            filter.classList.toggle('is-active', active);
            filter.setAttribute('aria-pressed', String(active));
        });

        projectCards.forEach((card) => {
            card.hidden = category !== 'all' && card.dataset.category !== category;
        });
    });
});

const coverImageInput = document.querySelector('[data-cover-image-input]');
const coverImagePreview = document.querySelector('[data-cover-image-preview]');
let coverPreviewObjectUrl;

if (coverImageInput && coverImagePreview) {
    coverImageInput.addEventListener('change', () => {
        const file = coverImageInput.files?.[0];

        if (!file) return;

        if (coverPreviewObjectUrl) URL.revokeObjectURL(coverPreviewObjectUrl);
        coverPreviewObjectUrl = URL.createObjectURL(file);
        coverImagePreview.src = coverPreviewObjectUrl;
        coverImagePreview.closest('.admin-cover-preview').hidden = false;
    });
}

