@extends('layouts.app')

@section('title', 'Apply — ' . ($job->title ?? 'Open Position') . ' — SHEFAHOMES')
@section('meta_description', 'Apply for ' . ($job->title ?? 'this position') . ' at SHEFAHOMES Nigeria.')

@section('content')

{{-- Hero --}}
<section class="bg-[#0A1628] py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-sm text-gray-400 mb-6 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-[#C9A84C]">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('careers.index') }}" class="hover:text-[#C9A84C]">Careers</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('careers.show', $job->slug ?? $job->id ?? '#') }}" class="hover:text-[#C9A84C]">{{ $job->title ?? 'Position' }}</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-[#C9A84C]">Apply</span>
        </nav>
        <div class="text-center">
            <span class="inline-block text-[#C9A84C] font-semibold text-sm tracking-widest uppercase mb-3">Job Application</span>
            <h1 class="font-display text-4xl lg:text-5xl font-bold text-white mb-3">Apply for</h1>
            <h2 class="font-display text-3xl font-bold text-[#C9A84C]">{{ $job->title ?? 'Open Position' }}</h2>
        </div>
    </div>
</section>

{{-- Application Form --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="h-1 bg-gradient-to-r from-[#0A1628] via-[#C9A84C] to-[#0A1628]"></div>
            <div class="p-8 lg:p-10">
                <h3 class="font-display text-xl font-bold text-[#0A1628] mb-2">Your Application</h3>
                <p class="text-gray-400 text-sm mb-8">Fill in the details below. All fields marked * are required.</p>

                @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-6 text-center mb-6">
                    <svg class="w-12 h-12 text-emerald-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <h3 class="font-bold text-emerald-800 text-lg mb-1">Application Submitted!</h3>
                    <p class="text-emerald-700 text-sm">{{ session('success') }}</p>
                </div>
                @endif

                @if($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
                    <ul class="space-y-1">
                        @foreach($errors->all() as $error)
                        <li class="text-red-600 text-sm flex items-center gap-2">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $error }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('careers.apply', $job->slug ?? $job->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="hidden" name="job_id" value="{{ $job->id }}">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">First Name *</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" required
                                   placeholder="John"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C9A84C] focus:border-[#C9A84C] text-[#0A1628] transition-all @error('first_name') border-red-400 @enderror">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Last Name *</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" required
                                   placeholder="Doe"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C9A84C] focus:border-[#C9A84C] text-[#0A1628] transition-all @error('last_name') border-red-400 @enderror">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Email Address *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               placeholder="john@example.com"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C9A84C] focus:border-[#C9A84C] text-[#0A1628] transition-all @error('email') border-red-400 @enderror">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Phone Number *</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" required
                               placeholder="+234 800 000 0000"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C9A84C] focus:border-[#C9A84C] text-[#0A1628] transition-all @error('phone') border-red-400 @enderror">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Cover Letter *</label>
                        <textarea name="cover_letter" rows="6" required
                                  placeholder="Tell us why you're the perfect candidate for this role and what value you would bring to SHEFAHOMES..."
                                  class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C9A84C] focus:border-[#C9A84C] text-[#0A1628] resize-none transition-all @error('cover_letter') border-red-400 @enderror">{{ old('cover_letter') }}</textarea>
                    </div>

                    {{-- CV Upload --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Upload CV / Resume *</label>
                        <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-[#C9A84C] transition-colors cursor-pointer"
                             x-data="{ fileName: '' }"
                             @dragover.prevent
                             @drop.prevent="fileName = $event.dataTransfer.files[0]?.name; $refs.cvInput.files = $event.dataTransfer.files">
                            <input type="file" name="cv" id="cv" ref="cvInput" accept=".pdf,.doc,.docx"
                                   class="hidden"
                                   @change="fileName = $event.target.files[0]?.name"
                                   x-ref="cvInput">
                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                            <p x-show="!fileName" class="text-gray-400 text-sm mb-3">Drag &amp; drop your CV here, or</p>
                            <p x-show="fileName" class="text-[#0A1628] font-semibold text-sm mb-3" x-text="fileName"></p>
                            <label for="cv" class="cursor-pointer bg-[#0A1628] hover:bg-[#C9A84C] hover:text-[#0A1628] text-white text-xs font-bold px-5 py-2 rounded-xl transition-all">
                                Browse Files
                            </label>
                            <p class="text-xs text-gray-400 mt-3">PDF, DOC or DOCX — Max 5MB</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 pt-2">
                        <input type="checkbox" name="consent" id="consent" required
                               class="w-4 h-4 text-[#C9A84C] border-gray-300 rounded mt-1 focus:ring-[#C9A84C]">
                        <label for="consent" class="text-gray-500 text-sm leading-relaxed">
                            I consent to SHEFAHOMES storing and processing my personal data for recruitment purposes in accordance with the <a href="{{ route('privacy') }}" class="text-[#C9A84C] hover:underline">Privacy Policy</a>.
                        </label>
                    </div>

                    <button type="submit"
                            class="w-full bg-[#C9A84C] hover:bg-[#b8943d] text-[#0A1628] font-bold py-4 rounded-xl transition-all hover:scale-[1.01] hover:shadow-lg hover:shadow-[#C9A84C]/30 text-base">
                        Submit Application
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
