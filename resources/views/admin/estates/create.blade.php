@extends('layouts.admin')

@section('title', 'Add Estate')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    {{-- Page Header --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.estates.index') }}"
           class="text-gray-400 hover:text-[#1A237E] transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h2 class="text-xl font-bold text-[#1A237E]">Add Estate</h2>
            <p class="text-sm text-gray-500 mt-0.5">Create a new estate or development project.</p>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form action="{{ route('admin.estates.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Estate Name <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       placeholder="e.g. Shefa Greens Phase 1"
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22]/40 focus:border-[#27AE22] transition @error('name') border-red-400 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- State --}}
            <div>
                <label for="state" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    State <span class="text-red-500">*</span>
                </label>
                <select id="state" name="state" required
                        class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22]/40 focus:border-[#27AE22] transition bg-white @error('state') border-red-400 @enderror">
                    <option value="">— Select state —</option>
                    @php
                        $nigerianStates = [
                            'Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa',
                            'Benue', 'Borno', 'Cross River', 'Delta', 'Ebonyi', 'Edo',
                            'Ekiti', 'Enugu', 'FCT - Abuja', 'Gombe', 'Imo', 'Jigawa',
                            'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi', 'Kwara',
                            'Lagos', 'Nasarawa', 'Niger', 'Ogun', 'Ondo', 'Osun',
                            'Oyo', 'Plateau', 'Rivers', 'Sokoto', 'Taraba', 'Yobe', 'Zamfara',
                        ];
                    @endphp
                    @foreach($nigerianStates as $stateName)
                        <option value="{{ $stateName }}" {{ old('state') === $stateName ? 'selected' : '' }}>
                            {{ $stateName }}
                        </option>
                    @endforeach
                </select>
                @error('state')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1.5">Description</label>
                <textarea id="description" name="description" rows="4"
                          placeholder="Brief description of the estate, amenities, location highlights..."
                          class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22]/40 focus:border-[#27AE22] transition resize-none @error('description') border-red-400 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Cover Image --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Cover Image</label>
                <div class="border-2 border-dashed border-gray-200 rounded-lg p-4 hover:border-[#27AE22]/50 transition-colors">
                    <input type="file" id="cover_image" name="cover_image" accept="image/*"
                           onchange="document.getElementById('coverPreview').src=URL.createObjectURL(this.files[0])"
                           class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#1A237E] file:text-white hover:file:bg-[#27AE22] file:cursor-pointer file:transition-colors">
                    <img id="coverPreview" src="" alt="Cover image preview"
                         class="mt-3 h-32 w-auto rounded-lg object-cover border border-gray-100 hidden"
                         onerror="this.classList.add('hidden')"
                         onload="this.classList.remove('hidden')">
                </div>
                <p class="text-xs text-gray-400 mt-1">Recommended: landscape orientation, min 1200×630px, max 5MB.</p>
                @error('cover_image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Is Active --}}
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div>
                    <p class="text-sm font-semibold text-gray-700">Active</p>
                    <p class="text-xs text-gray-400 mt-0.5">Publish this estate on the website.</p>
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
                    Save Estate
                </button>
                <a href="{{ route('admin.estates.index') }}"
                   class="text-gray-500 hover:text-gray-700 text-sm font-medium transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
