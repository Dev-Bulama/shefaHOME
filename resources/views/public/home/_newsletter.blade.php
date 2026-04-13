{{-- Newsletter --}}
<section class="py-20 bg-[#27AE22] relative overflow-hidden">
    {{-- Decorative elements --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-64 h-64 bg-[#1A237E] rounded-full translate-x-1/3 -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-[#1A237E] rounded-full -translate-x-1/3 translate-y-1/2"></div>
    </div>
    <div class="absolute inset-0 opacity-5 bg-[url('data:image/svg+xml,%3Csvg width=\"30\" height=\"30\" viewBox=\"0 0 30 30\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"%230A1628\"%3E%3Ccircle cx=\"15\" cy=\"15\" r=\"1.5\"/%3E%3C/g%3E%3C/svg%3E')]"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center"
         x-data="{
             email: '',
             loading: false,
             success: false,
             error: '',
             async subscribe() {
                 if (!this.email || !this.email.includes('@')) {
                     this.error = 'Please enter a valid email address.';
                     return;
                 }
                 this.loading = true;
                 this.error = '';
                 try {
                     const response = await fetch('{{ route('newsletter.subscribe') }}', {
                         method: 'POST',
                         headers: {
                             'Content-Type': 'application/json',
                             'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                             'Accept': 'application/json'
                         },
                         body: JSON.stringify({ email: this.email })
                     });
                     const data = await response.json();
                     if (response.ok) {
                         this.success = true;
                         this.email = '';
                     } else {
                         this.error = data.message || 'Something went wrong. Please try again.';
                     }
                 } catch(e) {
                     this.error = 'Network error. Please try again.';
                 } finally {
                     this.loading = false;
                 }
             }
         }">

        {{-- Icon --}}
        <div class="inline-flex items-center justify-center w-16 h-16 bg-[#1A237E]/15 rounded-2xl mb-6">
            <svg class="w-8 h-8 text-[#1A237E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>

        <h2 class="font-display text-4xl md:text-5xl font-bold text-[#1A237E] mb-4">
            Stay Ahead of the Market
        </h2>
        <p class="text-[#1A237E]/70 text-lg mb-10 max-w-xl mx-auto">
            Get exclusive property listings, investment insights and special offers delivered to your inbox. No spam, ever.
        </p>

        {{-- Success state --}}
        <div x-show="success" x-transition class="bg-[#1A237E] text-white rounded-2xl p-6 mb-6 inline-flex items-center gap-3">
            <svg class="w-6 h-6 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="font-semibold">You're subscribed! Welcome to the SHEFAHOMES family.</span>
        </div>

        {{-- Form --}}
        <div x-show="!success">
            <div class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto">
                <input type="email"
                       x-model="email"
                       @keyup.enter="subscribe()"
                       placeholder="Enter your email address"
                       class="flex-1 bg-white/90 backdrop-blur border-0 text-[#1A237E] placeholder-gray-400 px-6 py-4 rounded-2xl focus:outline-none focus:ring-4 focus:ring-[#1A237E]/20 text-base shadow-md">
                <button @click="subscribe()"
                        :disabled="loading"
                        class="flex-shrink-0 bg-[#1A237E] hover:bg-[#0D1566] text-white font-bold px-8 py-4 rounded-2xl transition-all hover:scale-105 shadow-md disabled:opacity-70 disabled:cursor-not-allowed flex items-center gap-2 justify-center">
                    <span x-show="!loading">Subscribe</span>
                    <span x-show="loading" class="flex items-center gap-2">
                        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        Subscribing...
                    </span>
                </button>
            </div>

            {{-- Error --}}
            <p x-show="error" x-text="error" class="mt-3 text-[#1A237E] font-semibold text-sm bg-[#1A237E]/10 px-4 py-2 rounded-xl inline-block"></p>

            <p class="mt-4 text-[#1A237E]/50 text-xs">
                By subscribing you agree to our <a href="{{ route('privacy') }}" class="underline hover:text-[#1A237E]">Privacy Policy</a>.
                Unsubscribe anytime.
            </p>
        </div>

        {{-- Trust signals --}}
        <div class="mt-10 flex flex-wrap items-center justify-center gap-8 text-[#1A237E]/60 text-sm">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                No spam, ever
            </span>
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                5,000+ subscribers
            </span>
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                Unsubscribe anytime
            </span>
        </div>
    </div>
</section>
