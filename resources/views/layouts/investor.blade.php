<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Investor Dashboard') | SHEFAHOMES Investor Portal</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
    theme: {
        extend: {
            colors: { navy: '#0A1628', gold: '#C9A84C', 'gold-light': '#E8C97A' },
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
    background: rgba(201, 168, 76, 0.15); color: #C9A84C;
}
.sidebar-link .icon { width: 1.25rem; height: 1.25rem; flex-shrink: 0; }
.sidebar-section-label {
    font-size: 0.65rem; font-weight: 600; letter-spacing: 0.1em;
    text-transform: uppercase; color: #475569; padding: 0.5rem 1rem 0.25rem;
}
.tier-badge-platinum { background: linear-gradient(135deg, #e5e7eb, #9ca3af); color: #1f2937; }
.tier-badge-gold { background: linear-gradient(135deg, #C9A84C, #E8C97A); color: #0A1628; }
.tier-badge-silver { background: linear-gradient(135deg, #cbd5e1, #94a3b8); color: #1e293b; }
.tier-badge-bronze { background: linear-gradient(135deg, #d97706, #b45309); color: #fff; }
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
           class="hidden lg:flex flex-col bg-[#0A1628] transition-all duration-300 overflow-y-auto overflow-x-hidden flex-shrink-0">

        {{-- Brand --}}
        <div class="flex items-center gap-3 px-4 py-5 border-b border-white/10 min-h-[72px]">
            <div class="w-8 h-8 bg-[#C9A84C] rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-[#0A1628]" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                </svg>
            </div>
            <div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                <span class="text-white font-bold text-base tracking-wide block">SHEFAHOMES</span>
                <span class="text-[#C9A84C] text-xs">Investor Portal</span>
            </div>
        </div>

        {{-- Investor Tier Badge --}}
        @auth
        <div x-show="sidebarOpen" class="mx-3 mt-4 mb-2 p-3 rounded-xl bg-white/5 border border-white/10">
            <div class="flex items-center gap-2 mb-2">
                <div class="w-9 h-9 rounded-full overflow-hidden ring-2 ring-[#C9A84C]/40 flex-shrink-0">
                    <img src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name ?? 'Investor').'&background=0A1628&color=C9A84C' }}"
                         alt="{{ auth()->user()->name }}"
                         class="w-full h-full object-cover">
                </div>
                <div class="min-w-0">
                    <p class="text-white text-xs font-semibold truncate">{{ auth()->user()->name ?? 'Investor' }}</p>
                    <p class="text-gray-400 text-xs truncate">{{ auth()->user()->email ?? '' }}</p>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-gray-400 text-xs">Tier</span>
                @php
                    $tier = auth()->user()->investor_tier ?? 'silver';
                    $tierClass = match(strtolower($tier)) {
                        'platinum' => 'tier-badge-platinum',
                        'gold' => 'tier-badge-gold',
                        'bronze' => 'tier-badge-bronze',
                        default => 'tier-badge-silver',
                    };
                @endphp
                <span class="px-2 py-0.5 rounded-full text-xs font-bold {{ $tierClass }} capitalize">
                    {{ ucfirst($tier) }}
                </span>
            </div>
        </div>
        @endauth

        {{-- Navigation --}}
        <nav class="flex-1 px-2 py-3 space-y-0.5">

            <p class="sidebar-section-label" x-show="sidebarOpen">My Portal</p>

            <a href="{{ route('investor.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('investor.dashboard') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span x-show="sidebarOpen">Dashboard</span>
            </a>

            <a href="{{ route('investor.portfolio.index') }}"
               class="sidebar-link {{ request()->routeIs('investor.portfolio*') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <span x-show="sidebarOpen">My Portfolio</span>
            </a>

            <a href="{{ route('investor.returns.index') }}"
               class="sidebar-link {{ request()->routeIs('investor.returns*') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                <span x-show="sidebarOpen">Returns & ROI</span>
            </a>

            <a href="{{ route('investor.documents.index') }}"
               class="sidebar-link {{ request()->routeIs('investor.documents*') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span x-show="sidebarOpen">Documents</span>
            </a>

            <p class="sidebar-section-label" x-show="sidebarOpen">Account</p>

            <a href="{{ route('investor.profile.edit') }}"
               class="sidebar-link {{ request()->routeIs('investor.profile*') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span x-show="sidebarOpen">My Profile</span>
            </a>
        </nav>

        {{-- Quick Stats (collapsed: icon only) --}}
        <div x-show="sidebarOpen" class="mx-3 mb-3 p-3 rounded-xl bg-[#C9A84C]/10 border border-[#C9A84C]/20">
            <p class="text-[#C9A84C] text-xs font-semibold mb-2 uppercase tracking-wider">Quick Stats</p>
            <div class="space-y-1.5">
                <div class="flex justify-between items-center">
                    <span class="text-gray-400 text-xs">Properties</span>
                    <span class="text-white text-xs font-semibold">{{ auth()->user()->investor->portfolio_count ?? '—' }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-400 text-xs">Total ROI</span>
                    <span class="text-[#C9A84C] text-xs font-semibold">{{ auth()->user()->investor->total_roi_formatted ?? '—' }}</span>
                </div>
            </div>
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
           class="fixed left-0 top-0 bottom-0 w-64 bg-[#0A1628] z-50 lg:hidden overflow-y-auto flex flex-col"
           style="display:none;">
        <div class="flex items-center justify-between px-4 py-5 border-b border-white/10">
            <div>
                <span class="text-white font-bold text-base block">SHEFAHOMES</span>
                <span class="text-[#C9A84C] text-xs">Investor Portal</span>
            </div>
            <button @click="mobileOpen=false" class="text-gray-400 hover:text-white p-1 rounded">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <nav class="flex-1 px-2 py-4 space-y-0.5">
            <a href="{{ route('investor.dashboard') }}" class="sidebar-link">Dashboard</a>
            <a href="{{ route('investor.portfolio.index') }}" class="sidebar-link">My Portfolio</a>
            <a href="{{ route('investor.returns.index') }}" class="sidebar-link">Returns & ROI</a>
            <a href="{{ route('investor.documents.index') }}" class="sidebar-link">Documents</a>
            <a href="{{ route('investor.profile.edit') }}" class="sidebar-link">My Profile</a>
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
                    <h1 class="text-gray-800 font-semibold text-sm lg:text-base leading-tight">@yield('page-title', 'Dashboard')</h1>
                    @hasSection('breadcrumb')
                        <p class="text-gray-400 text-xs">@yield('breadcrumb')</p>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-3" x-data="{ dropOpen: false }">
                {{-- Notifications --}}
                <button class="relative text-gray-500 hover:text-[#0A1628] p-1 rounded transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>

                <a href="{{ route('home') }}" target="_blank"
                   class="text-gray-500 hover:text-[#0A1628] text-xs hidden sm:flex items-center gap-1 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    View Site
                </a>

                <div class="relative">
                    <button @click="dropOpen=!dropOpen" class="flex items-center gap-2 text-sm focus:outline-none">
                        <img src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name ?? 'Investor').'&background=0A1628&color=C9A84C' }}"
                             alt="{{ auth()->user()->name ?? 'Investor' }}"
                             class="w-8 h-8 rounded-full object-cover ring-2 ring-[#C9A84C]/30">
                        <span class="hidden sm:block text-gray-700 font-medium truncate max-w-[120px]">{{ auth()->user()->name ?? 'Investor' }}</span>
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
                            <p class="text-xs font-semibold text-gray-900 truncate">{{ auth()->user()->name ?? 'Investor' }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email ?? '' }}</p>
                        </div>
                        <a href="{{ route('investor.profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">My Profile</a>
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
