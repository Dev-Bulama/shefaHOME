@extends('layouts.app')

@section('title', 'Virtual Tours — SHEFAHOMES')
@section('meta_description', 'Explore SHEFAHOMES estates through immersive virtual tours from the comfort of your home.')

@section('content')

{{-- Hero --}}
<section class="bg-[#0A1628] py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-5 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"%23C9A84C\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"2\"/%3E%3C/g%3E%3C/svg%3E')]"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block text-[#C9A84C] font-semibold text-sm tracking-widest uppercase mb-3">Immersive Experience</span>
        <h1 class="font-display text-5xl lg:text-6xl font-bold text-white mb-4">
            Virtual <span class="text-[#C9A84C]">Tours</span>
        </h1>
        <p class="text-gray-300 text-xl max-w-xl mx-auto">
            Walk through our premium estates from anywhere in the world. 360° immersive tours available 24/7.
        </p>
    </div>
</section>

{{-- Tour Content --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"
         x-data="{
             activeTour: {{ isset($tours) && $tours->count() ? json_encode(['id' => $tours->first()->id, 'url' => $tours->first()->tour_url, 'name' => $tours->first()->name, 'description' => $tours->first()->description ?? '']) : 'null' }},
             setTour(tour) { this.activeTour = tour; }
         }">

        {{-- Tour Selector Grid --}}
        @if(isset($tours) && $tours->count())
        <div class="mb-10">
            <h2 class="font-display text-2xl font-bold text-[#0A1628] mb-6">Select an Estate to Tour</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($tours as $i => $tour)
                <button @click="setTour({{ json_encode(['id' => $tour->id, 'url' => $tour->tour_url, 'name' => $tour->name, 'description' => $tour->description ?? '']) }})"
                        :class="activeTour && activeTour.id === {{ $tour->id }} ? 'ring-2 ring-[#C9A84C] ring-offset-2 bg-[#0A1628] text-white' : 'bg-white text-gray-700 hover:border-[#C9A84C]/50'"
                        class="relative rounded-2xl border border-gray-200 overflow-hidden transition-all group text-left"
                        data-reveal style="transition-delay:{{ $i * 80 }}ms">
                    <div class="relative h-32 bg-[#0A1628]/10 overflow-hidden">
                        @if($tour->thumbnail_url)
                        <img src="{{ $tour->thumbnail_url }}" alt="{{ $tour->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                        <img src="https://picsum.photos/seed/tour{{ $tour->id }}/400/250" alt="{{ $tour->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0A1628]/60 to-transparent"></div>
                        {{-- VR icon --}}
                        <div class="absolute top-3 right-3 w-7 h-7 bg-[#C9A84C] rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <svg class="w-4 h-4 text-[#0A1628]" fill="currentColor" viewBox="0 0 24 24"><path d="M20.5 6c-2.61.7-5.67 1-8.5 1s-5.89-.3-8.5-1L3 8c1.86.5 4 .83 6 1v13h2v-6h2v6h2V9c2-.17 4.14-.5 6-1l-.5-2z"/></svg>
                        </div>
                    </div>
                    <div class="p-3">
                        <h4 class="font-bold text-sm leading-snug">{{ $tour->name }}</h4>
                        @if($tour->location ?? false)<p class="text-xs opacity-60 mt-0.5">{{ $tour->location }}</p>@endif
                    </div>
                </button>
                @endforeach
            </div>
        </div>

        {{-- Active Tour Embed --}}
        <div x-show="activeTour" class="mb-10">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <div>
                        <h3 class="font-display font-bold text-[#0A1628]" x-text="activeTour?.name"></h3>
                        <p class="text-gray-400 text-sm" x-text="activeTour?.description"></p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 bg-[#C9A84C]/15 text-[#b8943d] text-xs font-bold px-3 py-1.5 rounded-full">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/></svg>
                            360° Virtual Tour
                        </span>
                    </div>
                </div>
                {{-- Tour iframe --}}
                <div class="relative" style="padding-top: 56.25%;">
                    <template x-if="activeTour">
                        <iframe :src="activeTour.url"
                                class="absolute inset-0 w-full h-full"
                                frameborder="0"
                                allow="fullscreen; accelerometer; gyroscope; vr"
                                allowfullscreen
                                :title="activeTour.name + ' Virtual Tour'">
                        </iframe>
                    </template>
                </div>
            </div>
        </div>

        {{-- Property Info below tour --}}
        <template x-if="activeTour">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="flex flex-col sm:flex-row items-start gap-6">
                    <div class="flex-1">
                        <h4 class="font-display text-xl font-bold text-[#0A1628] mb-2" x-text="activeTour.name"></h4>
                        <p class="text-gray-500 text-sm" x-text="activeTour.description"></p>
                    </div>
                    <div class="flex-shrink-0 flex gap-3">
                        <a href="{{ route('properties.index') }}"
                           class="bg-[#0A1628] hover:bg-[#C9A84C] text-white hover:text-[#0A1628] font-semibold text-sm px-6 py-3 rounded-xl transition-all">
                            View Properties
                        </a>
                        <a href="{{ route('contact') }}"
                           class="border border-[#0A1628] text-[#0A1628] hover:bg-[#0A1628] hover:text-white font-semibold text-sm px-6 py-3 rounded-xl transition-all">
                            Book Site Visit
                        </a>
                    </div>
                </div>
            </div>
        </template>

        @else
        {{-- Empty state --}}
        <div class="text-center py-24 bg-white rounded-2xl border border-gray-100">
            <div class="w-20 h-20 mx-auto mb-6 bg-[#C9A84C]/10 rounded-full flex items-center justify-center">
                <svg class="w-10 h-10 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
            </div>
            <h3 class="font-display text-2xl font-bold text-[#0A1628] mb-3">Virtual Tours Coming Soon</h3>
            <p class="text-gray-400 max-w-sm mx-auto mb-8">We are currently producing immersive 360° tours of our estates. Check back soon or book a physical site visit.</p>
            <a href="{{ route('contact') }}" class="bg-[#C9A84C] text-[#0A1628] font-bold px-10 py-4 rounded-full hover:bg-[#E8C97A] transition-all">
                Book a Site Visit
            </a>
        </div>
        @endif
    </div>
</section>

{{-- CTA --}}
<section class="py-16 bg-[#0A1628] text-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-display text-3xl font-bold text-white mb-4">Like What You See?</h2>
        <p class="text-gray-400 mb-8">Schedule a live site inspection and talk to one of our property experts.</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('properties.index') }}" class="bg-[#C9A84C] hover:bg-[#E8C97A] text-[#0A1628] font-bold px-8 py-4 rounded-full transition-all hover:scale-105">
                Browse Estates
            </a>
            <a href="{{ route('contact') }}" class="border-2 border-white text-white hover:bg-white hover:text-[#0A1628] font-bold px-8 py-4 rounded-full transition-all">
                Book Site Visit
            </a>
        </div>
    </div>
</section>

@endsection
