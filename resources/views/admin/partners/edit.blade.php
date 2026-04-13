@extends('layouts.admin')

@section('title', 'Edit Partner')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    {{-- Page Header --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.partners.index') }}"
           class="text-gray-400 hover:text-[#1A237E] transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h2 class="text-xl font-bold text-[#1A237E]">Edit Partner</h2>
            <p class="text-sm text-gray-500 mt-0.5">Update details for <strong>{{ $partner->name }}</strong>.</p>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form action="{{ route('admin.partners.update', $partner) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Partner Name <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name', $partner->name) }}" required
                       placeholder="e.g. Dangote Group"
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22]/40 focus:border-[#27AE22] transition @error('name') border-red-400 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Logo Upload --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Logo</label>
                <div class="border-2 border-dashed border-gray-200 rounded-lg p-4 hover:border-[#27AE22]/50 transition-colors">
                    {{-- Current logo preview --}}
                    @if($partner->logo)
                    <div class="mb-3">
                        <p class="text-xs text-gray-500 mb-1.5">Current logo:</p>
                        <img id="logoPreview"
                             src="{{ Storage::url($partner->logo) }}"
                             alt="{{ $partner->name }}"
                             class="h-20 w-auto rounded object-contain border border-gray-100 bg-gray-50 p-2">
                    </div>
                    @else
                    <img id="logoPreview" src="" alt="Logo preview"
                         class="mb-3 h-20 w-auto rounded object-contain border border-gray-100 bg-gray-50 p-2 hidden"
                         onerror="this.classList.add('hidden')"
                         onload="this.classList.remove('hidden')">
                    @endif
                    <input type="file" id="logo" name="logo" accept="image/*"
                           onchange="document.getElementById('logoPreview').src=URL.createObjectURL(this.files[0]);document.getElementById('logoPreview').classList.remove('hidden')"
                           class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#1A237E] file:text-white hover:file:bg-[#27AE22] file:cursor-pointer file:transition-colors">
                </div>
                <p class="text-xs text-gray-400 mt-1">Leave empty to keep the current logo. Max 2MB.</p>
                @error('logo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Website URL --}}
            <div>
                <label for="website" class="block text-sm font-semibold text-gray-700 mb-1.5">Website URL</label>
                <input type="url" id="website" name="website" value="{{ old('website', $partner->website) }}"
                       placeholder="https://example.com"
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22]/40 focus:border-[#27AE22] transition @error('website') border-red-400 @enderror">
                @error('website')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Sort Order --}}
            <div>
                <label for="sort_order" class="block text-sm font-semibold text-gray-700 mb-1.5">Sort Order</label>
                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $partner->sort_order) }}" min="0"
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22]/40 focus:border-[#27AE22] transition @error('sort_order') border-red-400 @enderror">
                <p class="text-xs text-gray-400 mt-1">Lower numbers appear first.</p>
                @error('sort_order')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Is Active --}}
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div>
                    <p class="text-sm font-semibold text-gray-700">Active</p>
                    <p class="text-xs text-gray-400 mt-0.5">Show this partner on the website.</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                           {{ old('is_active', $partner->is_active) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#27AE22]/40 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#27AE22]"></div>
                </label>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="bg-[#27AE22] hover:bg-[#b8963e] text-white text-sm font-semibold px-6 py-2.5 rounded-lg transition-colors shadow-sm">
                    Update Partner
                </button>
                <a href="{{ route('admin.partners.index') }}"
                   class="text-gray-500 hover:text-gray-700 text-sm font-medium transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
