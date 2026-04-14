@extends('layouts.app')

@section('title', 'Gallery — Shefa Homes and Properties Ltd')
@section('description', 'Explore our portfolio of completed estates, community events, and property development projects across Nigeria.')

@section('content')

{{-- Hero --}}
<section class="relative bg-[#1A237E] py-24 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-[#1A237E] to-[#0D1566]"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 opacity-10 rounded-full" style="background:radial-gradient(circle, #27AE22, transparent 70%)"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-4">Our Portfolio</span>
        <h1 class="font-display text-5xl lg:text-6xl font-bold text-white mb-5">Gallery</h1>
        <p class="text-gray-300 text-xl max-w-2xl mx-auto">Explore our completed projects, community events, and real estate developments across Nigeria.</p>
    </div>
</section>

{{-- Category Filter --}}
<section class="bg-white border-b border-gray-100 sticky top-20 z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex gap-1 py-3 overflow-x-auto">
            @foreach(['all' => 'All', 'projects' => 'Projects', 'properties' => 'Properties', 'events' => 'Events', 'team' => 'Team', 'general' => 'General'] as $key => $label)
            @if($key === 'all' || $categories->contains($key))
            <a href="{{ route('gallery', ['category' => $key]) }}"
               class="px-5 py-2 text-sm rounded-full font-medium whitespace-nowrap transition
                      {{ $category === $key ? 'bg-[#1A237E] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                {{ $label }}
            </a>
            @endif
            @endforeach
        </div>
    </div>
</section>

{{-- Gallery Grid --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($items->isEmpty())
        <div class="text-center py-20">
            <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-gray-400 text-lg">No gallery items in this category yet.</p>
        </div>
        @else

        {{-- Masonry-style grid --}}
        <div class="columns-1 sm:columns-2 lg:columns-3 xl:columns-4 gap-4 space-y-4"
             x-data="{ lightbox: false, current: null, items: {{ json_encode($items->map(fn($i) => ['url'=>$i->file_url,'title'=>$i->title,'caption'=>$i->caption,'type'=>$i->type])->values()) }} }"
             >

            @foreach($items as $i => $item)
            <div class="break-inside-avoid group cursor-pointer rounded-2xl overflow-hidden bg-white shadow-sm hover:shadow-lg transition-all border border-gray-100"
                 @click="current = {{ $i }}; lightbox = true">
                @if($item->type === 'image')
                    <img src="{{ $item->file_url }}" alt="{{ $item->title }}"
                         class="w-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                @else
                    <div class="relative aspect-video bg-gray-900">
                        <video src="{{ $item->file_url }}" class="w-full h-full object-cover opacity-80"></video>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-14 h-14 bg-white/90 rounded-full flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-[#1A237E] ml-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                @endif

                @if($item->title || $item->caption)
                <div class="p-3">
                    @if($item->title)<p class="text-sm font-semibold text-gray-800">{{ $item->title }}</p>@endif
                    @if($item->caption)<p class="text-xs text-gray-500 mt-0.5">{{ $item->caption }}</p>@endif
                </div>
                @endif
            </div>
            @endforeach

            {{-- Lightbox --}}
            <div x-show="lightbox"
                 @keydown.escape.window="lightbox = false"
                 @keydown.arrow-left.window="current = (current - 1 + items.length) % items.length"
                 @keydown.arrow-right.window="current = (current + 1) % items.length"
                 class="fixed inset-0 z-50 bg-black/90 flex items-center justify-center p-4"
                 style="display:none;" @click.self="lightbox = false">

                <button @click="current = (current - 1 + items.length) % items.length"
                        class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/40 rounded-full flex items-center justify-center text-white transition z-10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button @click="current = (current + 1) % items.length"
                        class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/40 rounded-full flex items-center justify-center text-white transition z-10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
                <button @click="lightbox = false" class="absolute top-4 right-4 w-10 h-10 bg-white/20 hover:bg-white/40 rounded-full flex items-center justify-center text-white transition z-10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <div class="max-w-5xl w-full">
                    <template x-if="items[current]?.type === 'image'">
                        <img :src="items[current]?.url" :alt="items[current]?.title" class="max-h-[80vh] w-full object-contain rounded-xl">
                    </template>
                    <template x-if="items[current]?.type === 'video'">
                        <video :src="items[current]?.url" class="max-h-[80vh] w-full rounded-xl" controls autoplay></video>
                    </template>
                    <div class="text-center mt-4" x-show="items[current]?.title || items[current]?.caption">
                        <p class="text-white font-semibold" x-text="items[current]?.title"></p>
                        <p class="text-gray-400 text-sm mt-1" x-text="items[current]?.caption"></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-10">{{ $items->links() }}</div>
        @endif
    </div>
</section>

{{-- CTA --}}
<section class="py-16 bg-[#1A237E]">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="font-display text-3xl font-bold text-white mb-4">Interested in Our Properties?</h2>
        <p class="text-gray-300 mb-8">Browse our available estates and properties, or get in touch to discuss your real estate goals.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('properties.index') }}" class="inline-flex items-center justify-center gap-2 bg-[#27AE22] text-white font-bold px-8 py-4 rounded-full hover:bg-[#1D9418] transition-all">
                View Properties
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center gap-2 border-2 border-white text-white font-bold px-8 py-4 rounded-full hover:bg-white hover:text-[#1A237E] transition-all">
                Contact Us
            </a>
        </div>
    </div>
</section>

@endsection
