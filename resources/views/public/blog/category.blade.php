@extends('layouts.app')

@section('title', ($category->name ?? 'Category') . ' — SHEFAHOMES Blog')
@section('meta_description', 'Browse ' . ($category->name ?? '') . ' articles from SHEFAHOMES real estate blog.')

@section('content')

{{-- Category Header --}}
<section class="bg-[#1A237E] py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-5 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"%23C9A84C\" fill-opacity=\"1\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"2\"/%3E%3C/g%3E%3C/svg%3E')]"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <nav class="flex items-center justify-center gap-2 text-sm text-gray-400 mb-6 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-[#27AE22]">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('blog.index') }}" class="hover:text-[#27AE22]">Blog</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-[#27AE22]">{{ $category->name ?? 'Category' }}</span>
        </nav>
        <span class="inline-block bg-[#27AE22] text-[#1A237E] text-xs font-bold px-4 py-2 rounded-full mb-4">Category</span>
        <h1 class="font-display text-5xl font-bold text-white mb-4">
            {{ $category->name ?? 'Articles' }}
        </h1>
        @if($category->description ?? false)
        <p class="text-gray-300 text-lg max-w-xl mx-auto">{{ $category->description }}</p>
        @endif
        <p class="text-gray-400 mt-4 text-sm">
            {{ $posts->total() }} {{ Str::plural('article', $posts->total()) }} in this category
        </p>
    </div>
</section>

{{-- Category Tabs --}}
<section class="bg-white border-b border-gray-200 sticky top-16 z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 overflow-x-auto py-4">
            <a href="{{ route('blog.index') }}"
               class="flex-shrink-0 px-5 py-2 rounded-full text-sm font-semibold bg-gray-100 text-gray-600 hover:bg-gray-200 transition-all">
                All Posts
            </a>
            @if(isset($allCategories))
            @foreach($allCategories as $cat)
            <a href="{{ route('blog.category', $cat->slug) }}"
               class="flex-shrink-0 px-5 py-2 rounded-full text-sm font-semibold transition-all {{ isset($category) && $category->slug === $cat->slug ? 'bg-[#27AE22] text-[#1A237E]' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                {{ $cat->name }}
            </a>
            @endforeach
            @endif
        </div>
    </div>
</section>

{{-- Posts Grid --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($posts->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $i => $post)
            <article class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-[#1A237E]/10 border border-gray-100 transition-all duration-500 hover:-translate-y-1 flex flex-col"
                     data-reveal style="transition-delay:{{ $i * 100 }}ms">
                <div class="relative h-52 overflow-hidden flex-shrink-0">
                    <img src="{{ $post->featured_image_url ?? 'https://picsum.photos/seed/cat'.$post->id.'/600/400' }}"
                         alt="{{ $post->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" loading="lazy">
                    <span class="absolute top-4 left-4 bg-[#27AE22] text-[#1A237E] text-xs font-bold px-3 py-1.5 rounded-full">
                        {{ $category->name ?? '' }}
                    </span>
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
            <h3 class="font-bold text-[#1A237E] text-xl mb-2">No Posts in This Category</h3>
            <p class="text-gray-400 mb-6">Check back soon, or browse all articles.</p>
            <a href="{{ route('blog.index') }}" class="bg-[#27AE22] text-[#1A237E] font-bold px-8 py-3 rounded-full hover:bg-[#4ADE80] transition-all">
                Browse All Posts
            </a>
        </div>
        @endif
    </div>
</section>

@endsection
