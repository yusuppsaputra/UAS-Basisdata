<?php

namespace App\Filament\Admin\Resources\DokterResource\Pages;

use App\Filament\Admin\Resources\DokterResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDokter extends CreateRecord
{
    protected static string $resource = DokterResource::class;

    protected function getRedirectUrl(): string
    {
        session()->flash('success', 'Dokter berhasil dibuat.');

        return $this->getResource()::getUrl('index');
    }

    protected function getScripts(): array
    {
        return [
            <<<'JS'
document.addEventListener('DOMContentLoaded', function () {
    // Manage a counter of active uploads and disable all submit buttons while >0
    window.__filament_active_uploads = 0;

    const submitButtons = Array.from(document.querySelectorAll('form button[type="submit"]'));
    const setButtonsDisabled = (state) => {
        submitButtons.forEach(btn => {
            btn.disabled = state;
            btn.classList.toggle('opacity-60', state);
            btn.classList.toggle('cursor-not-allowed', state);
        });
    };

    // Create a small progress UI next to the Upload Gambar input
    const uploadLabel = [...document.querySelectorAll('label')].find(l => l.textContent && l.textContent.trim().startsWith('Upload Gambar'));
    let progressEl = null;
    if (uploadLabel) {
        progressEl = document.createElement('div');
        progressEl.style.marginTop = '0.5rem';
        progressEl.style.fontSize = '0.875rem';
        progressEl.style.color = '#6b7280';
        progressEl.textContent = '';
        uploadLabel.parentElement.appendChild(progressEl);
    }

    const onUploadStart = () => {
        window.__filament_active_uploads += 1;
        setButtonsDisabled(true);
        if (progressEl) progressEl.textContent = 'Upload sedang berlangsung...';
    };

    const onUploadProgress = (e) => {
        const pct = e && e.detail && e.detail.progress ? e.detail.progress : null;
        if (progressEl && pct !== null) progressEl.textContent = `Upload: ${pct}%`;
    };

    const onUploadFinishOrError = () => {
        // delay slightly to allow Filament to update its state
        setTimeout(() => {
            window.__filament_active_uploads = Math.max(0, window.__filament_active_uploads - 1);
            if (window.__filament_active_uploads === 0) {
                setButtonsDisabled(false);
                if (progressEl) progressEl.textContent = '';
            }
        }, 250);
    };

    window.addEventListener('livewire-upload-start', onUploadStart);
    window.addEventListener('livewire-upload-progress', onUploadProgress);
    window.addEventListener('livewire-upload-finish', onUploadFinishOrError);
    window.addEventListener('livewire-upload-error', onUploadFinishOrError);

    // Intercept form submits to prevent accidental submit during upload
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', (ev) => {
            if (window.__filament_active_uploads > 0) {
                ev.preventDefault();
                ev.stopImmediatePropagation();
                // show a small toast using Filament's event if available
                if (window.Filament && window.Filament.emit) {
                    window.Filament.emit('notifications.notify', {
                        type: 'danger',
                        title: 'Upload sedang berlangsung',
                        description: 'Tunggu sampai upload selesai sebelum klik Create.'
                    });
                } else {
                    alert('Tunggu sampai upload selesai sebelum klik Create.');
                }
                return false;
            }
        }, { capture: true, passive: false });
    });

});
JS
        ];
    }
}
