@props([
    'from' => 1,
    'to' => 1,
    'total' => 0,
    'currentPage' => 1,
    'lastPage' => 1
])

<div class="flex flex-col gap-3 pt-3 sm:flex-row sm:items-center sm:justify-between text-xs text-slate-500">
    <div>
        Menampilkan 
        <strong class="text-slate-800 dark:text-slate-200">{{ $from }}–{{ $to }}</strong> 
        dari 
        <strong class="text-slate-800 dark:text-slate-200">{{ $total }}</strong> 
        data
    </div>

    <div class="flex items-center gap-1">
        <button 
            type="button" 
            {{ $currentPage <= 1 ? 'disabled' : '' }}
            class="rounded border border-slate-200 px-2.5 py-1 transition-colors dark:border-slate-800 disabled:opacity-50 disabled:cursor-not-allowed hover:enabled:bg-slate-50 dark:hover:enabled:bg-slate-800"
        >
            Sebelumnya
        </button>

        @for($i = 1; $i <= $lastPage; $i++)
            <button 
                type="button" 
                class="rounded border px-2.5 py-1 transition-colors {{ $i === $currentPage ? 'border-slate-200 bg-emerald-600 text-white font-medium dark:border-slate-800' : 'border-slate-200 hover:bg-slate-50 dark:border-slate-800 dark:hover:bg-slate-800' }}"
            >
                {{ $i }}
            </button>
        @endfor

        <button 
            type="button" 
            {{ $currentPage >= $lastPage ? 'disabled' : '' }}
            class="rounded border border-slate-200 px-2.5 py-1 transition-colors dark:border-slate-800 disabled:opacity-50 disabled:cursor-not-allowed hover:enabled:bg-slate-50 dark:hover:enabled:bg-slate-800"
        >
            Selanjutnya
        </button>
    </div>
</div>