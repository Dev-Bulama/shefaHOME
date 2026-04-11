@extends('layouts.app')

@section('title', ($job->title ?? 'Job Listing') . ' — SHEFAHOMES Careers')
@section('meta_description', 'Apply for ' . ($job->title ?? 'this position') . ' at SHEFAHOMES Nigeria.')

@section('content')

{{-- Hero --}}
<section class="bg-[#0A1628] py-20 relative overflow-hidden">
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-sm text-gray-400 mb-6 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-[#C9A84C]">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('careers.index') }}" class="hover:text-[#C9A84C]">Careers</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-[#C9A84C]">{{ $job->title ?? 'Job' }}</span>
        </nav>
        <div class="flex flex-col lg:flex-row gap-8 items-start">
            <div class="flex-1">
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="bg-[#C9A84C]/20 text-[#C9A84C] text-xs font-bold px-3 py-1.5 rounded-full">{{ $job->department ?? 'General' }}</span>
                    <span class="{{ $job->type === 'full_time' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-blue-500/20 text-blue-400' }} text-xs font-bold px-3 py-1.5 rounded-full">
                        {{ ucwords(str_replace('_', ' ', $job->type ?? 'Full Time')) }}
                    </span>
                </div>
                <h1 class="font-display text-4xl lg:text-5xl font-bold text-white mb-4">{{ $job->title ?? 'Position' }}</h1>
                <div class="flex flex-wrap gap-5 text-gray-400 text-sm">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $job->location ?? 'Lagos, Nigeria' }}
                    </span>
                    @if($job->deadline)
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Deadline: {{ \Carbon\Carbon::parse($job->deadline)->format('F d, Y') }}
                    </span>
                    @endif
                    @if($job->salary_range ?? false)
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $job->salary_range }}
                    </span>
                    @endif
                </div>
            </div>
            <div class="flex-shrink-0">
                <a href="{{ route('careers.show', $job->slug ?? $job->id) }}"
                   class="block bg-[#C9A84C] hover:bg-[#E8C97A] text-[#0A1628] font-bold px-10 py-4 rounded-full transition-all hover:scale-105 text-center">
                    Apply Now
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Job Details --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 lg:p-10 space-y-10">

            {{-- About the Role --}}
            @if($job->description)
            <div>
                <h2 class="font-display text-2xl font-bold text-[#0A1628] mb-5 pb-3 border-b border-gray-100">About This Role</h2>
                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed">
                    {!! $job->description !!}
                </div>
            </div>
            @endif

            {{-- Responsibilities --}}
            @if($job->responsibilities && (is_array($job->responsibilities) ? count($job->responsibilities) : false))
            <div>
                <h2 class="font-display text-2xl font-bold text-[#0A1628] mb-5 pb-3 border-b border-gray-100">Key Responsibilities</h2>
                <ul class="space-y-3">
                    @foreach($job->responsibilities as $res)
                    <li class="flex items-start gap-3 text-gray-600 text-sm">
                        <div class="w-5 h-5 rounded-full bg-[#C9A84C]/15 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        {{ $res }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Requirements --}}
            @if($job->requirements && (is_array($job->requirements) ? count($job->requirements) : false))
            <div>
                <h2 class="font-display text-2xl font-bold text-[#0A1628] mb-5 pb-3 border-b border-gray-100">Requirements</h2>
                <ul class="space-y-3">
                    @foreach($job->requirements as $req)
                    <li class="flex items-start gap-3 text-gray-600 text-sm">
                        <div class="w-5 h-5 rounded-full bg-[#0A1628]/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-[#0A1628]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        </div>
                        {{ $req }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Benefits --}}
            @if($job->benefits && (is_array($job->benefits) ? count($job->benefits) : false))
            <div>
                <h2 class="font-display text-2xl font-bold text-[#0A1628] mb-5 pb-3 border-b border-gray-100">What We Offer</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($job->benefits as $benefit)
                    <div class="flex items-center gap-3 bg-gray-50 rounded-xl px-4 py-3">
                        <svg class="w-4 h-4 text-[#C9A84C] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-gray-600 text-sm">{{ $benefit }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Apply CTA --}}
            <div class="bg-gradient-to-r from-[#0A1628] to-[#1a2d4a] rounded-2xl p-8 text-center">
                <h3 class="font-display text-2xl font-bold text-white mb-3">Ready to Join Our Team?</h3>
                <p class="text-gray-300 mb-6">Submit your application and take the first step towards a rewarding career at SHEFAHOMES.</p>
                <a href="{{ route('careers.show', $job->slug ?? $job->id) }}"
                   class="inline-block bg-[#C9A84C] hover:bg-[#E8C97A] text-[#0A1628] font-bold px-10 py-4 rounded-full transition-all hover:scale-105">
                    Apply for This Position
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
