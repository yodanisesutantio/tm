<div class="space-y-6 font-sans">
    @if(session('success'))
        <div x-data="{ open: true }" 
             x-show="open" 
             x-transition
             class="flex items-center justify-between rounded-xl border border-emerald-200 bg-emerald-50/80 p-4 text-sm text-emerald-800 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-400">
            <div class="flex items-center gap-2">
                <svg class="h-5 w-5 flex-shrink-0 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" 
                    @click="open = false" 
                    class="text-emerald-600 hover:text-emerald-800 dark:text-emerald-400 dark:hover:text-emerald-200">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200 dark:border-slate-800">
        <div>
            <h2 class="text-xl font-bold tracking-tight text-slate-900 dark:text-slate-100">Katalog Produk</h2>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Kelola data produk, persediaan stok, dan penyesuaian harga.</p>
        </div>
        
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-50 text-xs font-medium text-slate-600 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400">
                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                Total: <strong class="text-slate-900 dark:text-slate-100">24 Produk</strong>
            </span>
        </div>
    </div>

    <div class="rounded-xl border border-slate-200 bg-slate-50/50 p-5 dark:border-slate-800 dark:bg-slate-900/50">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2">
                <div class="p-1.5 rounded-lg bg-emerald-100 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-400">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-slate-900 dark:text-slate-100">
                    Tambah Produk Baru
                </h3>
            </div>
        </div>

        <form method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-2">
                    <x-creatable-select 
                        label="Kategori" 
                        name="category" 
                        :options="['Barang Jadi', 'Bahan Baku', 'Aset', 'Material']" 
                        selected="Biji Kopi Lengkap"
                        placeholder="Cari atau ketik kategori baru..."
                        required 
                    />
                </div>

                <x-input 
                    label="Kode Produk" 
                    name="code" 
                    placeholder="PRD-001" 
                    maxlength="64"
                    required 
                />

                <x-input 
                    label="Nama Produk" 
                    name="name" 
                    placeholder="Contoh: Kopi Arabika 250g" 
                    maxlength="255"
                    required 
                />

                <x-input 
                    label="Harga (Rp)" 
                    name="price" 
                    type="number" 
                    placeholder="0" 
                    maxlength="16"
                />

                <x-input 
                    label="Stok" 
                    name="stock" 
                    type="number" 
                    placeholder="0" 
                    maxlength="16"
                />
            </div>

            <div class="mt-4 flex items-center justify-end gap-3 pt-2">
                <button type="button" class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-600 transition-colors hover:bg-slate-100 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400 dark:hover:bg-slate-800">
                    Batal
                </button>
                <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition-colors hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/50">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>

    <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="relative w-full sm:w-72">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            <input 
                type="text" 
                placeholder="Cari kode atau nama..." 
                class="w-full rounded-lg border border-slate-200 bg-white pl-9 pr-3 py-1.5 text-xs text-slate-900 placeholder-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100 dark:placeholder-slate-500 dark:focus:border-emerald-500"
            />
        </div>
    </div>

    @php
        $columns = [
            'code' => 'Kode',
            'name' => 'Nama Produk',
            'price' => 'Harga',
            'stock' => 'Stok',
        ];

        $products = [
            [
                'code' => 'PRD-001',
                'name' => 'Kopi Arabika Specialty 250g',
                'category' => 'Biji Kopi Lengkap',
                'price' => 'Rp 85.000',
                'stock' => 45,
            ],
            [
                'code' => 'PRD-002',
                'name' => 'Susu Oat Milk 1L',
                'category' => 'Bahan Baku',
                'price' => 'Rp 42.500',
                'stock' => 5,
            ],
            [
                'code' => 'PRD-003',
                'name' => 'Syrup Vanilla 750ml',
                'category' => 'Sirup',
                'price' => 'Rp 120.000',
                'stock' => 0,
            ],
        ];
    @endphp

    <div class="space-y-3">
        <x-table :columns="$columns">
            @forelse($products as $item)
                <x-table.row :columns="$columns" :item="$item">

                    <x-slot:col_name>
                        <div class="font-medium text-slate-900 dark:text-slate-100">{{ $item['name'] }}</div>
                        <div class="text-[11px] text-slate-400">{{ $item['category'] }}</div>
                    </x-slot:col_name>

                </x-table.row>
            @empty
                <tr>
                    <td colspan="{{ count($columns) + 1 }}" class="p-8 text-center text-slate-400 dark:text-slate-500">
                        Tidak ada data untuk ditampilkan.
                    </td>
                </tr>
            @endforelse
        </x-table>

        <x-pagination :from="1" :to="10" :total="24" :current-page="1" :last-page="3" />
    </div>
</div>