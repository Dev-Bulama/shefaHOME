@extends('layouts.admin')

@section('page-title', 'Edit – '.$pageName)
@section('breadcrumb', 'Page Content')

@section('content')
<div x-data="{ showAddField: false }" class="space-y-6">

    <div class="flex items-center justify-between flex-wrap gap-3">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.pages.index') }}"
               class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h1 class="text-xl font-bold text-gray-800">{{ $pageName }}</h1>
                <p class="text-sm text-gray-500">Edit content fields — changes are saved immediately.</p>
            </div>
        </div>
        <div class="flex gap-2">
            <button @click="showAddField = !showAddField"
                    class="inline-flex items-center gap-2 px-4 py-2 border border-[#1A237E]/30 text-[#1A237E] text-sm font-medium rounded-lg hover:bg-[#1A237E]/5 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Field
            </button>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">{{ session('success') }}</div>
    @endif

    {{-- Add Field Form --}}
    <div x-show="showAddField" x-transition class="bg-blue-50 border border-blue-200 rounded-xl p-5" style="display:none;">
        <h3 class="font-semibold text-gray-800 mb-4 text-sm">Add New Content Field</h3>
        <form method="POST" action="{{ route('admin.pages.addField', $page) }}">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Section Key <span class="text-red-500">*</span></label>
                    <input type="text" name="section" required placeholder="e.g. hero" pattern="[a-z0-9_-]+"
                           class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#27AE22] focus:outline-none font-mono"/>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Field Key <span class="text-red-500">*</span></label>
                    <input type="text" name="key" required placeholder="e.g. title" pattern="[a-z0-9_-]+"
                           class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#27AE22] focus:outline-none font-mono"/>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Label <span class="text-red-500">*</span></label>
                    <input type="text" name="label" required placeholder="e.g. Hero Title"
                           class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#27AE22] focus:outline-none"/>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Type <span class="text-red-500">*</span></label>
                    <select name="type" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#27AE22] focus:outline-none">
                        <option value="text">Text (single line)</option>
                        <option value="textarea">Textarea (multi-line)</option>
                        <option value="html">HTML / Rich Text</option>
                        <option value="url">URL / Link</option>
                        <option value="image">Image (media picker)</option>
                        <option value="boolean">Visible toggle (on/off)</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-[#27AE22] hover:bg-[#1D9418] text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                        Add Field
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Content form --}}
    <form method="POST" action="{{ route('admin.pages.update', $page) }}" enctype="multipart/form-data">
        @csrf

        @if($rows->isEmpty())
        <div class="bg-white rounded-xl border border-gray-100 p-10 text-center">
            <p class="text-gray-400 text-sm">No content fields found for this page.</p>
            <p class="text-gray-400 text-xs mt-1">Use the "Add Field" button above to create your first field.</p>
        </div>
        @else

        @foreach($rows as $section => $fields)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-4">
            <div class="px-5 py-3 bg-gray-50 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">
                    {{ ucwords(str_replace(['-','_'], ' ', $section)) }}
                </h3>
                <span class="text-xs text-gray-400 font-mono">section: {{ $section }}</span>
            </div>

            <div class="p-5 space-y-5">
                @foreach($fields as $field)
                <div class="flex items-start gap-3">
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="block text-sm font-medium text-gray-700">{{ $field->label }}</label>
                            <div class="flex items-center gap-2">
                                <span class="text-xs text-gray-400 font-mono">{{ $field->section }}.{{ $field->key }}</span>
                                <button type="button"
                                        onclick="deleteField({{ $field->id }}, this)"
                                        class="text-red-400 hover:text-red-600 transition p-0.5" title="Remove field">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        @if($field->type === 'text' || $field->type === 'url')
                        <input type="text"
                               name="content[{{ $field->section }}][{{ $field->key }}]"
                               value="{{ $field->value }}"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#27AE22] focus:outline-none {{ $field->type === 'url' ? 'font-mono' : '' }}"
                               placeholder="{{ $field->type === 'url' ? 'https:// or /path' : $field->label }}"/>

                        @elseif($field->type === 'textarea')
                        <textarea name="content[{{ $field->section }}][{{ $field->key }}]"
                                  rows="3"
                                  class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#27AE22] focus:outline-none resize-y">{{ $field->value }}</textarea>

                        @elseif($field->type === 'html')
                        @php
                            $qId      = 'quill_'.preg_replace('/[^a-z0-9]/i','_',$field->section.'_'.$field->key);
                            $qInitVal = preg_replace('/<(style|script)[^>]*>.*?<\/\1>/is', '', $field->value ?? '');
                        @endphp
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            {{-- WYSIWYG editor (Quill attaches here) --}}
                            <div id="{{ $qId }}" data-initial="{!! htmlspecialchars($qInitVal, ENT_QUOTES) !!}" style="min-height:220px;"></div>
                            {{-- Source / raw-HTML mode --}}
                            <textarea id="{{ $qId }}_source"
                                      class="w-full px-3 py-2 text-sm font-mono focus:outline-none resize-y border-t border-gray-200"
                                      style="display:none; min-height:220px;"></textarea>
                            {{-- Footer bar --}}
                            <div class="flex items-center justify-between gap-2 px-3 py-2 bg-gray-50 border-t border-gray-200">
                                <button type="button"
                                        id="{{ $qId }}_toggle"
                                        onclick="toggleHtmlSource('{{ $qId }}')"
                                        class="inline-flex items-center gap-1 text-xs font-mono font-semibold text-gray-500 hover:text-[#1A237E] border border-gray-200 hover:border-[#1A237E] px-2 py-1 rounded transition">
                                    &lt;/&gt; Source
                                </button>
                                <span class="text-xs text-gray-400">Tip: use &lt;/&gt; Source to paste raw HTML</span>
                            </div>
                            {{-- Hidden submit target --}}
                            <textarea name="content[{{ $field->section }}][{{ $field->key }}]"
                                      id="{{ $qId }}_input"
                                      class="hidden">{{ $field->value }}</textarea>
                        </div>

                        @elseif($field->type === 'boolean')
                        <div class="flex items-center gap-3">
                            <input type="hidden" name="content[{{ $field->section }}][{{ $field->key }}]" value="0">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="content[{{ $field->section }}][{{ $field->key }}]" value="1"
                                       {{ $field->value == '1' ? 'checked' : '' }}
                                       class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#27AE22]"></div>
                            </label>
                            <span class="text-sm text-gray-600">{{ $field->value == '1' ? 'Visible (on)' : 'Hidden (off)' }}</span>
                        </div>

                        @elseif($field->type === 'image')
                        @php $fieldId = 'img_'.preg_replace('/[^a-z0-9]/i','_', $field->section.'_'.$field->key); @endphp
                        <div x-data="{
                            url: '{{ $field->value }}',
                            showPicker: false,
                            pickerImages: [],
                            async openPicker() {
                                this.showPicker = true;
                                if (this.pickerImages.length) return;
                                const res = await fetch('{{ route('admin.media.picker') }}?type=image');
                                this.pickerImages = await res.json();
                            },
                            pick(imgUrl) { this.url = imgUrl; this.showPicker = false; }
                        }">
                            {{-- Preview + URL bar --}}
                            <div class="flex gap-3 items-start">
                                <div class="w-24 h-24 rounded-lg border-2 border-gray-200 overflow-hidden flex-shrink-0 bg-gray-50">
                                    <img :src="url || ''" x-show="url"
                                         class="w-full h-full object-cover">
                                    <div x-show="!url" class="w-full h-full flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 space-y-2">
                                    <input type="text" :value="url" @input="url = $event.target.value"
                                           name="content[{{ $field->section }}][{{ $field->key }}]"
                                           placeholder="Image URL or pick from library"
                                           class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm font-mono focus:ring-2 focus:ring-[#27AE22] focus:outline-none"/>
                                    <button type="button" @click="openPicker()"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#1A237E]/5 hover:bg-[#1A237E]/10 text-[#1A237E] text-xs font-semibold rounded-lg transition border border-[#1A237E]/20">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Browse Media Library
                                    </button>
                                </div>
                            </div>

                            {{-- Media Picker Overlay --}}
                            <div x-show="showPicker" @click.self="showPicker=false"
                                 class="fixed inset-0 z-50 bg-black/60 flex items-end sm:items-center justify-center p-4"
                                 style="display:none;">
                                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[80vh] flex flex-col" @click.stop>
                                    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100 flex-shrink-0">
                                        <h3 class="font-semibold text-gray-800">Media Library — Pick an Image</h3>
                                        <button @click="showPicker=false" class="text-gray-400 hover:text-gray-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </div>
                                    <div class="overflow-y-auto p-4">
                                        <div x-show="!pickerImages.length" class="text-center py-10 text-gray-400 text-sm">No images found. Upload some in the Media Library first.</div>
                                        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3">
                                            <template x-for="img in pickerImages" :key="img.id">
                                                <button type="button" @click="pick(img.url)"
                                                        class="aspect-square rounded-xl overflow-hidden border-2 border-transparent hover:border-[#27AE22] transition-all focus:outline-none focus:border-[#27AE22]">
                                                    <img :src="img.url" :alt="img.name" class="w-full h-full object-cover">
                                                </button>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

        <div class="flex items-center justify-between pt-2">
            <a href="{{ route('admin.pages.index') }}" class="text-sm text-gray-500 hover:text-gray-700 transition">← Back to Pages</a>
            <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#27AE22] hover:bg-[#1D9418] text-white text-sm font-semibold rounded-lg transition shadow-sm hover:shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Save Changes
            </button>
        </div>
        @endif
    </form>

</div>
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css">
<style>
    .ql-toolbar.ql-snow { border-top:none; border-left:none; border-right:none; background:#f9fafb; }
    .ql-container.ql-snow { border:none; font-size:0.9rem; }
    .ql-editor { min-height:200px; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
<script>
(function () {
    const toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote'],
        [{ header: [1, 2, 3, false] }],
        [{ list: 'ordered' }, { list: 'bullet' }],
        [{ color: [] }, { background: [] }],
        ['link'],
        ['clean']
    ];

    // Map of editorId -> Quill instance, used by the source toggle
    window._quillMap = {};
    const editors = [];

    document.querySelectorAll('[id^="quill_"]:not([id$="_input"]):not([id$="_source"])').forEach(function (el) {
        try {
            const initialHTML = el.dataset.initial || '';
            const q = new Quill(el, { theme: 'snow', modules: { toolbar: toolbarOptions } });
            if (initialHTML.trim()) {
                // dangerouslyPasteHTML correctly maps <h3>, <ul>, <li> etc to Quill's Delta
                q.clipboard.dangerouslyPasteHTML(initialHTML);
            }
            window._quillMap[el.id] = q;
            editors.push({ quill: q, inputId: el.id + '_input' });
        } catch (err) {
            console.warn('Quill init failed for', el.id, err);
        }
    });

    document.querySelector('form[action*="pages"]').addEventListener('submit', function () {
        editors.forEach(function (e) {
            const ta = document.getElementById(e.inputId);
            if (!ta) return;
            const srcId = e.inputId.slice(0, -'_input'.length) + '_source';
            const src   = document.getElementById(srcId);
            // Use computed style — reliable regardless of whether display came from class or inline
            const srcVisible = src && window.getComputedStyle(src).display !== 'none';
            ta.value = srcVisible ? src.value : e.quill.root.innerHTML;
        });
    });
})();

// Source toggle — called by each field's button
window.toggleHtmlSource = function (qId) {
    const editorEl  = document.getElementById(qId);
    const sourceEl  = document.getElementById(qId + '_source');
    const toggleBtn = document.getElementById(qId + '_toggle');
    const q         = window._quillMap[qId];
    if (!editorEl || !sourceEl || !q) return;

    // Use computed style to check current state
    const inSource = window.getComputedStyle(sourceEl).display !== 'none';

    if (inSource) {
        // Source → WYSIWYG: load raw HTML into Quill
        q.clipboard.dangerouslyPasteHTML(sourceEl.value);
        sourceEl.style.display = 'none';
        editorEl.closest('.ql-container') && (editorEl.closest('.ql-container').style.display = '');
        const wrap = editorEl.parentElement;
        const toolbar = wrap ? wrap.querySelector('.ql-toolbar') : null;
        if (toolbar) toolbar.style.display = '';
        toggleBtn.textContent = '</> Source';
    } else {
        // WYSIWYG → Source: copy Quill HTML to textarea
        sourceEl.value = q.root.innerHTML;
        sourceEl.style.display = 'block';
        // Hide the Quill editor area (but not the container wrapping div)
        const wrap = editorEl.parentElement;
        const toolbar = wrap ? wrap.querySelector('.ql-toolbar') : null;
        if (toolbar) toolbar.style.display = 'none';
        editorEl.closest('.ql-container') && (editorEl.closest('.ql-container').style.display = 'none');
        toggleBtn.textContent = 'WYSIWYG';
    }
};
</script>
@endpush

@push('scripts')
<script>
function deleteField(id, btn) {
    if (!confirm('Remove this field?')) return;
    btn.disabled = true;
    fetch('/admin/pages/fields/' + id, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ _method: 'DELETE' })
    }).then(r => {
        if (r.ok || r.redirected) location.reload();
        else { alert('Delete failed.'); btn.disabled = false; }
    }).catch(() => { alert('Delete failed.'); btn.disabled = false; });
}
</script>
@endpush
@endsection
