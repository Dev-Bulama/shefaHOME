@extends('layouts.app')

@section('title', $property->name . ' — SHEFAHOMES')
@section('meta_description', Str::limit(strip_tags($property->description ?? ''), 160))

@section('content')

{{-- Breadcrumb --}}
<nav class="bg-[#0A1628] py-3">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <ol class="flex items-center gap-2 text-sm text-gray-400 flex-wrap">
            <li><a href="{{ route('home') }}" class="hover:text-[#C9A84C] transition-colors">Home</a></li>
            <li><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
            <li><a href="{{ route('properties.index') }}" class="hover:text-[#C9A84C] transition-colors">Properties</a></li>
            <li><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
            <li class="text-[#C9A84C] truncate max-w-[200px]">{{ $property->name }}</li>
        </ol>
    </div>
</nav>

<section class="bg-gray-50 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-10">

            {{-- Main Content --}}
            <div class="flex-1 min-w-0">

                {{-- Gallery Hero --}}
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 mb-6"
                     x-data="{
                         mainImage: '{{ $property->cover_image_url }}',
                         images: {{ json_encode(($property->gallery ?? collect())->pluck('image_url')->prepend($property->cover_image_url)->filter()->values()) }},
                         activeIndex: 0,
                         setImage(url, i) { this.mainImage = url; this.activeIndex = i; }
                     }">
                    {{-- Main image --}}
                    <div class="relative h-72 sm:h-96 lg:h-[480px] overflow-hidden">
                        <img :src="mainImage"
                             alt="{{ $property->name }}"
                             class="w-full h-full object-cover transition-all duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0A1628]/30 via-transparent to-transparent pointer-events-none"></div>

                        {{-- Status badge --}}
                        @php
                            $sMap = ['available'=>'bg-emerald-500','selling_fast'=>'bg-orange-500','sold_out'=>'bg-red-500','coming_soon'=>'bg-blue-500'];
                            $sLabel = ['available'=>'Available','selling_fast'=>'Selling Fast','sold_out'=>'Sold Out','coming_soon'=>'Coming Soon'];
                        @endphp
                        <span class="absolute top-5 left-5 {{ $sMap[$property->status] ?? 'bg-gray-500' }} text-white text-sm font-bold px-4 py-2 rounded-full shadow-lg">
                            {{ $sLabel[$property->status] ?? ucfirst($property->status) }}
                        </span>

                        {{-- GLightbox trigger --}}
                        <a :href="mainImage" class="glightbox absolute bottom-5 right-5 bg-black/50 backdrop-blur-sm text-white p-2.5 rounded-xl hover:bg-[#C9A84C] hover:text-[#0A1628] transition-all" data-gallery="property-gallery">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                        </a>
                    </div>

                    {{-- Thumbnails --}}
                    <div class="p-4 flex gap-3 overflow-x-auto">
                        <template x-for="(img, i) in images" :key="i">
                            <button @click="setImage(img, i)"
                                    :class="activeIndex === i ? 'ring-2 ring-[#C9A84C] ring-offset-2' : 'opacity-60 hover:opacity-100'"
                                    class="flex-shrink-0 w-20 h-16 rounded-xl overflow-hidden transition-all">
                                <img :src="img" class="w-full h-full object-cover" alt="">
                            </button>
                        </template>
                    </div>
                </div>

                {{-- Title & Info --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-6">
                    <div class="flex flex-col sm:flex-row sm:items-start gap-4 justify-between mb-6">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-[#C9A84C] text-sm font-semibold uppercase tracking-wider">{{ $property->propertyType->name ?? 'Estate' }}</span>
                            </div>
                            <h1 class="font-display text-3xl sm:text-4xl font-bold text-[#0A1628] mb-2 leading-tight">
                                {{ $property->name }}
                            </h1>
                            <div class="flex items-center gap-2 text-gray-500">
                                <svg class="w-4 h-4 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $property->location }}, {{ $property->state }}, Nigeria
                            </div>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="text-sm text-gray-400 mb-1">Starting from</p>
                            <p class="font-display text-3xl font-bold text-[#C9A84C]">{{ $property->formatted_price }}</p>
                        </div>
                    </div>

                    {{-- Plot sizes --}}
                    @if(!empty($property->plot_sizes_array))
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="text-sm text-gray-500 font-medium mr-2 self-center">Plot sizes:</span>
                        @foreach($property->plot_sizes_array as $size)
                        <span class="bg-gray-100 border border-gray-200 text-gray-600 text-sm font-medium px-3 py-1.5 rounded-xl">{{ $size }}</span>
                        @endforeach
                    </div>
                    @endif

                    {{-- Tab Navigation --}}
                    <div x-data="{ tab: 'overview' }">
                        <div class="flex gap-1 border-b border-gray-200 mb-6 overflow-x-auto">
                            @foreach([['overview','Overview'],['plans','Payment Plans'],['gallery','Gallery'],['tour','Virtual Tour']] as [$key, $label])
                            <button @click="tab = '{{ $key }}'"
                                    :class="tab === '{{ $key }}' ? 'border-[#C9A84C] text-[#C9A84C]' : 'border-transparent text-gray-500 hover:text-[#0A1628]'"
                                    class="px-5 py-3 text-sm font-semibold border-b-2 transition-all whitespace-nowrap -mb-px">
                                {{ $label }}
                            </button>
                            @endforeach
                        </div>

                        {{-- Overview --}}
                        <div x-show="tab === 'overview'" x-transition>
                            @if($property->description)
                            <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed mb-6">
                                {!! nl2br(e($property->description)) !!}
                            </div>
                            @endif

                            {{-- Features grid --}}
                            @if($property->features && count($property->features))
                            <div>
                                <h3 class="font-bold text-[#0A1628] mb-4">Estate Features</h3>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                    @foreach($property->features as $feature)
                                    <div class="flex items-center gap-2.5 bg-gray-50 rounded-xl px-4 py-3">
                                        <svg class="w-4 h-4 text-[#C9A84C] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span class="text-gray-600 text-sm">{{ $feature }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>

                        {{-- Payment Plans --}}
                        <div x-show="tab === 'plans'" x-transition>
                            @if(isset($property->paymentPlans) && $property->paymentPlans->count())
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($property->paymentPlans as $plan)
                                <div class="border-2 {{ $plan->is_recommended ? 'border-[#C9A84C]' : 'border-gray-200' }} rounded-2xl p-5 text-center relative">
                                    @if($plan->is_recommended)
                                    <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-[#C9A84C] text-[#0A1628] text-xs font-bold px-3 py-1 rounded-full">Recommended</span>
                                    @endif
                                    <h4 class="font-bold text-[#0A1628] mb-2">{{ $plan->name }}</h4>
                                    <p class="text-2xl font-display font-bold text-[#C9A84C] mb-1">{{ $plan->formatted_price }}</p>
                                    <p class="text-gray-400 text-sm mb-4">{{ $plan->duration_label }}</p>
                                    @if($plan->deposit_amount)
                                    <p class="text-xs text-gray-500 mb-4">Initial deposit: {{ $plan->formatted_deposit }}</p>
                                    @endif
                                    <a href="{{ route('inquiries.store') }}" class="block bg-[#0A1628] hover:bg-[#C9A84C] hover:text-[#0A1628] text-white text-sm font-semibold py-2.5 rounded-xl transition-all">Select Plan</a>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="text-center py-10 text-gray-400">
                                <p>Payment plan details are available on request.</p>
                                <a href="#inquiry-form" class="inline-block mt-3 text-[#C9A84C] font-semibold hover:underline">Enquire Now</a>
                            </div>
                            @endif
                        </div>

                        {{-- Gallery tab --}}
                        <div x-show="tab === 'gallery'" x-transition>
                            @if(isset($property->gallery) && $property->gallery->count())
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                @foreach($property->gallery as $g)
                                <a href="{{ $g->image_url }}" class="glightbox rounded-xl overflow-hidden h-40 block" data-gallery="property-gallery">
                                    <img src="{{ $g->image_url }}" alt="{{ $g->caption ?? $property->name }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                                </a>
                                @endforeach
                            </div>
                            @else
                            <p class="text-gray-400 text-center py-10">No gallery images available.</p>
                            @endif
                        </div>

                        {{-- Virtual Tour --}}
                        <div x-show="tab === 'tour'" x-transition>
                            @if($property->virtual_tour_url)
                            <div class="rounded-2xl overflow-hidden aspect-video bg-[#0A1628]">
                                <iframe src="{{ $property->virtual_tour_url }}"
                                        class="w-full h-full"
                                        frameborder="0"
                                        allow="fullscreen; vr"
                                        allowfullscreen></iframe>
                            </div>
                            @else
                            <div class="text-center py-16 bg-gray-50 rounded-2xl">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                <p class="text-gray-400">Virtual tour coming soon.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sticky Sidebar --}}
            <div class="lg:w-80 flex-shrink-0">
                <div class="sticky top-24 space-y-4">

                    {{-- Inquiry Form --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" id="inquiry-form">
                        <div class="h-1 bg-gradient-to-r from-[#0A1628] via-[#C9A84C] to-[#0A1628]"></div>
                        <div class="p-6"
                             x-data="{
                                 name: '', email: '', phone: '', message: 'I am interested in {{ addslashes($property->name) }}. Please send me more details.',
                                 loading: false, success: false, error: '',
                                 async submit() {
                                     if (!this.name || !this.email || !this.phone) { this.error = 'Please fill all required fields.'; return; }
                                     this.loading = true; this.error = '';
                                     try {
                                         const r = await fetch('{{ route('inquiries.store') }}', {
                                             method: 'POST',
                                             headers: {'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name=csrf-token]').content,'Accept':'application/json'},
                                             body: JSON.stringify({name:this.name,email:this.email,phone:this.phone,message:this.message,property_id:{{ $property->id }}})
                                         });
                                         const d = await r.json();
                                         if (r.ok) { this.success = true; } else { this.error = d.message || 'Failed. Try again.'; }
                                     } catch(e) { this.error = 'Network error.'; } finally { this.loading = false; }
                                 }
                             }">
                            <h3 class="font-display font-bold text-[#0A1628] text-lg mb-1">Make an Enquiry</h3>
                            <p class="text-gray-400 text-sm mb-5">Our property expert will contact you within 24 hours.</p>

                            <div x-show="success" class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 mb-4 text-emerald-700 text-sm font-medium">
                                Enquiry sent! We will be in touch shortly.
                            </div>
                            <div x-show="error" x-text="error" class="bg-red-50 border border-red-200 rounded-xl p-4 mb-4 text-red-600 text-sm"></div>

                            <div x-show="!success" class="space-y-3">
                                <input type="text" x-model="name" placeholder="Full Name *" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#C9A84C] text-[#0A1628]">
                                <input type="email" x-model="email" placeholder="Email Address *" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#C9A84C] text-[#0A1628]">
                                <input type="tel" x-model="phone" placeholder="Phone Number *" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#C9A84C] text-[#0A1628]">
                                <textarea x-model="message" rows="3" placeholder="Message" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#C9A84C] text-[#0A1628] resize-none"></textarea>
                                <button @click="submit()" :disabled="loading"
                                        class="w-full bg-[#C9A84C] hover:bg-[#b8943d] text-[#0A1628] font-bold py-3.5 rounded-xl transition-all hover:scale-[1.02] disabled:opacity-70 flex items-center justify-center gap-2">
                                    <span x-show="!loading">Send Enquiry</span>
                                    <span x-show="loading" class="flex items-center gap-2"><svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>Sending...</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Quick Action Buttons --}}
                    <div class="grid grid-cols-2 gap-3">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', config('shefahomes.whatsapp', '+2349000000000')) }}?text={{ urlencode('Hello, I am interested in ' . $property->name . '. Please provide more information.') }}"
                           target="_blank" rel="noopener"
                           class="flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#20bc5a] text-white font-semibold py-3.5 rounded-xl transition-all text-sm">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.107.548 4.084 1.504 5.803L0 24l6.338-1.481A11.933 11.933 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.013-1.372l-.36-.214-3.727.871.938-3.624-.234-.372A9.794 9.794 0 012.182 12C2.182 6.582 6.582 2.182 12 2.182S21.818 6.582 21.818 12 17.418 21.818 12 21.818z"/></svg>
                            WhatsApp
                        </a>
                        <a href="{{ route('properties.show', $property->slug) }}#inquiry-form"
                           class="flex items-center justify-center gap-2 bg-[#0A1628] hover:bg-[#1a2d4a] text-white font-semibold py-3.5 rounded-xl transition-all text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            Buy Now
                        </a>
                    </div>

                    {{-- Property quick facts --}}
                    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
                        <h4 class="font-bold text-[#0A1628] text-sm mb-4 uppercase tracking-wider">Property Details</h4>
                        <div class="space-y-3">
                            @foreach([
                                ['Type', $property->propertyType->name ?? 'N/A'],
                                ['Location', ($property->location ?? '') . ', ' . ($property->state ?? '')],
                                ['Status', ucwords(str_replace('_', ' ', $property->status ?? 'N/A'))],
                                ['Title', $property->title_type ?? 'Government Approved'],
                            ] as [$key, $val])
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-400">{{ $key }}</span>
                                <span class="font-semibold text-[#0A1628] text-right max-w-[60%]">{{ $val }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related Properties --}}
        @if(isset($related) && $related->count())
        <div class="mt-16">
            <div class="flex items-center justify-between mb-8">
                <h2 class="font-display text-2xl font-bold text-[#0A1628]">Related <span class="text-[#C9A84C]">Properties</span></h2>
                <a href="{{ route('properties.index') }}" class="text-sm text-[#C9A84C] hover:underline font-medium">View All</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($related as $r)
                <a href="{{ route('properties.show', $r->slug) }}"
                   class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg border border-gray-100 transition-all hover:-translate-y-1 flex flex-col">
                    <div class="h-48 overflow-hidden flex-shrink-0">
                        <img src="{{ $r->cover_image_url }}" alt="{{ $r->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" onerror="this.src='https://picsum.photos/seed/{{ $r->id }}/600/400'">
                    </div>
                    <div class="p-5">
                        <p class="text-[#C9A84C] text-xs font-semibold uppercase tracking-wider mb-1">{{ $r->propertyType->name ?? 'Estate' }}</p>
                        <h3 class="font-bold text-[#0A1628] mb-1 group-hover:text-[#C9A84C] transition-colors">{{ $r->name }}</h3>
                        <p class="text-gray-400 text-xs mb-3">{{ $r->location }}, {{ $r->state }}</p>
                        <p class="text-[#C9A84C] font-bold font-display">{{ $r->formatted_price }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        GLightbox({ selector: '.glightbox', touchNavigation: true, loop: true });
    });
</script>
@endpush

@endsection
