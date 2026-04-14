<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'My Dashboard') | SHEFAHOMES Client Portal</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
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
h1,h2,h3 { font-family: 'Playfair Display', serif; }
.sidebar-link {
    display: flex; align-items: center; gap: 0.75rem;
    padding: 0.625rem 1rem; border-radius: 0.5rem;
    color: #94a3b8; transition: all 0.2s; font-size: 0.875rem;
    white-space: nowrap;
}
.sidebar-link:hover, .sidebar-link.active {
    background: rgba(201, 168, 76, 0.15); color: #27AE22;
}
.sidebar-link .icon { width: 1.25rem; height: 1.25rem; flex-shrink: 0; }
.sidebar-section-label {
    font-size: 0.65rem; font-weight: 600; letter-spacing: 0.1em;
    text-transform: uppercase; color: #475569; padding: 0.5rem 1rem 0.25rem;
}
</style>
@stack('styles')
</head>
<body class="bg-gray-50"
      x-data="{ sidebarOpen: window.innerWidth >= 1024, mobileOpen: false, toast: null, toastType: 'success' }"
      @show-toast.window="toast = $event.detail.message; toastType = $event.detail.type || 'success'; setTimeout(() => toast = null, 4000)">

{{-- Toast Notification --}}
<div x-show="toast"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-2"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 translate-y-2"
     class="fixed top-4 right-4 z-[9999] min-w-[300px] max-w-sm px-5 py-4 rounded-lg shadow-2xl text-white text-sm flex items-start gap-3"
     :class="toastType === 'success' ? 'bg-green-600' : 'bg-red-600'"
     style="display:none;">
    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path x-show="toastType==='success'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        <path x-show="toastType==='error'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
    </svg>
    <span x-text="toast"></span>
</div>

<div class="flex h-screen overflow-hidden">

    {{-- Desktop Sidebar --}}
    <aside :class="sidebarOpen ? 'w-64' : 'w-16'"
           class="hidden lg:flex flex-col bg-[#1A237E] transition-all duration-300 overflow-y-auto overflow-x-hidden flex-shrink-0">

        {{-- Brand --}}
        <div class="flex items-center gap-3 px-4 py-5 border-b border-white/10 min-h-[72px]">
            <div class="w-8 h-8 bg-[#27AE22] rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-[#1A237E]" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                </svg>
            </div>
            <div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                <span class="text-white font-bold text-base tracking-wide block">SHEFAHOMES</span>
                <span class="text-[#27AE22] text-xs">Client Portal</span>
            </div>
        </div>

        {{-- Client ID Card --}}
        @auth
        <div x-show="sidebarOpen" class="mx-3 mt-4 mb-2 p-3 rounded-xl bg-white/5 border border-white/10">
            <div class="flex items-center gap-2 mb-3">
                <div class="w-9 h-9 rounded-full overflow-hidden ring-2 ring-[#27AE22]/40 flex-shrink-0">
                    <img src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name ?? 'Client').'&background=1A237E&color=27AE22' }}"
                         alt="{{ auth()->user()->name }}"
                         class="w-full h-full object-cover">
                </div>
                <div class="min-w-0">
                    <p class="text-white text-xs font-semibold truncate">{{ auth()->user()->name ?? 'Client' }}</p>
                    <p class="text-gray-400 text-xs truncate">{{ auth()->user()->email ?? '' }}</p>
                </div>
            </div>
            <div class="bg-[#27AE22]/10 border border-[#27AE22]/20 rounded-lg px-3 py-2">
                <p class="text-gray-400 text-xs mb-0.5">Client ID</p>
                <p class="text-[#27AE22] text-sm font-bold tracking-widest font-mono">
                    #{{ str_pad(auth()->user()->id ?? '0000', 6, '0', STR_PAD_LEFT) }}
                </p>
            </div>
        </div>
        @endauth

        {{-- Navigation --}}
        <nav class="flex-1 px-2 py-3 space-y-0.5">

            <p class="sidebar-section-label" x-show="sidebarOpen">My Account</p>

            <a href="{{ route('client.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('client.dashboard') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span x-show="sidebarOpen">Dashboard</span>
            </a>

            <a href="{{ route('client.properties.index') }}"
               class="sidebar-link {{ request()->routeIs('client.properties*') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <span x-show="sidebarOpen">My Properties</span>
            </a>

            <a href="{{ route('client.payments.index') }}"
               class="sidebar-link {{ request()->routeIs('client.payments*') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
                <span x-show="sidebarOpen">Payments</span>
            </a>

            <a href="{{ route('client.documents.index') }}"
               class="sidebar-link {{ request()->routeIs('client.documents*') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span x-show="sidebarOpen">Documents</span>
            </a>

            <p class="sidebar-section-label" x-show="sidebarOpen">Settings</p>

            <a href="{{ route('client.profile') }}"
               class="sidebar-link {{ request()->routeIs('client.profile*') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span x-show="sidebarOpen">My Profile</span>
            </a>
        </nav>

        {{-- Support Link --}}
        <div x-show="sidebarOpen" class="mx-3 mb-3">
            <a href="{{ route('contact') }}"
               class="flex items-center gap-2 p-3 rounded-xl bg-[#27AE22]/10 border border-[#27AE22]/20 hover:bg-[#27AE22]/20 transition-colors group">
                <svg class="w-4 h-4 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <div>
                    <p class="text-[#27AE22] text-xs font-semibold">Need Help?</p>
                    <p class="text-gray-400 text-xs">Contact Support</p>
                </div>
            </a>
        </div>

        {{-- Logout --}}
        <div class="px-2 py-4 border-t border-white/10">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-link w-full hover:bg-red-900/30 hover:text-red-400">
                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span x-show="sidebarOpen">Sign Out</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- Mobile Sidebar Overlay --}}
    <div x-show="mobileOpen"
         @click="mobileOpen=false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/60 z-40 lg:hidden"
         style="display:none;"></div>

    {{-- Mobile Sidebar Drawer --}}
    <aside x-show="mobileOpen"
           x-transition:enter="transition ease-out duration-300"
           x-transition:enter-start="-translate-x-full"
           x-transition:enter-end="translate-x-0"
           x-transition:leave="transition ease-in duration-200"
           x-transition:leave-start="translate-x-0"
           x-transition:leave-end="-translate-x-full"
           class="fixed left-0 top-0 bottom-0 w-64 bg-[#1A237E] z-50 lg:hidden overflow-y-auto flex flex-col"
           style="display:none;">
        <div class="flex items-center justify-between px-4 py-5 border-b border-white/10">
            <div>
                <span class="text-white font-bold text-base block">SHEFAHOMES</span>
                <span class="text-[#27AE22] text-xs">Client Portal</span>
            </div>
            <button @click="mobileOpen=false" class="text-gray-400 hover:text-white p-1 rounded">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <nav class="flex-1 px-2 py-4 space-y-0.5">
            <a href="{{ route('client.dashboard') }}" class="sidebar-link">Dashboard</a>
            <a href="{{ route('client.properties.index') }}" class="sidebar-link">My Properties</a>
            <a href="{{ route('client.payments.index') }}" class="sidebar-link">Payments</a>
            <a href="{{ route('client.documents.index') }}" class="sidebar-link">Documents</a>
            <a href="{{ route('client.profile') }}" class="sidebar-link">My Profile</a>
        </nav>
        <div class="px-2 py-4 border-t border-white/10">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-link w-full hover:bg-red-900/30 hover:text-red-400">Sign Out</button>
            </form>
        </div>
    </aside>

    {{-- Main Content Area --}}
    <div class="flex-1 flex flex-col overflow-hidden min-w-0">

        {{-- Top Header Bar --}}
        <header class="bg-white shadow-sm px-4 lg:px-6 py-3 flex items-center justify-between flex-shrink-0">
            <div class="flex items-center gap-3">
                <button @click="mobileOpen=true" class="lg:hidden text-gray-600 hover:text-gray-900 p-1 rounded">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <button @click="sidebarOpen=!sidebarOpen" class="hidden lg:block text-gray-600 hover:text-gray-900 p-1 rounded">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div>
                    <h1 class="text-gray-800 font-semibold text-sm lg:text-base leading-tight">@yield('page-title', 'My Dashboard')</h1>
                    @hasSection('breadcrumb')
                        <p class="text-gray-400 text-xs">@yield('breadcrumb')</p>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-3" x-data="{ dropOpen: false }">
                {{-- WhatsApp Quick Contact --}}
                <a href="https://wa.me/{{ $settings['whatsapp'] ?? '2349122388541' }}"
                   target="_blank"
                   class="hidden sm:flex items-center gap-1.5 text-xs text-green-600 hover:text-green-700 transition-colors bg-green-50 hover:bg-green-100 px-3 py-1.5 rounded-full">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Support
                </a>

                <div class="relative">
                    <button @click="dropOpen=!dropOpen" class="flex items-center gap-2 text-sm focus:outline-none">
                        <img src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name ?? 'Client').'&background=1A237E&color=27AE22' }}"
                             alt="{{ auth()->user()->name ?? 'Client' }}"
                             class="w-8 h-8 rounded-full object-cover ring-2 ring-[#27AE22]/30">
                        <span class="hidden sm:block text-gray-700 font-medium truncate max-w-[120px]">{{ auth()->user()->name ?? 'Client' }}</span>
                        <svg class="w-4 h-4 text-gray-400 transition-transform" :class="dropOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="dropOpen"
                         @click.away="dropOpen=false"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 top-full mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-1 z-50"
                         style="display:none;">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-xs font-semibold text-gray-900 truncate">{{ auth()->user()->name ?? 'Client' }}</p>
                            <p class="text-xs text-[#27AE22] font-mono">
                                #{{ str_pad(auth()->user()->id ?? '0000', 6, '0', STR_PAD_LEFT) }}
                            </p>
                        </div>
                        <a href="{{ route('client.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">My Profile</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">Sign Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        {{-- Session Flash Messages --}}
        @if(session('success'))
            <div class="mx-4 mt-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm flex items-center gap-2">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mx-4 mt-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm flex items-center gap-2">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto p-4 lg:p-6">
            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@stack('scripts')
</body>
</html>
