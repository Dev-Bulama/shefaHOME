@extends('layouts.app')

@php
use App\Helpers\PageContent as PC;
$heroTitle   = PC::get('privacy-policy', 'hero.title',        'Privacy Policy');
$lastUpdated = PC::get('privacy-policy', 'hero.last_updated', 'Last updated: January 2025');
$rawContent  = PC::get('privacy-policy', 'page.content', '');
$safeContent = preg_replace('/<(style|script)[^>]*>.*?<\/\1>/is', '', $rawContent);
@endphp

@section('title', $heroTitle . ' — SHEFAHOMES')
@section('description', 'Read the SHEFAHOMES Privacy Policy to understand how we collect, use, and protect your personal information.')

@section('content')

{{-- Hero --}}
<section class="relative bg-[#1A237E] py-20 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-[#1A237E] to-[#0D1566]"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 opacity-10 rounded-full" style="background:radial-gradient(circle, #27AE22, transparent 70%)"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-sm text-gray-400 mb-6">
            <a href="{{ route('home') }}" class="hover:text-[#27AE22] transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-300">{{ $heroTitle }}</span>
        </nav>
        <h1 class="font-display text-4xl sm:text-5xl font-bold text-white mb-3">{{ $heroTitle }}</h1>
        <p class="text-[#27AE22] text-sm font-medium">{{ $lastUpdated }}</p>
    </div>
</section>

{{-- Content --}}
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($safeContent)
        <div class="privacy-body">
            {!! $safeContent !!}
        </div>
        @else
        {{-- Fallback static content shown only if DB content is empty --}}
        <div class="privacy-body">
            <h2>1. Introduction</h2>
            <p>Welcome to <strong>Shefa Homes and Properties Ltd</strong>. We are committed to protecting your personal information and your right to privacy.</p>

            <h2>2. Information We Collect</h2>
            <ul>
                <li>Personal details (name, email, phone, address) provided during inquiries or registration.</li>
                <li>Property inquiry data including preferred locations, budget, and purchase intent.</li>
                <li>Usage data such as IP address, browser type, and pages visited.</li>
            </ul>

            <h2>3. How We Use Your Information</h2>
            <ul>
                <li>Respond to property inquiries and provide relevant listings.</li>
                <li>Send marketing communications where you have consented.</li>
                <li>Improve our website and services.</li>
                <li>Comply with applicable laws and regulations.</li>
            </ul>

            <h2>4. Data Security</h2>
            <p>We implement appropriate technical and organisational measures to protect your personal data against unauthorised access.</p>

            <h2>5. Your Rights</h2>
            <p>You have the right to access, correct, or delete your personal data at any time. Contact us to exercise these rights.</p>

            <h2>6. Contact Us</h2>
            <ul>
                <li><strong>Shefa Homes and Properties Ltd</strong></li>
                <li>Email: info@shefahomes.com</li>
                <li>Phone: +234 912 238 8541</li>
            </ul>
        </div>
        @endif

        <div class="mt-12 pt-8 border-t border-gray-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <p class="text-sm text-gray-400">Questions about this policy?
                <a href="{{ route('contact') }}" class="text-[#27AE22] hover:text-[#1A237E] font-medium transition-colors">Contact us</a>
            </p>
            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-2 text-sm text-[#1A237E] hover:text-[#27AE22] font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Homepage
            </a>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .privacy-body { font-size: 1rem; line-height: 1.85; color: #374151; }
    .privacy-body h2 {
        font-family: 'Playfair Display', serif;
        font-weight: 700; color: #1A237E;
        font-size: 1.25rem;
        margin-top: 2rem; margin-bottom: 0.6rem;
        padding-bottom: 0.4rem;
        border-bottom: 2px solid rgba(39,174,34,0.2);
    }
    .privacy-body h2:first-child { margin-top: 0; }
    .privacy-body h3 { font-weight: 700; color: #1e3a8a; font-size: 1.05rem; margin-top: 1.4rem; margin-bottom: 0.4rem; }
    .privacy-body p { margin-bottom: 0.9rem; color: #4b5563; }
    .privacy-body ul { list-style: none; padding: 0; margin: 0 0 1rem; }
    .privacy-body ul li { display: flex; align-items: flex-start; gap: 0.7rem; padding: 0.3rem 0; color: #374151; }
    .privacy-body ul li::before { content: ''; flex-shrink: 0; width: 7px; height: 7px; border-radius: 50%; background: #27AE22; margin-top: 0.58rem; }
    .privacy-body ol { list-style: none; counter-reset: priv; padding: 0; margin: 0 0 1rem; }
    .privacy-body ol li { display: flex; align-items: flex-start; gap: 0.7rem; padding: 0.3rem 0; counter-increment: priv; }
    .privacy-body ol li::before { content: counter(priv) '.'; flex-shrink: 0; font-weight: 700; color: #27AE22; min-width: 1.5rem; }
    .privacy-body strong, .privacy-body b { color: #1A237E; font-weight: 600; }
    .privacy-body a { color: #27AE22; text-decoration: underline; }
    .privacy-body a:hover { color: #1A237E; }
    .privacy-body blockquote { border-left: 3px solid #27AE22; padding: 0.5rem 1rem; margin: 1rem 0; background: rgba(39,174,34,0.05); border-radius: 0 0.5rem 0.5rem 0; color: #6b7280; font-style: italic; }
</style>
@endpush
