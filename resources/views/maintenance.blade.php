<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Under Maintenance — SHEFAHOMES</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<style>* { font-family: 'DM Sans', sans-serif; } h1,h2 { font-family: 'Playfair Display', serif; }</style>
</head>
<body class="min-h-screen bg-[#1A237E] flex items-center justify-center px-4">
<div class="max-w-2xl w-full text-center">

    {{-- Logo mark --}}
    <div class="w-20 h-20 bg-[#27AE22] rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl shadow-[#27AE22]/30">
        <svg class="w-10 h-10 text-[#1A237E]" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
        </svg>
    </div>

    {{-- Content --}}
    <span class="inline-block text-[#27AE22] font-semibold text-xs tracking-widest uppercase mb-4">Site Notice</span>
    <h1 class="text-4xl sm:text-5xl font-bold text-white mb-5 leading-tight">
        We'll Be Back<br><span class="text-[#27AE22]">Very Soon</span>
    </h1>
    <p class="text-gray-300 text-lg mb-10 leading-relaxed max-w-xl mx-auto">
        We're making improvements to give you a better experience. Shefa Homes and Properties Ltd will be back online shortly. Thank you for your patience.
    </p>

    {{-- Contact links --}}
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
        @php $wa = \App\Helpers\Settings::get('whatsapp', '2348000000000'); @endphp
        <a href="https://wa.me/{{ $wa }}"
           target="_blank" rel="noopener"
           class="inline-flex items-center justify-center gap-2 bg-green-500 text-white font-semibold px-8 py-4 rounded-full hover:bg-green-400 transition-all">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            Chat on WhatsApp
        </a>
        @php $email = \App\Helpers\Settings::get('email', ''); @endphp
        @if($email)
        <a href="mailto:{{ $email }}"
           class="inline-flex items-center justify-center gap-2 border-2 border-white/30 text-white font-semibold px-8 py-4 rounded-full hover:bg-white/10 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Email Us
        </a>
        @endif
    </div>

    {{-- Footer note --}}
    <p class="text-gray-500 text-sm mt-12">&copy; {{ date('Y') }} Shefa Homes and Properties Ltd. All rights reserved.</p>
</div>
</body>
</html>
