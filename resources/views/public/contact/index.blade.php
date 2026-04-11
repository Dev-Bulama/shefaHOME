@extends('layouts.app')

@section('title', 'Contact Us — SHEFAHOMES')
@section('meta_description', 'Get in touch with SHEFAHOMES. Our property advisors are available to help you find your dream estate.')

@section('content')

{{-- Page Hero --}}
<section class="bg-[#0A1628] py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-[#C9A84C] rounded-full translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-[#C9A84C] rounded-full -translate-x-1/3 translate-y-1/3"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block text-[#C9A84C] font-semibold text-sm tracking-widest uppercase mb-3">We're Here to Help</span>
        <h1 class="font-display text-5xl font-bold text-white mb-4">Contact <span class="text-[#C9A84C]">SHEFAHOMES</span></h1>
        <p class="text-gray-300 text-lg max-w-xl mx-auto">Have questions about any of our properties? Our expert team is ready to guide you every step of the way.</p>
    </div>
</section>

{{-- Contact Content --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            {{-- Left: AJAX Contact Form --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden"
                 x-data="{
                     name: '', email: '', phone: '', subject: '', message: '',
                     loading: false, success: false, error: '',
                     async submit() {
                         if (!this.name || !this.email || !this.message) { this.error = 'Please fill all required fields.'; return; }
                         this.loading = true; this.error = '';
                         try {
                             const r = await fetch('{{ route('contact.send') }}', {
                                 method: 'POST',
                                 headers: {'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name=csrf-token]').content,'Accept':'application/json'},
                                 body: JSON.stringify({name:this.name,email:this.email,phone:this.phone,subject:this.subject,message:this.message})
                             });
                             const d = await r.json();
                             if (r.ok) { this.success = true; } else { this.error = d.message || 'Failed to send. Please try again.'; }
                         } catch(e) { this.error = 'Network error. Please try again.'; } finally { this.loading = false; }
                     }
                 }">
                <div class="h-1 bg-gradient-to-r from-[#0A1628] via-[#C9A84C] to-[#0A1628]"></div>
                <div class="p-8 lg:p-10">
                    <h2 class="font-display text-2xl font-bold text-[#0A1628] mb-2">Send Us a Message</h2>
                    <p class="text-gray-500 text-sm mb-8">We typically respond within 24 hours on business days.</p>

                    {{-- Success --}}
                    <div x-show="success" x-transition class="bg-emerald-50 border border-emerald-200 rounded-2xl p-6 text-center mb-6">
                        <svg class="w-12 h-12 text-emerald-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <h3 class="font-bold text-emerald-800 text-lg mb-1">Message Sent!</h3>
                        <p class="text-emerald-700 text-sm">Thank you for reaching out. We'll be in touch shortly.</p>
                    </div>

                    {{-- Error --}}
                    <div x-show="error" x-text="error" class="bg-red-50 border border-red-200 rounded-xl p-4 text-red-600 text-sm mb-5"></div>

                    <div x-show="!success" class="space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Full Name *</label>
                                <input type="text" x-model="name" placeholder="John Doe"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C9A84C] focus:border-[#C9A84C] text-[#0A1628] transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Email Address *</label>
                                <input type="email" x-model="email" placeholder="john@example.com"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C9A84C] focus:border-[#C9A84C] text-[#0A1628] transition-all">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Phone Number</label>
                                <input type="tel" x-model="phone" placeholder="+234 800 000 0000"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C9A84C] focus:border-[#C9A84C] text-[#0A1628] transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Subject</label>
                                <select x-model="subject"
                                        class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C9A84C] focus:border-[#C9A84C] text-gray-700 bg-white transition-all">
                                    <option value="">Select a subject</option>
                                    <option value="property-inquiry">Property Inquiry</option>
                                    <option value="payment-plan">Payment Plan</option>
                                    <option value="site-visit">Book a Site Visit</option>
                                    <option value="partnership">Partnership</option>
                                    <option value="complaint">Complaint</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Message *</label>
                            <textarea x-model="message" rows="5" placeholder="Tell us how we can help you..."
                                      class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C9A84C] focus:border-[#C9A84C] text-[#0A1628] resize-none transition-all"></textarea>
                        </div>
                        <button @click="submit()" :disabled="loading"
                                class="w-full bg-[#C9A84C] hover:bg-[#b8943d] text-[#0A1628] font-bold py-4 rounded-xl transition-all hover:scale-[1.01] hover:shadow-lg hover:shadow-[#C9A84C]/30 disabled:opacity-70 flex items-center justify-center gap-2 text-base">
                            <span x-show="!loading">Send Message</span>
                            <span x-show="loading" class="flex items-center gap-2">
                                <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                                Sending...
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Right: Map + Info --}}
            <div class="space-y-6">
                {{-- Google Maps Embed --}}
                <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-100 h-72">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253682.6334706!2d3.1190749!3d6.5483679!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b8b2ae68280c1%3A0xdc9e87a367c3d9cb!2sLagos!5e0!3m2!1sen!2sng!4v1700000000000"
                        width="100%" height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="SHEFAHOMES Office Location">
                    </iframe>
                </div>

                {{-- Contact Info Cards --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach([
                        ['icon'=>'phone','label'=>'Call Us','value'=>config('shefahomes.phone', '+234 800 SHEFA (74332)'),'color'=>'bg-blue-50 text-blue-600','link'=>'tel:+2348004743325'],
                        ['icon'=>'email','label'=>'Email Us','value'=>config('shefahomes.email', 'hello@shefahomes.com'),'color'=>'bg-emerald-50 text-emerald-600','link'=>'mailto:hello@shefahomes.com'],
                        ['icon'=>'whatsapp','label'=>'WhatsApp','value'=>config('shefahomes.whatsapp', '+234 900 000 0000'),'color'=>'bg-green-50 text-green-600','link'=>'https://wa.me/2349000000000'],
                        ['icon'=>'location','label'=>'Head Office','value'=>config('shefahomes.address', 'Lagos, Nigeria'),'color'=>'bg-orange-50 text-orange-600','link'=>'#'],
                    ] as $info)
                    <a href="{{ $info['link'] }}"
                       class="flex items-start gap-4 bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md hover:border-[#C9A84C]/30 transition-all group">
                        <div class="w-11 h-11 {{ $info['color'] }} rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                            @if($info['icon']==='phone')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            @elseif($info['icon']==='email')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            @elseif($info['icon']==='whatsapp')
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.107.548 4.084 1.504 5.803L0 24l6.338-1.481A11.933 11.933 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.013-1.372l-.36-.214-3.727.871.938-3.624-.234-.372A9.794 9.794 0 012.182 12C2.182 6.582 6.582 2.182 12 2.182S21.818 6.582 21.818 12 17.418 21.818 12 21.818z"/></svg>
                            @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            @endif
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-0.5">{{ $info['label'] }}</p>
                            <p class="text-[#0A1628] font-semibold text-sm leading-snug">{{ $info['value'] }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>

                {{-- Office hours --}}
                <div class="bg-[#0A1628] rounded-2xl p-6 text-white">
                    <h4 class="font-bold text-[#C9A84C] mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Office Hours
                    </h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between"><span class="text-gray-400">Monday – Friday</span><span class="font-semibold">8:00am – 6:00pm</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Saturday</span><span class="font-semibold">9:00am – 4:00pm</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Sunday</span><span class="text-gray-500">Closed</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
