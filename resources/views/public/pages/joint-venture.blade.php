@extends('layouts.app')

@section('title', 'Joint Venture Partnerships — SHEFAHOMES')
@section('description', 'Build strategic real estate developments with Shefa Homes and Properties Ltd. JV partnerships for landowners, investors, and developers across Nigeria.')

@section('content')

{{-- Hero --}}
<section class="relative bg-[#1A237E] py-28 overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-br from-[#1A237E] via-[#1A237E]/95 to-[#1a2e50]"></div>
        <div class="absolute bottom-0 right-0 w-1/2 h-full opacity-10"
             style="background:radial-gradient(circle at 80% 50%, #27AE22 0%, transparent 60%)"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-4">Strategic Partnerships</span>
            <h1 class="font-display text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                Joint Venture<br><span class="text-[#27AE22]">Partnerships</span>
            </h1>
            <p class="text-gray-300 text-xl leading-relaxed mb-4">
                Build Strategic Developments. Share Profitable Outcomes.
            </p>
            <p class="text-gray-400 text-base leading-relaxed mb-10 max-w-2xl">
                At Shefa Homes and Properties Ltd, we structure Joint Venture partnerships that transform land and capital into high-value real estate developments. We collaborate with landowners, investors, and developers to unlock the full potential of prime assets through professionally managed projects.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="#jv-consultation"
                   class="inline-flex items-center gap-2 bg-[#27AE22] text-[#1A237E] font-bold px-8 py-4 rounded-full hover:bg-[#4ADE80] transition-all hover:scale-105 shadow-lg shadow-[#27AE22]/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    Book a JV Consultation
                </a>
                <a href="https://wa.me/{{ $whatsapp ?? '2349122388541' }}?text=Hello%2C%20I%27m%20interested%20in%20a%20JV%20Partnership"
                   target="_blank" rel="noopener"
                   class="inline-flex items-center gap-2 border-2 border-white/40 text-white hover:border-white hover:bg-white/10 font-bold px-8 py-4 rounded-full transition-all">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Speak on WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Why JV With Us --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14" data-reveal>
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Why Partner With Us</span>
            <h2 class="font-display text-4xl font-bold text-[#1A237E] mb-4">We bring structure, expertise,<br>and execution power</h2>
            <p class="text-gray-500">Every JV partnership we enter is built on a transparent framework, professional management, and a clear path to profitable outcomes.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['Strategic project planning & feasibility analysis', 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                ['End-to-end development management', 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5'],
                ['Transparent legal framework & documentation', 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                ['Market-driven development strategies', 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6'],
                ['Defined profit-sharing structure', 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['Professional transparency at every stage', 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'],
            ] as [$text, $icon])
            <div class="flex items-start gap-4 p-5 rounded-2xl border border-gray-100 hover:border-[#27AE22]/30 hover:shadow-md transition-all" data-reveal>
                <div class="w-10 h-10 bg-[#27AE22]/10 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
                    </svg>
                </div>
                <p class="text-gray-700 font-medium text-sm leading-relaxed mt-1">{{ $text }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- JV Models --}}
<section class="py-20 bg-[#1A237E]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14" data-reveal>
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Our JV Models</span>
            <h2 class="font-display text-4xl font-bold text-white mb-4">Three ways to partner with us</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Landowner --}}
            <div class="bg-white/5 border border-white/10 rounded-3xl p-8 hover:bg-white/8 transition-all" data-reveal>
                <div class="w-12 h-12 bg-[#27AE22] rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-[#1A237E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="font-display text-xl font-bold text-white mb-2">Landowner Partnership</h3>
                <p class="text-[#27AE22] text-sm font-medium mb-4">You contribute land. We handle development.</p>
                <ul class="space-y-3 text-gray-400 text-sm">
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-[#27AE22] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Land is professionally evaluated
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-[#27AE22] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Development plan is structured
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-[#27AE22] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Profits shared based on agreed terms
                    </li>
                </ul>
            </div>
            {{-- Investor --}}
            <div class="bg-[#27AE22] rounded-3xl p-8 relative overflow-hidden" data-reveal style="transition-delay:150ms">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-8 translate-x-8"></div>
                <div class="w-12 h-12 bg-[#1A237E] rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-display text-xl font-bold text-[#1A237E] mb-2">Investor Partnership</h3>
                <p class="text-[#1A237E]/70 text-sm font-medium mb-4">You provide capital. We manage execution.</p>
                <ul class="space-y-3 text-[#1A237E]/80 text-sm">
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-[#1A237E] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Capital deployed into structured projects
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-[#1A237E] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Full project management by our team
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-[#1A237E] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Returns generated from sales or development
                    </li>
                </ul>
            </div>
            {{-- Hybrid --}}
            <div class="bg-white/5 border border-white/10 rounded-3xl p-8 hover:bg-white/8 transition-all" data-reveal style="transition-delay:300ms">
                <div class="w-12 h-12 bg-[#27AE22] rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-[#1A237E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="font-display text-xl font-bold text-white mb-2">Hybrid Partnership</h3>
                <p class="text-[#27AE22] text-sm font-medium mb-4">Land + Capital collaboration model.</p>
                <ul class="space-y-3 text-gray-400 text-sm">
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-[#27AE22] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Combined resources for larger-scale developments
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-[#27AE22] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Optimised returns through strategic structuring
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Our Process --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14" data-reveal>
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Our Process</span>
            <h2 class="font-display text-4xl font-bold text-[#1A237E] mb-4">How a JV Partnership Works</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['01', 'Asset Evaluation & Feasibility Study', 'We assess land value, location potential, and project viability before any commitment.'],
                ['02', 'JV Structuring & Legal Agreement', 'A transparent, professionally drafted agreement defines roles, contributions, and profit-sharing.'],
                ['03', 'Project Planning & Design', 'Our team develops architectural plans, timelines, and budgets aligned with market demand.'],
                ['04', 'Development & Execution', 'We manage contractors, quality control, and timelines from ground-breaking to completion.'],
                ['05', 'Sales / Monetisation', 'Strategic marketing and sales execution to maximise project returns.'],
                ['06', 'Profit Distribution', 'Clear, documented profit distribution according to the agreed JV terms.'],
            ] as [$step, $title, $desc])
            <div class="bg-white rounded-2xl p-6 border border-gray-100 hover:shadow-md transition-all relative overflow-hidden" data-reveal>
                <span class="absolute top-4 right-4 text-5xl font-black text-gray-50 select-none">{{ $step }}</span>
                <div class="w-8 h-8 bg-[#27AE22] rounded-lg flex items-center justify-center mb-4">
                    <span class="text-[#1A237E] font-bold text-xs">{{ $step }}</span>
                </div>
                <h3 class="font-semibold text-[#1A237E] mb-2 text-base">{{ $title }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- What You Can Expect --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div data-reveal>
                <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">What You Can Expect</span>
                <h2 class="font-display text-4xl font-bold text-[#1A237E] mb-8 leading-tight">A partnership built on trust and results</h2>
                <div class="space-y-4">
                    @foreach([
                        'Professional transparency at every stage',
                        'Timely project execution',
                        'Clear communication and regular reporting',
                        'Strong return potential based on market dynamics',
                        'Legally structured agreement protecting all parties',
                    ] as $point)
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-[#27AE22]/15 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-gray-700 font-medium">{{ $point }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="bg-[#1A237E] rounded-3xl p-8 lg:p-10 text-white" data-reveal style="transition-delay:200ms">
                <h3 class="font-display text-2xl font-bold mb-2">We Are Seeking Strategic Partners</h3>
                <p class="text-gray-400 text-sm mb-8 leading-relaxed">
                    We are constantly seeking strategic partners ready to participate in high-growth real estate opportunities.
                    If you own land, have capital, or seek a trusted development partner — we invite you to collaborate with us.
                </p>
                <div class="space-y-3" id="jv-consultation">
                    <a href="{{ route('contact') }}"
                       class="flex items-center gap-3 w-full bg-[#27AE22] text-[#1A237E] font-semibold px-6 py-3.5 rounded-xl hover:bg-[#4ADE80] transition-all text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        Book a JV Consultation
                    </a>
                    <a href="{{ route('contact') }}"
                       class="flex items-center gap-3 w-full bg-white/10 border border-white/20 text-white font-semibold px-6 py-3.5 rounded-xl hover:bg-white/15 transition-all text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Request a JV Proposal
                    </a>
                    <a href="https://wa.me/{{ $whatsapp ?? '2349122388541' }}?text=Hello%2C%20I%27d%20like%20to%20discuss%20a%20JV%20Partnership"
                       target="_blank" rel="noopener"
                       class="flex items-center gap-3 w-full bg-green-600 text-white font-semibold px-6 py-3.5 rounded-xl hover:bg-green-500 transition-all text-sm">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Speak on WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
