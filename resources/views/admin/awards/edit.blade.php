@extends('layouts.admin')

@section('page-title', 'Edit Award')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-bold text-gray-800">Edit Award</h1>
        <a href="{{ route('admin.awards.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back</a>
    </div>

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.awards.update', $award) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Award Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $award->title) }}" required
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none @error('title') border-red-400 @enderror"/>
                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Year <span class="text-red-500">*</span></label>
                <input type="number" name="year" value="{{ old('year', $award->year) }}" required
                    min="1990" max="{{ date('Y') + 1 }}"
                    class="w-40 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none @error('year') border-red-400 @enderror"/>
                @error('year')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Current Image --}}
            @if($award->image)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                <div class="flex items-center gap-4">
                    <img src="{{ Storage::url($award->image) }}" alt="{{ $award->title }}"
                         class="w-32 h-24 object-cover rounded-lg border border-gray-200"/>
                    <p class="text-xs text-gray-400">Upload a new image below to replace this one.</p>
                </div>
            </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ $award->image ? 'Replace Image' : 'Award Image' }}</label>
                <input type="file" name="image" accept="image/*"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100"
                    onchange="previewNewImage(this)"/>
                <img id="newPreview" src="#" alt="" class="w-32 h-24 object-cover rounded-lg mt-3 hidden"/>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="3"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">{{ old('description', $award->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $award->sort_order ?? 0) }}" min="0"
                    class="w-32 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                <p class="text-xs text-gray-400 mt-1">Lower numbers appear first.</p>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 mt-4">
            <a href="{{ route('admin.awards.index') }}" class="px-5 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition">Cancel</a>
            <button type="submit" class="px-6 py-2.5 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-lg font-semibold transition shadow-sm">Update Award</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function previewNewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('newPreview');
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
