@extends('layouts.auth')

@section('title', 'Reset Password')
@section('description', 'Reset your SHEFAHOMES account password.')

@section('auth-content')
<div>

    {{-- Header --}}
    <div class="mb-7">
        <div class="w-14 h-14 bg-[#0A1628] rounded-2xl flex items-center justify-center mb-5 shadow-lg">
            <svg class="w-7 h-7 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
            </svg>
        </div>
        <h1 class="font-display text-[#0A1628] text-3xl font-bold mb-2">Forgot Password?</h1>
        <p class="text-gray-500 text-sm leading-relaxed">
            No worries. Enter your registered email address and we'll send you a secure link to reset your password.
        </p>
    </div>

    {{-- Session Status --}}
    @if(session('status'))
        <div class="mb-5 bg-green-50 border border-green-200 text-green-700 px-4 py-4 rounded-xl text-sm">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-green-800 mb-0.5">Email Sent!</p>
                    <p class="text-green-700">{{ session('status') }}</p>
                </div>
            </div>
        </div>
    @endif

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

    {{-- Forgot Password Form --}}
    <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
        @csrf

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
                       autofocus
                       placeholder="Enter your registered email"
                       class="input-gold w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-800 bg-gray-50 placeholder-gray-400 transition-all duration-200 @error('email') border-red-400 @enderror">
            </div>
            @error('email')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit Button --}}
        <button type="submit"
                class="w-full bg-[#C9A84C] hover:bg-[#E8C97A] text-[#0A1628] font-bold py-3.5 px-6 rounded-xl transition-all duration-200 text-sm tracking-wide shadow-lg shadow-[#C9A84C]/25 hover:shadow-[#C9A84C]/40 hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Send Reset Link
        </button>

        {{-- Back to Login --}}
        <div class="text-center">
            <a href="{{ route('login') }}"
               class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-[#0A1628] transition-colors font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Sign In
            </a>
        </div>
    </form>

    {{-- Info box --}}
    <div class="mt-7 p-4 bg-blue-50 border border-blue-100 rounded-xl">
        <div class="flex items-start gap-3">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="text-xs font-semibold text-blue-800 mb-1">Check your inbox</p>
                <p class="text-xs text-blue-600 leading-relaxed">
                    The reset link will be sent to your email and expires in 60 minutes. If you don't see it, check your spam folder.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
