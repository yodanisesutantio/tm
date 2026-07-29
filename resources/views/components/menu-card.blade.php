@props([
    'title',
    'description',
    'href' => '#',
    'active' => false,
    'color' => 'blue',
])

@php
$colorClasses = [
    'blue'    => 'bg-blue-50 text-blue-600 dark:bg-blue-950/50 dark:text-blue-400 group-hover:bg-blue-100 dark:group-hover:bg-blue-900/50',
    'emerald' => 'bg-emerald-50 text-emerald-600 dark:bg-emerald-950/50 dark:text-emerald-400 group-hover:bg-emerald-100 dark:group-hover:bg-emerald-900/50',
    'violet'  => 'bg-violet-50 text-violet-600 dark:bg-violet-950/50 dark:text-violet-400 group-hover:bg-violet-100 dark:group-hover:bg-violet-900/50',
][$color] ?? 'bg-slate-50 text-slate-600 dark:bg-slate-800 dark:text-slate-400';

$activeClasses = $active 
    ? 'border-blue-500 bg-blue-50/40 dark:bg-blue-950/20 ring-1 ring-blue-500/20' 
    : 'border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 hover:border-slate-300 dark:hover:border-slate-700 hover:shadow-sm';
@endphp

<a href="{{ $href }}" 
   {{ $attributes->merge(['class' => "group relative flex items-start gap-4 rounded-xl border p-4 transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500/50 {$activeClasses}"]) }}>
    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg transition-colors duration-200 {{ $colorClasses }}">
        {{ $slot }}
    </div>

    <div class="flex-1 min-w-0">
        <div class="flex items-center justify-between">
            <h3 class="text-sm font-semibold text-slate-900 dark:text-slate-100 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                {{ $title }}
            </h3>
            <svg class="h-4 w-4 text-slate-400 transition-transform duration-200 group-hover:translate-x-0.5 group-hover:text-slate-600 dark:group-hover:text-slate-300" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </div>
        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400 line-clamp-2 leading-relaxed">
            {{ $description }}
        </p>
    </div>
</a>