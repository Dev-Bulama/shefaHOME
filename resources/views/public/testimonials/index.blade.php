@extends('layouts.app')

@section('title', 'Client Testimonials — SHEFAHOMES')
@section('meta_description', 'Real stories from real investors. See what clients say about SHEFAHOMES Nigeria.')

@section('content')

{{-- Hero --}}
<section class="bg-[#0A1628] py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-5 bg-[url('data:image/svg+xml,%3Csvg width=\"40\" height=\"40\" viewBox=\"0 0 40 40\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"%23C9A84C\"%3E%3Ccircle cx=\"20\" cy=\"20\" r=\"1.5\"/%3E%3C/g%3E%3C/svg%3E')]"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block text-[#C9A84C] font-semibold text-sm tracking-widest uppercase mb-3">Social Proof</span>
        <h1 class="font-display text-5xl lg:text-6xl font-bold text-white mb-4">
            Our Clients <span class="text-[#C9A84C]">Speak</span>
        </h1>
        <p class="text-gray-300 text-xl max-w-xl mx-auto">
            Over 5,000 families and investors trust SHEFAHOMES. Here is what they have to say.
        </p>
        {{-- Star rating summary --}}
        <div class="flex items-center justify-center gap-2 mt-6">
            <div class="flex gap-1">
                @for($i=0;$i<5;$i++)
                <svg class="w-6 h-6 text-[#C9A84C]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                @endfor
            </div>
            <span class="text-white font-bold text-xl">4.9</span>
            <span class="text-gray-400 text-sm">/ 5 from 500+ reviews</span>
        </div>
    </div>
</section>

{{-- Video Testimonials --}}
@if(isset($videoTestimonials) && $videoTestimonials->count())
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-reveal>
            <span class="inline-block text-[#C9A84C] font-semibold text-sm tracking-widest uppercase mb-3">Watch Their Stories</span>
            <h2 class="font-display text-4xl font-bold text-[#0A1628]">Video <span class="text-[#C9A84C]">Testimonials</span></h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"
             x-data="{
                 modalOpen: false,
                 videoUrl: '',
                 openVideo(url) { this.videoUrl = url; this.modalOpen = true; },
                 closeVideo() { this.modalOpen = false; this.videoUrl = ''; }
             }">

            @foreach($videoTestimonials as $i => $vt)
            <div class="group relative rounded-2xl overflow-hidden shadow-sm border border-gray-100 cursor-pointer hover:shadow-xl transition-all hover:-translate-y-1"
                 @click="openVideo('{{ $vt->youtube_embed_url ?? 'https://www.youtube.com/embed/dQw4w9WgXcQ' }}')"
                 data-reveal style="transition-delay:{{ $i * 100 }}ms">
                <div class="relative h-52 bg-[#0A1628]">
                    <img src="{{ $vt->thumbnail_url ?? 'https://picsum.photos/seed/vt'.$vt->id.'/600/400' }}"
                         alt="{{ $vt->client_name }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-80">
                    {{-- Play button --}}
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-16 h-16 bg-[#C9A84C] rounded-full flex items-center justify-center shadow-2xl group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-[#0A1628] ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="p-4 bg-white">
                    <h4 class="font-bold text-[#0A1628] mb-1">{{ $vt->client_name }}</h4>
                    @if($vt->property_bought)<p class="text-[#C9A84C] text-xs font-semibold">{{ $vt->property_bought }}</p>@endif
                </div>
            </div>
            @endforeach

            {{-- Video Modal --}}
            <div x-show="modalOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 class="fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4"
                 @click.self="closeVideo()">
                <div class="relative w-full max-w-3xl">
                    <button @click="closeVideo()" class="absolute -top-10 right-0 text-white hover:text-[#C9A84C] transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                    <div class="rounded-2xl overflow-hidden aspect-video bg-black">
                        <iframe :src="videoUrl + '?autoplay=1'" class="w-full h-full" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- Written Testimonials --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-reveal>
            <span class="inline-block text-[#C9A84C] font-semibold text-sm tracking-widest uppercase mb-3">Written Reviews</span>
            <h2 class="font-display text-4xl font-bold text-[#0A1628]">Client <span class="text-[#C9A84C]">Stories</span></h2>
        </div>

        @if(isset($testimonials) && $testimonials->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonials as $i => $t)
            <div class="bg-white rounded-2xl p-7 shadow-sm border border-gray-100 hover:shadow-md hover:border-[#C9A84C]/20 transition-all flex flex-col"
                 data-reveal style="transition-delay:{{ $i * 80 }}ms">
                {{-- Quote --}}
                <svg class="w-8 h-8 text-[#C9A84C]/30 mb-4" fill="currentColor" viewBox="0 0 32 32"><path d="M10 8C6.686 8 4 10.686 4 14v10h10V14H7c0-1.654 1.346-3 3-3V8zm18 0c-3.314 0-6 2.686-6 6v10h10V14h-7c0-1.654 1.346-3 3-3V8z"/></svg>

                <p class="text-gray-600 italic text-sm leading-relaxed flex-1 mb-5">"{{ $t->content }}"</p>

                {{-- Stars --}}
                <div class="flex gap-1 mb-4">
                    @for($s = 1; $s <= 5; $s++)
                    <svg class="w-4 h-4 {{ $s <= ($t->rating ?? 5) ? 'text-[#C9A84C]' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>

                {{-- Client --}}
                <div class="flex items-center gap-3 border-t border-gray-100 pt-5">
                    @if($t->avatar_url ?? false)
                    <img src="{{ $t->avatar_url }}" alt="{{ $t->client_name }}" class="w-11 h-11 rounded-full object-cover border-2 border-[#C9A84C]/30">
                    @else
                    <div class="w-11 h-11 rounded-full bg-gradient-to-br from-[#C9A84C] to-[#b8943d] flex items-center justify-center text-[#0A1628] font-bold">
                        {{ strtoupper(substr($t->client_name, 0, 1)) }}
                    </div>
                    @endif
                    <div>
                        <p class="font-bold text-[#0A1628] text-sm">{{ $t->client_name }}</p>
                        @if($t->property_bought ?? false)<p class="text-[#C9A84C] text-xs font-medium">{{ $t->property_bought }}</p>@endif
                        @if($t->location ?? false)<p class="text-gray-400 text-xs">{{ $t->location }}</p>@endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($testimonials->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $testimonials->links('vendor.pagination.tailwind') }}
        </div>
        @endif
        @else
        <div class="text-center py-16 text-gray-400">
            <p>No testimonials yet. Check back soon.</p>
        </div>
        @endif
    </div>
</section>

{{-- CTA --}}
<section class="py-16 bg-[#0A1628] text-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-display text-3xl font-bold text-white mb-4">Ready to Write Your Own Success Story?</h2>
        <p class="text-gray-400 mb-8">Join thousands of satisfied investors who chose SHEFAHOMES.</p>
        <a href="{{ route('properties.index') }}" class="inline-block bg-[#C9A84C] hover:bg-[#E8C97A] text-[#0A1628] font-bold px-10 py-4 rounded-full transition-all hover:scale-105">
            Browse Properties
        </a>
    </div>
</section>

@endsection
