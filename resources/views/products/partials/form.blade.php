<div class="space-y-6 font-sans">
    @if(session('success'))
        <div x-data="{ open: true }"
             x-show="open"
             x-transition
             class="flex items-center justify-between rounded-xl border border-emerald-200 bg-emerald-50/80 p-4 text-sm text-emerald-800 dark:border-emerald-900/50 dark:bg-emerald-950/30 dark:text-emerald-400">
            <div class="flex items-center gap-2">
                <svg class="h-5 w-5 shrink-0 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
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

    @if($errors->any())
        <div x-data="{ open: true }" x-show="open" class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800 dark:border-red-900/50 dark:bg-red-950/30 dark:text-red-400">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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
                Total: <strong class="text-slate-900 dark:text-slate-100">{{ $totalProducts }} Produk</strong>
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
                    {{ $editingProduct ? 'Edit Produk' : 'Tambah Produk Baru' }}
                </h3>
            </div>
            @if($editingProduct)
                <a href="{{ route('hub', ['tab' => 'products']) }}" class="text-xs text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200">
                    + Tambah Produk Baru
                </a>
            @endif
        </div>

        <form method="POST" action="{{ route('products.save') }}" class="space-y-4">
            @csrf

            <input type="hidden" name="uuid" value="{{ old('uuid', $editingProduct?->uuid) }}" />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-2">
                    <x-creatable-select
                        label="Kategori"
                        name="category"
                        :options="$categories"
                        selected="{{ old('category', $editingProduct?->category ?? 'Barang Jadi') }}"
                        placeholder="Cari atau ketik kategori baru..."
                        required
                    />
                </div>

                <x-input
                    label="Kode Produk"
                    name="code"
                    value="{{ old('code', $editingProduct?->code) }}"
                    placeholder="PRD-001"
                    maxlength="64"
                    required
                    :disabled="isset($editingCustomer)"
                />

                <x-input
                    label="Nama Produk"
                    name="name"
                    value="{{ old('name', $editingProduct?->name) }}"
                    placeholder="Contoh: Kopi Arabika 250g"
                    maxlength="255"
                    required
                />

                <x-input
                    label="Harga (Rp)"
                    name="price"
                    type="text"
                    inputmode="decimal"
                    value="{{ old('price', isset($editingProduct->price) ? (float) $editingProduct->price : 0) }}"
                    placeholder="0,00"
                />

                <x-input
                    label="Stok"
                    name="stock"
                    type="text"
                    inputmode="decimal"
                    value="{{ old('stock', isset($editingProduct->stock) ? (float) $editingProduct->stock : 0) }}"
                    placeholder="0,00"
                />
            </div>

            <div class="mt-4 flex items-center justify-end gap-3 pt-2">
                @if($editingProduct)
                    <a href="{{ route('hub', ['tab' => 'products']) }}" class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-600 transition-colors hover:bg-slate-100 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400 dark:hover:bg-slate-800">
                        Batal
                    </a>
                @else
                    <button type="reset" class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-600 transition-colors hover:bg-slate-100 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400 dark:hover:bg-slate-800">
                        Reset
                    </button>
                @endif

                <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition-colors hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/50">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    {{ $editingProduct ? 'Perbarui Produk' : 'Simpan Produk' }}
                </button>
            </div>
        </form>
    </div>

    <form method="GET" action="{{ route('hub') }}" class="flex flex-col sm:flex-row items-center justify-between gap-3">
        <input type="hidden" name="tab" value="products" />

        <div class="flex items-center justify-between gap-2 w-full">
            <div class="relative w-full sm:w-72">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input
                    type="text"
                    name="search"
                    value="{{ $search ?? request('search') }}"
                    placeholder="Cari kode atau nama..."
                    onchange="this.form.submit()"
                    class="w-full rounded-lg border border-slate-200 bg-white pl-9 pr-3 py-1.5 text-xs text-slate-900 placeholder-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100 dark:placeholder-slate-500 dark:focus:border-emerald-500"
                />
            </div>

            <a
                href="{{ route('hub', ['tab' => 'products']) }}"
                title="Reload Data"
                class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white p-2 text-slate-500 hover:bg-slate-50 hover:text-slate-700 transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500/50 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-200"
            >
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M20.985 19.644v-4.992m0 0h-4.992m4.992 0L17.51 12.01a8.25 8.25 0 10-2.481 5.922" />
                </svg>
            </a>
        </div>
    </form>

    @php
        $columns = [
            'code'  => 'Kode',
            'name'  => 'Nama Produk',
            'price' => 'Harga',
            'stock' => 'Stok',
        ];
    @endphp

    <div class="space-y-3">
        <x-table :columns="$columns">
            @forelse($products as $product)
                @php
                    $itemData = [
                        'uuid'     => $product->uuid,
                        'code'     => $product->code,
                        'name'     => $product->name,
                        'category' => $product->category,
                        'price'    => 'Rp ' . number_format($product->price, 0, ',', '.'),
                        'stock'    => (float) $product->stock,
                    ];
                @endphp

                <x-table.row
                    :columns="$columns"
                    :item="$itemData"
                    :edit-url="route('hub', ['tab' => 'products', 'edit' => $product->uuid])"
                    :delete-url="route('products.delete', $product->uuid)"
                >
                    <x-slot:col_name>
                        <div class="font-medium text-slate-900 dark:text-slate-100">{{ $product->name }}</div>
                        <div class="text-[11px] text-slate-400">{{ $product->category }}</div>
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

        @if($products->hasPages() || $products->total() > 0)
            <x-pagination
                :from="$products->firstItem() ?? 0"
                :to="$products->lastItem() ?? 0"
                :total="$products->total()"
                :current-page="$products->currentPage()"
                :last-page="$products->lastPage()"
            />
        @endif
    </div>
</div>
