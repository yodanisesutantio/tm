@props([
    'id' => null,
    'disabled' => false,
    'required' => false,
    'label' => null,
    'name' => '',
    'type' => 'text',
    'value' => '',
    'error' => null,
    'maxlength' => null
])

@php
    $currentLength = mb_strlen(old($name, $value) ?? '');
    $counterId = 'counter_' . $name . '_' . uniqid();
@endphp

<div class="flex flex-col gap-1.5">
    @if($label)
        <label for="{{ $id ?? $name }}" class="text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300">
            {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    <div class="relative w-full">
        <input 
            {{ $disabled ? 'disabled' : '' }} 
            {{ $required ? 'required' : '' }}
            type="{{ $type }}" 
            id="{{ $id ?? $name }}"
            name="{{ $name }}" 
            value="{{ old($name, $value) }}"
            @if($maxlength) 
                maxlength="{{ $maxlength }}" 
                oninput="
                    (function(el) {
                        const countEl = document.getElementById('{{ $counterId }}');
                        if (!countEl) return;
                        const len = el.value.length;
                        const max = {{ $maxlength }};
                        countEl.querySelector('.current-count').textContent = len;
                        if (len >= max) {
                            countEl.classList.add('text-amber-500', 'dark:text-amber-400', 'font-bold');
                        } else {
                            countEl.classList.remove('text-amber-500', 'dark:text-amber-400', 'font-bold');
                        }
                    })(this)
                "
            @endif
            {{ $attributes->merge([
                'class' => 'w-full rounded-lg border px-3 py-2 text-sm transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500/50 ' . 
                ($maxlength ? 'pr-16 ' : '') .
                ($error 
                    ? 'border-red-500 bg-red-50/50 text-red-900 focus:border-red-500 dark:border-red-800 dark:bg-red-950/20 dark:text-red-300' 
                    : 'border-slate-200 bg-white text-slate-900 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100')
            ]) }}
        />

        @if($maxlength)
            <div 
                id="{{ $counterId }}" 
                class="pointer-events-none absolute right-2.5 bottom-2 text-[10px] font-medium tracking-tight text-slate-400 dark:text-slate-500 {{ $currentLength >= $maxlength ? 'text-amber-500 dark:text-amber-400 font-bold' : '' }}"
            >
                <span class="current-count">{{ $currentLength }}</span>/{{ $maxlength }}
            </div>
        @endif
    </div>

    @if($error)
        <p class="text-xs text-red-500 dark:text-red-400 font-medium">{{ $error }}</p>
    @endif
</div>