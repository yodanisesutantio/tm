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
            <h2 class="text-xl font-bold tracking-tight text-slate-900 dark:text-slate-100">Katalog Customer</h2>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Kelola data pelanggan, informasi kontak, dan detail alamat pengiriman.</p>
        </div>
        
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-50 text-xs font-medium text-slate-600 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400">
                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                Total: <strong class="text-slate-900 dark:text-slate-100">18 Customer</strong>
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
                    Tambah Customer Baru
                </h3>
            </div>
        </div>

        <form method="POST" class="space-y-4">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input 
                    label="Kode Customer" 
                    name="code" 
                    placeholder="CUST-001" 
                    maxlength="32"
                    required 
                />

                <x-input 
                    label="Nama Customer" 
                    name="name" 
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
                placeholder="Jl. Mawar No. 12, RT 01/RW 03" 
                maxlength="255"
                required 
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <x-creatable-select 
                    label="Provinsi" 
                    name="province" 
                    :options="['DKI Jakarta', 'Jawa Barat', 'Jawa Tengah', 'Jawa Timur', 'Banten']" 
                    placeholder="Pilih atau ketik provinsi..."
                />

                <x-creatable-select 
                    label="Kota / Kabupaten" 
                    name="city" 
                    :options="['Jakarta Selatan', 'Bandung', 'Semarang', 'Surabaya', 'Tangerang']" 
                    placeholder="Pilih atau ketik kota..."
                />

                <x-creatable-select 
                    label="Kecamatan" 
                    name="district" 
                    :options="['Kebayoran Baru', 'Coblong', 'Gajahmungkur', 'Tegalsari']" 
                    placeholder="Pilih atau ketik kecamatan..."
                />

                <x-creatable-select 
                    label="Kelurahan" 
                    name="subdistrict" 
                    :options="['Senayan', 'Dago', 'Sampangan', 'Kedungdoro']" 
                    placeholder="Pilih atau ketik kelurahan..."
                />

                <x-input 
                    label="Kode Pos" 
                    name="postal_code" 
                    placeholder="12190" 
                    maxlength="10"
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
                    Simpan Customer
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
                placeholder="Cari kode atau nama customer..." 
                class="w-full rounded-lg border border-slate-200 bg-white pl-9 pr-3 py-1.5 text-xs text-slate-900 placeholder-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100 dark:placeholder-slate-500 dark:focus:border-emerald-500"
            />
        </div>
    </div>

    @php
        $columns = [
            'code' => 'Kode',
            'name' => 'Nama Customer',
            'city' => 'Kota / Provinsi',
            'postal_code' => 'Kode Pos',
        ];

        $customers = [
            [
                'code' => 'CUST-001',
                'name' => 'PT Kopi Nusantara',
                'address' => 'Jl. Jend. Sudirman No. 45, Senayan',
                'city' => 'Jakarta Selatan, DKI Jakarta',
                'postal_code' => '12190',
            ],
            [
                'code' => 'CUST-002',
                'name' => 'Budi Santoso',
                'address' => 'Jl. Dago No. 112, Coblong',
                'city' => 'Bandung, Jawa Barat',
                'postal_code' => '40135',
            ],
            [
                'code' => 'CUST-003',
                'name' => 'CV Cahaya Abadi',
                'address' => 'Jl. Pemuda No. 88, Gajahmungkur',
                'city' => 'Semarang, Jawa Tengah',
                'postal_code' => '50232',
            ],
        ];
    @endphp

    <div class="space-y-3">
        <x-table :columns="$columns">
            @forelse($customers as $item)
                <x-table.row :columns="$columns" :item="$item">

                    <x-slot:col_name>
                        <div class="font-medium text-slate-900 dark:text-slate-100">{{ $item['name'] }}</div>
                        <div class="text-[11px] text-slate-400 truncate max-w-xs">{{ $item['address'] }}</div>
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

        <x-pagination :from="1" :to="10" :total="18" :current-page="1" :last-page="2" />
    </div>
</div>