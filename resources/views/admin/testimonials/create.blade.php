@extends('layouts.admin')

@section('page-title', 'Add Testimonial')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-bold text-gray-800">Add Testimonial</h1>
        <a href="{{ route('admin.testimonials.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back</a>
    </div>

    <form method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data"
        x-data="{ rating: {{ old('rating', 5) }} }">
        @csrf
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Client Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none @error('name') border-red-400 @enderror"/>
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Location / City</label>
                    <input type="text" name="location" value="{{ old('location') }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Property Purchased</label>
                    <input type="text" name="property_name" value="{{ old('property_name') }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                </div>
            </div>

            {{-- Star Rating --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Rating <span class="text-red-500">*</span></label>
                <div class="flex items-center gap-1">
                    <template x-for="star in [1,2,3,4,5]" :key="star">
                        <button type="button" @click="rating = star"
                            :class="star <= rating ? 'text-amber-400' : 'text-gray-200'"
                            class="focus:outline-none transition hover:scale-110">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </button>
                    </template>
                    <span class="ml-2 text-sm text-gray-500" x-text="rating + ' star' + (rating > 1 ? 's' : '')"></span>
                </div>
                <input type="hidden" name="rating" :value="rating"/>
                @error('rating')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Testimonial Content <span class="text-red-500">*</span></label>
                <textarea name="content" rows="4" required
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none @error('content') border-red-400 @enderror">{{ old('content') }}</textarea>
                @error('content')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Video URL (YouTube / Vimeo)</label>
                <input type="url" name="video_url" value="{{ old('video_url') }}" placeholder="https://youtu.be/…"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Photo (optional)</label>
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center">
                    <img id="photoPreview" src="#" alt="" class="w-20 h-20 rounded-full object-cover mx-auto mb-2 hidden"/>
                    <p id="photoPlaceholder" class="text-gray-400 text-xs mb-2">Client photo</p>
                    <input type="file" name="photo" id="photoInput" accept="image/*"
                        class="hidden" onchange="previewPhoto(this)"/>
                    <label for="photoInput" class="cursor-pointer text-xs text-amber-600 font-medium border border-amber-200 rounded-lg px-3 py-1.5 hover:bg-amber-50 transition">
                        Upload Photo
                    </label>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <input type="hidden" name="is_active" value="0"/>
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                    class="w-4 h-4 text-amber-500 rounded border-gray-300 focus:ring-amber-400"/>
                <label for="is_active" class="text-sm font-medium text-gray-700">Show on website</label>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 mt-4">
            <a href="{{ route('admin.testimonials.index') }}" class="px-5 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition">Cancel</a>
            <button type="submit" class="px-6 py-2.5 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-lg font-semibold transition shadow-sm">Save</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const p = document.getElementById('photoPreview');
            p.src = e.target.result; p.classList.remove('hidden');
            document.getElementById('photoPlaceholder').classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
