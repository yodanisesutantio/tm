@props([
    'label' => null,
    'name',
    'id' => null,
    'options' => [],
    'selected' => null,
    'placeholder' => 'Pilih...',
    'required' => false,
])

@php
    $componentId = $id ?? 'select-' . Str::random(8);

    $normalizedOptions = collect($options)->map(function ($item, $key) {
        if (is_array($item)) {
            return [
                'value' => $item['value'] ?? $key,
                'label' => $item['label'] ?? $item['value'] ?? $key,
                'data'  => $item['data'] ?? [],
            ];
        }
        return [
            'value' => is_numeric($key) ? $item : $key,
            'label' => $item,
            'data'  => [],
        ];
    })->values()->toArray();

    $selectedItem = collect($normalizedOptions)->firstWhere('value', $selected);
    $initialLabel = $selectedItem['label'] ?? '';
    $initialValue = $selectedItem['value'] ?? '';
@endphp

<div id="{{ $componentId }}-wrapper" class="space-y-1.5 relative">
    @if($label)
        <label for="{{ $componentId }}-trigger" class="block text-xs font-semibold text-slate-700 dark:text-slate-300">
            {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    <input type="hidden" name="{{ $name }}" id="{{ $id ?? $componentId }}" value="{{ $initialValue }}" @if($required) required @endif />

    <button type="button" 
            id="{{ $componentId }}-trigger"
            class="flex w-full items-center justify-between rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100">
        <span id="{{ $componentId }}-label" class="{{ !$initialValue ? 'text-slate-400 dark:text-slate-500' : '' }}">
            {{ $initialLabel ?: $placeholder }}
        </span>
        <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
        </svg>
    </button>

    <div id="{{ $componentId }}-dropdown" 
         class="hidden absolute left-0 right-0 z-20 mt-1 max-h-60 w-full overflow-auto rounded-lg border border-slate-200 bg-white p-1.5 shadow-lg dark:border-slate-800 dark:bg-slate-900">
        
        <div class="p-1">
            <input type="text" 
                   id="{{ $componentId }}-search"
                   placeholder="Cari..." 
                   class="w-full rounded-md border border-slate-200 bg-slate-50 px-2.5 py-1.5 text-xs text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 dark:border-slate-800 dark:bg-slate-800 dark:text-slate-100" />
        </div>

        <ul id="{{ $componentId }}-list" class="mt-1 space-y-0.5 text-xs"></ul>
    </div>
</div>

<script>
(function() {
    function initSelectComponent() {
        const options = @json($normalizedOptions);
        let selectedValue = @json($initialValue);

        const wrapper = document.getElementById('{{ $componentId }}-wrapper');
        const trigger = document.getElementById('{{ $componentId }}-trigger');
        const label = document.getElementById('{{ $componentId }}-label');
        const hiddenInput = document.getElementById('{{ $id ?? $componentId }}');
        const dropdown = document.getElementById('{{ $componentId }}-dropdown');
        const searchInput = document.getElementById('{{ $componentId }}-search');
        const list = document.getElementById('{{ $componentId }}-list');

        if (!wrapper || wrapper.dataset.initialized) return;
        wrapper.dataset.initialized = 'true';

        function renderOptions(filterText = '') {
            list.innerHTML = '';
            const cleanFilter = filterText.trim().toLowerCase();
            const filtered = options.filter(opt => opt.label.toLowerCase().includes(cleanFilter));

            if (filtered.length === 0) {
                const emptyLi = document.createElement('li');
                emptyLi.className = 'px-2.5 py-1.5 text-slate-400 dark:text-slate-500 italic text-center';
                emptyLi.textContent = 'Tidak ditemukan';
                list.appendChild(emptyLi);
                return;
            }

            filtered.forEach(opt => {
                const li = document.createElement('li');
                li.className = 'flex cursor-pointer items-center justify-between rounded-md px-2.5 py-1.5 text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 dark:text-slate-300 dark:hover:bg-emerald-950/50 dark:hover:text-emerald-400';
                
                const textSpan = document.createElement('span');
                textSpan.textContent = opt.label;
                li.appendChild(textSpan);

                if (opt.value === selectedValue) {
                    const checkSvg = document.createElement('div');
                    checkSvg.innerHTML = `<svg class="h-3.5 w-3.5 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>`;
                    li.appendChild(checkSvg.firstChild);
                }

                li.addEventListener('click', () => selectOption(opt));
                list.appendChild(li);
            });
        }

        function selectOption(option) {
            selectedValue = option.value;
            hiddenInput.value = option.value;
            label.textContent = option.label;
            label.classList.remove('text-slate-400', 'dark:text-slate-500');

            const customerData = option.data || {};
            hiddenInput.dataset.selectedData = JSON.stringify(customerData);
            
            hiddenInput.dispatchEvent(new CustomEvent('select-change', {
                bubbles: true,
                detail: {
                    value: option.value,
                    data: customerData
                }
            }));

            hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));

            closeDropdown();
        }

        function openDropdown() {
            dropdown.classList.remove('hidden');
            searchInput.value = '';
            renderOptions();
            setTimeout(() => searchInput.focus(), 50);
        }

        function closeDropdown() {
            dropdown.classList.add('hidden');
            searchInput.value = '';
        }

        trigger.addEventListener('click', () => {
            if (dropdown.classList.contains('hidden')) {
                openDropdown();
            } else {
                closeDropdown();
            }
        });

        searchInput.addEventListener('input', (e) => renderOptions(e.target.value));

        searchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeDropdown();
            }
        });

        document.addEventListener('click', (e) => {
            if (!wrapper.contains(e.target)) {
                closeDropdown();
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSelectComponent);
    } else {
        initSelectComponent();
    }
})();
</script>