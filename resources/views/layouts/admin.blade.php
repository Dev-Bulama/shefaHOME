<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Dashboard') | SHEFAHOMES Admin</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
    theme: {
        extend: {
            colors: { navy: '#0A1628', gold: '#C9A84C', 'gold-light': '#E8C97A' }
        }
    }
}
</script>
<style>
* { font-family: 'DM Sans', sans-serif; }
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
</style>
@stack('styles')
</head>
<body class="bg-gray-100"
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
                <span class="text-[#0A1628] font-bold text-sm">S</span>
            </div>
            <div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                <span class="text-white font-bold text-base tracking-wide block">SHEFAHOMES</span>
                <span class="text-[#C9A84C] text-xs">Admin Panel</span>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-2 py-4 space-y-0.5">

            <p class="sidebar-section-label" x-show="sidebarOpen">Main</p>

            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span x-show="sidebarOpen">Dashboard</span>
            </a>

            <p class="sidebar-section-label" x-show="sidebarOpen">Content</p>

            <a href="{{ route('admin.properties.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.properties*') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <span x-show="sidebarOpen">Properties</span>
            </a>

            <a href="{{ route('admin.sliders.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.sliders*') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span x-show="sidebarOpen">Sliders</span>
            </a>

            <a href="{{ route('admin.blog.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.blog*') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
                <span x-show="sidebarOpen">Blog</span>
            </a>

            <a href="{{ route('admin.awards.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.awards*') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                </svg>
                <span x-show="sidebarOpen">Awards</span>
            </a>

            <p class="sidebar-section-label" x-show="sidebarOpen">People</p>

            <a href="{{ route('admin.team.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.team*') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
                </svg>
                <span x-show="sidebarOpen">Team</span>
            </a>

            <a href="{{ route('admin.testimonials.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <span x-show="sidebarOpen">Testimonials</span>
            </a>

            <a href="{{ route('admin.clients.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.clients*') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <span x-show="sidebarOpen">Clients</span>
            </a>

            <a href="{{ route('admin.investors.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.investors*') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span x-show="sidebarOpen">Investors</span>
            </a>

            <p class="sidebar-section-label" x-show="sidebarOpen">Operations</p>

            <a href="{{ route('admin.inquiries.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.inquiries*') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span x-show="sidebarOpen">Inquiries</span>
            </a>

            <a href="{{ route('admin.careers.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.careers*') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span x-show="sidebarOpen">Careers</span>
            </a>

            <a href="{{ route('admin.faqs.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.faqs*') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span x-show="sidebarOpen">FAQs</span>
            </a>

            <p class="sidebar-section-label" x-show="sidebarOpen">System</p>

            <a href="{{ route('admin.settings.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span x-show="sidebarOpen">Settings</span>
            </a>

            <a href="{{ route('admin.system-update.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.system-update*') ? 'active' : '' }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
                <span x-show="sidebarOpen">System Update</span>
            </a>
        </nav>

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
                <span class="text-[#C9A84C] text-xs">Admin Panel</span>
            </div>
            <button @click="mobileOpen=false" class="text-gray-400 hover:text-white p-1 rounded">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <nav class="flex-1 px-2 py-4 space-y-0.5">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link">Dashboard</a>
            <a href="{{ route('admin.properties.index') }}" class="sidebar-link">Properties</a>
            <a href="{{ route('admin.sliders.index') }}" class="sidebar-link">Sliders</a>
            <a href="{{ route('admin.blog.index') }}" class="sidebar-link">Blog</a>
            <a href="{{ route('admin.awards.index') }}" class="sidebar-link">Awards</a>
            <a href="{{ route('admin.team.index') }}" class="sidebar-link">Team</a>
            <a href="{{ route('admin.testimonials.index') }}" class="sidebar-link">Testimonials</a>
            <a href="{{ route('admin.clients.index') }}" class="sidebar-link">Clients</a>
            <a href="{{ route('admin.investors.index') }}" class="sidebar-link">Investors</a>
            <a href="{{ route('admin.inquiries.index') }}" class="sidebar-link">Inquiries</a>
            <a href="{{ route('admin.careers.index') }}" class="sidebar-link">Careers</a>
            <a href="{{ route('admin.faqs.index') }}" class="sidebar-link">FAQs</a>
            <a href="{{ route('admin.settings.index') }}" class="sidebar-link">Settings</a>
            <a href="{{ route('admin.system-update.index') }}" class="sidebar-link">System Update</a>
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
                {{-- Mobile hamburger --}}
                <button @click="mobileOpen=true" class="lg:hidden text-gray-600 hover:text-gray-900 p-1 rounded">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                {{-- Desktop collapse toggle --}}
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
                <a href="{{ route('home') }}" target="_blank"
                   class="text-gray-500 hover:text-[#0A1628] text-xs hidden sm:flex items-center gap-1 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    View Site
                </a>

                <div class="relative">
                    <button @click="dropOpen=!dropOpen" class="flex items-center gap-2 text-sm focus:outline-none">
                        <img src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name ?? 'Admin').'&background=0A1628&color=C9A84C' }}"
                             alt="{{ auth()->user()->name ?? 'Admin' }}"
                             class="w-8 h-8 rounded-full object-cover ring-2 ring-[#C9A84C]/30">
                        <span class="hidden sm:block text-gray-700 font-medium truncate max-w-[120px]">{{ auth()->user()->name ?? 'Admin' }}</span>
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
                            <p class="text-xs font-semibold text-gray-900 truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email ?? '' }}</p>
                        </div>
                        <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">Settings</a>
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
        @if(session('warning'))
            <div class="mx-4 mt-4 bg-yellow-50 border border-yellow-200 text-yellow-700 px-4 py-3 rounded-lg text-sm flex items-center gap-2">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
                {{ session('warning') }}
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
