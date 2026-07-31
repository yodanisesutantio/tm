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

    @if(session('error'))
        <div id="alert-error" class="flex items-center justify-between rounded-xl border border-rose-200 bg-rose-50/80 p-4 text-sm text-rose-800 dark:border-rose-900/50 dark:bg-rose-950/30 dark:text-rose-400">
            <div class="flex items-center gap-2">
                <svg class="h-5 w-5 flex-shrink-0 text-rose-600 dark:text-rose-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
            <button type="button" onclick="document.getElementById('alert-error').remove()" class="text-rose-600 hover:text-rose-800 dark:text-rose-400 dark:hover:text-rose-200">
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
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Kelola dan lihat histori riwayat transaksi invoice (Total: {{ $totalTransactions }}).</p>
            </div>
            <button type="button" id="btn-show-form" class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-600 px-3.5 py-2 text-xs font-semibold text-white shadow-sm hover:bg-emerald-500 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Transaksi Baru
            </button>
        </div>

        <form method="GET" action="{{ route('hub') }}" class="flex items-center gap-2">
            <input type="hidden" name="tab" value="transactions">
            <div class="relative flex-1">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari No Invoice / Nama Customer..." class="w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2 pl-9 text-xs text-slate-900 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100">
                <svg class="absolute left-3 top-2.5 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
            <button type="submit" class="rounded-lg bg-slate-800 px-4 py-2 text-xs font-semibold text-white hover:bg-slate-700 dark:bg-slate-700 dark:hover:bg-slate-600">
                Cari
            </button>
            @if($search)
                <a href="{{ route('hub', ['tab' => 'transactions']) }}" class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-50 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400">
                    Reset
                </a>
            @endif
        </form>

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
                    @forelse($transactions as $trx)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/40">
                            <td class="p-3 font-semibold text-slate-900 dark:text-slate-100">{{ $trx->no_inv }}</td>
                            <td class="p-3">{{ \Carbon\Carbon::parse($trx->inv_date)->format('d M Y') }}</td>
                            <td class="p-3">
                                <div class="font-medium text-slate-900 dark:text-slate-100">{{ $trx->cust_name }}</div>
                                <div class="text-[10px] text-slate-400">{{ $trx->cust_code }}</div>
                            </td>
                            <td class="p-3 text-right font-bold text-emerald-600 dark:text-emerald-400">
                                Rp {{ number_format($trx->total, 0, ',', '.') }}
                            </td>
                            <td class="p-3 text-center flex items-center justify-center gap-2">
                                <button type="button" onclick="viewTransactionDetail({{ json_encode($trx) }})" class="text-slate-500 hover:text-emerald-600 font-medium">
                                    Detail
                                </button>
                                <span class="text-slate-300">|</span>
                                <form action="{{ route('transactions.delete', $trx->uuid) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini? Stok akan dikembalikan ke master produk.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-500 hover:text-rose-700 font-medium">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-slate-400">
                                Belum ada transaksi ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transactions->hasPages())
            <div class="pt-2">
                {{ $transactions->links() }}
            </div>
        @endif
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

        <form id="transaction-form" method="POST" action="{{ route('transactions.save') }}" class="space-y-6">
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

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">No. Invoice</label>
                        <input type="text" name="no_inv" id="no_inv_input" value="{{ $nextNoInv }}" readonly class="w-full rounded-lg border border-slate-200 bg-slate-100 px-3 py-2 text-xs font-semibold text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Tanggal Invoice</label>
                        <input type="date" name="inv_date" value="{{ date('Y-m-d') }}" required class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-900 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100 focus:border-emerald-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Pilih Customer</label>
                        <select name="cust_code" id="cust_code_select" required class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-900 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100 focus:border-emerald-500 focus:outline-none">
                            <option value="">-- Pilih Customer --</option>
                            @foreach($customerOptions as $opt)
                                <option value="{{ $opt['value'] }}" data-name="{{ $opt['data']['name'] }}" data-address="{{ $opt['data']['address'] }}">
                                    {{ $opt['label'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nama Customer</label>
                        <input type="text" id="cust_name_input" name="cust_name" placeholder="Otomatis terisi..." readonly class="w-full rounded-lg border border-slate-200 bg-slate-100 px-3 py-2 text-xs text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Alamat Customer</label>
                        <input type="text" id="cust_address_input" name="cust_address" placeholder="Otomatis terisi..." readonly class="w-full rounded-lg border border-slate-200 bg-slate-100 px-3 py-2 text-xs text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 focus:outline-none">
                    </div>
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
            <button type="button" id="btn-close-modal" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 text-lg">&times;</button>
        </div>

        <p class="text-xs text-slate-500 dark:text-slate-400">
            Tambahkan potongan bertingkat secara berurutan (% atau Rp).
        </p>

        <div id="modal-discounts-container" class="space-y-2.5 max-h-60 overflow-y-auto pr-1"></div>

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

<div id="detail-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm hidden">
    <div class="w-full max-w-2xl rounded-xl border border-slate-200 bg-white p-6 shadow-2xl dark:border-slate-800 dark:bg-slate-900 space-y-4">
        <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-3">
            <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">Detail Transaksi <span id="detail-modal-noinv" class="text-emerald-600"></span></h3>
            <button type="button" onclick="document.getElementById('detail-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-lg">&times;</button>
        </div>

        <div class="grid grid-cols-2 gap-4 text-xs">
            <div>
                <p class="text-slate-400">Customer:</p>
                <p id="detail-modal-cust" class="font-semibold text-slate-800 dark:text-slate-200"></p>
            </div>
            <div>
                <p class="text-slate-400">Tanggal:</p>
                <p id="detail-modal-date" class="font-semibold text-slate-800 dark:text-slate-200"></p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700 dark:text-slate-300">
                <thead class="bg-slate-50 dark:bg-slate-800 text-[11px] uppercase">
                    <tr>
                        <th class="p-2">Produk</th>
                        <th class="p-2 text-center">Qty</th>
                        <th class="p-2 text-right">Harga</th>
                        <th class="p-2 text-right">Net Price</th>
                        <th class="p-2 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody id="detail-modal-tbody" class="divide-y divide-slate-200 dark:divide-slate-800"></tbody>
            </table>
        </div>

        <div class="flex justify-between items-center text-sm font-bold pt-2 border-t border-slate-200 dark:border-slate-800">
            <span>Grand Total:</span>
            <span id="detail-modal-total" class="text-emerald-600"></span>
        </div>
    </div>
</div>

<script>
    const availableProducts = @json($products);

    let itemRowIndex = 0;
    let activeEditingRowIndex = null;
    let activeDiscountsMap = {};

    const viewList = document.getElementById('view-list');
    const viewForm = document.getElementById('view-form');
    const btnShowForm = document.getElementById('btn-show-form');
    const btnShowList = document.getElementById('btn-show-list');
    const btnCancelForm = document.getElementById('btn-cancel-form');
    const custCodeSelect = document.getElementById('cust_code_select');
    const custNameInput = document.getElementById('cust_name_input');
    const custAddressInput = document.getElementById('cust_address_input');
    const detailItemsBody = document.getElementById('detail-items-body');
    const emptyNotice = document.getElementById('empty-table-notice');
    const btnAddItem = document.getElementById('btn-add-item');

    btnShowForm.addEventListener('click', () => {
        viewList.classList.add('hidden');
        viewForm.classList.remove('hidden');
    });

    const hideForm = () => {
        viewForm.classList.add('hidden');
        viewList.classList.remove('hidden');
    };
    btnShowList.addEventListener('click', hideForm);
    btnCancelForm.addEventListener('click', hideForm);

    custCodeSelect.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        if (this.value) {
            custNameInput.value = selectedOption.getAttribute('data-name') || '';
            custAddressInput.value = selectedOption.getAttribute('data-address') || '';
        } else {
            custNameInput.value = '';
            custAddressInput.value = '';
        }
    });

    btnAddItem.addEventListener('click', () => {
        emptyNotice.classList.add('hidden');
        const idx = itemRowIndex++;
        activeDiscountsMap[idx] = [];

        const tr = document.createElement('tr');
        tr.id = `item-row-${idx}`;
        tr.className = "hover:bg-slate-50/50 dark:hover:bg-slate-800/40";

        let productOptionsHtml = `<option value="">-- Pilih Produk --</option>`;
        availableProducts.forEach(p => {
            productOptionsHtml += `<option value="${p.code}" data-price="${p.price}" data-stock="${p.stock}">${p.code} - ${p.name}</option>`;
        });

        tr.innerHTML = `
            <td class="p-2.5">
                <select name="details[${idx}][product_code]" class="w-full rounded-lg border border-slate-200 bg-white px-2.5 py-1.5 text-xs product-select focus:border-emerald-500 focus:outline-none dark:border-slate-800 dark:bg-slate-900" required>
                    ${productOptionsHtml}
                </select>
            </td>
            <td class="p-2.5 text-center font-semibold text-slate-500 stock-cell">-</td>
            <td class="p-2.5">
                <input type="number" name="details[${idx}][qty]" value="1" min="1" class="w-full rounded-lg border border-slate-200 px-2 py-1 text-xs qty-input text-center focus:border-emerald-500 focus:outline-none dark:border-slate-800 dark:bg-slate-900" required>
            </td>
            <td class="p-2.5">
                <input type="number" step="any" name="details[${idx}][price]" value="0" class="w-full rounded-lg border border-slate-200 px-2 py-1 text-xs price-input text-right focus:border-emerald-500 focus:outline-none dark:border-slate-800 dark:bg-slate-900" required>
            </td>
            <td class="p-2.5 text-center">
                <button type="button" onclick="openDiscountModal(${idx})" class="text-xs font-semibold text-emerald-600 hover:underline discount-label">
                    0 Diskon (Set)
                </button>
                <input type="hidden" name="details[${idx}][discounts_json]" id="discounts-json-${idx}" value="[]">
                <input type="hidden" name="details[${idx}][net_price]" id="net-price-input-${idx}" value="0">
                <input type="hidden" name="details[${idx}][subtotal]" id="subtotal-input-${idx}" value="0">
            </td>
            <td class="p-2.5 font-semibold text-slate-700 dark:text-slate-300 net-price-cell">Rp 0</td>
            <td class="p-2.5 font-bold text-emerald-600 dark:text-emerald-400 subtotal-cell">Rp 0</td>
            <td class="p-2.5 text-center">
                <button type="button" onclick="removeItemRow(${idx})" class="text-rose-500 hover:text-rose-700 text-base font-bold">&times;</button>
            </td>
        `;

        detailItemsBody.appendChild(tr);

        const select = tr.querySelector('.product-select');
        const qtyInput = tr.querySelector('.qty-input');
        const priceInput = tr.querySelector('.price-input');

        select.addEventListener('change', () => {
            const opt = select.options[select.selectedIndex];
            const stock = opt.getAttribute('data-stock') || '-';
            const price = opt.getAttribute('data-price') || 0;
            tr.querySelector('.stock-cell').textContent = stock;
            priceInput.value = price;

            if (stock !== '-') {
                qtyInput.setAttribute('max', stock);
            }

            recalculateRow(idx);
        });

        qtyInput.addEventListener('input', () => recalculateRow(idx));
        priceInput.addEventListener('input', () => recalculateRow(idx));
    });

    function removeItemRow(idx) {
        document.getElementById(`item-row-${idx}`).remove();
        delete activeDiscountsMap[idx];
        if (detailItemsBody.children.length === 0) {
            emptyNotice.classList.remove('hidden');
        }
        recalculateTotals();
    }

    function recalculateRow(idx) {
        const tr = document.getElementById(`item-row-${idx}`);
        if (!tr) return;

        const qty = parseFloat(tr.querySelector('.qty-input').value) || 0;
        const price = parseFloat(tr.querySelector('.price-input').value) || 0;
        const stockCell = tr.querySelector('.stock-cell');
        const stock = parseInt(stockCell.textContent) || 0;

        if (stockCell.textContent !== '-' && qty > stock) {
            alert(`Stok tidak mencukupi! Maksimal stok tersedia adalah ${stock}`);
            tr.querySelector('.qty-input').value = stock;
            return recalculateRow(idx);
        }

        const discounts = activeDiscountsMap[idx] || [];
        let currentPrice = price;

        discounts.forEach(d => {
            const val = parseFloat(d.value) || 0;
            if (d.type === 'percent') {
                currentPrice = currentPrice - (currentPrice * (val / 100));
            } else if (d.type === 'nominal') {
                currentPrice = Math.max(0, currentPrice - val);
            }
        });

        const netPrice = currentPrice;
        const subtotal = netPrice * qty;

        tr.querySelector('.net-price-cell').textContent = `Rp ${Math.round(netPrice).toLocaleString('id-ID')}`;
        tr.querySelector('.subtotal-cell').textContent = `Rp ${Math.round(subtotal).toLocaleString('id-ID')}`;

        document.getElementById(`net-price-input-${idx}`).value = netPrice;
        document.getElementById(`subtotal-input-${idx}`).value = subtotal;

        recalculateTotals();
    }

    function recalculateTotals() {
        let totalItems = 0;
        let grandTotal = 0;

        document.querySelectorAll('#detail-items-body tr').forEach(tr => {
            const qty = parseFloat(tr.querySelector('.qty-input').value) || 0;
            const subtotal = parseFloat(tr.querySelector('.subtotal-cell').textContent.replace(/[^\d]/g, '')) || 0;
            totalItems += qty;
            grandTotal += subtotal;
        });

        document.getElementById('summary-total-items').textContent = totalItems;
        document.getElementById('summary-grand-total').textContent = `Rp ${grandTotal.toLocaleString('id-ID')}`;
        document.getElementById('header_total_input').value = grandTotal;
    }

    const discountModal = document.getElementById('discount-modal');
    const modalContainer = document.getElementById('modal-discounts-container');

    function openDiscountModal(idx) {
        activeEditingRowIndex = idx;
        modalContainer.innerHTML = '';

        const existingDiscounts = activeDiscountsMap[idx] || [];
        if (existingDiscounts.length === 0) {
            addDiscountTierRow();
        } else {
            existingDiscounts.forEach(d => addDiscountTierRow(d.type, d.value));
        }

        discountModal.classList.remove('hidden');
    }

    document.getElementById('btn-close-modal').addEventListener('click', () => {
        discountModal.classList.add('hidden');
    });

    document.getElementById('btn-add-discount-tier').addEventListener('click', () => addDiscountTierRow());

    function addDiscountTierRow(type = 'percent', val = '') {
        const div = document.createElement('div');
        div.className = "flex items-center gap-2 modal-discount-tier";
        div.innerHTML = `
            <select class="rounded-lg border border-slate-200 bg-white px-2 py-1.5 text-xs dark:border-slate-800 dark:bg-slate-900 tier-type">
                <option value="percent" ${type === 'percent' ? 'selected' : ''}>Diskon %</option>
                <option value="nominal" ${type === 'nominal' ? 'selected' : ''}>Potongan Rp</option>
            </select>
            <input type="number" step="any" value="${val}" placeholder="Nilai..." class="w-full rounded-lg border border-slate-200 px-2 py-1.5 text-xs dark:border-slate-800 dark:bg-slate-900 tier-value" required />
            <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 font-bold text-base">&times;</button>
        `;
        modalContainer.appendChild(div);
    }

    document.getElementById('btn-apply-discounts').addEventListener('click', () => {
        if (activeEditingRowIndex === null) return;

        const tiers = [];
        document.querySelectorAll('.modal-discount-tier').forEach(row => {
            const type = row.querySelector('.tier-type').value;
            const val = parseFloat(row.querySelector('.tier-value').value) || 0;
            if (val > 0) {
                tiers.push({ type, value: val });
            }
        });

        activeDiscountsMap[activeEditingRowIndex] = tiers;

        const tr = document.getElementById(`item-row-${activeEditingRowIndex}`);
        const labelBtn = tr.querySelector('.discount-label');
        labelBtn.textContent = `${tiers.length} Diskon (Set)`;
        document.getElementById(`discounts-json-${activeEditingRowIndex}`).value = JSON.stringify(tiers);

        discountModal.classList.add('hidden');
        recalculateRow(activeEditingRowIndex);
    });

    function viewTransactionDetail(trx) {
        document.getElementById('detail-modal-noinv').textContent = trx.no_inv;
        document.getElementById('detail-modal-cust').textContent = `${trx.cust_code} - ${trx.cust_name}`;
        document.getElementById('detail-modal-date').textContent = trx.inv_date;
        document.getElementById('detail-modal-total').textContent = `Rp ${parseInt(trx.total).toLocaleString('id-ID')}`;

        const tbody = document.getElementById('detail-modal-tbody');
        tbody.innerHTML = '';

        (trx.items || []).forEach(d => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="p-2">${d.product_code} - ${d.product_name}</td>
                <td class="p-2 text-center">${d.qty}</td>
                <td class="p-2 text-right">Rp ${parseInt(d.price).toLocaleString('id-ID')}</td>
                <td class="p-2 text-right">Rp ${parseInt(d.net_price).toLocaleString('id-ID')}</td>
                <td class="p-2 text-right font-bold text-emerald-600">Rp ${parseInt(d.subtotal).toLocaleString('id-ID')}</td>
            `;
            tbody.appendChild(tr);
        });

        document.getElementById('detail-modal').classList.remove('hidden');
    }
</script>
