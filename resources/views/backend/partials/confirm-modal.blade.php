<div id="admin-confirm-modal" class="fixed inset-0 z-[90] hidden">
    <div class="admin-overlay absolute inset-0 bg-primary/50"></div>
    <div class="relative flex min-h-full items-center justify-center p-4">
        <div class="w-full max-w-md rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-card">
            <div class="mb-4 flex items-start gap-3">
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-error-container text-error">
                    <span class="material-symbols-outlined">warning</span>
                </span>
                <div>
                    <h3 id="admin-confirm-title" class="font-display text-xl text-primary">Konfirmasi</h3>
                    <p id="admin-confirm-message" class="mt-1 text-sm text-on-surface-variant">Apakah Anda yakin?</p>
                </div>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" id="admin-confirm-cancel"
                    class="rounded-lg border border-outline-variant px-4 py-2.5 text-sm font-semibold text-on-surface-variant hover:bg-surface-container-low">
                    Batal
                </button>
                <button type="button" id="admin-confirm-accept"
                    class="rounded-lg bg-error px-4 py-2.5 text-sm font-semibold text-on-error">
                    Ya, lanjutkan
                </button>
            </div>
        </div>
    </div>
</div>
