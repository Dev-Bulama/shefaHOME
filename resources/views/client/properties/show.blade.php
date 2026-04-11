@extends('layouts.client')

@section('title', ($clientProperty->property->name ?? 'Property Details'))
@section('page-title', ($clientProperty->property->name ?? 'Property Details'))

@section('breadcrumb')
    <a href="{{ route('client.dashboard') }}" class="hover:text-[#C9A84C]">Dashboard</a>
    <span class="mx-1">/</span>
    <a href="{{ route('client.properties.index') }}" class="hover:text-[#C9A84C]">My Properties</a>
    <span class="mx-1">/</span>
    {{ $clientProperty->property->name ?? 'Details' }}
@endsection

@section('content')
@php
    $prop = $clientProperty->property;
    $totalPrice = $payment->total_price ?? 0;
    $amountPaid = $payment->amount_paid ?? 0;
    $balance = $payment->balance ?? 0;
    $progressPct = $totalPrice > 0 ? min(100, round(($amountPaid / $totalPrice) * 100)) : 0;
@endphp

<div class="space-y-6">

    {{-- Breadcrumb (visible on page) --}}
    <nav class="flex items-center gap-2 text-xs text-gray-400">
        <a href="{{ route('client.dashboard') }}" class="hover:text-[#C9A84C] transition-colors">Dashboard</a>
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <a href="{{ route('client.properties.index') }}" class="hover:text-[#C9A84C] transition-colors">My Properties</a>
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-[#0A1628] font-medium">{{ $prop->name ?? 'Property' }}</span>
    </nav>

    {{-- Hero Section --}}
    <div class="relative h-64 lg:h-80 rounded-2xl overflow-hidden bg-[#0A1628] shadow-lg">
        @if($prop && $prop->cover_image_url)
        <img src="{{ $prop->cover_image_url }}" alt="{{ $prop->name }}" class="w-full h-full object-cover">
        @else
        <div class="w-full h-full flex items-center justify-center">
            <svg class="w-24 h-24 text-white/10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
        </div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-[#0A1628]/80 via-[#0A1628]/20 to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 p-6">
            <div class="flex flex-wrap items-end justify-between gap-3">
                <div>
                    <p class="text-[#C9A84C] text-sm font-medium mb-1 flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                        {{ $prop->lga ?? '' }}{{ ($prop->lga && $prop->state) ? ', ' : '' }}{{ $prop->state ?? 'Nigeria' }}
                    </p>
                    <h1 class="text-white text-2xl lg:text-3xl font-bold font-['Playfair_Display']">
                        {{ $prop->name ?? 'Property' }}
                    </h1>
                </div>
                @if($prop && $prop->plot_size)
                <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl px-4 py-2 text-center">
                    <p class="text-white/70 text-xs">Plot Size</p>
                    <p class="text-white font-bold text-sm">{{ $prop->plot_size }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

        {{-- Left Column: Property Details --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Property Description --}}
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h3 class="text-[#0A1628] text-lg font-bold font-['Playfair_Display'] mb-3">About This Property</h3>
                <div class="text-gray-600 text-sm leading-relaxed prose prose-sm max-w-none">
                    {!! nl2br(e($prop->description ?? 'No description available for this property.')) !!}
                </div>
            </div>

            {{-- Amenities / Features --}}
            @if($prop && $prop->amenities)
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h3 class="text-[#0A1628] text-lg font-bold font-['Playfair_Display'] mb-4">Amenities & Features</h3>
                @php
                    $amenities = is_array($prop->amenities)
                        ? $prop->amenities
                        : (is_string($prop->amenities) ? array_filter(array_map('trim', explode(',', $prop->amenities))) : []);
                @endphp
                @if(count($amenities) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    @foreach($amenities as $amenity)
                    <div class="flex items-center gap-2.5 py-2 px-3 bg-gray-50 rounded-lg">
                        <div class="w-5 h-5 bg-[#C9A84C]/10 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3 text-[#C9A84C]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="text-gray-700 text-sm">{{ trim($amenity) }}</span>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-gray-400 text-sm">Amenities information not available.</p>
                @endif
            </div>
            @endif

            {{-- Virtual Tour --}}
            @if($prop && $prop->virtual_tour_url)
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h3 class="text-[#0A1628] text-lg font-bold font-['Playfair_Display'] mb-3">Virtual Tour</h3>
                <p class="text-gray-500 text-sm mb-4">Take an immersive virtual tour of this property from the comfort of your home.</p>
                <a href="{{ $prop->virtual_tour_url }}" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 bg-[#0A1628] hover:bg-[#152238] text-white font-semibold px-5 py-3 rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Launch Virtual Tour
                </a>
            </div>
            @endif

            {{-- Document Checklist --}}
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h3 class="text-[#0A1628] text-lg font-bold font-['Playfair_Display'] mb-4">Document Checklist</h3>
                <p class="text-gray-500 text-sm mb-4">Track your property documentation progress.</p>
                @php
                    $expectedDocs = [
                        ['name' => 'Offer Letter', 'key' => 'offer_letter', 'desc' => 'Formal offer of property purchase'],
                        ['name' => 'Payment Receipt', 'key' => 'receipt', 'desc' => 'Proof of payment issued by SHEFAHOMES'],
                        ['name' => 'Allotment Letter', 'key' => 'allotment_letter', 'desc' => 'Plot allocation confirmation'],
                        ['name' => 'Certificate of Occupancy (C of O)', 'key' => 'c_of_o', 'desc' => 'Government title document'],
                    ];
                    $clientDocTypes = $clientProperty->documents ? $clientProperty->documents->pluck('document_type')->map(fn($t) => strtolower(str_replace([' ', '-'], '_', $t)))->toArray() : [];
                @endphp
                <div class="space-y-3">
                    @foreach($expectedDocs as $doc)
                    @php $hasDoc = in_array($doc['key'], $clientDocTypes); @endphp
                    <div class="flex items-center gap-4 p-3 rounded-xl {{ $hasDoc ? 'bg-green-50 border border-green-100' : 'bg-gray-50 border border-gray-100' }}">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0
                            {{ $hasDoc ? 'bg-green-500' : 'bg-gray-200' }}">
                            @if($hasDoc)
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            @else
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold {{ $hasDoc ? 'text-green-700' : 'text-gray-700' }}">
                                {{ $doc['name'] }}
                            </p>
                            <p class="text-xs {{ $hasDoc ? 'text-green-500' : 'text-gray-400' }}">
                                {{ $doc['desc'] }}
                            </p>
                        </div>
                        <span class="text-xs font-semibold flex-shrink-0 {{ $hasDoc ? 'text-green-600' : 'text-gray-400' }}">
                            {{ $hasDoc ? 'Available' : 'Pending' }}
                        </span>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <a href="{{ route('client.documents.index') }}" class="text-sm text-[#C9A84C] hover:underline font-semibold">
                        View All Documents &rarr;
                    </a>
                </div>
            </div>
        </div>

        {{-- Right Column: Payment Summary (Sticky) --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm p-5 lg:sticky lg:top-6">
                <h3 class="text-[#0A1628] text-base font-bold font-['Playfair_Display'] mb-4 pb-3 border-b border-gray-100">
                    Payment Summary
                </h3>

                @if($payment)
                {{-- Payment Plan Badge --}}
                <div class="mb-4">
                    <span class="inline-flex items-center gap-1.5 bg-[#0A1628] text-[#C9A84C] text-xs font-semibold px-3 py-1.5 rounded-full">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        {{ $payment->payment_plan ?? 'Payment Plan' }}
                    </span>
                </div>

                {{-- Price Breakdown --}}
                <div class="space-y-3 mb-4">
                    <div class="flex justify-between items-center py-2 border-b border-gray-50">
                        <span class="text-gray-500 text-sm">Total Price</span>
                        <span class="text-[#0A1628] font-bold text-sm">₦{{ number_format($totalPrice, 0) }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-50">
                        <span class="text-gray-500 text-sm">Amount Paid</span>
                        <span class="text-[#C9A84C] font-bold text-sm">₦{{ number_format($amountPaid, 0) }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-50">
                        <span class="text-gray-500 text-sm">Balance</span>
                        <span class="text-red-500 font-bold text-sm">₦{{ number_format($balance, 0) }}</span>
                    </div>
                </div>

                {{-- Progress Bar --}}
                <div class="mb-4">
                    <div class="flex justify-between text-xs text-gray-500 mb-1.5">
                        <span>Progress</span>
                        <span class="font-bold text-[#C9A84C]">{{ $progressPct }}% paid</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2.5">
                        <div class="bg-gradient-to-r from-[#C9A84C] to-[#E8C97A] h-2.5 rounded-full transition-all duration-700"
                             style="width: {{ $progressPct }}%"></div>
                    </div>
                </div>

                {{-- Next Due Date Alert --}}
                @if($payment->next_due_date)
                <div class="mb-4 flex items-start gap-2 bg-amber-50 border border-amber-200 rounded-xl px-3 py-3">
                    <svg class="w-4 h-4 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-amber-700 text-xs font-bold">Next Payment Due</p>
                        <p class="text-amber-600 text-xs">{{ \Carbon\Carbon::parse($payment->next_due_date)->format('l, F j, Y') }}</p>
                        @if(\Carbon\Carbon::parse($payment->next_due_date)->isPast())
                        <p class="text-red-500 text-xs font-semibold mt-0.5">Overdue!</p>
                        @elseif(\Carbon\Carbon::parse($payment->next_due_date)->diffInDays(now()) <= 7)
                        <p class="text-amber-600 text-xs font-semibold mt-0.5">
                            Due in {{ \Carbon\Carbon::parse($payment->next_due_date)->diffInDays(now()) }} days
                        </p>
                        @endif
                    </div>
                </div>
                @endif

                {{-- CTA Button --}}
                @if($balance > 0)
                <a href="{{ route('client.payments.make', $payment->id) }}"
                   class="w-full flex items-center justify-center gap-2 bg-[#C9A84C] hover:bg-[#b8963e] text-white font-bold py-3.5 px-4 rounded-xl transition-colors shadow-md shadow-[#C9A84C]/20 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                    Make Payment
                </a>
                @else
                <div class="w-full flex items-center justify-center gap-2 bg-green-500 text-white font-bold py-3.5 px-4 rounded-xl text-sm">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Fully Paid
                </div>
                @endif

                @else
                <div class="text-center py-6">
                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                    <p class="text-gray-500 text-sm">No payment record found</p>
                    <a href="{{ route('client.payments.index') }}" class="text-[#C9A84C] text-xs hover:underline mt-1 inline-block">View payments</a>
                </div>
                @endif

                {{-- Payment History Link --}}
                <div class="mt-3 pt-3 border-t border-gray-100 text-center">
                    <a href="{{ route('client.payments.index') }}" class="text-xs text-gray-500 hover:text-[#C9A84C] transition-colors">
                        View full payment history
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
