@extends('layouts.client')

@section('title', 'My Properties')
@section('page-title', 'My Properties')

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h2 class="text-[#1A237E] text-2xl font-bold font-['Playfair_Display']">My Properties</h2>
            <p class="text-gray-500 text-sm mt-0.5">{{ $properties->count() }} {{ Str::plural('property', $properties->count()) }} in your portfolio</p>
        </div>
        <a href="{{ route('properties.index') }}"
           class="inline-flex items-center gap-2 bg-[#27AE22] hover:bg-[#b8963e] text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Browse More Properties
        </a>
    </div>

    @if($properties->isEmpty())
    {{-- Empty State --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 py-20 px-8 text-center">
        <div class="max-w-sm mx-auto">
            {{-- Illustration --}}
            <div class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-gray-50 to-gray-100 rounded-full flex items-center justify-center border-4 border-gray-100">
                <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </div>
            <h3 class="text-[#1A237E] text-xl font-bold font-['Playfair_Display'] mb-2">No Properties Yet</h3>
            <p class="text-gray-500 text-sm leading-relaxed mb-6">
                You haven't acquired any properties yet. Explore our available estates and secure your dream investment today.
            </p>
            <a href="{{ route('properties.index') }}"
               class="inline-flex items-center gap-2 bg-[#27AE22] hover:bg-[#b8963e] text-white font-semibold px-6 py-3 rounded-xl transition-colors shadow-md shadow-[#27AE22]/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Browse Available Estates
            </a>
        </div>
    </div>

    @else
    {{-- Properties Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($properties as $clientProperty)
        @php
            $prop = $clientProperty->property;
            $status = strtolower($clientProperty->payment_status ?? 'active');
            $statusConfig = match($status) {
                'completed' => ['label' => 'Completed', 'class' => 'bg-green-100 text-green-700 ring-green-200'],
                'defaulted' => ['label' => 'Defaulted', 'class' => 'bg-red-100 text-red-600 ring-red-200'],
                default     => ['label' => 'Active', 'class' => 'bg-blue-100 text-blue-700 ring-blue-200'],
            };
            $propAvailable = strtolower($prop->status ?? 'available') === 'available';
        @endphp
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden border border-gray-100 group">

            {{-- Cover Image --}}
            <div class="relative h-48 bg-gradient-to-br from-[#1A237E] to-[#0D1566] overflow-hidden">
                @if($prop && $prop->cover_image_url)
                <img src="{{ $prop->cover_image_url }}"
                     alt="{{ $prop->name ?? 'Property' }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                <div class="w-full h-full flex items-center justify-center">
                    <svg class="w-16 h-16 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>

                {{-- Property Availability Badge --}}
                <div class="absolute top-3 left-3">
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold backdrop-blur-sm
                        {{ $propAvailable ? 'bg-green-500/90 text-white' : 'bg-gray-700/90 text-white' }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $propAvailable ? 'bg-white' : 'bg-gray-400' }} animate-pulse"></span>
                        {{ $propAvailable ? 'Available' : 'Sold Out' }}
                    </span>
                </div>
            </div>

            {{-- Card Content --}}
            <div class="p-5">
                {{-- Property Name --}}
                <h3 class="text-[#1A237E] font-bold text-base font-['Playfair_Display'] leading-snug mb-2 line-clamp-2">
                    {{ $prop->name ?? 'Property Name' }}
                </h3>

                {{-- Location --}}
                <div class="flex items-center gap-1.5 text-gray-500 text-xs mb-3">
                    <svg class="w-3.5 h-3.5 text-[#27AE22] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="truncate">
                        {{ $prop->lga ?? '' }}{{ ($prop->lga && $prop->state) ? ', ' : '' }}{{ $prop->state ?? 'Nigeria' }}
                    </span>
                </div>

                {{-- Meta Info --}}
                <div class="grid grid-cols-2 gap-2 mb-4">
                    @if($prop && $prop->plot_size)
                    <div class="bg-gray-50 rounded-lg px-3 py-2">
                        <p class="text-gray-400 text-xs">Plot Size</p>
                        <p class="text-[#1A237E] text-xs font-semibold">{{ $prop->plot_size }}</p>
                    </div>
                    @endif
                    <div class="bg-gray-50 rounded-lg px-3 py-2">
                        <p class="text-gray-400 text-xs">Purchase Date</p>
                        <p class="text-[#1A237E] text-xs font-semibold">
                            {{ $clientProperty->created_at ? \Carbon\Carbon::parse($clientProperty->created_at)->format('M Y') : 'N/A' }}
                        </p>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold ring-1 {{ $statusConfig['class'] }}">
                        {{ $statusConfig['label'] }}
                    </span>
                    <a href="{{ route('client.properties.show', $clientProperty->id) }}"
                       class="inline-flex items-center gap-1.5 text-[#1A237E] hover:text-[#27AE22] text-xs font-semibold transition-colors">
                        View Details
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</div>
@endsection
