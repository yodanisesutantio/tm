<div class="space-y-6 font-sans">
    @if(session('success'))
        <div id="alert-success" class="flex items-center justify-between rounded-xl border border-emerald-200 bg-emerald-50/80 p-4 text-sm text-emerald-800 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-400">
            <div class="flex items-center gap-2">
                <svg class="h-5 w-5 flex-shrink-0 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" onclick="document.getElementById('alert-success').remove()" class="text-emerald-600 hover:text-emerald-800 dark:text-emerald-400 dark:hover:text-emerald-200">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <div id="view-list" class="space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200 dark:border-slate-800">
            <div>
                <h2 class="text-xl font-bold tracking-tight text-slate-900 dark:text-slate-100">Daftar Transaksi Penjualan</h2>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Kelola dan lihat histori riwayat transaksi invoice.</p>
            </div>
            <button type="button" id="btn-show-form" class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-600 px-3 py-2 text-xs font-semibold text-white shadow-sm hover:bg-emerald-500 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Transaksi Baru
            </button>
        </div>

        <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900 shadow-sm">
            <table class="w-full text-left text-xs text-slate-700 dark:text-slate-300">
                <thead class="bg-slate-50 text-[11px] font-semibold uppercase tracking-wider text-slate-500 dark:bg-slate-800/50 dark:text-slate-400">
                    <tr>
                        <th class="p-3">No. Invoice</th>
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">Customer</th>
                        <th class="p-3 text-right">Total Transaksi</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/40">
                        <td class="p-3 font-semibold text-slate-900 dark:text-slate-100">INV/20260330/801</td>
                        <td class="p-3">30 Mar 2026</td>
                        <td class="p-3">
                            <div class="font-medium text-slate-900 dark:text-slate-100">PT Kopi Nusantara</div>
                            <div class="text-[10px] text-slate-400">CUST-001</div>
                        </td>
                        <td class="p-3 text-right font-bold text-emerald-600 dark:text-emerald-400">Rp 1.425.000</td>
                        <td class="p-3 text-center">
                            <button type="button" class="text-slate-500 hover:text-emerald-600 font-medium">Detail</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="view-form" class="space-y-6 hidden">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200 dark:border-slate-800">
            <div>
                <h2 class="text-xl font-bold tracking-tight text-slate-900 dark:text-slate-100">Transaksi Penjualan Baru</h2>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Buat invoice baru dengan susunan diskon fleksibel.</p>
            </div>
            <button type="button" id="btn-show-list" class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 shadow-sm hover:bg-slate-50 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-300 dark:hover:bg-slate-800">
                &larr; Kembali ke Daftar Transaksi
            </button>
        </div>

        <form id="transaction-form" method="POST" action="#" class="space-y-6">
            @csrf

            <div class="rounded-xl border border-slate-200 bg-slate-50/50 p-5 dark:border-slate-800 dark:bg-slate-900/50 space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-200 dark:border-slate-800 pb-3">
                    <div class="p-1.5 rounded-lg bg-emerald-100 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-slate-100">
                        Header Informasi Transaksi
                    </h3>
                </div>
            
                @php
                    $customerOptions = [
                        [
                            'value' => 'CUST-001',
                            'label' => 'CUST-001 - PT Kopi Nusantara',
                            'data' => [
                                'name' => 'PT Kopi Nusantara',
                                'address' => 'Jl. Jend. Sudirman No. 45, Jakarta Selatan'
                            ]
                        ],
                        [
                            'value' => 'CUST-002',
                            'label' => 'CUST-002 - Budi Santoso',
                            'data' => [
                                'name' => 'Budi Santoso',
                                'address' => 'Jl. Dago No. 112, Bandung'
                            ]
                        ],
                        [
                            'value' => 'CUST-003',
                            'label' => 'CUST-003 - CV Cahaya Abadi',
                            'data' => [
                                'name' => 'CV Cahaya Abadi',
                                'address' => 'Jl. Pemuda No. 88, Semarang'
                            ]
                        ]
                    ];
                @endphp
            
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <x-input label="No. Invoice" name="no_inv" id="no_inv_input" readonly required />
                    <x-input label="Tanggal Invoice" name="inv_date" type="date" value="{{ date('Y-m-d') }}" required />
            
                    <x-select 
                        label="Pilih Customer" 
                        name="cust_code" 
                        id="cust_code_select" 
                        placeholder="-- Pilih Customer --"
                        :options="$customerOptions" 
                        required 
                    />
                </div>
            
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                    <x-input label="Nama Customer" id="cust_name_input" name="cust_name" placeholder="Otomatis terisi..." readonly required />
                    <x-input label="Alamat Customer" id="cust_address_input" name="cust_address" placeholder="Otomatis terisi..." readonly required />
                </div>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-5 dark:border-slate-800 dark:bg-slate-900 space-y-4 shadow-sm">
                <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-3">
                    <div class="flex items-center gap-2">
                        <div class="p-1.5 rounded-lg bg-emerald-100 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-400">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-6 0a1.5 1.5 0 003 0m-3 0a1.5 1.5 0 013 0m6 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.25A2.25 2.25 0 0021 18V6a2.25 2.25 0 00-2.25-2.25H3.75A2.25 2.25 0 001.5 6v12a2.25 2.25 0 002.25 2.25H5.25" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-slate-100">
                            Detail Produk Transaksi
                        </h3>
                    </div>

                    <button type="button" id="btn-add-item" class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-emerald-500 transition-colors">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Produk
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-slate-700 dark:text-slate-300">
                        <thead class="bg-slate-50 text-[11px] font-semibold uppercase tracking-wider text-slate-500 dark:bg-slate-800/50 dark:text-slate-400">
                            <tr>
                                <th class="p-2.5 min-w-[200px]">Produk</th>
                                <th class="p-2.5 w-20 text-center">Stok</th>
                                <th class="p-2.5 w-24">Qty</th>
                                <th class="p-2.5 w-32">Harga (Rp)</th>
                                <th class="p-2.5 w-48 text-center">Kelola Diskon</th>
                                <th class="p-2.5 w-32">Harga Net</th>
                                <th class="p-2.5 w-36">Jumlah (Rp)</th>
                                <th class="p-2.5 w-12 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="detail-items-body" class="divide-y divide-slate-200 dark:divide-slate-800">
                        </tbody>
                    </table>
                </div>

                <div id="empty-table-notice" class="py-8 text-center text-xs text-slate-400 dark:text-slate-500">
                    Belum ada produk ditambahkan. Klik tombol <strong>+ Tambah Produk</strong> di atas.
                </div>

                <div class="flex flex-col sm:flex-row items-end justify-end pt-4 border-t border-slate-200 dark:border-slate-800">
                    <div class="w-full sm:w-80 space-y-2">
                        <div class="flex justify-between items-center text-xs text-slate-600 dark:text-slate-400">
                            <span>Total Item:</span>
                            <span id="summary-total-items" class="font-semibold text-slate-900 dark:text-slate-100">0</span>
                        </div>
                        <div class="flex justify-between items-center text-sm font-bold text-slate-900 dark:text-slate-100 pt-2 border-t border-slate-200 dark:border-slate-800">
                            <span>Grand Total:</span>
                            <span id="summary-grand-total" class="text-emerald-600 dark:text-emerald-400 text-base">Rp 0</span>
                        </div>
                        <input type="hidden" name="total" id="header_total_input" value="0" />
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <button type="button" id="btn-cancel-form" class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400 dark:hover:bg-slate-800">
                    Batal
                </button>
                <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-600 px-5 py-2.5 text-xs font-semibold text-white shadow-sm hover:bg-emerald-500">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    Simpan & Buat Transaksi
                </button>
            </div>
        </form>
    </div>
</div>

<div id="discount-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm hidden">
    <div class="w-full max-w-md rounded-xl border border-slate-200 bg-white p-5 shadow-2xl dark:border-slate-800 dark:bg-slate-900 space-y-4">
        <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-3">
            <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">Atur Diskon Bertingkat</h3>
            <button type="button" id="btn-close-modal" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">&times;</button>
        </div>

        <p class="text-xs text-slate-500 dark:text-slate-400">
            Tambahkan potongan bertingkat secara berurutan (% atau Rp).
        </p>

        <div id="modal-discounts-container" class="space-y-2.5 max-h-60 overflow-y-auto pr-1">
        </div>

        <button type="button" id="btn-add-discount-tier" class="w-full py-2 border-2 border-dashed border-slate-200 dark:border-slate-800 hover:border-emerald-500 rounded-lg text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-emerald-600 transition-colors">
            + Tambah Skema Diskon
        </button>

        <div class="flex justify-end gap-2 pt-3 border-t border-slate-200 dark:border-slate-800">
            <button type="button" id="btn-apply-discounts" class="w-full rounded-lg bg-emerald-600 py-2 text-xs font-semibold text-white hover:bg-emerald-500">
                Terapkan Diskon
            </button>
        </div>
    </div>
</div>

<script>
    const MASTER_PRODUCTS = [
        { code: 'PRD-001', name: 'Kopi Arabika Specialty 250g', price: 85000, stock: 45 },
        { code: 'PRD-002', name: 'Susu Oat Milk 1L', price: 42500, stock: 5 },
        { code: 'PRD-003', name: 'Syrup Vanilla 750ml', price: 120000, stock: 12 },
        { code: 'PRD-004', name: 'Paper Cup 12oz Pack', price: 35000, stock: 100 }
    ];
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const viewList = document.getElementById('view-list');
    const viewForm = document.getElementById('view-form');
    const btnShowForm = document.getElementById('btn-show-form');
    const btnShowList = document.getElementById('btn-show-list');
    const btnCancelForm = document.getElementById('btn-cancel-form');
    const btnAddItem = document.getElementById('btn-add-item');

    if (btnShowForm) {
        btnShowForm.addEventListener('click', () => {
            const targetNoInv = getRealInputElement('no_inv_input', 'no_inv');
            
            if (targetNoInv) {
                targetNoInv.value = 'INV/' + new Date().toISOString().slice(0,10).replace(/-/g,'') + '/' + Math.floor(100 + Math.random() * 900);
            }

            if (viewList && viewForm) {
                viewList.classList.add('hidden');
                viewForm.classList.remove('hidden');
            }
        });
    }

    function showList() {
        if (viewForm && viewList) {
            viewForm.classList.add('hidden');
            viewList.classList.remove('hidden');
        }
    }

    if (btnShowList) btnShowList.addEventListener('click', showList);
    if (btnCancelForm) btnCancelForm.addEventListener('click', showList);

    function handleCustomerChange(e) {
        const target = e.target;
        
        if (target && (target.id === 'cust_code_select' || target.name === 'cust_code')) {
            const custNameInput = getRealInputElement('cust_name_input', 'cust_name');
            const custAddressInput = getRealInputElement('cust_address_input', 'cust_address');

            let customerData = null;

            if (e.detail && e.detail.data) {
                customerData = e.detail.data;
            } 
            else if (target.dataset && target.dataset.selectedData) {
                try {
                    customerData = typeof target.dataset.selectedData === 'string' 
                        ? JSON.parse(target.dataset.selectedData) 
                        : target.dataset.selectedData;
                } catch (err) {
                    console.error('Failed to parse customer dataset:', err);
                }
            }

            if (customerData) {
                if (custNameInput) custNameInput.value = customerData.name || '';
                if (custAddressInput) custAddressInput.value = customerData.address || '';
            } else {
                if (custNameInput) custNameInput.value = '';
                if (custAddressInput) custAddressInput.value = '';
            }
        }
    }

    document.addEventListener('change', handleCustomerChange);
    document.addEventListener('select-change', handleCustomerChange);
    document.addEventListener('customer-selected', handleCustomerChange);

    function getRealInputElement(id, name) {
        let el = document.getElementById(id);
        if (el && el.tagName !== 'INPUT') {
            el = el.querySelector('input') || el;
        }
        if (!el || el.tagName !== 'INPUT') {
            el = document.querySelector(`input[name="${name}"]`);
        }
        return el;
    }

    if (btnAddItem) {
        btnAddItem.addEventListener('click', () => {
            if (typeof addRow === 'function') {
                addRow();
            } else {
                console.warn('addRow function is not defined yet.');
            }
        });
    }
});
document.addEventListener('DOMContentLoaded', () => {
    const viewList = document.getElementById('view-list');
    const viewForm = document.getElementById('view-form');
    const btnShowForm = document.getElementById('btn-show-form');
    const btnShowList = document.getElementById('btn-show-list');
    const btnCancelForm = document.getElementById('btn-cancel-form');

    const noInvInput = document.getElementById('no_inv_input');
    const custSelect = document.getElementById('cust_code_select');
    const custNameInput = document.getElementById('cust_name_input');
    const custAddressInput = document.getElementById('cust_address_input');
    const tableBody = document.getElementById('detail-items-body');
    const emptyNotice = document.getElementById('empty-table-notice');
    const btnAddItem = document.getElementById('btn-add-item');
    const summaryGrandTotal = document.getElementById('summary-grand-total');
    const summaryTotalItems = document.getElementById('summary-total-items');
    const headerTotalInput = document.getElementById('header_total_input');

    const modal = document.getElementById('discount-modal');
    const btnCloseModal = document.getElementById('btn-close-modal');
    const btnApplyDiscounts = document.getElementById('btn-apply-discounts');
    const btnAddDiscountTier = document.getElementById('btn-add-discount-tier');
    const modalContainer = document.getElementById('modal-discounts-container');

    let rowCounter = 0;
    let activeRowForDiscount = null;

    if (btnShowForm) {
        btnShowForm.addEventListener('click', () => {
            const targetNoInv = document.getElementById('no_inv_input') || document.querySelector('input[name="no_inv"]');
            
            if (targetNoInv) {
                targetNoInv.value = 'INV/' + new Date().toISOString().slice(0,10).replace(/-/g,'') + '/' + Math.floor(100 + Math.random() * 900);
            }

            if (viewList && viewForm) {
                viewList.classList.add('hidden');
                viewForm.classList.remove('hidden');
            }
        });
    }

    function showList() {
        viewForm.classList.add('hidden');
        viewList.classList.remove('hidden');
    }

    btnShowList.addEventListener('click', showList);
    btnCancelForm.addEventListener('click', showList);

    btnAddItem.addEventListener('click', () => addRow());

    function addRow() {
        rowCounter++;
        const detailId = 'DET-' + Date.now() + '-' + rowCounter;

        const tr = document.createElement('tr');
        tr.className = 'item-row hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition-colors';
        tr.id = `row-${rowCounter}`;

        tr.innerHTML = `
            <td class="p-2">
                <input type="hidden" name="details[${rowCounter}][detail_id]" value="${detailId}" />
                <input type="hidden" name="details[${rowCounter}][product_name]" class="row-product-name" />
                <input type="hidden" name="details[${rowCounter}][discounts_json]" class="row-discounts-json" value="[]" />
                
                <select name="details[${rowCounter}][product_code]" class="row-product-select w-full rounded-md border border-slate-200 bg-white p-1.5 text-xs text-slate-900 focus:border-emerald-500 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100" required>
                    <option value="">-- Pilih Produk --</option>
                    ${MASTER_PRODUCTS.map(p => `
                        <option value="${p.code}" data-name="${p.name}" data-price="${p.price}" data-stock="${p.stock}">
                            ${p.code} - ${p.name}
                        </option>
                    `).join('')}
                </select>
            </td>
            <td class="p-2 text-center font-medium">
                <span class="row-stock-label text-slate-500 dark:text-slate-400">-</span>
            </td>
            <td class="p-2">
                <input type="number" name="details[${rowCounter}][qty]" class="row-qty w-full rounded-md border border-slate-200 bg-white p-1.5 text-xs text-slate-900 focus:border-emerald-500 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100" min="1" value="1" required disabled />
                <span class="row-qty-error text-[10px] text-red-500 hidden font-semibold">Max stok terlampaui!</span>
            </td>
            <td class="p-2">
                <input type="number" name="details[${rowCounter}][price]" class="row-price w-full rounded-md border border-slate-200 bg-white p-1.5 text-xs text-slate-900 focus:border-emerald-500 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100" min="0" value="0" required disabled />
            </td>
            <td class="p-2 text-center">
                <button type="button" class="btn-open-discount border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 hover:bg-emerald-50 dark:hover:bg-emerald-950 px-2.5 py-1.5 rounded-lg text-[11px] font-semibold text-slate-700 dark:text-slate-300 transition-colors inline-flex items-center gap-1">
                    <span class="row-discount-summary text-emerald-600 dark:text-emerald-400 font-bold">0 Diskon</span>
                    <svg class="h-3 w-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                    </svg>
                </button>
            </td>
            <td class="p-2 font-medium">
                <input type="hidden" name="details[${rowCounter}][net_price]" class="row-net-price-input" value="0" />
                <span class="row-net-price-label text-slate-700 dark:text-slate-300">Rp 0</span>
            </td>
            <td class="p-2 font-semibold">
                <input type="hidden" name="details[${rowCounter}][subtotal]" class="row-subtotal-input" value="0" />
                <span class="row-subtotal-label text-emerald-600 dark:text-emerald-400">Rp 0</span>
            </td>
            <td class="p-2 text-center">
                <button type="button" class="btn-remove-row text-slate-400 hover:text-red-500 transition-colors">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </button>
            </td>
        `;

        tableBody.appendChild(tr);
        checkEmptyState();
        attachRowEvents(tr);
    }

    function attachRowEvents(row) {
        const productSelect = row.querySelector('.row-product-select');
        const productNameInput = row.querySelector('.row-product-name');
        const stockLabel = row.querySelector('.row-stock-label');
        const qtyInput = row.querySelector('.row-qty');
        const qtyError = row.querySelector('.row-qty-error');
        const priceInput = row.querySelector('.row-price');
        const btnOpenDiscount = row.querySelector('.btn-open-discount');
        const btnRemove = row.querySelector('.btn-remove-row');

        productSelect.addEventListener('change', () => {
            const opt = productSelect.options[productSelect.selectedIndex];
            if (opt.value) {
                const stock = parseInt(opt.dataset.stock) || 0;
                const price = parseFloat(opt.dataset.price) || 0;

                productNameInput.value = opt.dataset.name;
                stockLabel.textContent = stock;
                priceInput.value = price;
                
                qtyInput.disabled = false;
                priceInput.disabled = false;
                qtyInput.max = stock;
                
                if (stock <= 0) {
                    qtyInput.value = 0;
                    qtyInput.disabled = true;
                    stockLabel.className = 'row-stock-label text-red-500 font-bold';
                } else {
                    qtyInput.value = 1;
                    stockLabel.className = 'row-stock-label text-slate-700 dark:text-slate-300';
                }

                validateAndCalculateRow(row);
            } else {
                stockLabel.textContent = '-';
                qtyInput.value = 1;
                priceInput.value = 0;
                qtyInput.disabled = true;
                priceInput.disabled = true;
                validateAndCalculateRow(row);
            }
        });

        qtyInput.addEventListener('input', () => {
            const maxStock = parseInt(qtyInput.max) || 0;
            let currentQty = parseInt(qtyInput.value) || 0;

            if (currentQty > maxStock) {
                qtyInput.value = maxStock;
                qtyError.classList.remove('hidden');
                setTimeout(() => qtyError.classList.add('hidden'), 2500);
            } else {
                qtyError.classList.add('hidden');
            }

            validateAndCalculateRow(row);
        });

        priceInput.addEventListener('input', () => validateAndCalculateRow(row));

        btnOpenDiscount.addEventListener('click', () => openDiscountModal(row));

        btnRemove.addEventListener('click', () => {
            row.remove();
            checkEmptyState();
            calculateGrandTotal();
        });
    }

    function openDiscountModal(row) {
        activeRowForDiscount = row;
        modalContainer.innerHTML = '';
        
        const existingDiscounts = JSON.parse(row.querySelector('.row-discounts-json').value || '[]');
        if (existingDiscounts.length === 0) {
            addDiscountTierToModal();
        } else {
            existingDiscounts.forEach(d => addDiscountTierToModal(d.type, d.value));
        }

        modal.classList.remove('hidden');
    }

    function addDiscountTierToModal(type = 'percent', value = 0) {
        const div = document.createElement('div');
        div.className = 'discount-tier-row flex items-center gap-2';

        div.innerHTML = `
            <select class="tier-type rounded-lg border border-slate-200 bg-slate-50 p-1.5 text-xs text-slate-900 focus:outline-none dark:border-slate-800 dark:bg-slate-800 dark:text-slate-100">
                <option value="percent" ${type === 'percent' ? 'selected' : ''}>Persen (%)</option>
                <option value="fixed" ${type === 'fixed' ? 'selected' : ''}>Nominal (Rp)</option>
            </select>
            <input type="number" class="tier-value w-full rounded-lg border border-slate-200 bg-white p-1.5 text-xs text-slate-900 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100" value="${value}" min="0" step="0.1" placeholder="Nilai Diskon" />
            <button type="button" class="btn-remove-tier text-slate-400 hover:text-red-500 p-1">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        `;

        div.querySelector('.btn-remove-tier').addEventListener('click', () => div.remove());
        modalContainer.appendChild(div);
    }

    btnAddDiscountTier.addEventListener('click', () => addDiscountTierToModal());

    btnCloseModal.addEventListener('click', () => modal.classList.add('hidden'));

    btnApplyDiscounts.addEventListener('click', () => {
        if (!activeRowForDiscount) return;

        const discounts = [];
        modalContainer.querySelectorAll('.discount-tier-row').forEach(row => {
            const type = row.querySelector('.tier-type').value;
            const value = parseFloat(row.querySelector('.tier-value').value) || 0;
            if (value > 0) {
                discounts.push({ type, value });
            }
        });

        activeRowForDiscount.querySelector('.row-discounts-json').value = JSON.stringify(discounts);
        
        const summaryLabel = activeRowForDiscount.querySelector('.row-discount-summary');
        if (discounts.length === 0) {
            summaryLabel.textContent = '0 Diskon';
        } else {
            summaryLabel.textContent = discounts.map(d => d.type === 'percent' ? `${d.value}%` : `Rp${d.value.toLocaleString('id-ID')}`).join(' + ');
        }

        validateAndCalculateRow(activeRowForDiscount);
        modal.classList.add('hidden');
    });

    function validateAndCalculateRow(row) {
        const qty = parseInt(row.querySelector('.row-qty').value) || 0;
        const price = parseFloat(row.querySelector('.row-price').value) || 0;
        const discounts = JSON.parse(row.querySelector('.row-discounts-json').value || '[]');

        let netPrice = price;
        discounts.forEach(d => {
            if (d.type === 'percent') {
                netPrice = netPrice * (1 - (d.value / 100));
            } else if (d.type === 'fixed') {
                netPrice = Math.max(0, netPrice - d.value);
            }
        });

        const subtotal = netPrice * qty;

        row.querySelector('.row-net-price-input').value = Math.round(netPrice);
        row.querySelector('.row-net-price-label').textContent = formatRupiah(netPrice);

        row.querySelector('.row-subtotal-input').value = Math.round(subtotal);
        row.querySelector('.row-subtotal-label').textContent = formatRupiah(subtotal);

        calculateGrandTotal();
    }

    function calculateGrandTotal() {
        let total = 0;
        let count = 0;

        document.querySelectorAll('.row-subtotal-input').forEach(input => {
            total += parseFloat(input.value) || 0;
            count++;
        });

        summaryTotalItems.textContent = count;
        summaryGrandTotal.textContent = formatRupiah(total);
        headerTotalInput.value = Math.round(total);
    }

    function checkEmptyState() {
        const rows = tableBody.querySelectorAll('tr');
        emptyNotice.classList.toggle('hidden', rows.length > 0);
    }

    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(number);
    }
});
</script>