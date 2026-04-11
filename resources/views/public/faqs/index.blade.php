@extends('layouts.app')

@section('title', 'Frequently Asked Questions — SHEFAHOMES')
@section('meta_description', 'Get answers to your real estate questions. SHEFAHOMES FAQ — payment plans, property titles, buying process and more.')

@section('content')

{{-- Hero --}}
<section class="bg-[#0A1628] py-20 relative overflow-hidden">
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block text-[#C9A84C] font-semibold text-sm tracking-widest uppercase mb-3">Help Centre</span>
        <h1 class="font-display text-5xl font-bold text-white mb-4">
            Frequently Asked <span class="text-[#C9A84C]">Questions</span>
        </h1>
        <p class="text-gray-300 text-lg max-w-xl mx-auto mb-10">
            Everything you need to know about buying land and property with SHEFAHOMES.
        </p>

        {{-- Search Bar --}}
        <div class="max-w-xl mx-auto" x-data="{ search: '' }" id="faq-search-root">
            <div class="relative">
                <svg class="absolute left-5 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="search"
                       x-model="search"
                       @input="window.faqSearch = search; document.dispatchEvent(new CustomEvent('faq-search', {detail: search}))"
                       placeholder="Search questions..."
                       class="w-full bg-white/10 backdrop-blur border border-white/20 text-white placeholder-gray-400 pl-14 pr-6 py-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#C9A84C] focus:bg-white/15 text-base">
            </div>
        </div>
    </div>
</section>

{{-- FAQs --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8"
         x-data="{
             activeTab: '{{ isset($categories) && $categories->count() ? $categories->first()->id : 'all' }}',
             searchQuery: '',
             init() {
                 document.addEventListener('faq-search', (e) => { this.searchQuery = e.detail.toLowerCase(); });
             }
         }">

        {{-- Category Tabs --}}
        @if(isset($categories) && $categories->count())
        <div class="flex flex-wrap gap-2 mb-10 bg-white rounded-2xl p-2 shadow-sm border border-gray-100">
            <button @click="activeTab = 'all'"
                    :class="activeTab === 'all' ? 'bg-[#0A1628] text-white' : 'text-gray-600 hover:text-[#0A1628]'"
                    class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all">
                All Questions
            </button>
            @foreach($categories as $cat)
            <button @click="activeTab = '{{ $cat->id }}'"
                    :class="activeTab === '{{ $cat->id }}' ? 'bg-[#C9A84C] text-[#0A1628]' : 'text-gray-600 hover:text-[#0A1628]'"
                    class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all">
                {{ $cat->name }}
                @if($cat->faqs_count ?? false)
                <span class="ml-1 opacity-60 text-xs">({{ $cat->faqs_count }})</span>
                @endif
            </button>
            @endforeach
        </div>
        @endif

        {{-- FAQ Accordions --}}
        @if(isset($faqs) && $faqs->count())

            @if(isset($categories) && $categories->count())
            @foreach($categories as $cat)
            <div x-show="activeTab === 'all' || activeTab === '{{ $cat->id }}'" class="mb-10">
                <h3 class="font-display text-xl font-bold text-[#0A1628] mb-5 flex items-center gap-3">
                    <span class="w-8 h-8 bg-[#C9A84C]/15 rounded-xl flex items-center justify-center">
                        <svg class="w-4 h-4 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                    {{ $cat->name }}
                </h3>
                <div class="space-y-3">
                    @foreach($faqs->where('category_id', $cat->id) as $i => $faq)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"
                         x-data="{ open: false }"
                         x-show="searchQuery === '' || '{{ strtolower(addslashes($faq->question)) }}'.includes(searchQuery) || '{{ strtolower(addslashes($faq->answer)) }}'.includes(searchQuery)"
                         data-reveal style="transition-delay:{{ $i * 60 }}ms">
                        <button @click="open = !open"
                                class="w-full flex items-center justify-between p-6 text-left hover:bg-gray-50 transition-colors gap-4">
                            <span class="font-semibold text-[#0A1628] text-sm sm:text-base leading-snug">{{ $faq->question }}</span>
                            <svg :class="open ? 'rotate-180 text-[#C9A84C]' : 'text-gray-400'" class="w-5 h-5 flex-shrink-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="px-6 pb-6">
                            <div class="text-gray-500 text-sm leading-relaxed border-t border-gray-100 pt-4">
                                {!! nl2br(e($faq->answer)) !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
            @else
            {{-- No categories, flat list --}}
            <div class="space-y-3">
                @foreach($faqs as $i => $faq)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"
                     x-data="{ open: false }"
                     x-show="searchQuery === '' || '{{ strtolower(addslashes($faq->question)) }}'.includes(searchQuery) || '{{ strtolower(addslashes($faq->answer)) }}'.includes(searchQuery)"
                     data-reveal style="transition-delay:{{ $i * 60 }}ms">
                    <button @click="open = !open"
                            class="w-full flex items-center justify-between p-6 text-left hover:bg-gray-50 transition-colors gap-4">
                        <span class="font-semibold text-[#0A1628]">{{ $faq->question }}</span>
                        <svg :class="open ? 'rotate-180 text-[#C9A84C]' : 'text-gray-400'" class="w-5 h-5 flex-shrink-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-transition class="px-6 pb-6">
                        <div class="text-gray-500 text-sm leading-relaxed border-t border-gray-100 pt-4">
                            {!! nl2br(e($faq->answer)) !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

        @else
        {{-- Placeholder FAQs --}}
        <div class="space-y-3">
            @foreach([
                ['How do I subscribe for a plot?', 'Simply browse our properties, choose your preferred estate and plot size, then contact us via the inquiry form or WhatsApp. Our team will guide you through the subscription process, documentation and payment plan options.'],
                ['What titles do your properties come with?', 'All SHEFAHOMES estates come with government-approved documentation including Certificate of Occupancy (C of O), Right of Occupancy (R of O), or Deed of Assignment depending on the estate. We never sell land without proper titles.'],
                ['What payment plans are available?', 'We offer flexible payment plans ranging from outright payment (with a discount) to 6, 12, 18, 24 and 36-month instalment plans. All plans require an initial deposit to activate subscription.'],
                ['Can I visit the site before subscribing?', 'Absolutely! We encourage all prospective buyers to visit the site. We organise regular free site visits from Lagos, Abuja and other major cities. Contact us to schedule a visit.'],
                ['How do I get my title deed?', 'Your title deed is processed and delivered upon completion of payment. The timeline depends on the estate and documentation type, but typically ranges from 30 to 90 days after final payment.'],
                ['Is SHEFAHOMES registered?', 'Yes. SHEFAHOMES is fully registered with the Corporate Affairs Commission (CAC), REDAN (Real Estate Developers Association of Nigeria), LASRERA (Lagos State Real Estate Regulatory Authority) and relevant state governments.'],
            ] as $i => $faq)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"
                 x-data="{ open: {{ $i === 0 ? 'true' : 'false' }} }"
                 x-show="searchQuery === '' || '{{ strtolower($faq[0]) }}'.includes(searchQuery) || '{{ strtolower(substr($faq[1], 0, 100)) }}'.includes(searchQuery)">
                <button @click="open = !open"
                        class="w-full flex items-center justify-between p-6 text-left hover:bg-gray-50 transition-colors gap-4">
                    <span class="font-semibold text-[#0A1628]">{{ $faq[0] }}</span>
                    <svg :class="open ? 'rotate-180 text-[#C9A84C]' : 'text-gray-400'" class="w-5 h-5 flex-shrink-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" x-transition class="px-6 pb-6">
                    <p class="text-gray-500 text-sm leading-relaxed border-t border-gray-100 pt-4">{{ $faq[1] }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Still have questions CTA --}}
        <div class="mt-12 bg-gradient-to-r from-[#0A1628] to-[#1a2d4a] rounded-2xl p-8 text-center">
            <h3 class="font-display text-xl font-bold text-white mb-3">Still Have Questions?</h3>
            <p class="text-gray-300 text-sm mb-6">Our team is available Monday–Saturday to answer your questions.</p>
            <div class="flex flex-wrap gap-3 justify-center">
                <a href="{{ route('contact') }}" class="bg-[#C9A84C] hover:bg-[#E8C97A] text-[#0A1628] font-bold px-8 py-3 rounded-full transition-all text-sm">
                    Contact Us
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', config('shefahomes.whatsapp', '2349000000000')) }}"
                   target="_blank" class="bg-[#25D366] hover:opacity-90 text-white font-bold px-8 py-3 rounded-full transition-all text-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                    WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
