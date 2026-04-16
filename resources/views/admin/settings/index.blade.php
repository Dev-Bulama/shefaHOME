@extends('layouts.admin')

@section('page-title', 'Settings')

@section('content')
<div x-data="{ activeTab: 'general' }" class="space-y-6">

    <div class="flex items-center justify-between">
        <h1 class="text-xl font-bold text-gray-800">Site Settings</h1>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        {{-- Tab Navigation --}}
        <div class="border-b border-gray-100 flex overflow-x-auto">
            @foreach(['general' => 'General', 'social' => 'Social Media', 'seo' => 'SEO', 'payments' => 'Payments', 'scripts' => 'Scripts & Integrations'] as $tab => $label)
            <button type="button" @click="activeTab = '{{ $tab }}'"
                :class="activeTab === '{{ $tab }}' ? 'border-b-2 border-amber-500 text-amber-600' : 'text-gray-500 hover:text-gray-700'"
                class="px-6 py-4 text-sm font-medium whitespace-nowrap transition focus:outline-none">
                {{ $label }}
            </button>
            @endforeach
        </div>

        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf

            {{-- General Tab --}}
            <div x-show="activeTab === 'general'" class="p-6 space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Site Name</label>
                        <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tagline</label>
                        <input type="text" name="tagline" value="{{ old('tagline', $settings['tagline'] ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone 1</label>
                        <input type="text" name="phone_1" value="{{ old('phone_1', $settings['phone_1'] ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone 2</label>
                        <input type="text" name="phone_2" value="{{ old('phone_2', $settings['phone_2'] ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $settings['email'] ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp Number</label>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp', $settings['whatsapp'] ?? '') }}"
                            placeholder="+2348012345678"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Office Address</label>
                        <textarea name="address" rows="2"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">{{ old('address', $settings['address'] ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Company RC Number</label>
                        <input type="text" name="rc_number" value="{{ old('rc_number', $settings['rc_number'] ?? '') }}" placeholder="e.g. MCT60842"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                        <p class="text-xs text-gray-400 mt-1">Shows in the footer. Leave blank to hide.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Logo</label>
                        @if(!empty($settings['logo']))
                        <img src="{{ Storage::url($settings['logo']) }}" class="h-12 mb-2 object-contain"/>
                        @endif
                        <input type="file" name="logo" accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Logo Height (px)</label>
                        <input type="number" name="logo_height" value="{{ old('logo_height', $settings['logo_height'] ?? '48') }}" min="20" max="120"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                        <p class="text-xs text-gray-400 mt-1">Recommended: 40–80px. Default is 48px.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Footer Logo</label>
                        <p class="text-xs text-gray-400 mb-2">Shown in the footer. Leave blank to use the main logo above.</p>
                        @if(!empty($settings['footer_logo']))
                        <img src="{{ Storage::url($settings['footer_logo']) }}" class="h-10 mb-2 object-contain"/>
                        @endif
                        <input type="file" name="footer_logo" accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Footer Logo Height (px)</label>
                        <input type="number" name="footer_logo_height" value="{{ old('footer_logo_height', $settings['footer_logo_height'] ?? '40') }}" min="20" max="120"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Navbar Background Color</label>
                        <p class="text-xs text-gray-400 mb-2">Color of the navbar when the page is scrolled or the mobile menu is open.</p>
                        <div class="flex items-center gap-3">
                            <input type="color" id="navbarBgColorPicker"
                                value="{{ old('navbar_bg_color', $settings['navbar_bg_color'] ?? '#1A237E') }}"
                                class="h-10 w-16 border border-gray-200 rounded-lg cursor-pointer p-1"
                                oninput="document.getElementById('navbarBgColor').value=this.value"/>
                            <input type="text" name="navbar_bg_color"
                                id="navbarBgColor"
                                value="{{ old('navbar_bg_color', $settings['navbar_bg_color'] ?? '#1A237E') }}"
                                placeholder="#1A237E"
                                class="w-32 border border-gray-200 rounded-lg px-3 py-2 text-sm font-mono focus:ring-2 focus:ring-amber-400 focus:outline-none"
                                oninput="(function(v){if(/^#[0-9a-f]{6}$/i.test(v))document.getElementById('navbarBgColorPicker').value=v})(this.value)"/>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Default: #1A237E (navy). You can also type a hex code directly.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Favicon</label>
                        @if(!empty($settings['favicon']))
                        <img src="{{ Storage::url($settings['favicon']) }}" class="h-8 w-8 mb-2 object-contain"/>
                        @endif
                        <input type="file" name="favicon" accept="image/x-icon,image/png"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100"/>
                    </div>
                </div>

                {{-- Site Controls --}}
                <div class="border-t border-gray-100 pt-5">
                    <h4 class="font-semibold text-gray-700 mb-4 text-sm">Site Controls</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Maintenance Mode --}}
                        <div class="flex items-center justify-between gap-4 p-4 rounded-xl border border-gray-200 bg-gray-50 hover:border-gray-300 transition">
                            <div>
                                <p class="text-sm font-semibold text-gray-800">Maintenance Mode</p>
                                <p class="text-xs text-gray-500 mt-0.5">Public visitors see a "coming back soon" page. Admins are unaffected.</p>
                            </div>
                            <div class="flex-shrink-0">
                                <input type="hidden" name="maintenance_mode" value="0">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="maintenance_mode" value="1"
                                           {{ ($settings['maintenance_mode'] ?? '0') === '1' ? 'checked' : '' }}
                                           class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 rounded-full
                                                peer-checked:bg-red-500
                                                after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                                after:bg-white after:rounded-full after:h-5 after:w-5
                                                after:transition-all peer-checked:after:translate-x-full"></div>
                                </label>
                            </div>
                        </div>

                        {{-- WhatsApp Bubble --}}
                        <div class="flex items-center justify-between gap-4 p-4 rounded-xl border border-gray-200 bg-gray-50 hover:border-gray-300 transition">
                            <div>
                                <p class="text-sm font-semibold text-gray-800">WhatsApp Bubble</p>
                                <p class="text-xs text-gray-500 mt-0.5">Show or hide the floating WhatsApp chat button on all public pages.</p>
                            </div>
                            <div class="flex-shrink-0">
                                <input type="hidden" name="whatsapp_bubble" value="0">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="whatsapp_bubble" value="1"
                                           {{ ($settings['whatsapp_bubble'] ?? '1') === '1' ? 'checked' : '' }}
                                           class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 rounded-full
                                                peer-checked:bg-green-500
                                                after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                                after:bg-white after:rounded-full after:h-5 after:w-5
                                                after:transition-all peer-checked:after:translate-x-full"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Services Page Images --}}
                <div class="border-t border-gray-100 pt-5">
                    <h4 class="font-semibold text-gray-700 mb-1 text-sm">Services Page Images</h4>
                    <p class="text-xs text-gray-400 mb-4">Upload images for each service section. If left blank, the default coloured block is shown.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @foreach([
                            ['Land Banking Investment', 'svc_land_banking_image'],
                            ['Project Management', 'svc_project_mgmt_image'],
                            ['Property Flipping', 'svc_flipping_image'],
                            ['JV Partnerships', 'svc_jv_image'],
                            ['Property Development', 'svc_development_image'],
                        ] as [$label, $key])
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
                            @if(!empty($settings[$key]))
                            <img src="{{ Storage::url($settings[$key]) }}" class="h-20 w-full object-cover rounded-lg border mb-2"/>
                            @endif
                            <input type="file" name="{{ $key }}" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100"/>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Social Tab --}}
            <div x-show="activeTab === 'social'" class="p-6 space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @foreach([
                        ['Facebook', 'facebook', 'https://facebook.com/…'],
                        ['Instagram', 'instagram', 'https://instagram.com/…'],
                        ['Twitter / X', 'twitter', 'https://twitter.com/…'],
                        ['LinkedIn', 'linkedin', 'https://linkedin.com/company/…'],
                        ['YouTube', 'youtube', 'https://youtube.com/…'],
                        ['TikTok', 'tiktok', 'https://tiktok.com/@…'],
                    ] as [$label, $key, $placeholder])
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
                        <input type="url" name="social_{{ $key }}" placeholder="{{ $placeholder }}"
                            value="{{ old('social_' . $key, $settings['social_' . $key] ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- SEO Tab --}}
            <div x-show="activeTab === 'seo'" class="p-6 space-y-5">
                <div class="grid grid-cols-1 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Default Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $settings['meta_title'] ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                        <p class="text-xs text-gray-400 mt-1">Shown on pages that don't have a specific meta title</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Default Meta Description</label>
                        <textarea name="meta_description" rows="3"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Google Analytics ID</label>
                        <input type="text" name="google_analytics_id" placeholder="G-XXXXXXXXXX"
                            value="{{ old('google_analytics_id', $settings['google_analytics_id'] ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Google Search Console Verification</label>
                        <input type="text" name="google_site_verification"
                            value="{{ old('google_site_verification', $settings['google_site_verification'] ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">OG / Social Share Image</label>
                        @if(!empty($settings['og_image']))
                        <img src="{{ Storage::url($settings['og_image']) }}" class="h-24 object-cover rounded-lg border mb-2"/>
                        @endif
                        <input type="file" name="og_image" accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100"/>
                        <p class="text-xs text-gray-400 mt-1">Recommended: 1200 × 630px</p>
                    </div>
                </div>
            </div>

            {{-- Payments Tab --}}
            <div x-show="activeTab === 'payments'" class="p-6 space-y-6">
                <div class="bg-blue-50 border border-blue-200 rounded-lg px-4 py-3 text-sm text-blue-800">
                    <strong>Paystack Integration:</strong> Enter your Paystack API keys below. Get them from your <a href="https://dashboard.paystack.com/#/settings/developer" target="_blank" class="underline">Paystack Dashboard → Settings → API Keys</a>.
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Paystack Public Key</label>
                        <input type="text" name="paystack_public_key" placeholder="pk_live_xxxxxxxxxxxxxxxxxxxx"
                            value="{{ old('paystack_public_key', $settings['paystack_public_key'] ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm font-mono focus:ring-2 focus:ring-[#27AE22] focus:outline-none"/>
                        <p class="text-xs text-gray-400 mt-1">Used on the payment form (client-visible). Use <code>pk_test_</code> for test mode.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Paystack Secret Key</label>
                        <input type="password" name="paystack_secret_key" placeholder="sk_live_xxxxxxxxxxxxxxxxxxxx"
                            value="{{ old('paystack_secret_key', $settings['paystack_secret_key'] ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm font-mono focus:ring-2 focus:ring-[#27AE22] focus:outline-none"/>
                        <p class="text-xs text-gray-400 mt-1">Used server-side only for verification. Never expose this publicly.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Payment Mode</label>
                        <select name="paystack_mode" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#27AE22] focus:outline-none">
                            <option value="live" {{ ($settings['paystack_mode'] ?? 'live') === 'live' ? 'selected' : '' }}>Live (Production)</option>
                            <option value="test" {{ ($settings['paystack_mode'] ?? '') === 'test' ? 'selected' : '' }}>Test (Sandbox)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Currency</label>
                        <select name="payment_currency" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#27AE22] focus:outline-none">
                            <option value="NGN" {{ ($settings['payment_currency'] ?? 'NGN') === 'NGN' ? 'selected' : '' }}>NGN — Nigerian Naira</option>
                            <option value="USD" {{ ($settings['payment_currency'] ?? '') === 'USD' ? 'selected' : '' }}>USD — US Dollar</option>
                            <option value="GHS" {{ ($settings['payment_currency'] ?? '') === 'GHS' ? 'selected' : '' }}>GHS — Ghanaian Cedi</option>
                        </select>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-5">
                    <h3 class="text-sm font-semibold text-gray-700 mb-4">Payment Display Settings</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Payment Page Title</label>
                            <input type="text" name="payment_page_title" placeholder="Complete Your Payment"
                                value="{{ old('payment_page_title', $settings['payment_page_title'] ?? 'Complete Your Payment') }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#27AE22] focus:outline-none"/>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Support Email (on receipts)</label>
                            <input type="email" name="receipt_support_email" placeholder="support@shefahomesng.com"
                                value="{{ old('receipt_support_email', $settings['receipt_support_email'] ?? $settings['contact_email'] ?? '') }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#27AE22] focus:outline-none"/>
                        </div>
                    </div>
                </div>

                {{-- Payment Method --}}
                <div class="md:col-span-2 border-t border-gray-100 pt-5">
                    <h4 class="font-semibold text-gray-700 mb-4">Active Payment Method</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach(['paystack' => 'Paystack Only', 'bank_transfer' => 'Bank Transfer Only', 'both' => 'Both Methods'] as $val => $lbl)
                        <label class="flex items-center gap-3 cursor-pointer border rounded-xl p-4 {{ ($settings['payment_method'] ?? 'paystack') === $val ? 'border-[#27AE22] bg-[#27AE22]/5' : 'border-gray-200 hover:border-gray-300' }} transition">
                            <input type="radio" name="payment_method" value="{{ $val }}"
                                   {{ ($settings['payment_method'] ?? 'paystack') === $val ? 'checked' : '' }}
                                   class="text-[#27AE22]">
                            <span class="text-sm font-medium text-gray-700">{{ $lbl }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Bank Transfer Details --}}
                <div class="md:col-span-2 border-t border-gray-100 pt-5">
                    <h4 class="font-semibold text-gray-700 mb-4">Bank Transfer Details</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bank Name</label>
                            <input type="text" name="bank_name" value="{{ old('bank_name', $settings['bank_name'] ?? '') }}"
                                   placeholder="e.g. Zenith Bank"
                                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Account Name</label>
                            <input type="text" name="bank_account_name" value="{{ old('bank_account_name', $settings['bank_account_name'] ?? '') }}"
                                   placeholder="e.g. Shefa Homes and Properties Ltd"
                                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Account Number</label>
                            <input type="text" name="bank_account_number" value="{{ old('bank_account_number', $settings['bank_account_number'] ?? '') }}"
                                   placeholder="e.g. 1234567890"
                                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm font-mono focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Sort Code / SWIFT (optional)</label>
                            <input type="text" name="bank_sort_code" value="{{ old('bank_sort_code', $settings['bank_sort_code'] ?? '') }}"
                                   placeholder="e.g. 057 or ZEIBNGLA"
                                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm font-mono focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Payment Instructions (shown to customer)</label>
                            <textarea name="bank_transfer_instructions" rows="3"
                                      class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none resize-none"
                                      placeholder="e.g. Please transfer the exact amount and send proof of payment to payments@shefahomes.com">{{ old('bank_transfer_instructions', $settings['bank_transfer_instructions'] ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Scripts & Integrations Tab --}}
            <div x-show="activeTab === 'scripts'" class="p-6 space-y-6">
                <div class="bg-amber-50 border border-amber-200 rounded-lg px-4 py-3 text-sm text-amber-800">
                    <strong>Note:</strong> Scripts entered here are output as raw HTML. Only paste trusted code from Meta Pixel, Google Tag Manager, chatbots, live-chat widgets, etc.
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        &lt;head&gt; Scripts
                        <span class="text-xs font-normal text-gray-400 ml-1">— inserted just before &lt;/head&gt;</span>
                    </label>
                    <p class="text-xs text-gray-400 mb-2">Use for Meta Pixel, Google Tag Manager, analytics, and verification tags.</p>
                    <textarea name="head_scripts" rows="12" spellcheck="false"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-xs font-mono focus:ring-2 focus:ring-amber-400 focus:outline-none bg-gray-50">{{ old('head_scripts', $settings['head_scripts'] ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        &lt;body&gt; Scripts
                        <span class="text-xs font-normal text-gray-400 ml-1">— inserted just before &lt;/body&gt;</span>
                    </label>
                    <p class="text-xs text-gray-400 mb-2">Use for live chat widgets, chatbots, or any script that requires the DOM to be loaded.</p>
                    <textarea name="body_scripts" rows="10" spellcheck="false"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-xs font-mono focus:ring-2 focus:ring-amber-400 focus:outline-none bg-gray-50">{{ old('body_scripts', $settings['body_scripts'] ?? '') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Facebook Pixel ID</label>
                        <input type="text" name="facebook_pixel_id" placeholder="2115240449426594"
                            value="{{ old('facebook_pixel_id', $settings['facebook_pixel_id'] ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                        <p class="text-xs text-gray-400 mt-1">Shortcut: paste just the Pixel ID and we auto-generate the snippet, <em>or</em> paste the full snippet above.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Google Tag Manager ID</label>
                        <input type="text" name="gtm_id" placeholder="GTM-XXXXXXX"
                            value="{{ old('gtm_id', $settings['gtm_id'] ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tawk.to / Chat Widget ID</label>
                        <input type="text" name="chat_widget_id" placeholder="e.g. Tawk Property ID"
                            value="{{ old('chat_widget_id', $settings['chat_widget_id'] ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Crisp Chat Website ID</label>
                        <input type="text" name="crisp_website_id" placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx"
                            value="{{ old('crisp_website_id', $settings['crisp_website_id'] ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                </div>
            </div>

            <div class="px-6 pb-6 flex justify-end">
                <button type="submit" class="px-8 py-2.5 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-lg font-semibold transition shadow-sm">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
