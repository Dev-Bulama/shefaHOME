<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<link rel="alternate icon" href="/favicon.ico">
<title>@yield('title', 'Sign In') | SHEFAHOMES</title>
<meta name="description" content="@yield('description', 'Access your SHEFAHOMES account.')">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
    theme: {
        extend: {
            colors: { navy: '#1A237E', gold: '#27AE22', 'gold-light': '#4ADE80' },
            fontFamily: { display: ['"Playfair Display"','serif'], body: ['"DM Sans"','sans-serif'] }
        }
    }
}
</script>
<style>
* { font-family: 'DM Sans', sans-serif; }
h1,h2,h3,.font-display { font-family: 'Playfair Display', serif; }
:root { --navy:#1A237E; --gold:#27AE22; }

/* Gold focus ring for inputs */
.input-gold:focus {
    outline: none;
    border-color: #27AE22;
    box-shadow: 0 0 0 3px rgba(201,168,76,0.15);
}

/* Auth page split image */
.auth-image-panel {
    background-image: linear-gradient(
        to bottom right,
        rgba(10,22,40,0.85) 0%,
        rgba(10,22,40,0.65) 50%,
        rgba(10,22,40,0.80) 100%
    ), url('https://picsum.photos/seed/luxury/1200/800');
    background-size: cover;
    background-position: center;
}

/* Floating label animation */
.floating-group input:focus + label,
.floating-group input:not(:placeholder-shown) + label {
    transform: translateY(-1.5rem) scale(0.85);
    color: #27AE22;
}
.floating-group label {
    transition: all 0.2s ease;
    transform-origin: left top;
}
</style>
@stack('styles')
</head>
<body class="bg-gray-50 min-h-screen" x-data="{}">

<div class="min-h-screen flex">

    {{-- Left Panel: Luxury Property Image --}}
    <div class="hidden lg:flex lg:w-1/2 xl:w-5/12 auth-image-panel relative flex-col justify-between p-10 overflow-hidden">

        {{-- Decorative patterns --}}
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <div class="absolute top-0 right-0 w-64 h-64 border border-[#27AE22]/30 rounded-full -translate-y-32 translate-x-32"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 border border-[#27AE22]/20 rounded-full translate-y-48 -translate-x-48"></div>
        </div>

        {{-- Top: Logo --}}
        <div class="relative z-10">
            @php
                $authLogo       = \App\Helpers\Settings::get('logo');
                $authLogoHeight = \App\Helpers\Settings::get('logo_height', '48');
            @endphp
            <a href="{{ route('home') }}" class="flex items-center gap-3 w-fit">
                @if($authLogo)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($authLogo) }}"
                         alt="SHEFAHOMES"
                         style="height: {{ intval($authLogoHeight) }}px;"
                         class="w-auto object-contain">
                @else
                <div class="w-10 h-10 bg-[#27AE22] rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-[#1A237E]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                </div>
                <span class="text-white font-display font-bold text-xl tracking-wide">SHEFAHOMES</span>
                @endif
            </a>
        </div>

        {{-- Middle: Tagline --}}
        <div class="relative z-10">
            <div class="w-12 h-0.5 bg-[#27AE22] mb-6"></div>
            <h2 class="font-display text-white text-3xl xl:text-4xl font-bold leading-tight mb-4">
                Building Dreams<br>
                <span class="text-[#27AE22]">Across Nigeria</span>
            </h2>
            <p class="text-gray-300 text-sm xl:text-base leading-relaxed max-w-sm">
                Access your premium real estate dashboard. Manage properties, track investments, and connect with our expert team.
            </p>

            {{-- Trust badges --}}
            <div class="flex items-center gap-6 mt-8">
                <div class="text-center">
                    <p class="text-[#27AE22] font-display font-bold text-2xl">500+</p>
                    <p class="text-gray-400 text-xs mt-0.5">Properties Sold</p>
                </div>
                <div class="w-px h-10 bg-white/20"></div>
                <div class="text-center">
                    <p class="text-[#27AE22] font-display font-bold text-2xl">15+</p>
                    <p class="text-gray-400 text-xs mt-0.5">Years Experience</p>
                </div>
                <div class="w-px h-10 bg-white/20"></div>
                <div class="text-center">
                    <p class="text-[#27AE22] font-display font-bold text-2xl">98%</p>
                    <p class="text-gray-400 text-xs mt-0.5">Client Satisfaction</p>
                </div>
            </div>
        </div>

        {{-- Bottom: Testimonial --}}
        <div class="relative z-10">
            <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-5">
                <div class="flex items-start gap-3">
                    <svg class="w-6 h-6 text-[#27AE22] flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                    </svg>
                    <div>
                        <p class="text-gray-200 text-sm italic leading-relaxed">
                            "SHEFAHOMES made purchasing my dream home seamless. Truly premium service from start to finish."
                        </p>
                        <div class="flex items-center gap-2 mt-3">
                            <img src="https://ui-avatars.com/api/?name=Amara+O&background=27AE22&color=1A237E&size=32"
                                 alt="Client" class="w-7 h-7 rounded-full">
                            <div>
                                <p class="text-white text-xs font-semibold">Amara Okafor</p>
                                <p class="text-gray-400 text-xs">Lekki, Lagos</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Panel: Form Content --}}
    <div class="flex-1 flex flex-col justify-center items-center px-6 py-10 lg:px-12 xl:px-16 bg-white relative overflow-y-auto">

        {{-- Mobile Logo --}}
        <div class="lg:hidden mb-8 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 justify-center">
                @if($authLogo ?? false)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($authLogo) }}"
                         alt="SHEFAHOMES"
                         style="height: {{ intval($authLogoHeight ?? 48) }}px;"
                         class="w-auto object-contain">
                @else
                <div class="w-9 h-9 bg-[#1A237E] rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#27AE22]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                </div>
                <span class="font-display font-bold text-[#1A237E] text-xl tracking-wide">SHEFAHOMES</span>
                @endif
            </a>
        </div>

        {{-- Form Slot --}}
        <div class="w-full max-w-md">
            @yield('auth-content')
        </div>

        {{-- Bottom Links --}}
        <div class="mt-8 text-center">
            <a href="{{ route('home') }}" class="text-xs text-gray-400 hover:text-[#1A237E] transition-colors inline-flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Homepage
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@stack('scripts')
</body>
</html>
