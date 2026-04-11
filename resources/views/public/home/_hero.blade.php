<section x-data="{
    slides: {{ json_encode($sliders->map(fn($s) => ['id'=>$s->id,'image'=>$s->image_url,'title'=>$s->title,'subtitle'=>$s->subtitle,'cta_text'=>$s->cta_text,'cta_url'=>$s->cta_url,'cta_text_2'=>$s->cta_text_2,'cta_url_2'=>$s->cta_url_2])->values()) }},
    current: 0,
    autoplay: null,
    touchStartX: 0,
    startAutoplay() { this.autoplay = setInterval(() => this.next(), 5000); },
    stopAutoplay() { clearInterval(this.autoplay); },
    next() { this.current = (this.current + 1) % this.slides.length; },
    prev() { this.current = (this.current - 1 + this.slides.length) % this.slides.length; },
    goTo(i) { this.current = i; }
}" x-init="if(slides.length > 0) { startAutoplay(); }" @mouseenter="stopAutoplay()" @mouseleave="startAutoplay()" @touchstart="touchStartX = $event.touches[0].clientX" @touchend="$event.changedTouches[0].clientX - touchStartX > 50 ? prev() : ($event.changedTouches[0].clientX - touchStartX < -50 ? next() : null)" class="relative h-screen min-h-[600px] overflow-hidden bg-[#0A1628]">

    <template x-if="slides.length === 0">
        <div class="absolute inset-0 bg-gradient-to-br from-[#0A1628] to-[#1a2d4a] flex items-center justify-center">
            <div class="text-center text-white px-4">
                <h1 class="font-display text-5xl md:text-7xl font-bold mb-6">Find Your <span class="text-[#C9A84C]">Dream</span> Home</h1>
                <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">Premium real estate properties across Nigeria. Flexible payment plans. Government approved titles.</p>
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="{{ route('properties.index') }}" class="bg-[#C9A84C] text-[#0A1628] font-bold px-8 py-4 rounded-full hover:bg-[#E8C97A] transition-all hover:scale-105">Explore Properties</a>
                    <a href="{{ route('contact') }}" class="border-2 border-white text-white font-bold px-8 py-4 rounded-full hover:bg-white hover:text-[#0A1628] transition-all">Contact Us</a>
                </div>
            </div>
        </div>
    </template>

    <template x-if="slides.length > 0">
        <div class="relative h-full">
            <template x-for="(slide, index) in slides" :key="slide.id">
                <div :class="current === index ? 'opacity-100' : 'opacity-0'" class="absolute inset-0 transition-opacity duration-1000">
                    <img :src="slide.image" class="w-full h-full object-cover" alt="" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#0A1628]/80 via-[#0A1628]/50 to-transparent"></div>
                    <div class="absolute inset-0 flex items-center">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                            <div class="max-w-2xl" :class="current === index ? 'animate-[fadeInUp_0.8s_ease_forwards]' : ''">
                                <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold text-white leading-tight mb-4" x-text="slide.title"></h1>
                                <p class="text-gray-200 text-lg sm:text-xl mb-8 hidden sm:block" x-text="slide.subtitle"></p>
                                <div class="flex flex-wrap gap-4">
                                    <a :href="slide.cta_url || '/properties'" class="bg-[#C9A84C] text-[#0A1628] font-bold px-8 py-4 rounded-full hover:bg-[#E8C97A] transition-all hover:scale-105 text-sm sm:text-base" x-text="slide.cta_text || 'Explore Properties'"></a>
                                    <a x-show="slide.cta_text_2" :href="slide.cta_url_2 || '/contact'" class="border-2 border-white text-white font-bold px-8 py-4 rounded-full hover:bg-white hover:text-[#0A1628] transition-all text-sm sm:text-base" x-text="slide.cta_text_2"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            {{-- Prev/Next --}}
            <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/40 rounded-full flex items-center justify-center text-white transition-all backdrop-blur-sm z-10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/40 rounded-full flex items-center justify-center text-white transition-all backdrop-blur-sm z-10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>

            {{-- Dots --}}
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                <template x-for="(s, i) in slides" :key="i">
                    <button @click="goTo(i)" :class="current === i ? 'bg-[#C9A84C] w-8' : 'bg-white/50 w-3'" class="h-3 rounded-full transition-all duration-300"></button>
                </template>
            </div>
        </div>
    </template>
</section>
<style>@keyframes fadeInUp{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:translateY(0)}}</style>
