@extends('layouts.app')

@section('title', $post->title . ' — SHEFAHOMES Blog')
@section('meta_description', $post->excerpt ?? Str::limit(strip_tags($post->content ?? ''), 160))

@section('content')

{{-- Article Hero --}}
<section class="relative bg-[#1A237E] py-24 overflow-hidden">
    @if($post->featured_image_url)
    <div class="absolute inset-0">
        <img src="{{ $post->featured_image_url }}" class="w-full h-full object-cover opacity-20" alt="">
        <div class="absolute inset-0 bg-gradient-to-b from-[#1A237E]/80 to-[#1A237E]"></div>
    </div>
    @endif
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        {{-- Breadcrumb --}}
        <nav class="flex items-center justify-center gap-2 text-sm text-gray-400 mb-6 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-[#27AE22]">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('blog.index') }}" class="hover:text-[#27AE22]">Blog</a>
            @if($post->category)
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('blog.category', is_object($post->category) ? $post->category->slug : $post->category) }}" class="hover:text-[#27AE22]">{{ is_object($post->category) ? $post->category->name : $post->category }}</a>
            @endif
        </nav>

        @if($post->category)
        <span class="inline-block bg-[#27AE22] text-[#1A237E] text-xs font-bold px-4 py-1.5 rounded-full mb-4">
            {{ is_object($post->category) ? $post->category->name : $post->category }}
        </span>
        @endif

        <h1 class="font-display text-4xl sm:text-5xl font-bold text-white mb-6 leading-tight">
            {{ $post->title }}
        </h1>

        <div class="flex items-center justify-center gap-4 flex-wrap text-gray-400 text-sm">
            @if($post->author)
            <span class="flex items-center gap-2">
                @if($post->author->photo_url ?? false)
                <img src="{{ $post->author->photo_url }}" class="w-7 h-7 rounded-full object-cover" alt="">
                @endif
                {{ $post->author->name }}
            </span>
            <span>•</span>
            @endif
            <span>{{ $post->published_at?->format('F d, Y') ?? $post->created_at->format('F d, Y') }}</span>
            @if($post->read_time)<span>•</span><span>{{ $post->read_time }} min read</span>@endif
        </div>
    </div>
</section>

{{-- Article Body --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-12">

            {{-- Main article --}}
            <article class="flex-1 max-w-3xl">
                {{-- Featured image --}}
                @if($post->featured_image_url)
                <div class="rounded-2xl overflow-hidden mb-10 shadow-lg">
                    <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-72 sm:h-96 object-cover">
                </div>
                @endif

                {{-- Content --}}
                <div class="prose prose-lg prose-gray max-w-none
                            prose-headings:font-display prose-headings:text-[#1A237E]
                            prose-a:text-[#27AE22] prose-a:no-underline hover:prose-a:underline
                            prose-strong:text-[#1A237E]
                            prose-blockquote:border-l-[#27AE22] prose-blockquote:text-gray-500">
                    {!! $post->content !!}
                </div>

                {{-- Tags --}}
                @if($post->tags && $post->tags->count())
                <div class="mt-10 flex flex-wrap gap-2 pt-6 border-t border-gray-100">
                    <span class="text-sm text-gray-400 font-medium mr-2 self-center">Tags:</span>
                    @foreach($post->tags as $tag)
                    <span class="bg-gray-100 text-gray-600 text-xs font-medium px-3 py-1.5 rounded-full hover:bg-[#27AE22]/20 hover:text-[#1A237E] transition-colors cursor-default">
                        #{{ $tag->name }}
                    </span>
                    @endforeach
                </div>
                @endif

                {{-- Share Buttons --}}
                <div class="mt-10 p-6 bg-gray-50 rounded-2xl border border-gray-100"
                     x-data="{
                         copyLink() {
                             navigator.clipboard.writeText(window.location.href);
                             this.$dispatch('link-copied');
                         }
                     }"
                     @link-copied.window="$dispatch('notify', { message: 'Link copied!' })">
                    <p class="font-semibold text-[#1A237E] mb-4">Share this article</p>
                    <div class="flex flex-wrap gap-3">
                        {{-- WhatsApp --}}
                        <a href="https://wa.me/?text={{ urlencode($post->title . ' — ' . url()->current()) }}"
                           target="_blank" rel="noopener"
                           class="flex items-center gap-2 bg-[#25D366] text-white text-sm font-semibold px-5 py-2.5 rounded-xl hover:opacity-90 transition-opacity">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.107.548 4.084 1.504 5.803L0 24l6.338-1.481A11.933 11.933 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.013-1.372l-.36-.214-3.727.871.938-3.624-.234-.372A9.794 9.794 0 012.182 12C2.182 6.582 6.582 2.182 12 2.182S21.818 6.582 21.818 12 17.418 21.818 12 21.818z"/></svg>
                            WhatsApp
                        </a>
                        {{-- Twitter/X --}}
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}"
                           target="_blank" rel="noopener"
                           class="flex items-center gap-2 bg-[#1DA1F2] text-white text-sm font-semibold px-5 py-2.5 rounded-xl hover:opacity-90 transition-opacity">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            Twitter
                        </a>
                        {{-- Copy Link --}}
                        <button @click="copyLink()"
                                class="flex items-center gap-2 bg-gray-200 hover:bg-[#1A237E] hover:text-white text-gray-700 text-sm font-semibold px-5 py-2.5 rounded-xl transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                            Copy Link
                        </button>
                    </div>
                </div>

                {{-- Author Card --}}
                @if($post->author)
                <div class="mt-10 bg-gray-50 rounded-2xl p-6 border border-gray-100 flex items-start gap-5">
                    @if($post->author->photo_url ?? false)
                    <img src="{{ $post->author->photo_url }}" alt="{{ $post->author->name }}" class="w-16 h-16 rounded-2xl object-cover flex-shrink-0">
                    @else
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#1A237E] to-[#0D1566] flex items-center justify-center flex-shrink-0">
                        <span class="text-2xl font-bold text-[#27AE22]">{{ strtoupper(substr($post->author->name,0,1)) }}</span>
                    </div>
                    @endif
                    <div>
                        <p class="text-xs text-[#27AE22] font-semibold uppercase tracking-wider mb-1">About the Author</p>
                        <h4 class="font-bold text-[#1A237E] text-lg mb-2">{{ $post->author->name }}</h4>
                        @if($post->author->bio ?? false)
                        <p class="text-gray-500 text-sm leading-relaxed">{{ $post->author->bio }}</p>
                        @endif
                    </div>
                </div>
                @endif
            </article>

            {{-- Sidebar --}}
            <aside class="lg:w-72 flex-shrink-0 space-y-6">
                {{-- Recent Posts --}}
                @if(isset($recentPosts) && $recentPosts->count())
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h3 class="font-bold text-[#1A237E] text-base mb-4 pb-3 border-b border-gray-100">Recent Articles</h3>
                    <div class="space-y-4">
                        @foreach($recentPosts as $rp)
                        <a href="{{ route('blog.show', $rp->slug) }}" class="flex gap-3 group">
                            <img src="{{ $rp->featured_image_url ?? 'https://picsum.photos/seed/rp'.$rp->id.'/100/80' }}" alt="" class="w-16 h-14 rounded-xl object-cover flex-shrink-0">
                            <div>
                                <p class="text-sm font-semibold text-[#1A237E] group-hover:text-[#27AE22] transition-colors line-clamp-2 leading-snug">{{ $rp->title }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $rp->published_at?->format('M d, Y') }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- CTA Box --}}
                <div class="bg-[#1A237E] rounded-2xl p-6 text-white">
                    <div class="w-10 h-10 bg-[#27AE22]/20 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </div>
                    <h4 class="font-bold text-white mb-2">Ready to Invest?</h4>
                    <p class="text-gray-400 text-sm mb-4">Browse our premium estates with government-approved titles.</p>
                    <a href="{{ route('properties.index') }}"
                       class="block text-center bg-[#27AE22] hover:bg-[#4ADE80] text-[#1A237E] font-bold py-3 rounded-xl transition-all text-sm">
                        Browse Properties
                    </a>
                </div>
            </aside>
        </div>

        {{-- Related Posts --}}
        @if(isset($relatedPosts) && $relatedPosts->count())
        <div class="mt-16">
            <h2 class="font-display text-2xl font-bold text-[#1A237E] mb-8">Related <span class="text-[#27AE22]">Articles</span></h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($relatedPosts as $rp)
                <a href="{{ route('blog.show', $rp->slug) }}"
                   class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg border border-gray-100 transition-all hover:-translate-y-1">
                    <div class="h-44 overflow-hidden">
                        <img src="{{ $rp->featured_image_url ?? 'https://picsum.photos/seed/rel'.$rp->id.'/600/400' }}" alt="{{ $rp->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    </div>
                    <div class="p-5">
                        <p class="text-xs text-gray-400 mb-2">{{ $rp->published_at?->format('M d, Y') }}</p>
                        <h3 class="font-bold text-[#1A237E] group-hover:text-[#27AE22] transition-colors line-clamp-2 leading-snug">{{ $rp->title }}</h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

@endsection
