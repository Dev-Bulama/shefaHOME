@extends('layouts.admin')

@section('title', 'Add Virtual Tour')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    {{-- Page Header --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.virtual-tours.index') }}"
           class="text-gray-400 hover:text-[#1A237E] transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h2 class="text-xl font-bold text-[#1A237E]">Add Virtual Tour</h2>
            <p class="text-sm text-gray-500 mt-0.5">Attach a virtual tour to a property listing.</p>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form action="{{ route('admin.virtual-tours.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Tour Title <span class="text-red-500">*</span>
                </label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required
                       placeholder="e.g. Lekki Gardens Phase 3 – Full Walkthrough"
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22]/40 focus:border-[#27AE22] transition @error('title') border-red-400 @enderror">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Property --}}
            <div>
                <label for="property_id" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Property <span class="text-red-500">*</span>
                </label>
                <select id="property_id" name="property_id" required
                        class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22]/40 focus:border-[#27AE22] transition bg-white @error('property_id') border-red-400 @enderror">
                    <option value="">— Select a property —</option>
                    @foreach($properties as $property)
                        <option value="{{ $property->id }}" {{ old('property_id') == $property->id ? 'selected' : '' }}>
                            {{ $property->name }}
                        </option>
                    @endforeach
                </select>
                @error('property_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tour Type --}}
            <div>
                <label for="type" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Tour Type <span class="text-red-500">*</span>
                </label>
                <select id="type" name="type" required
                        class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22]/40 focus:border-[#27AE22] transition bg-white @error('type') border-red-400 @enderror">
                    <option value="">— Select type —</option>
                    <option value="youtube"    {{ old('type') === 'youtube'    ? 'selected' : '' }}>YouTube</option>
                    <option value="matterport" {{ old('type') === 'matterport' ? 'selected' : '' }}>Matterport</option>
                    <option value="other"      {{ old('type') === 'other'      ? 'selected' : '' }}>Other</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Embed URL --}}
            <div>
                <label for="embed_url" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Embed URL <span class="text-red-500">*</span>
                </label>
                <input type="url" id="embed_url" name="embed_url" value="{{ old('embed_url') }}" required
                       placeholder="https://www.youtube.com/embed/... or https://my.matterport.com/show/..."
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22]/40 focus:border-[#27AE22] transition @error('embed_url') border-red-400 @enderror">
                <p class="text-xs text-gray-400 mt-1">Paste the embeddable iframe URL (not the share link).</p>
                @error('embed_url')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Thumbnail Upload --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Thumbnail Image</label>
                <div class="border-2 border-dashed border-gray-200 rounded-lg p-4 hover:border-[#27AE22]/50 transition-colors">
                    <input type="file" id="thumbnail" name="thumbnail" accept="image/*"
                           onchange="document.getElementById('thumbPreview').src=URL.createObjectURL(this.files[0])"
                           class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#1A237E] file:text-white hover:file:bg-[#27AE22] file:cursor-pointer file:transition-colors">
                    <img id="thumbPreview" src="" alt="Thumbnail preview"
                         class="mt-3 h-32 w-auto rounded-lg object-cover border border-gray-100 hidden"
                         onerror="this.classList.add('hidden')"
                         onload="this.classList.remove('hidden')">
                </div>
                <p class="text-xs text-gray-400 mt-1">Recommended: 16:9 ratio, min 640×360px, max 3MB.</p>
                @error('thumbnail')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Is Active --}}
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div>
                    <p class="text-sm font-semibold text-gray-700">Active</p>
                    <p class="text-xs text-gray-400 mt-0.5">Show this tour on the property listing.</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                           {{ old('is_active', true) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#27AE22]/40 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#27AE22]"></div>
                </label>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="bg-[#27AE22] hover:bg-[#b8963e] text-white text-sm font-semibold px-6 py-2.5 rounded-lg transition-colors shadow-sm">
                    Save Tour
                </button>
                <a href="{{ route('admin.virtual-tours.index') }}"
                   class="text-gray-500 hover:text-gray-700 text-sm font-medium transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
