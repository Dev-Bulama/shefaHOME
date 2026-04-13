{{-- Latest Blog Posts --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-14" data-reveal>
            <div>
                <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-2">Real Estate Insights</span>
                <h2 class="font-display text-4xl md:text-5xl font-bold text-[#1A237E]">
                    From Our <span class="text-[#27AE22]">Blog</span>
                </h2>
            </div>
            <a href="{{ route('blog.index') }}"
               class="flex-shrink-0 inline-flex items-center gap-2 text-[#1A237E] hover:text-[#27AE22] font-semibold border-2 border-[#1A237E] hover:border-[#27AE22] px-6 py-3 rounded-full transition-all text-sm">
                View All Articles
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        {{-- Grid --}}
        @if(isset($latestPosts) && $latestPosts->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($latestPosts as $index => $post)
            <article class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-[#1A237E]/10 border border-gray-100 transition-all duration-500 hover:-translate-y-1 flex flex-col"
                     data-reveal style="transition-delay: {{ $index * 120 }}ms">

                {{-- Image --}}
                <div class="relative overflow-hidden h-52 flex-shrink-0">
                    @if($post->featured_image_url)
                    <img src="{{ $post->featured_image_url }}"
                         alt="{{ $post->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                         loading="lazy"
                         onerror="this.src='https://picsum.photos/seed/blog{{ $post->id }}/600/400'">
                    @else
                    <img src="https://picsum.photos/seed/blog{{ $post->id ?? $index }}/600/400"
                         alt="{{ $post->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                         loading="lazy">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    {{-- Category badge --}}
                    @if($post->category)
                    <span class="absolute top-4 left-4 bg-[#27AE22] text-[#1A237E] text-xs font-bold px-3 py-1.5 rounded-full">
                        {{ is_object($post->category) ? $post->category->name : $post->category }}
                    </span>
                    @endif
                </div>

                {{-- Content --}}
                <div class="p-6 flex flex-col flex-1">
                    {{-- Meta --}}
                    <div class="flex items-center gap-3 text-xs text-gray-400 mb-3">
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                        </span>
                        @if($post->read_time)
                        <span>•</span>
                        <span>{{ $post->read_time }} min read</span>
                        @endif
                    </div>

                    {{-- Title --}}
                    <h3 class="font-display font-bold text-[#1A237E] text-lg mb-3 leading-snug group-hover:text-[#27AE22] transition-colors line-clamp-2">
                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                    </h3>

                    {{-- Excerpt --}}
                    <p class="text-gray-500 text-sm leading-relaxed mb-5 flex-1 line-clamp-3">
                        {{ $post->excerpt ?? Str::limit(strip_tags($post->content ?? ''), 120) }}
                    </p>

                    {{-- Read more --}}
                    <a href="{{ route('blog.show', $post->slug) }}"
                       class="inline-flex items-center gap-2 text-[#1A237E] hover:text-[#27AE22] font-semibold text-sm transition-colors group/link">
                        Read More
                        <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
        @else
        <div class="text-center py-16 text-gray-400">
            <svg class="w-16 h-16 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
            <p>No blog posts yet. Check back soon.</p>
        </div>
        @endif
    </div>
</section>
