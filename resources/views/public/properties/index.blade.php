@extends('layouts.app')

@section('title', 'Browse Properties — Premium Real Estate Nigeria')
@section('meta_description', 'Explore SHEFAHOMES premium real estate portfolio across Nigeria. Government-approved titles, flexible payment plans.')

@section('content')

{{-- Page Hero --}}
<section class="relative bg-[#1A237E] py-20 overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <img src="https://picsum.photos/seed/proplist/1400/400" class="w-full h-full object-cover" alt="">
        <div class="absolute inset-0 bg-[#1A237E]/80"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Our Portfolio</span>
        <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-4">
            Premium <span class="text-[#27AE22]">Properties</span>
        </h1>
        <p class="text-gray-300 text-lg max-w-xl mx-auto">
            Discover premium estates across Nigeria with government-approved titles and flexible payment plans.
        </p>
        {{-- Breadcrumb --}}
        <nav class="mt-6 flex items-center justify-center gap-2 text-sm text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-[#27AE22] transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-[#27AE22]">Properties</span>
        </nav>
    </div>
</section>

{{-- Main Content --}}
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">

            {{-- Sidebar Filter --}}
            <aside class="lg:w-72 flex-shrink-0" x-data="{ open: false }">
                {{-- Mobile toggle --}}
                <button @click="open = !open"
                        class="lg:hidden w-full flex items-center justify-between bg-white border border-gray-200 rounded-2xl px-6 py-4 font-semibold text-[#1A237E] mb-4 shadow-sm">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/></svg>
                        Filter Properties
                    </span>
                    <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>

                <div :class="open ? 'block' : 'hidden lg:block'"
                     class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">

                    {{-- Filter header --}}
                    <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="font-bold text-[#1A237E]">Filters</h3>
                        <a href="{{ route('properties.index') }}" class="text-xs text-[#27AE22] hover:underline font-medium">Clear All</a>
                    </div>

                    <form method="GET" action="{{ route('properties.index') }}" id="filter-form" class="divide-y divide-gray-100">

                        {{-- State --}}
                        <div class="px-6 py-5">
                            <h4 class="font-semibold text-[#1A237E] text-sm mb-4 uppercase tracking-wider">Location</h4>
                            <div class="space-y-2 max-h-48 overflow-y-auto pr-1">
                                @php
                                    $stateList = $states ?? ['Lagos', 'Abuja', 'Rivers', 'Ogun', 'Oyo', 'Kano', 'Delta', 'Enugu', 'Anambra', 'Imo'];
                                @endphp
                                @foreach($stateList as $s)
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="checkbox" name="state[]" value="{{ $s }}"
                                           {{ in_array($s, (array)request('state', [])) ? 'checked' : '' }}
                                           class="w-4 h-4 text-[#27AE22] border-gray-300 rounded focus:ring-[#27AE22]"
                                           onchange="document.getElementById('filter-form').submit()">
                                    <span class="text-gray-600 text-sm group-hover:text-[#1A237E] transition-colors">{{ $s }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Property Type --}}
                        <div class="px-6 py-5">
                            <h4 class="font-semibold text-[#1A237E] text-sm mb-4 uppercase tracking-wider">Property Type</h4>
                            <div class="space-y-2">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" name="type" value="" {{ !request('type') ? 'checked' : '' }} class="w-4 h-4 text-[#27AE22] border-gray-300 focus:ring-[#27AE22]" onchange="this.form.submit()">
                                    <span class="text-gray-600 text-sm">All Types</span>
                                </label>
                                @foreach($propertyTypes ?? [] as $pt)
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" name="type" value="{{ $pt->id }}"
                                           {{ request('type') == $pt->id ? 'checked' : '' }}
                                           class="w-4 h-4 text-[#27AE22] border-gray-300 focus:ring-[#27AE22]"
                                           onchange="this.form.submit()">
                                    <span class="text-gray-600 text-sm">{{ $pt->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Price Range --}}
                        <div class="px-6 py-5" x-data="{ min: '{{ request('min_price', '') }}', max: '{{ request('max_price', '') }}' }">
                            <h4 class="font-semibold text-[#1A237E] text-sm mb-4 uppercase tracking-wider">Price Range</h4>
                            <div class="space-y-3">
                                <div>
                                    <label class="text-xs text-gray-400 mb-1 block">Min Price (₦)</label>
                                    <input type="number" name="min_price" x-model="min"
                                           placeholder="0"
                                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22] text-[#1A237E]">
                                </div>
                                <div>
                                    <label class="text-xs text-gray-400 mb-1 block">Max Price (₦)</label>
                                    <input type="number" name="max_price" x-model="max"
                                           placeholder="No limit"
                                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22] text-[#1A237E]">
                                </div>
                                <button type="submit" class="w-full bg-[#1A237E] text-white text-sm font-semibold py-2.5 rounded-xl hover:bg-[#27AE22] hover:text-[#1A237E] transition-all">Apply Price</button>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="px-6 py-5">
                            <h4 class="font-semibold text-[#1A237E] text-sm mb-4 uppercase tracking-wider">Status</h4>
                            <div class="space-y-2">
                                @foreach(['' => 'All', 'rent' => 'For Rent', 'buy' => 'For Sale', 'buy_and_rent' => 'Rent & Sale', 'shortlet' => 'Short Let', 'available' => 'Available', 'sold_out' => 'Sold Out', 'coming_soon' => 'Coming Soon'] as $val => $label)
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" name="status" value="{{ $val }}"
                                           {{ request('status', '') == $val ? 'checked' : '' }}
                                           class="w-4 h-4 text-[#27AE22] border-gray-300 focus:ring-[#27AE22]"
                                           onchange="this.form.submit()">
                                    <span class="text-gray-600 text-sm">{{ $label }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Hidden sort --}}
                        <input type="hidden" name="sort" value="{{ request('sort', 'latest') }}">
                    </form>
                </div>
            </aside>

            {{-- Main listing --}}
            <div class="flex-1 min-w-0">

                {{-- Toolbar --}}
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6 bg-white rounded-2xl px-6 py-4 shadow-sm border border-gray-100">
                    <p class="text-gray-500 text-sm">
                        Showing
                        <span class="font-semibold text-[#1A237E]">{{ $properties->firstItem() ?? 0 }}</span>
                        –
                        <span class="font-semibold text-[#1A237E]">{{ $properties->lastItem() ?? 0 }}</span>
                        of
                        <span class="font-semibold text-[#1A237E]">{{ $properties->total() }}</span>
                        properties
                    </p>
                    <div class="flex items-center gap-3">
                        <label class="text-sm text-gray-500 font-medium">Sort:</label>
                        <select onchange="window.location.href='?{{ http_build_query(array_merge(request()->except(['sort', 'page']), [])) }}&sort=' + this.value"
                                class="border border-gray-200 rounded-xl px-4 py-2 text-sm text-[#1A237E] focus:outline-none focus:ring-2 focus:ring-[#27AE22] bg-gray-50">
                            <option value="latest" {{ request('sort','latest')=='latest'?'selected':'' }}>Latest First</option>
                            <option value="price_asc" {{ request('sort')=='price_asc'?'selected':'' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort')=='price_desc'?'selected':'' }}>Price: High to Low</option>
                            <option value="popular" {{ request('sort')=='popular'?'selected':'' }}>Most Popular</option>
                        </select>
                    </div>
                </div>

                {{-- Properties Grid --}}
                @if($properties->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($properties as $index => $property)
                    <article class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-[#1A237E]/10 border border-gray-100 transition-all duration-500 hover:-translate-y-1 flex flex-col">

                        {{-- Image --}}
                        <div class="relative overflow-hidden h-56 flex-shrink-0">
                            <img src="{{ $property->cover_image_url }}"
                                 alt="{{ $property->name }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                 loading="lazy"
                                 onerror="this.src='https://picsum.photos/seed/{{ $property->id }}/600/400'">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#1A237E]/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                            {{-- Status badge --}}
                            @php
                                $statusMap = ['available'=>'bg-emerald-500','selling_fast'=>'bg-orange-500','sold_out'=>'bg-red-500','coming_soon'=>'bg-blue-500','rent'=>'bg-sky-600','buy'=>'bg-violet-600','buy_and_rent'=>'bg-amber-500','shortlet'=>'bg-pink-500'];
                                $statusLabel = ['available'=>'Available','selling_fast'=>'Selling Fast','sold_out'=>'Sold Out','coming_soon'=>'Coming Soon','rent'=>'For Rent','buy'=>'For Sale','buy_and_rent'=>'Rent & Sale','shortlet'=>'Short Let'];
                            @endphp
                            <span class="absolute top-3 left-3 {{ $statusMap[$property->status] ?? 'bg-gray-500' }} text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                                {{ $statusLabel[$property->status] ?? ucfirst($property->status) }}
                            </span>
                            @if($property->is_featured)
                            <span class="absolute top-3 right-3 bg-[#27AE22] text-[#1A237E] text-xs font-bold px-3 py-1 rounded-full shadow">★ Featured</span>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="p-5 flex flex-col flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-[#27AE22] text-xs font-semibold uppercase tracking-wider">{{ $property->propertyType->name ?? 'Estate' }}</span>
                                <span class="text-gray-300">•</span>
                                <span class="text-gray-400 text-xs">{{ $property->state }}</span>
                            </div>
                            <h3 class="font-display font-bold text-[#1A237E] text-base mb-1.5 group-hover:text-[#27AE22] transition-colors leading-snug line-clamp-2">
                                {{ $property->name }}
                            </h3>
                            <div class="flex items-center gap-1.5 text-gray-400 text-xs mb-3">
                                <svg class="w-3.5 h-3.5 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $property->location }}, {{ $property->state }}
                            </div>
                            @if(!empty($property->plot_sizes_array))
                            <div class="flex flex-wrap gap-1.5 mb-3">
                                @foreach(array_slice($property->plot_sizes_array, 0, 3) as $size)
                                <span class="bg-gray-100 text-gray-500 text-xs px-2 py-0.5 rounded-md">{{ $size }}</span>
                                @endforeach
                            </div>
                            @endif
                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                                <div>
                                    <p class="text-xs text-gray-400">From</p>
                                    <p class="text-[#27AE22] font-bold text-lg font-display">{{ $property->formatted_price }}</p>
                                </div>
                                <a href="{{ route('properties.show', $property->slug) }}"
                                   class="bg-[#1A237E] hover:bg-[#27AE22] text-white hover:text-[#1A237E] text-xs font-semibold px-4 py-2.5 rounded-xl transition-all">
                                    View Estate
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($properties->hasPages())
                <div class="mt-10 flex justify-center">
                    {{ $properties->withQueryString()->links('vendor.pagination.tailwind') }}
                </div>
                @endif

                @else
                {{-- Empty state --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-16 text-center">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <h3 class="font-display font-bold text-[#1A237E] text-xl mb-3">No Properties Found</h3>
                    <p class="text-gray-500 mb-6 max-w-sm mx-auto">No properties match your current filters. Try adjusting your search criteria or clear all filters.</p>
                    <a href="{{ route('properties.index') }}"
                       class="inline-flex items-center gap-2 bg-[#27AE22] text-[#1A237E] font-bold px-8 py-3 rounded-full hover:bg-[#4ADE80] transition-all">
                        Clear Filters
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
