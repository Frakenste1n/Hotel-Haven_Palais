(() => {
    const qs = (sel, root = document) => root.querySelector(sel);
    const qsa = (sel, root = document) => [...root.querySelectorAll(sel)];

    const toastRoot = () => qs('#admin-toast-root');

    function showToast(message, type = 'success') {
        const root = toastRoot();
        if (!root || !message) return;

        const colors = {
            success: 'bg-primary-container text-on-primary border-secondary',
            error: 'bg-error-container text-on-error-container border-error',
            info: 'bg-surface-container-highest text-on-surface border-outline-variant',
        };

        const icons = {
            success: 'check_circle',
            error: 'error',
            info: 'info',
        };

        const el = document.createElement('div');
        el.className = `toast-enter pointer-events-auto min-w-[280px] max-w-sm rounded-xl border px-4 py-3 shadow-lg ${colors[type] || colors.info}`;
        el.innerHTML = `
            <div class="flex items-start gap-3">
                <span class="material-symbols-outlined text-[20px]">${icons[type] || icons.info}</span>
                <div class="flex-1 text-sm leading-relaxed">${message}</div>
                <button type="button" class="opacity-70 hover:opacity-100" aria-label="Tutup">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
        `;

        const close = () => {
            el.classList.remove('toast-enter');
            el.classList.add('toast-leave');
            setTimeout(() => el.remove(), 220);
        };

        el.querySelector('button')?.addEventListener('click', close);
        root.appendChild(el);
        setTimeout(close, 4200);
    }

    window.AdminUI = {
        toast: showToast,
        confirm({
            title = 'Konfirmasi',
            message = 'Apakah Anda yakin?',
            confirmText = 'Ya, lanjutkan',
            cancelText = 'Batal',
            danger = false,
        } = {}) {
            return new Promise((resolve) => {
                const modal = qs('#admin-confirm-modal');
                if (!modal) {
                    resolve(window.confirm(message));
                    return;
                }

                qs('#admin-confirm-title', modal).textContent = title;
                qs('#admin-confirm-message', modal).textContent = message;
                const confirmBtn = qs('#admin-confirm-accept', modal);
                const cancelBtn = qs('#admin-confirm-cancel', modal);

                confirmBtn.textContent = confirmText;
                cancelBtn.textContent = cancelText;
                confirmBtn.className = danger
                    ? 'inline-flex items-center justify-center rounded-lg bg-error px-4 py-2.5 text-sm font-semibold text-on-error hover:opacity-90'
                    : 'inline-flex items-center justify-center rounded-lg bg-primary-container px-4 py-2.5 text-sm font-semibold text-on-primary hover:bg-primary';

                const cleanup = (result) => {
                    modal.classList.add('hidden');
                    confirmBtn.onclick = null;
                    cancelBtn.onclick = null;
                    resolve(result);
                };

                confirmBtn.onclick = () => cleanup(true);
                cancelBtn.onclick = () => cleanup(false);
                modal.classList.remove('hidden');
            });
        },
    };

    function initSidebar() {
        const sidebar = qs('#admin-sidebar');
        const overlay = qs('#admin-sidebar-overlay');
        const openBtn = qs('#admin-sidebar-open');
        const closeBtn = qs('#admin-sidebar-close');

        const open = () => {
            sidebar?.classList.remove('-translate-x-full');
            overlay?.classList.remove('hidden');
        };
        const close = () => {
            sidebar?.classList.add('-translate-x-full');
            overlay?.classList.add('hidden');
        };

        openBtn?.addEventListener('click', open);
        closeBtn?.addEventListener('click', close);
        overlay?.addEventListener('click', close);

        qsa('[data-submenu-toggle]').forEach((btn) => {
            btn.addEventListener('click', () => {
                const key = btn.getAttribute('data-submenu-toggle');
                const panel = qs(`[data-submenu-panel="${key}"]`);
                const icon = btn.querySelector('[data-chevron]');
                if (!panel) return;
                panel.classList.toggle('hidden');
                icon?.classList.toggle('rotate-180');
            });
        });
    }

    function initAvatarMenu() {
        const trigger = qs('#admin-avatar-trigger');
        const menu = qs('#admin-avatar-menu');
        if (!trigger || !menu) return;

        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            menu.classList.toggle('hidden');
        });

        document.addEventListener('click', () => menu.classList.add('hidden'));
    }

    function initConfirmForms() {
        qsa('form[data-confirm]').forEach((form) => {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const ok = await window.AdminUI.confirm({
                    title: form.dataset.confirmTitle || 'Hapus data?',
                    message: form.dataset.confirm || 'Tindakan ini tidak dapat dibatalkan.',
                    confirmText: form.dataset.confirmText || 'Hapus',
                    cancelText: 'Batal',
                    danger: form.dataset.confirmDanger !== 'false',
                });
                if (ok) {
                    const submitter = e.submitter;
                    if (submitter) submitter.classList.add('btn-loading');
                    form.submit();
                }
            });
        });
    }

    function initLogout() {
        const form = qs('#admin-logout-form');
        const buttons = qsa('[data-logout]');
        buttons.forEach((btn) => {
            btn.addEventListener('click', async (e) => {
                e.preventDefault();
                const ok = await window.AdminUI.confirm({
                    title: 'Keluar dari panel?',
                    message: 'Anda akan keluar dari sesi admin Haven Palais.',
                    confirmText: 'Logout',
                    cancelText: 'Batal',
                    danger: true,
                });
                if (ok) form?.submit();
            });
        });
    }

    function initSubmitLoading() {
        qsa('form[data-loading]').forEach((form) => {
            form.addEventListener('submit', () => {
                const btn = form.querySelector('[type="submit"]');
                btn?.classList.add('btn-loading');
                btn?.setAttribute('disabled', 'disabled');
            });
        });
    }

    function bootFlashToasts() {
        const success = qs('meta[name="flash-success"]')?.content;
        const error = qs('meta[name="flash-error"]')?.content;
        if (success) showToast(success, 'success');
        if (error) showToast(error, 'error');
    }

    function openModal(modal) {
        if (!modal) return;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeModal(modal) {
        if (!modal) return;
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        if (!document.querySelector('.fi-modal.flex, [id$="-modal"].flex')) {
            document.body.classList.remove('overflow-hidden');
        }
    }

    function fieldKey(name) {
        return name.replace(/\[\]$/, '');
    }

    function fillForm(form, record) {
        const data = record || {};
        qsa('input, select, textarea', form).forEach((field) => {
            if (!field.name || field.name === '_token' || field.name === '_method' || field.name === '_fi_modal') return;
            if (field.type === 'file') {
                field.value = '';
                return;
            }
            const key = fieldKey(field.name);
            const value = data[key];

            if (field.type === 'checkbox') {
                if (field.name.endsWith('[]')) {
                    const list = Array.isArray(value) ? value.map(String) : [];
                    field.checked = list.includes(String(field.value));
                } else {
                    field.checked = value === true || value === 1 || value === '1' || value === 'on';
                }
                return;
            }

            if (field.multiple) {
                const list = Array.isArray(value) ? value.map(String) : [];
                [...field.options].forEach((option) => {
                    option.selected = list.includes(String(option.value));
                });
                return;
            }

            if (value === undefined || value === null) {
                if (field.type !== 'checkbox') field.value = field.dataset.default ?? '';
                return;
            }

            field.value = value;
        });

        qsa('[data-bind]', form.closest('.fi-modal') || form).forEach((node) => {
            const bound = data[node.dataset.bind];
            node.textContent = bound === undefined || bound === null || bound === '' ? '-' : bound;
        });

        form.dispatchEvent(new CustomEvent('fi:filled', { detail: data }));
    }

    function setMethod(form, method) {
        let input = form.querySelector('input[name="_method"]');
        if (!method || method === 'POST') {
            input?.remove();
            return;
        }
        if (!input) {
            input = document.createElement('input');
            input.type = 'hidden';
            input.name = '_method';
            form.appendChild(input);
        }
        input.value = method;
    }

    function prepareModalForm(form, { action, title, record, editing }) {
        if (!form.dataset.storeAction) form.dataset.storeAction = form.getAttribute('action');
        form.setAttribute('action', action || form.dataset.storeAction);
        setMethod(form, editing ? 'PUT' : null);

        qsa('[data-required-on-create]', form).forEach((field) => {
            field.required = !editing;
        });

        const heading = form.closest('[id$="-modal"], .fi-modal')?.querySelector('[data-fi-modal-title]');
        if (heading && !heading.dataset.createTitle) {
            heading.dataset.createTitle = heading.textContent.trim();
        }
        if (heading) {
            heading.textContent = editing
                ? (title || 'Edit data')
                : (title || heading.dataset.createTitle || 'Tambah data');
        }

        if (editing) {
            fillForm(form, record);
        } else {
            form.reset();
            qsa('input[type="checkbox"][data-default-checked]', form).forEach((field) => {
                field.checked = true;
            });
            form.dispatchEvent(new CustomEvent('fi:reset'));
        }

        let marker = form.querySelector('input[name="_fi_modal"]');
        if (!marker) {
            marker = document.createElement('input');
            marker.type = 'hidden';
            marker.name = '_fi_modal';
            form.appendChild(marker);
        }
        marker.value = form.closest('[id]')?.id || '';
    }

    function initFi() {
        qsa('[id$="-modal"], .fi-modal').forEach((modal) => {
            modal.addEventListener('click', (event) => {
                if (event.target === modal) closeModal(modal);
            });
        });

        qsa('[data-fi-close]').forEach((button) => {
            button.addEventListener('click', () => closeModal(button.closest('[id$="-modal"], .fi-modal')));
        });

        document.addEventListener('keydown', (event) => {
            if (event.key !== 'Escape') return;
            qsa('[id$="-modal"].flex, .fi-modal.flex').forEach(closeModal);
        });

        qsa('[data-fi-create]').forEach((button) => {
            button.addEventListener('click', () => {
                const modal = qs('#' + button.dataset.modal);
                const form = modal?.querySelector('form');
                if (!form) return;
                prepareModalForm(form, {
                    title: button.dataset.title || '',
                    editing: false,
                });
                openModal(modal);
            });
        });

        qsa('[data-fi-edit]').forEach((button) => {
            button.addEventListener('click', () => {
                const modal = qs('#' + button.dataset.modal);
                const form = modal?.querySelector('form');
                if (!form) return;
                let record = {};
                try {
                    record = JSON.parse(button.dataset.record || '{}');
                } catch (error) {
                    record = {};
                }
                prepareModalForm(form, {
                    action: button.dataset.action,
                    title: button.dataset.title || 'Edit data',
                    record,
                    editing: true,
                });
                openModal(modal);
            });
        });

        qsa('[data-fi-detail]').forEach((button) => {
            button.addEventListener('click', () => {
                const modal = qs('#fi-detail-modal');
                if (!modal) return;
                let payload = {};
                try {
                    payload = JSON.parse(button.dataset.fiDetail || '{}');
                } catch (error) {
                    payload = {};
                }
                qs('#fi-detail-title', modal).textContent = payload.title || 'Detail';
                const body = qs('#fi-detail-body', modal);
                body.innerHTML = '';
                (payload.rows || []).forEach((row) => {
                    const block = document.createElement('div');
                    block.className = 'space-y-1';
                    const label = document.createElement('p');
                    label.className = 'text-xs font-semibold uppercase tracking-wide text-on-surface-variant';
                    label.textContent = row.label || '';
                    const value = document.createElement(row.pre ? 'pre' : 'div');
                    value.className = 'rounded-lg border border-outline-variant/50 bg-surface-container-low px-3 py-2 text-sm text-on-surface whitespace-pre-wrap break-words';
                    value.textContent = row.value ?? '-';
                    block.append(label, value);
                    body.appendChild(block);
                });
                openModal(modal);
            });
        });

        qsa('form').forEach((form) => {
            form.addEventListener('submit', () => {
                let actionField = form.querySelector('input[name="_fi_action"]');
                if (!actionField) {
                    actionField = document.createElement('input');
                    actionField.type = 'hidden';
                    actionField.name = '_fi_action';
                    form.appendChild(actionField);
                }
                actionField.value = form.getAttribute('action');

                qsa('input[type="checkbox"]', form).forEach((field) => {
                    if (field.checked || field.name.endsWith('[]') || !field.name) return;
                    const hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = field.name;
                    hidden.value = '0';
                    form.appendChild(hidden);
                });
            });
        });

        qsa('[data-fi-file]').forEach((input) => {
            input.addEventListener('change', () => {
                const wrap = input.closest('.fi-upload');
                const preview = wrap?.querySelector('[data-fi-preview]');
                const file = input.files?.[0];
                if (!preview) return;
                if (!file || !file.type.startsWith('image/')) {
                    preview.classList.add('hidden');
                    preview.removeAttribute('src');
                    return;
                }
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
            });
        });

        qsa('[data-table-filter]').forEach((input) => {
            const table = qs(input.dataset.tableFilter);
            input.addEventListener('input', () => {
                const term = input.value.trim().toLowerCase();
                qsa('tbody tr', table).forEach((row) => {
                    if (row.querySelector('td[colspan]')) return;
                    row.classList.toggle('hidden', term !== '' && !row.textContent.toLowerCase().includes(term));
                });
            });
        });

        const openId = qs('meta[name="fi-open-modal"]')?.content;
        const oldNode = qs('#fi-old-input');
        if (openId && oldNode) {
            const modal = qs('#' + openId);
            const form = modal?.querySelector('form');
            if (form) {
                let oldValues = {};
                try {
                    oldValues = JSON.parse(oldNode.textContent || '{}');
                } catch (error) {
                    oldValues = {};
                }
                prepareModalForm(form, {
                    action: oldValues._fi_action || form.dataset.storeAction,
                    title: form.closest('[id]')?.querySelector('[data-fi-modal-title]')?.textContent,
                    record: oldValues,
                    editing: oldValues._method === 'PUT',
                });
                openModal(modal);
            }
        }
    }

    window.AdminUI.openModal = openModal;
    window.AdminUI.closeModal = closeModal;

    document.addEventListener('DOMContentLoaded', () => {
        initSidebar();
        initAvatarMenu();
        initConfirmForms();
        initLogout();
        initSubmitLoading();
        bootFlashToasts();
        initFi();
    });
})();
