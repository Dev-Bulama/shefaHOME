@extends('layouts.admin')

@section('title', 'Add Property Type')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    {{-- Page Header --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.property-types.index') }}"
           class="text-gray-400 hover:text-[#0A1628] transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h2 class="text-xl font-bold text-[#0A1628]">Add Property Type</h2>
            <p class="text-sm text-gray-500 mt-0.5">Create a new property category for listings.</p>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form action="{{ route('admin.property-types.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Name <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       placeholder="e.g. Detached Duplex"
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C] transition @error('name') border-red-400 @enderror"
                       oninput="generateSlug(this.value)">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Slug (auto-generated) --}}
            <div>
                <label for="slug" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Slug
                    <span class="text-xs font-normal text-gray-400 ml-1">(auto-generated, editable)</span>
                </label>
                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-[#C9A84C]/40 focus-within:border-[#C9A84C] transition @error('slug') border-red-400 @enderror">
                    <span class="px-3 py-2.5 text-sm text-gray-400 bg-gray-50 border-r border-gray-300 select-none">/types/</span>
                    <input type="text" id="slug" name="slug" value="{{ old('slug') }}"
                           placeholder="detached-duplex"
                           class="flex-1 px-3.5 py-2.5 text-sm focus:outline-none bg-white">
                </div>
                @error('slug')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Icon --}}
            <div>
                <label for="icon" class="block text-sm font-semibold text-gray-700 mb-1.5">Icon</label>
                <div class="flex items-center gap-3">
                    <input type="text" id="icon" name="icon" value="{{ old('icon') }}"
                           placeholder="e.g. 🏠 or fa-home"
                           class="flex-1 border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C] transition @error('icon') border-red-400 @enderror">
                    <div id="iconPreviewBox"
                         class="w-12 h-12 bg-[#0A1628]/5 rounded-xl flex items-center justify-center text-2xl border border-gray-200 flex-shrink-0 transition-all">
                        ?
                    </div>
                </div>
                <p class="text-xs text-gray-400 mt-1">Use an emoji (🏠 🏗️ 🏢 🌳) or a CSS icon class name.</p>
                @error('icon')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1.5">Description</label>
                <textarea id="description" name="description" rows="3"
                          placeholder="Brief description of this property type..."
                          class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C] transition resize-none @error('description') border-red-400 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="bg-[#C9A84C] hover:bg-[#b8963e] text-white text-sm font-semibold px-6 py-2.5 rounded-lg transition-colors shadow-sm">
                    Save Type
                </button>
                <a href="{{ route('admin.property-types.index') }}"
                   class="text-gray-500 hover:text-gray-700 text-sm font-medium transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</div>
@endsection

@push('scripts')
<script>
    function generateSlug(value) {
        const slug = value
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
        document.getElementById('slug').value = slug;
    }

    document.getElementById('icon').addEventListener('input', function () {
        document.getElementById('iconPreviewBox').textContent = this.value || '?';
    });
</script>
@endpush
