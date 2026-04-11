@extends('layouts.auth')

@section('title', 'Create Account')
@section('description', 'Create your SHEFAHOMES client account to start your property journey.')

@section('auth-content')
<div x-data="{ showPassword: false, showConfirm: false }">

    {{-- Header --}}
    <div class="mb-7">
        <h1 class="font-display text-[#0A1628] text-3xl font-bold mb-2">Create Account</h1>
        <p class="text-gray-500 text-sm">Join thousands of satisfied homeowners across Nigeria.</p>
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

    {{-- Register Form --}}
    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf

        {{-- Full Name --}}
        <div>
            <label for="name" class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">Full Name</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       autocomplete="name"
                       placeholder="Your full name"
                       class="input-gold w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-800 bg-gray-50 placeholder-gray-400 transition-all duration-200 @error('name') border-red-400 @enderror">
            </div>
            @error('name')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">Email Address</label>
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

        {{-- Phone --}}
        <div>
            <label for="phone" class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">Phone Number</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <input type="tel"
                       id="phone"
                       name="phone"
                       value="{{ old('phone') }}"
                       required
                       autocomplete="tel"
                       placeholder="+234 800 000 0000"
                       class="input-gold w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-800 bg-gray-50 placeholder-gray-400 transition-all duration-200 @error('phone') border-red-400 @enderror">
            </div>
            @error('phone')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">Password</label>
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
                       autocomplete="new-password"
                       placeholder="Min. 8 characters"
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

        {{-- Confirm Password --}}
        <div>
            <label for="password_confirmation" class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">Confirm Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <input :type="showConfirm ? 'text' : 'password'"
                       id="password_confirmation"
                       name="password_confirmation"
                       required
                       autocomplete="new-password"
                       placeholder="Repeat your password"
                       class="input-gold w-full pl-10 pr-12 py-3 border border-gray-200 rounded-xl text-sm text-gray-800 bg-gray-50 placeholder-gray-400 transition-all duration-200">
                <button type="button"
                        @click="showConfirm=!showConfirm"
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600">
                    <svg x-show="!showConfirm" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg x-show="showConfirm" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Terms --}}
        <div class="flex items-start gap-3">
            <input type="checkbox"
                   id="terms"
                   name="terms"
                   required
                   class="mt-0.5 w-4 h-4 rounded border-gray-300 text-[#C9A84C] focus:ring-[#C9A84C] focus:ring-offset-0 cursor-pointer">
            <label for="terms" class="text-xs text-gray-500 leading-relaxed cursor-pointer">
                I agree to the
                <a href="{{ route('terms') }}" target="_blank" class="text-[#C9A84C] hover:text-[#E8C97A] transition-colors font-medium">Terms of Service</a>
                and
                <a href="{{ route('privacy') }}" target="_blank" class="text-[#C9A84C] hover:text-[#E8C97A] transition-colors font-medium">Privacy Policy</a>
            </label>
        </div>

        {{-- Submit Button --}}
        <button type="submit"
                class="w-full bg-[#0A1628] hover:bg-[#0d1e3d] text-white font-bold py-3.5 px-6 rounded-xl transition-all duration-200 text-sm tracking-wide shadow-lg hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2 mt-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            Create My Account
        </button>

        {{-- Login Link --}}
        <div class="text-center pt-2">
            <p class="text-sm text-gray-500">
                Already have an account?
                <a href="{{ route('login') }}" class="text-[#C9A84C] hover:text-[#E8C97A] font-semibold transition-colors ml-1">Sign In</a>
            </p>
        </div>
    </form>
</div>
@endsection
