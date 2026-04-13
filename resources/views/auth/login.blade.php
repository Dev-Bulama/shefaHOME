@extends('layouts.auth')

@section('title', 'Sign In')
@section('description', 'Sign in to your SHEFAHOMES account to manage your properties and investments.')

@section('auth-content')
<div x-data="{
    portal: '{{ old('portal', 'client') }}',
    showPassword: false,
    get portalLabel() {
        const labels = { client: 'Client Portal', investor: 'Investor Portal', admin: 'Admin Panel' };
        return labels[this.portal] || 'Portal';
    },
    get redirectHint() {
        const hints = {
            client: 'Access your property dashboard and payment history.',
            investor: 'View your portfolio, ROI tracking, and investment documents.',
            admin: 'Manage the full SHEFAHOMES platform.'
        };
        return hints[this.portal] || '';
    }
}">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="font-display text-[#1A237E] text-3xl font-bold mb-2">Welcome Back</h1>
        <p class="text-gray-500 text-sm">Sign in to your <span class="text-[#27AE22] font-medium" x-text="portalLabel"></span></p>
    </div>

    {{-- Portal Tabs --}}
    <div class="flex bg-gray-100 p-1 rounded-xl mb-6 gap-1">
        <button type="button"
                @click="portal='client'"
                :class="portal==='client' ? 'bg-white text-[#1A237E] shadow-sm' : 'text-gray-500 hover:text-gray-700'"
                class="flex-1 py-2 px-3 rounded-lg text-xs font-semibold transition-all duration-200">
            <svg class="w-3.5 h-3.5 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Client
        </button>
        <button type="button"
                @click="portal='investor'"
                :class="portal==='investor' ? 'bg-white text-[#1A237E] shadow-sm' : 'text-gray-500 hover:text-gray-700'"
                class="flex-1 py-2 px-3 rounded-lg text-xs font-semibold transition-all duration-200">
            <svg class="w-3.5 h-3.5 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
            </svg>
            Investor
        </button>
        <button type="button"
                @click="portal='admin'"
                :class="portal==='admin' ? 'bg-white text-[#1A237E] shadow-sm' : 'text-gray-500 hover:text-gray-700'"
                class="flex-1 py-2 px-3 rounded-lg text-xs font-semibold transition-all duration-200">
            <svg class="w-3.5 h-3.5 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            Admin
        </button>
    </div>

    {{-- Portal Hint --}}
    <div class="mb-6 px-4 py-2.5 bg-[#1A237E]/5 border border-[#1A237E]/10 rounded-lg">
        <p class="text-xs text-gray-500" x-text="redirectHint"></p>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="mb-5 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm">
            <div class="flex items-start gap-2">
                <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <ul class="space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- Session Status --}}
    @if(session('status'))
        <div class="mb-5 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('status') }}
        </div>
    @endif

    {{-- Login Form --}}
    <form action="{{ route('login') }}" method="POST" class="space-y-5">
        @csrf
        <input type="hidden" name="portal" :value="portal">

        {{-- Email --}}
        <div>
            <label for="email" class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">
                Email Address
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                    </svg>
                </div>
                <input type="email"
                       id="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autocomplete="email"
                       placeholder="you@example.com"
                       class="input-gold w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-800 bg-gray-50 placeholder-gray-400 transition-all duration-200 @error('email') border-red-400 @enderror">
            </div>
            @error('email')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">
                    Password
                </label>
                <a href="{{ route('password.request') }}"
                   class="text-xs text-[#27AE22] hover:text-[#4ADE80] transition-colors font-medium">
                    Forgot password?
                </a>
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <input :type="showPassword ? 'text' : 'password'"
                       id="password"
                       name="password"
                       required
                       autocomplete="current-password"
                       placeholder="••••••••"
                       class="input-gold w-full pl-10 pr-12 py-3 border border-gray-200 rounded-xl text-sm text-gray-800 bg-gray-50 placeholder-gray-400 transition-all duration-200 @error('password') border-red-400 @enderror">
                <button type="button"
                        @click="showPassword=!showPassword"
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600">
                    <svg x-show="!showPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg x-show="showPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer group">
                <div class="relative">
                    <input type="checkbox"
                           name="remember"
                           id="remember"
                           class="sr-only peer"
                           {{ old('remember') ? 'checked' : '' }}>
                    <div class="w-9 h-5 bg-gray-200 rounded-full peer-checked:bg-[#27AE22] transition-colors duration-200"></div>
                    <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform duration-200 peer-checked:translate-x-4"></div>
                </div>
                <span class="text-sm text-gray-600 group-hover:text-gray-800 transition-colors">Keep me signed in</span>
            </label>
        </div>

        {{-- Submit Button --}}
        <button type="submit"
                class="w-full bg-[#27AE22] hover:bg-[#4ADE80] text-[#1A237E] font-bold py-3.5 px-6 rounded-xl transition-all duration-200 text-sm tracking-wide shadow-lg shadow-[#27AE22]/25 hover:shadow-[#27AE22]/40 hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            Sign In to <span x-text="portalLabel"></span>
        </button>

        {{-- Register Link (Client only) --}}
        <div x-show="portal==='client'" class="text-center" x-transition>
            <p class="text-sm text-gray-500">
                Don't have an account?
                <a href="{{ route('register') }}"
                   class="text-[#1A237E] hover:text-[#27AE22] font-semibold transition-colors ml-1">
                    Create Account
                </a>
            </p>
        </div>

        {{-- Admin security note --}}
        <div x-show="portal==='admin'" class="text-center" x-transition>
            <p class="text-xs text-gray-400 flex items-center justify-center gap-1.5">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                Admin access is restricted. Contact your system administrator.
            </p>
        </div>

        {{-- Investor note --}}
        <div x-show="portal==='investor'" class="text-center" x-transition>
            <p class="text-xs text-gray-400 flex items-center justify-center gap-1.5">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                New investor? Contact us at
                <a href="mailto:invest@shefahomes.com" class="text-[#27AE22] hover:underline">invest@shefahomes.com</a>
            </p>
        </div>
    </form>

    {{-- Divider --}}
    <div class="flex items-center gap-4 my-6">
        <div class="flex-1 h-px bg-gray-200"></div>
        <span class="text-xs text-gray-400 font-medium">SECURE LOGIN</span>
        <div class="flex-1 h-px bg-gray-200"></div>
    </div>

    {{-- Security badges --}}
    <div class="flex items-center justify-center gap-4 text-xs text-gray-400">
        <span class="flex items-center gap-1">
            <svg class="w-3.5 h-3.5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            SSL Secured
        </span>
        <span class="flex items-center gap-1">
            <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            256-bit Encryption
        </span>
        <span class="flex items-center gap-1">
            <svg class="w-3.5 h-3.5 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
            </svg>
            Verified Platform
        </span>
    </div>
</div>
@endsection
