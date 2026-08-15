// import './bootstrap'; <-- Komentari atau hapus baris ini

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Give every server-backed form an immediate, accessible loading state.
document.addEventListener('submit', (event) => {
    const form = event.target;
    const submitButton = form.querySelector('button[type="submit"], input[type="submit"]');
    if (!submitButton || form.dataset.loading === 'true') return;

    form.dataset.loading = 'true';
    submitButton.disabled = true;
    submitButton.dataset.originalLabel = submitButton.textContent || submitButton.value;
    if (submitButton.tagName === 'INPUT') submitButton.value = 'Memproses...';
    else submitButton.innerHTML = '<span class="inline-flex items-center gap-2"><span class="loading-spinner" aria-hidden="true"></span>Memproses...</span>';
    submitButton.setAttribute('aria-busy', 'true');
});

