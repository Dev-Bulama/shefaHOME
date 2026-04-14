@extends('layouts.admin')

@section('page-title', 'Add Gallery Item')
@section('breadcrumb', 'Gallery')

@section('content')
<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.gallery.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-xl font-bold text-gray-800">Add Gallery Item</h1>
    </div>

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm mb-5">
        <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data"
          x-data="{ type: 'image', preview: null }">
        @csrf

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">

            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#27AE22] focus:outline-none"/>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                    <select name="type" x-model="type" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#27AE22] focus:outline-none">
                        <option value="image">Image</option>
                        <option value="video">Video</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#27AE22] focus:outline-none">
                        <option value="general">General</option>
                        <option value="projects">Projects</option>
                        <option value="events">Events</option>
                        <option value="team">Team</option>
                        <option value="properties">Properties</option>
                    </select>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2" x-text="type === 'video' ? 'Video File *' : 'Image *'"></label>

                    <div x-show="type === 'image'">
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer hover:border-[#27AE22] transition"
                             @click="$refs.imageInput.click()">
                            <img x-show="preview" :src="preview" class="max-h-40 mx-auto mb-2 rounded-lg object-contain">
                            <svg x-show="!preview" class="w-10 h-10 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-sm text-gray-500" x-show="!preview">Click to select image</p>
                        </div>
                        <input type="file" name="file" accept="image/*" x-ref="imageInput" class="hidden"
                               @change="preview = URL.createObjectURL($event.target.files[0])">
                    </div>

                    <div x-show="type === 'video'">
                        <input type="file" name="video_file" accept="video/*"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100"/>
                        <p class="text-xs text-gray-400 mt-1">MP4, MOV, WebM — Max 100MB</p>
                    </div>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Caption</label>
                    <textarea name="caption" rows="2" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#27AE22] focus:outline-none resize-none">{{ old('caption') }}</textarea>
                </div>

                <div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="w-4 h-4 text-[#27AE22] rounded border-gray-300"/>
                        <span class="text-sm text-gray-700">Featured (shown prominently)</span>
                    </label>
                </div>
                <div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-[#27AE22] rounded border-gray-300"/>
                        <span class="text-sm text-gray-700">Active (visible to public)</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex gap-3 mt-5">
            <button type="submit" class="px-8 py-2.5 bg-[#27AE22] hover:bg-[#1D9418] text-white text-sm font-semibold rounded-lg transition">
                Add to Gallery
            </button>
            <a href="{{ route('admin.gallery.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
