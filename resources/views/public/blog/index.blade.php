@extends('layouts.app')

@section('title', 'Real Estate Blog — SHEFAHOMES')
@section('meta_description', 'Property investment tips, market insights and real estate news from SHEFAHOMES Nigeria.')

@section('content')

{{-- Featured Post Hero --}}
@if(isset($featuredPost) && $featuredPost)
<section class="relative h-[70vh] min-h-[500px] bg-[#1A237E] overflow-hidden">
    <img src="{{ $featuredPost->featured_image_url ?? 'https://picsum.photos/seed/blog-hero/1400/700' }}"
         alt="{{ $featuredPost->title }}"
         class="w-full h-full object-cover opacity-50">
    <div class="absolute inset-0 bg-gradient-to-r from-[#1A237E]/90 via-[#1A237E]/60 to-transparent"></div>
    <div class="absolute inset-0 flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-2xl">
                @if($featuredPost->category)
                <span class="inline-block bg-[#27AE22] text-[#1A237E] text-xs font-bold px-4 py-1.5 rounded-full mb-4">
                    {{ is_object($featuredPost->category) ? $featuredPost->category->name : $featuredPost->category }}
                </span>
                @endif
                <h1 class="font-display text-4xl sm:text-5xl font-bold text-white mb-4 leading-tight">
                    {{ $featuredPost->title }}
                </h1>
                <p class="text-gray-300 text-lg mb-6 line-clamp-2">
                    {{ $featuredPost->excerpt ?? Str::limit(strip_tags($featuredPost->content ?? ''), 160) }}
                </p>
                <div class="flex items-center gap-4 text-gray-400 text-sm mb-6">
                    <span>{{ $featuredPost->published_at?->format('M d, Y') ?? $featuredPost->created_at->format('M d, Y') }}</span>
                    @if($featuredPost->read_time)<span>•</span><span>{{ $featuredPost->read_time }} min read</span>@endif
                </div>
                <a href="{{ route('blog.show', $featuredPost->slug) }}"
                   class="inline-flex items-center gap-2 bg-[#27AE22] text-[#1A237E] font-bold px-8 py-4 rounded-full hover:bg-[#4ADE80] transition-all hover:scale-105">
                    Read Article
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>
@else
<section class="bg-[#1A237E] py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Real Estate Insights</span>
        <h1 class="font-display text-5xl font-bold text-white mb-4">Our <span class="text-[#27AE22]">Blog</span></h1>
        <p class="text-gray-300 text-lg max-w-xl mx-auto">Expert advice, market updates and investment tips from Nigeria's premier real estate brand.</p>
    </div>
</section>
@endif

{{-- Category Filter --}}
<section class="bg-white border-b border-gray-200 sticky top-16 z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 overflow-x-auto py-4 scrollbar-hide">
            <a href="{{ route('blog.index') }}"
               class="flex-shrink-0 px-5 py-2 rounded-full text-sm font-semibold transition-all {{ !request('category') ? 'bg-[#1A237E] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                All Posts
            </a>
            @if(isset($categories))
            @foreach($categories as $cat)
            <a href="{{ route('blog.category', $cat->slug) }}"
               class="flex-shrink-0 px-5 py-2 rounded-full text-sm font-semibold transition-all {{ request()->routeIs('blog.category') && request()->route('category') == $cat->slug ? 'bg-[#27AE22] text-[#1A237E]' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                {{ $cat->name }}
                @if($cat->posts_count ?? false)
                <span class="ml-1 text-xs opacity-70">({{ $cat->posts_count }})</span>
                @endif
            </a>
            @endforeach
            @endif
        </div>
    </div>
</section>

{{-- Blog Grid --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(isset($posts) && $posts->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $i => $post)
            <article class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-[#1A237E]/10 border border-gray-100 transition-all duration-500 hover:-translate-y-1 flex flex-col"
                     data-reveal style="transition-delay:{{ $i * 100 }}ms">
                <div class="relative h-52 overflow-hidden flex-shrink-0">
                    <img src="{{ $post->featured_image_url ?? 'https://picsum.photos/seed/blog'.$post->id.'/600/400' }}"
                         alt="{{ $post->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                         loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    @if($post->category)
                    <span class="absolute top-4 left-4 bg-[#27AE22] text-[#1A237E] text-xs font-bold px-3 py-1.5 rounded-full">
                        {{ is_object($post->category) ? $post->category->name : $post->category }}
                    </span>
                    @endif
                </div>
                <div class="p-6 flex flex-col flex-1">
                    <div class="flex items-center gap-3 text-xs text-gray-400 mb-3">
                        <span>{{ $post->published_at?->format('M d, Y') ?? $post->created_at->format('M d, Y') }}</span>
                        @if($post->read_time)<span>•</span><span>{{ $post->read_time }} min read</span>@endif
                    </div>
                    <h2 class="font-display font-bold text-[#1A237E] text-lg mb-3 leading-snug group-hover:text-[#27AE22] transition-colors line-clamp-2">
                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                    </h2>
                    <p class="text-gray-500 text-sm leading-relaxed mb-5 flex-1 line-clamp-3">
                        {{ $post->excerpt ?? Str::limit(strip_tags($post->content ?? ''), 120) }}
                    </p>
                    <a href="{{ route('blog.show', $post->slug) }}"
                       class="inline-flex items-center gap-2 text-[#1A237E] hover:text-[#27AE22] font-semibold text-sm transition-colors group/link">
                        Read More
                        <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($posts->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $posts->withQueryString()->links('vendor.pagination.tailwind') }}
        </div>
        @endif
        @else
        <div class="text-center py-20">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            <h3 class="font-bold text-[#1A237E] text-xl mb-2">No Posts Yet</h3>
            <p class="text-gray-400">Check back soon for real estate insights and news.</p>
        </div>
        @endif
    </div>
</section>

@endsection
