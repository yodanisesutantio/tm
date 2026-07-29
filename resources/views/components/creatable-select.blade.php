@props([
    'label' => null,
    'name',
    'options' => [],
    'selected' => null,
    'placeholder' => 'Pilih atau buat baru...',
    'required' => false,
])

@php
    $id = 'select-' . Str::random(8);
    $initialSelected = $selected ?? ($options[0] ?? '');
@endphp

<div id="{{ $id }}-wrapper" class="space-y-1.5 relative">
    @if($label)
        <label for="{{ $id }}-trigger" class="block text-xs font-semibold text-slate-700 dark:text-slate-300">
            {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    <input type="hidden" name="{{ $name }}" id="{{ $id }}-hidden" value="{{ $initialSelected }}" @if($required) required @endif />

    <button type="button" 
            id="{{ $id }}-trigger"
            class="flex w-full items-center justify-between rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100">
        <span id="{{ $id }}-label" class="{{ !$initialSelected ? 'text-slate-400 dark:text-slate-500' : '' }}">
            {{ $initialSelected ?: $placeholder }}
        </span>
        <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
        </svg>
    </button>

    <div id="{{ $id }}-dropdown" 
         class="hidden absolute left-0 right-0 z-20 mt-1 max-h-60 w-full overflow-auto rounded-lg border border-slate-200 bg-white p-1.5 shadow-lg dark:border-slate-800 dark:bg-slate-900">
        
        <div class="p-1">
            <input type="text" 
                   id="{{ $id }}-search"
                   placeholder="{{ $placeholder }}" 
                   class="w-full rounded-md border border-slate-200 bg-slate-50 px-2.5 py-1.5 text-xs text-slate-900 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 dark:border-slate-800 dark:bg-slate-800 dark:text-slate-100" />
        </div>

        <ul id="{{ $id }}-list" class="mt-1 space-y-0.5 text-xs"></ul>
    </div>
</div>

<script>
(function() {
    function initCreatableSelect() {
        const categories = @json($options);
        let selectedValue = @json($initialSelected);

        const wrapper = document.getElementById('{{ $id }}-wrapper');
        const trigger = document.getElementById('{{ $id }}-trigger');
        const label = document.getElementById('{{ $id }}-label');
        const hiddenInput = document.getElementById('{{ $id }}-hidden');
        const dropdown = document.getElementById('{{ $id }}-dropdown');
        const searchInput = document.getElementById('{{ $id }}-search');
        const list = document.getElementById('{{ $id }}-list');

        if (!wrapper || wrapper.dataset.initialized) return;
        wrapper.dataset.initialized = 'true';

        function renderOptions(filterText = '') {
            list.innerHTML = '';
            const cleanFilter = filterText.trim().toLowerCase();
            
            const filtered = categories.filter(cat => cat.toLowerCase().includes(cleanFilter));
            const exactMatch = categories.some(cat => cat.toLowerCase() === cleanFilter);

            filtered.forEach(cat => {
                const li = document.createElement('li');
                li.className = 'flex cursor-pointer items-center justify-between rounded-md px-2.5 py-1.5 text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 dark:text-slate-300 dark:hover:bg-emerald-950/50 dark:hover:text-emerald-400';
                
                const textSpan = document.createElement('span');
                textSpan.textContent = cat;
                li.appendChild(textSpan);

                if (cat === selectedValue) {
                    const checkSvg = document.createElement('div');
                    checkSvg.innerHTML = `<svg class="h-3.5 w-3.5 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>`;
                    li.appendChild(checkSvg.firstChild);
                }

                li.addEventListener('click', () => selectOption(cat));
                list.appendChild(li);
            });

            if (cleanFilter && !exactMatch) {
                const createLi = document.createElement('li');
                createLi.className = 'flex cursor-pointer items-center gap-1.5 rounded-md px-2.5 py-1.5 font-medium text-emerald-600 hover:bg-emerald-50 dark:text-emerald-400 dark:hover:bg-emerald-950/50';
                createLi.innerHTML = `
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Buat "<strong>${escapeHtml(filterText.trim())}</strong>"</span>
                `;

                createLi.addEventListener('click', () => createOption(filterText.trim()));
                list.appendChild(createLi);
            }
        }

        function selectOption(value) {
            selectedValue = value;
            hiddenInput.value = value;
            label.textContent = value;
            label.classList.remove('text-slate-400', 'dark:text-slate-500');
            closeDropdown();
        }

        function createOption(value) {
            if (!value) return;
            if (!categories.includes(value)) {
                categories.push(value);
            }
            selectOption(value);
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

        function escapeHtml(str) {
            return str.replace(/[&<>"']/g, match => ({
                '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
            }[match]));
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
            if (e.key === 'Enter') {
                e.preventDefault();
                const val = searchInput.value.trim();
                if (!val) return;

                const match = categories.find(c => c.toLowerCase() === val.toLowerCase());
                if (match) {
                    selectOption(match);
                } else {
                    createOption(val);
                }
            } else if (e.key === 'Escape') {
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
        document.addEventListener('DOMContentLoaded', initCreatableSelect);
    } else {
        initCreatableSelect();
    }
})();
</script>