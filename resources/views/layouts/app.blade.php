<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
@stack('meta')
<title>@yield('title', 'Premium Real Estate') | {{ $siteName ?? 'SHEFAHOMES' }}</title>
<meta name="description" content="@yield('description', 'Premium real estate properties across Nigeria.')">
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
<style>
* { font-family: 'DM Sans', sans-serif; }
h1,h2,h3,.font-display { font-family: 'Playfair Display', serif; }
:root { --navy:#1A237E; --gold:#27AE22; }
[data-reveal] { opacity:0; transform:translateY(30px); transition:all 0.6s ease; }
[data-reveal].revealed { opacity:1; transform:translateY(0); }
[data-reveal="left"] { transform:translateX(-40px); }
[data-reveal="right"] { transform:translateX(40px); }
.page-loader { position:fixed; top:0; left:0; width:100%; height:3px; background:#27AE22; z-index:9999; animation:loader 0.8s ease forwards; }
@keyframes loader { from{width:0} to{width:100%} }
</style>
@stack('styles')
{{-- Google Tag Manager --}}
@php $gtmId = \App\Helpers\Settings::get('gtm_id'); @endphp
@if($gtmId)
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','{{ $gtmId }}');</script>
<!-- End Google Tag Manager -->
@endif
{{-- Head Scripts (Meta Pixel, analytics, etc.) from admin settings --}}
@php $headScripts = \App\Helpers\Settings::get('head_scripts'); @endphp
@if($headScripts){!! $headScripts !!}@endif
</head>
<body class="bg-white text-gray-800" x-data="{ toast: null, toastType: 'success' }" @show-toast.window="toast = $event.detail.message; toastType = $event.detail.type || 'success'; setTimeout(() => toast = null, 4000)">

<div class="page-loader" id="pageLoader"></div>

{{-- Toast Notification --}}
<div x-show="toast"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-2"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed top-4 right-4 z-[9999] min-w-[300px] max-w-sm px-5 py-4 rounded-lg shadow-2xl text-white font-body text-sm"
     :class="toastType === 'success' ? 'bg-green-600' : 'bg-red-600'"
     style="display:none;">
    <div class="flex items-start gap-3">
        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x-show="toastType==='success'" d="M5 13l4 4L19 7"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x-show="toastType==='error'" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        <span x-text="toast"></span>
    </div>
</div>

@include('components.navbar')

<main>@yield('content')</main>

@include('components.footer')

{{-- WhatsApp Floating Button --}}
<a href="https://wa.me/{{ $whatsapp ?? '2348000000000' }}?text=Hello%2C%20I'm%20interested%20in%20a%20property"
   target="_blank" rel="noopener"
   class="fixed bottom-6 right-6 z-50 bg-green-500 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-xl hover:bg-green-600 transition-all hover:scale-110"
   title="Chat on WhatsApp">
    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
    </svg>
</a>

{{-- Cookie Consent Banner --}}
<div x-data="{ show: !localStorage.getItem('cookieAccepted') }"
     x-show="show"
     x-transition:enter="transition ease-out duration-500"
     x-transition:enter-start="translate-y-full opacity-0"
     x-transition:enter-end="translate-y-0 opacity-100"
     class="fixed bottom-0 left-0 right-0 z-40 bg-[#1A237E] text-white py-4 px-6 shadow-2xl"
     style="display:none;">
    <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
        <p class="text-sm text-gray-300">We use cookies to enhance your experience. By continuing, you agree to our
            <a href="{{ route('privacy') }}" class="text-[#27AE22] underline hover:text-[#4ADE80] transition-colors">Privacy Policy</a>.
        </p>
        <button @click="show=false; localStorage.setItem('cookieAccepted','1')"
                class="shrink-0 bg-[#27AE22] text-[#1A237E] font-semibold px-6 py-2 rounded-full text-sm hover:bg-[#4ADE80] transition-colors">
            Accept
        </button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hide page loader
    setTimeout(() => {
        const l = document.getElementById('pageLoader');
        if (l) { l.style.opacity = '0'; l.style.transition = 'opacity 0.3s'; }
    }, 500);

    // Scroll reveal animation
    const reveals = document.querySelectorAll('[data-reveal]');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    reveals.forEach(el => observer.observe(el));

    // Initialize GLightbox
    if (typeof GLightbox !== 'undefined') {
        GLightbox({ selector: '.glightbox' });
    }
});
</script>
@stack('scripts')
{{-- Body Scripts (chatbots, live chat widgets, etc.) from admin settings --}}
@php $bodyScripts = \App\Helpers\Settings::get('body_scripts'); @endphp
@if($bodyScripts){!! $bodyScripts !!}@endif
{{-- Google Tag Manager (noscript) --}}
@if($gtmId ?? null)
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $gtmId }}"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
@endif
</body>
</html>
