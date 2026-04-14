@extends('layouts.admin')

@section('page-title', 'Gallery')
@section('breadcrumb', 'Manage gallery images and videos')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h1 class="text-xl font-bold text-gray-800">Gallery</h1>
            <p class="text-sm text-gray-500 mt-0.5">Manage photos and videos shown on the public gallery page.</p>
        </div>
        <a href="{{ route('admin.gallery.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-[#27AE22] text-white text-sm font-semibold rounded-lg hover:bg-[#1D9418] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Item
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">{{ session('success') }}</div>
    @endif

    {{-- Category Filter --}}
    <div class="flex gap-2 flex-wrap">
        @foreach(['all' => 'All', 'general' => 'General', 'projects' => 'Projects', 'events' => 'Events', 'team' => 'Team', 'properties' => 'Properties'] as $key => $label)
        <a href="{{ route('admin.gallery.index', ['category' => $key]) }}"
           class="px-4 py-2 text-sm rounded-lg font-medium transition {{ $category === $key ? 'bg-[#1A237E] text-white' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50' }}">
            {{ $label }}
        </a>
        @endforeach
    </div>

    @if($items->isEmpty())
    <div class="bg-white rounded-xl border border-gray-100 p-16 text-center text-gray-400">
        <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <p class="text-sm font-medium">No gallery items yet.</p>
        <a href="{{ route('admin.gallery.create') }}" class="text-[#27AE22] text-sm mt-1 inline-block">Add your first item →</a>
    </div>
    @else
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
        @foreach($items as $item)
        <div class="group relative bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-all">
            <div class="aspect-square bg-gray-100 overflow-hidden">
                @if($item->type === 'image')
                    <img src="{{ $item->file_url }}" alt="{{ $item->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-800">
                        <video src="{{ $item->file_url }}" class="w-full h-full object-cover"></video>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-10 h-10 text-white opacity-80" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                    </div>
                @endif

                {{-- Overlay badges --}}
                <div class="absolute top-2 left-2 flex gap-1">
                    @if($item->is_featured)
                    <span class="bg-[#27AE22] text-white text-xs px-1.5 py-0.5 rounded-full font-medium">★</span>
                    @endif
                    @if(!$item->is_active)
                    <span class="bg-gray-500 text-white text-xs px-1.5 py-0.5 rounded-full font-medium">Hidden</span>
                    @endif
                </div>

                {{-- Action overlay --}}
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                    <a href="{{ route('admin.gallery.edit', $item) }}"
                       class="bg-white text-gray-800 text-xs font-semibold px-3 py-1.5 rounded-lg hover:bg-gray-100 transition">
                        Edit
                    </a>
                    <form method="POST" action="{{ route('admin.gallery.destroy', $item) }}"
                          onsubmit="return confirm('Delete this item?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white text-xs font-semibold px-3 py-1.5 rounded-lg hover:bg-red-600 transition">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="p-3">
                <p class="text-xs font-medium text-gray-800 truncate">{{ $item->title }}</p>
                <div class="flex items-center justify-between mt-1">
                    <span class="text-xs text-gray-400 capitalize">{{ $item->category }}</span>
                    <span class="text-xs px-1.5 py-0.5 rounded-full {{ $item->type === 'video' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                        {{ ucfirst($item->type) }}
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4">{{ $items->links() }}</div>
    @endif
</div>
@endsection
