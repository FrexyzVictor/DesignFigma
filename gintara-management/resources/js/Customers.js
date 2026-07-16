import '../css/customers.css';

/* ==========================================================================
   Icon set — minimal stroke-based SVGs (no emoji), colored via currentColor
   ========================================================================== */
const ICONS = {
    eye: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>',
    edit: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.83 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>',
    trash: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M8.5 6V4a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v2"/></svg>',
    folder: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>',
    alert: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>',
};

/* ==========================================================================
   Toast helper
   ========================================================================== */
function ensureToastStack() {
    let stack = document.querySelector('.toast-stack');
    if (!stack) {
        stack = document.createElement('div');
        stack.className = 'toast-stack';
        document.body.appendChild(stack);
    }
    return stack;
}

function showToast(message, type = 'info') {
    const stack = ensureToastStack();
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerHTML = `<span class="dot"></span><span>${message}</span>`;
    stack.appendChild(toast);

    setTimeout(() => {
        toast.classList.add('out');
        toast.addEventListener('animationend', () => toast.remove(), { once: true });
    }, 2800);
}

/* ==========================================================================
   Ripple micro-interaction — attaches to any .btn-primary / .btn-small / .btn-icon
   ========================================================================== */
function attachRipple(root = document) {
    root.addEventListener('click', (e) => {
        const btn = e.target.closest('.btn-primary, .btn-small, .btn-icon');
        if (!btn) return;

        const rect = btn.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const ripple = document.createElement('span');

        ripple.className = 'ripple';
        ripple.style.width = ripple.style.height = `${size}px`;
        ripple.style.left = `${e.clientX - rect.left - size / 2}px`;
        ripple.style.top = `${e.clientY - rect.top - size / 2}px`;

        const prevPosition = getComputedStyle(btn).position;
        if (prevPosition === 'static') btn.style.position = 'relative';

        btn.appendChild(ripple);
        ripple.addEventListener('animationend', () => ripple.remove());
    });
}

/* ==========================================================================
   Data layer
   ========================================================================== */
async function fetchCustomers() {
    const response = await fetch('/api/customers');
    if (!response.ok) throw new Error(`HTTP ${response.status}`);
    const data = await response.json();
    return Array.isArray(data) ? data : (data.data ?? []);
}

/* ==========================================================================
   Rendering
   ========================================================================== */
function escapeHtml(value) {
    return String(value ?? '-').replace(/[&<>"']/g, (c) => ({
        '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;',
    }[c]));
}

function renderCustomers(customers) {
    const tbody = document.getElementById('customers-body');

    if (!customers.length) {
        tbody.innerHTML = `
            <tr>
                <td colspan="8" class="empty-state">
                    <span class="icon-box">${ICONS.folder}</span>
                    Tidak ada data pelanggan
                </td>
            </tr>`;
        return;
    }

    tbody.innerHTML = customers.map((customer, index) => {
        const status = (customer.status ?? '').toString().toLowerCase();
        return `
            <tr>
                <td>${index + 1}</td>
                <td><strong>${escapeHtml(customer.nama)}</strong></td>
                <td>${escapeHtml(customer.telepon)}</td>
                <td>${escapeHtml(customer.alamat)}</td>
                <td><code>${escapeHtml(customer.pppoe_username)}</code></td>
                <td><span class="status ${status}">${escapeHtml(customer.status).toUpperCase()}</span></td>
                <td><small>${escapeHtml(customer.sync_status)}</small></td>
                <td>
                    <div class="actions">
                        <button class="btn-icon btn-view" data-tip="Lihat" data-id="${customer.id}" data-action="view">${ICONS.eye}</button>
                        <button class="btn-icon btn-edit" data-tip="Edit" data-id="${customer.id}" data-action="edit">${ICONS.edit}</button>
                        <button class="btn-icon btn-delete" data-tip="Hapus" data-id="${customer.id}" data-action="delete">${ICONS.trash}</button>
                    </div>
                </td>
            </tr>`;
    }).join('');
}

function renderStats(customers) {
    const total = customers.length;
    const active = customers.filter((c) => c.status === 'aktif').length;
    const suspend = customers.filter((c) => c.status === 'suspend').length;
    const stop = customers.filter((c) => c.status === 'berhenti').length;

    document.getElementById('total-customers').textContent = total;
    document.getElementById('active-customers').textContent = active;
    document.getElementById('suspend-customers').textContent = suspend;
    document.getElementById('stop-customers').textContent = stop;
}

function renderError() {
    const tbody = document.getElementById('customers-body');
    tbody.innerHTML = `
        <tr>
            <td colspan="8" class="empty-state is-error">
                <span class="icon-box">${ICONS.alert}</span>
                Gagal memuat data pelanggan
            </td>
        </tr>`;
}

/* ==========================================================================
   Row action handlers
   ========================================================================== */
function handleRowAction(e) {
    const btn = e.target.closest('[data-action]');
    if (!btn) return;

    const id = btn.dataset.id;
    const action = btn.dataset.action;

    if (action === 'view') {
        showToast(`Menampilkan detail pelanggan #${id}`, 'info');
    } else if (action === 'edit') {
        showToast(`Membuka form edit pelanggan #${id}`, 'info');
    } else if (action === 'delete') {
        if (confirm('Yakin ingin menghapus pelanggan ini?')) {
            showToast(`Pelanggan #${id} berhasil dihapus`, 'success');
        }
    }
}

/* ==========================================================================
   Boot
   ========================================================================== */
async function loadCustomers() {
    try {
        const customers = await fetchCustomers();
        renderCustomers(customers);
        renderStats(customers);
    } catch (err) {
        console.error('Gagal memuat pelanggan:', err);
        renderError();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    attachRipple(document);

    const tbody = document.getElementById('customers-body');
    tbody?.addEventListener('click', handleRowAction);

    document.getElementById('add-customer-btn')?.addEventListener('click', (e) => {
        e.preventDefault();
        showToast('Form tambah pelanggan segera hadir', 'warn');
    });

    loadCustomers();
    setInterval(loadCustomers, 10000);
});