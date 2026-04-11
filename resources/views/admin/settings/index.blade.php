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
            @foreach(['general' => 'General', 'social' => 'Social Media', 'seo' => 'SEO'] as $tab => $label)
            <button type="button" @click="activeTab = '{{ $tab }}'"
                :class="activeTab === '{{ $tab }}' ? 'border-b-2 border-amber-500 text-amber-600' : 'text-gray-500 hover:text-gray-700'"
                class="px-6 py-4 text-sm font-medium whitespace-nowrap transition focus:outline-none">
                {{ $label }}
            </button>
            @endforeach
        </div>

        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

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
                        <label class="block text-sm font-medium text-gray-700 mb-2">Logo</label>
                        @if(!empty($settings['logo']))
                        <img src="{{ Storage::url($settings['logo']) }}" class="h-12 mb-2 object-contain"/>
                        @endif
                        <input type="file" name="logo" accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100"/>
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

            <div class="px-6 pb-6 flex justify-end">
                <button type="submit" class="px-8 py-2.5 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-lg font-semibold transition shadow-sm">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
