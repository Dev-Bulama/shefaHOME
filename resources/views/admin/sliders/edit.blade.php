@extends('layouts.admin')

@section('page-title', 'Edit Slider')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <h1 class="text-xl font-bold text-gray-800">Edit Slider</h1>
        <a href="{{ route('admin.sliders.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back</a>
    </div>

    <form method="POST" action="{{ route('admin.sliders.update', $slider) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">

            @if($slider->image)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                <img src="{{ Storage::url($slider->image) }}" class="w-full max-h-48 object-cover rounded-xl border"/>
            </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Replace Image</label>
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center">
                    <img id="sliderPreview" src="#" alt="" class="mx-auto mb-3 w-full max-h-48 object-cover rounded-lg hidden"/>
                    <p id="sliderPlaceholder" class="text-gray-400 text-sm mb-3">Click to select a new image</p>
                    <input type="file" name="image" id="sliderImage" accept="image/*"
                        class="hidden" onchange="previewSlider(this)"/>
                    <label for="sliderImage" class="cursor-pointer bg-amber-500 hover:bg-amber-600 text-white text-sm px-4 py-2 rounded-lg font-medium transition">
                        Choose Image
                    </label>
                </div>
                @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title', $slider->title) }}"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
                <input type="text" name="subtitle" value="{{ old('subtitle', $slider->subtitle) }}"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Text Position</label>
                <select name="position" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">
                    @foreach(['center' => 'Center', 'left' => 'Left', 'right' => 'Right'] as $val => $lbl)
                    <option value="{{ $val }}" {{ old('position', $slider->position) == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">CTA Button Text</label>
                    <input type="text" name="cta_text" value="{{ old('cta_text', $slider->cta_text) }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">CTA Link URL</label>
                    <input type="text" name="cta_url" value="{{ old('cta_url', $slider->cta_url) }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <input type="hidden" name="is_active" value="0"/>
                <input type="checkbox" name="is_active" id="is_active" value="1"
                    {{ old('is_active', $slider->is_active) ? 'checked' : '' }}
                    class="w-4 h-4 text-amber-500 rounded border-gray-300 focus:ring-amber-400"/>
                <label for="is_active" class="text-sm font-medium text-gray-700">Active (show on website)</label>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 mt-4">
            <a href="{{ route('admin.sliders.index') }}" class="px-5 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition">Cancel</a>
            <button type="submit" class="px-6 py-2.5 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-lg font-semibold transition shadow-sm">
                Update Slider
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function previewSlider(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const p = document.getElementById('sliderPreview');
            p.src = e.target.result; p.classList.remove('hidden');
            document.getElementById('sliderPlaceholder').classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
