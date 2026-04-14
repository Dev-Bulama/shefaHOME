@extends('layouts.admin')

@section('page-title', 'Edit Gallery Item')
@section('breadcrumb', 'Gallery')

@section('content')
<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.gallery.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-xl font-bold text-gray-800">Edit Gallery Item</h1>
    </div>

    <form method="POST" action="{{ route('admin.gallery.update', $galleryItem) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">

            {{-- Current file --}}
            <div class="bg-gray-50 rounded-xl p-4 text-center">
                @if($galleryItem->type === 'image')
                    <img src="{{ $galleryItem->file_url }}" class="max-h-40 mx-auto rounded-lg object-contain" alt="{{ $galleryItem->title }}">
                @else
                    <video src="{{ $galleryItem->file_url }}" class="max-h-40 mx-auto rounded-lg" controls></video>
                @endif
                <p class="text-xs text-gray-400 mt-2">Current file — upload a new one to replace</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" name="title" value="{{ old('title', $galleryItem->title) }}" required
                           class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#27AE22] focus:outline-none"/>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#27AE22] focus:outline-none">
                        @foreach(['general','projects','events','team','properties'] as $cat)
                        <option value="{{ $cat }}" {{ old('category',$galleryItem->category) === $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Replace {{ ucfirst($galleryItem->type) }}
                    </label>
                    @if($galleryItem->type === 'image')
                    <input type="file" name="file" accept="image/*"
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100"/>
                    @else
                    <input type="file" name="video_file" accept="video/*"
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100"/>
                    @endif
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Caption</label>
                    <textarea name="caption" rows="2" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#27AE22] focus:outline-none resize-none">{{ old('caption', $galleryItem->caption) }}</textarea>
                </div>

                <div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $galleryItem->is_featured) ? 'checked' : '' }} class="w-4 h-4 text-[#27AE22] rounded border-gray-300"/>
                        <span class="text-sm text-gray-700">Featured</span>
                    </label>
                </div>
                <div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $galleryItem->is_active) ? 'checked' : '' }} class="w-4 h-4 text-[#27AE22] rounded border-gray-300"/>
                        <span class="text-sm text-gray-700">Active</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex gap-3 mt-5">
            <button type="submit" class="px-8 py-2.5 bg-[#27AE22] hover:bg-[#1D9418] text-white text-sm font-semibold rounded-lg transition">
                Save Changes
            </button>
            <a href="{{ route('admin.gallery.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">
                Cancel
            </a>
            <form method="POST" action="{{ route('admin.gallery.destroy', $galleryItem) }}" class="ml-auto"
                  onsubmit="return confirm('Delete this item permanently?')">
                @csrf @method('DELETE')
                <button type="submit" class="px-6 py-2.5 bg-red-500 text-white text-sm font-semibold rounded-lg hover:bg-red-600 transition">
                    Delete
                </button>
            </form>
        </div>
    </form>
</div>
@endsection
