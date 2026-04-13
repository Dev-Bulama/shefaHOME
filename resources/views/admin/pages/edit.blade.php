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
    <form method="POST" action="{{ route('admin.pages.update', $page) }}">
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
                                <form method="POST" action="{{ route('admin.pages.deleteField', $field->id) }}"
                                      onsubmit="return confirm('Remove this field?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition p-0.5" title="Remove field">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </form>
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
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <div class="bg-gray-50 border-b border-gray-200 px-3 py-1.5 text-xs text-gray-400">HTML allowed — use &lt;p&gt;, &lt;ul&gt;, &lt;li&gt;, &lt;strong&gt;, etc.</div>
                            <textarea name="content[{{ $field->section }}][{{ $field->key }}]"
                                      rows="6"
                                      class="w-full px-3 py-2 text-sm font-mono focus:outline-none resize-y focus:ring-2 focus:ring-[#27AE22]">{{ $field->value }}</textarea>
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
@endsection
