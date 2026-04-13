@extends('layouts.app')

@section('title', 'Careers — SHEFAHOMES')
@section('meta_description', 'Join Nigeria\'s leading real estate company. Explore career opportunities at SHEFAHOMES.')

@section('content')

{{-- Hero --}}
<section class="bg-[#1A237E] py-24 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-10 -right-10 w-80 h-80 bg-[#27AE22] rounded-full"></div>
        <div class="absolute -bottom-10 -left-10 w-60 h-60 bg-[#27AE22] rounded-full"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Join Our Team</span>
        <h1 class="font-display text-5xl lg:text-6xl font-bold text-white mb-5">Build Your <span class="text-[#27AE22]">Career</span> with Us</h1>
        <p class="text-gray-300 text-xl max-w-2xl mx-auto mb-8">
            At SHEFAHOMES, every team member is a champion of a movement to transform how Nigerians own real estate.
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            @foreach([['🏢','Inclusive Culture'],['📈','Growth Focused'],['🏡','Industry Leader'],['💰','Competitive Pay']] as $perk)
            <span class="bg-white/10 text-white text-sm font-medium px-5 py-2.5 rounded-full border border-white/20">{{ $perk[0] }} {{ $perk[1] }}</span>
            @endforeach
        </div>
    </div>
</section>

{{-- Department Filter --}}
<section class="bg-white border-b border-gray-200 sticky top-16 z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 overflow-x-auto py-4">
            <a href="{{ route('careers.index') }}"
               class="flex-shrink-0 px-5 py-2 rounded-full text-sm font-semibold transition-all {{ !request('department') ? 'bg-[#1A237E] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                All Departments
            </a>
            @if(isset($departments))
            @foreach($departments as $dept)
            <a href="{{ route('careers.index') }}?department={{ $dept }}"
               class="flex-shrink-0 px-5 py-2 rounded-full text-sm font-semibold transition-all {{ request('department') == $dept ? 'bg-[#27AE22] text-[#1A237E]' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                {{ $dept }}
            </a>
            @endforeach
            @endif
        </div>
    </div>
</section>

{{-- Job Listings --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between mb-8">
            <p class="text-gray-500 text-sm">
                <span class="font-semibold text-[#1A237E]">{{ isset($jobs) ? $jobs->count() : 0 }}</span> open positions
            </p>
        </div>

        @if(isset($jobs) && $jobs->count())
        <div class="space-y-4" x-data="">
            @foreach($jobs as $i => $job)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all"
                 x-data="{ open: false }" data-reveal style="transition-delay:{{ $i * 80 }}ms">

                {{-- Job card header --}}
                <button @click="open = !open"
                        class="w-full flex items-start sm:items-center justify-between p-6 text-left gap-4 hover:bg-gray-50 transition-colors">
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="bg-[#27AE22]/15 text-[#1D9418] text-xs font-bold px-3 py-1 rounded-full">
                                {{ $job->department ?? 'General' }}
                            </span>
                            <span class="{{ $job->type === 'full_time' ? 'bg-emerald-100 text-emerald-700' : ($job->type === 'contract' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700') }} text-xs font-semibold px-3 py-1 rounded-full">
                                {{ ucwords(str_replace('_', ' ', $job->type ?? 'full_time')) }}
                            </span>
                        </div>
                        <h3 class="font-display font-bold text-[#1A237E] text-lg leading-snug">{{ $job->title }}</h3>
                        <div class="flex flex-wrap items-center gap-4 mt-2 text-sm text-gray-400">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $job->location ?? 'Lagos, Nigeria' }}
                            </span>
                            @if($job->deadline)
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Deadline: {{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>

                {{-- Accordion body --}}
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="border-t border-gray-100">
                    <div class="p-6">
                        @if($job->summary)
                        <p class="text-gray-500 text-sm leading-relaxed mb-5">{{ $job->summary }}</p>
                        @endif

                        @if($job->requirements && is_array($job->requirements))
                        <div class="mb-5">
                            <h4 class="font-semibold text-[#1A237E] text-sm mb-3">Requirements</h4>
                            <ul class="space-y-2">
                                @foreach($job->requirements as $req)
                                <li class="flex items-start gap-2 text-gray-500 text-sm">
                                    <svg class="w-4 h-4 text-[#27AE22] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    {{ $req }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('careers.show', $job->slug ?? $job->id) }}"
                               class="bg-[#1A237E] hover:bg-[#27AE22] text-white hover:text-[#1A237E] font-semibold text-sm px-6 py-3 rounded-xl transition-all">
                                View Full Details
                            </a>
                            <a href="{{ route('careers.show', $job->slug ?? $job->id) }}"
                               class="bg-[#27AE22] hover:bg-[#4ADE80] text-[#1A237E] font-semibold text-sm px-6 py-3 rounded-xl transition-all">
                                Apply Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-20 bg-white rounded-2xl border border-gray-100">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <h3 class="font-bold text-[#1A237E] text-xl mb-2">No Open Positions</h3>
            <p class="text-gray-400 mb-6 max-w-sm mx-auto">We don't have any open positions right now, but we're always looking for great talent.</p>
            <a href="{{ route('contact') }}" class="bg-[#27AE22] text-[#1A237E] font-bold px-8 py-3 rounded-full hover:bg-[#4ADE80] transition-all">
                Send Speculative Application
            </a>
        </div>
        @endif
    </div>
</section>

{{-- Culture CTA --}}
<section class="py-20 bg-[#1A237E]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-display text-4xl font-bold text-white mb-4">Don't See the Right Role?</h2>
        <p class="text-gray-400 text-lg mb-8">We're always open to hearing from exceptional people. Send us your CV and let's talk.</p>
        <a href="{{ route('contact') }}" class="bg-[#27AE22] hover:bg-[#4ADE80] text-[#1A237E] font-bold px-10 py-4 rounded-full transition-all hover:scale-105">
            Express Interest
        </a>
    </div>
</section>

@endsection
