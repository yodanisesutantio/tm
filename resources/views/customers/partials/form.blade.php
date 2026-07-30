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
            <h2 class="text-xl font-bold tracking-tight text-slate-900 dark:text-slate-100">Katalog Customer</h2>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Kelola data pelanggan, informasi kontak, dan detail alamat pengiriman.</p>
        </div>

        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-50 text-xs font-medium text-slate-600 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400">
                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                Total: <strong class="text-slate-900 dark:text-slate-100">{{ $totalCustomers }} Customer</strong>
            </span>
        </div>
    </div>

    <div class="rounded-xl border border-slate-200 bg-slate-50/50 p-5 dark:border-slate-800 dark:bg-slate-900/50">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2">
                <div class="p-1.5 rounded-lg bg-emerald-100 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-400">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-slate-900 dark:text-slate-100">
                    {{ isset($editingCustomer) && $editingCustomer ? 'Edit Data Customer' : 'Tambah Customer Baru' }}
                </h3>
            </div>
            @if(isset($editingCustomer) && $editingCustomer)
                <a href="{{ route('hub', ['tab' => 'customers']) }}" class="text-xs text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200">
                    + Tambah Customer Baru
                </a>
            @endif
        </div>

        <form method="POST" action="{{ route('customers.save') }}" class="space-y-4">
            @csrf

            <input type="hidden" name="uuid" value="{{ old('uuid', $editingCustomer->uuid ?? '') }}" />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input
                    label="Kode Customer"
                    name="code"
                    value="{{ old('code', $editingCustomer->code ?? '') }}"
                    placeholder="CUST-001"
                    maxlength="64"
                    required
                    :disabled="isset($editingCustomer)"
                />

                <x-input
                    label="Nama Customer"
                    name="name"
                    value="{{ old('name', $editingCustomer->name ?? '') }}"
                    placeholder="Contoh: PT Sumber Makmur / Budi Santoso"
                    maxlength="255"
                    required
                />
            </div>

            <div class="pt-2 border-t border-slate-200 dark:border-slate-800">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                    Detail Alamat
                </span>
            </div>

            <x-input
                label="Alamat Lengkap"
                name="address"
                value="{{ old('address', $editingCustomer->address ?? '') }}"
                placeholder="Jl. Mawar No. 12, RT 01/RW 03"
                maxlength="255"
                required
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <x-creatable-select
                    label="Provinsi"
                    name="province"
                    :options="$provinces ?? ['DKI Jakarta', 'Jawa Barat', 'Jawa Tengah', 'Jawa Timur', 'Banten']"
                    selected="{{ old('province', $editingCustomer->province ?? '') }}"
                    placeholder="Pilih atau ketik provinsi..."
                />

                <x-creatable-select
                    label="Kota / Kabupaten"
                    name="city"
                    :options="$cities ?? ['Jakarta Selatan', 'Bandung', 'Semarang', 'Surabaya', 'Tangerang']"
                    selected="{{ old('city', $editingCustomer->city ?? '') }}"
                    placeholder="Pilih atau ketik kota..."
                />

                <x-creatable-select
                    label="Kecamatan"
                    name="district"
                    :options="$districts ?? ['Kebayoran Baru', 'Coblong', 'Gajahmungkur', 'Tegalsari']"
                    selected="{{ old('district', $editingCustomer->district ?? '') }}"
                    placeholder="Pilih atau ketik kecamatan..."
                />

                <x-creatable-select
                    label="Kelurahan"
                    name="subdistrict"
                    :options="$subdistricts ?? ['Senayan', 'Dago', 'Sampangan', 'Kedungdoro']"
                    selected="{{ old('subdistrict', $editingCustomer->subdistrict ?? '') }}"
                    placeholder="Pilih atau ketik kelurahan..."
                />

                <x-input
                    label="Kode Pos"
                    name="postal_code"
                    value="{{ old('postal_code', $editingCustomer->postal_code ?? '') }}"
                    placeholder="12190"
                    maxlength="10"
                />
            </div>

            <div class="mt-4 flex items-center justify-end gap-3 pt-2">
                @if(isset($editingCustomer) && $editingCustomer)
                    <a href="{{ route('hub', ['tab' => 'customers']) }}" class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-600 transition-colors hover:bg-slate-100 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400 dark:hover:bg-slate-800">
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
                    {{ isset($editingCustomer) && $editingCustomer ? 'Perbarui Customer' : 'Simpan Customer' }}
                </button>
            </div>
        </form>
    </div>

    <form method="GET" action="{{ route('hub') }}" class="flex flex-col sm:flex-row items-center justify-between gap-3">
        <input type="hidden" name="tab" value="customers" />

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
                href="{{ route('hub', ['tab' => 'customers']) }}"
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
            'code'        => 'Kode',
            'name'        => 'Nama Customer',
            'city'        => 'Kota / Provinsi',
            'postal_code' => 'Kode Pos',
        ];
    @endphp

    <div class="space-y-3">
        <x-table :columns="$columns">
            @forelse($customers as $customer)
                @php
                    $locationParts = array_filter([$customer->city, $customer->province]);
                    $locationString = implode(', ', $locationParts);

                    $itemData = [
                        'uuid'        => $customer->uuid,
                        'code'        => $customer->code,
                        'name'        => $customer->name,
                        'city'        => $locationString ?: '-',
                        'postal_code' => $customer->postal_code ?? '-',
                    ];
                @endphp

                <x-table.row
                    :columns="$columns"
                    :item="$itemData"
                    :edit-url="route('hub', ['tab' => 'customers', 'edit' => $customer->uuid])"
                    :delete-url="route('customers.delete', $customer->uuid)"
                >
                    <x-slot:col_name>
                        <div class="font-medium text-slate-900 dark:text-slate-100">{{ $customer->name }}</div>
                        <div class="text-[11px] text-slate-400 truncate max-w-xs">{{ $customer->address }}</div>
                    </x-slot:col_name>
                </x-table.row>
            @empty
                <tr>
                    <td colspan="{{ count($columns) + 1 }}" class="p-8 text-center text-slate-400 dark:text-slate-500">
                        Tidak ada data customer untuk ditampilkan.
                    </td>
                </tr>
            @endforelse
        </x-table>

        @if($customers->hasPages() || $customers->total() > 0)
            <x-pagination
                :from="$customers->firstItem() ?? 0"
                :to="$customers->lastItem() ?? 0"
                :total="$customers->total()"
                :current-page="$customers->currentPage()"
                :last-page="$customers->lastPage()"
            />
        @endif
    </div>
</div>
