{{-- Testimonials --}}
<section class="py-20 bg-[#0A1628] relative overflow-hidden">
    <div class="absolute inset-0 opacity-5 bg-[url('data:image/svg+xml,%3Csvg width=\"40\" height=\"40\" viewBox=\"0 0 40 40\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"%23C9A84C\" fill-opacity=\"1\"%3E%3Ccircle cx=\"20\" cy=\"20\" r=\"1\"/%3E%3C/g%3E%3C/svg%3E')]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Header --}}
        <div class="text-center mb-14" data-reveal>
            <span class="inline-block text-[#C9A84C] font-semibold text-sm tracking-widest uppercase mb-3">Client Stories</span>
            <h2 class="font-display text-4xl md:text-5xl font-bold text-white mb-4">
                What Our <span class="text-[#C9A84C]">Clients</span> Say
            </h2>
            <p class="text-gray-400 text-lg max-w-xl mx-auto">Real words from real investors who chose SHEFAHOMES to secure their futures.</p>
        </div>

        {{-- Carousel --}}
        @if(isset($testimonials) && $testimonials->count())
        <div x-data="{
                current: 0,
                total: {{ $testimonials->count() }},
                autoplay: null,
                startAutoplay() { this.autoplay = setInterval(() => this.next(), 5000); },
                stopAutoplay() { clearInterval(this.autoplay); },
                next() { this.current = (this.current + 1) % Math.max(1, this.total - 2); },
                prev() { this.current = (this.current - 1 + Math.max(1, this.total - 2)) % Math.max(1, this.total - 2); }
             }"
             x-init="startAutoplay()"
             @mouseenter="stopAutoplay()"
             @mouseleave="startAutoplay()"
             class="relative">

            <div class="overflow-hidden">
                <div class="flex transition-transform duration-700 ease-in-out gap-6"
                     :style="'transform: translateX(calc(-' + current + ' * (100% / 3 + 8px)))'">

                    @foreach($testimonials as $t)
                    <div class="min-w-[calc(100%-2rem)] sm:min-w-[calc(50%-12px)] lg:min-w-[calc(33.333%-16px)] bg-white/10 backdrop-blur-sm border border-white/10 rounded-2xl p-7 flex flex-col hover:bg-white/15 transition-colors duration-300 group">

                        {{-- Quote icon --}}
                        <div class="mb-4">
                            <svg class="w-10 h-10 text-[#C9A84C]/40" fill="currentColor" viewBox="0 0 32 32">
                                <path d="M10 8C6.686 8 4 10.686 4 14v10h10V14H7c0-1.654 1.346-3 3-3V8zm18 0c-3.314 0-6 2.686-6 6v10h10V14h-7c0-1.654 1.346-3 3-3V8z"/>
                            </svg>
                        </div>

                        {{-- Content --}}
                        <p class="text-gray-300 text-base leading-relaxed mb-6 flex-1 italic">
                            "{{ $t->content }}"
                        </p>

                        {{-- Stars --}}
                        <div class="flex gap-1 mb-5">
                            @for($s = 1; $s <= 5; $s++)
                            <svg class="w-4 h-4 {{ $s <= ($t->rating ?? 5) ? 'text-[#C9A84C]' : 'text-white/20' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            @endfor
                        </div>

                        {{-- Client info --}}
                        <div class="flex items-center gap-4 border-t border-white/10 pt-5">
                            @if($t->avatar_url)
                            <img src="{{ $t->avatar_url }}" alt="{{ $t->client_name }}"
                                 class="w-12 h-12 rounded-full object-cover border-2 border-[#C9A84C]/50">
                            @else
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#C9A84C] to-[#b8943d] flex items-center justify-center text-[#0A1628] font-bold text-lg">
                                {{ strtoupper(substr($t->client_name, 0, 1)) }}
                            </div>
                            @endif
                            <div>
                                <p class="font-bold text-white text-sm">{{ $t->client_name }}</p>
                                @if($t->property_bought)
                                <p class="text-[#C9A84C] text-xs font-medium">Bought: {{ $t->property_bought }}</p>
                                @endif
                                @if($t->location)
                                <p class="text-gray-500 text-xs">{{ $t->location }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Navigation --}}
            <div class="flex items-center justify-center gap-4 mt-10">
                <button @click="prev()"
                        class="w-11 h-11 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-[#C9A84C] hover:border-[#C9A84C] hover:text-[#0A1628] transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <div class="flex gap-2">
                    <template x-for="i in Math.max(1, total - 2)" :key="i">
                        <button @click="current = i - 1"
                                :class="current === i - 1 ? 'bg-[#C9A84C] w-6' : 'bg-white/20 w-2'"
                                class="h-2 rounded-full transition-all duration-300"></button>
                    </template>
                </div>
                <button @click="next()"
                        class="w-11 h-11 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-[#C9A84C] hover:border-[#C9A84C] hover:text-[#0A1628] transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
        @else
        {{-- Placeholder testimonials --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['name'=>'Adebayo Okafor','role'=>'Lagos Investor','text'=>'SHEFAHOMES made my dream of owning land in Lagos a reality. The process was transparent and the team was incredibly supportive throughout.','property'=>'Green Valley Estate, Ibeju-Lekki'],
                ['name'=>'Chidinma Eze','role'=>'Abuja Client','text'=>'I was skeptical at first, but after visiting the site and seeing the documentation, I was convinced. Now I own two plots!','property'=>'Royal Gardens, Kuje'],
                ['name'=>'Emeka Nwachukwu','role'=>'Diaspora Investor','text'=>'As a Nigerian in the UK, I needed a trustworthy company. SHEFAHOMES delivered beyond expectations — title deeds in hand within 12 months.','property'=>'Heritage Court, Sangotedo'],
            ] as $pt)
            <div class="bg-white/10 border border-white/10 rounded-2xl p-7 flex flex-col">
                <svg class="w-8 h-8 text-[#C9A84C]/40 mb-4" fill="currentColor" viewBox="0 0 32 32">
                    <path d="M10 8C6.686 8 4 10.686 4 14v10h10V14H7c0-1.654 1.346-3 3-3V8zm18 0c-3.314 0-6 2.686-6 6v10h10V14h-7c0-1.654 1.346-3 3-3V8z"/>
                </svg>
                <p class="text-gray-300 italic text-sm leading-relaxed mb-6 flex-1">"{{ $pt['text'] }}"</p>
                <div class="flex gap-1 mb-4">
                    @for($s=0;$s<5;$s++)
                    <svg class="w-4 h-4 text-[#C9A84C]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <div class="flex items-center gap-3 border-t border-white/10 pt-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#C9A84C] to-[#b8943d] flex items-center justify-center text-[#0A1628] font-bold">
                        {{ strtoupper(substr($pt['name'], 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-bold text-white text-sm">{{ $pt['name'] }}</p>
                        <p class="text-[#C9A84C] text-xs">{{ $pt['property'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- CTA --}}
        <div class="text-center mt-12">
            <a href="{{ route('testimonials') }}"
               class="inline-flex items-center gap-2 border-2 border-[#C9A84C] text-[#C9A84C] hover:bg-[#C9A84C] hover:text-[#0A1628] font-bold px-8 py-4 rounded-full transition-all">
                Read More Stories
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
