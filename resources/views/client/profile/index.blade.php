@extends('layouts.client')
@section('title', 'My Profile')
@section('content')

<div class="max-w-4xl mx-auto space-y-6" x-data="{ activeTab: 'personal' }">

    {{-- Page Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-[#0A1628] font-display">My Profile</h1>
            <p class="text-gray-500 text-sm mt-1">Manage your personal information and security settings</p>
        </div>
        <span class="inline-flex items-center gap-2 bg-green-50 text-green-700 text-xs font-semibold px-3 py-1.5 rounded-full border border-green-200">
            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            Verified Client
        </span>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-800 rounded-xl px-5 py-4 flex items-center gap-3">
        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-800 rounded-xl px-5 py-4">
        <ul class="list-disc list-inside space-y-1 text-sm">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
    @endif

    {{-- Tabs --}}
    <div class="flex gap-1 bg-gray-100 rounded-xl p-1 w-fit">
        <button @click="activeTab='personal'" :class="activeTab==='personal' ? 'bg-white text-[#0A1628] shadow-sm' : 'text-gray-500 hover:text-gray-700'" class="px-5 py-2.5 rounded-lg text-sm font-semibold transition-all">Personal Info</button>
        <button @click="activeTab='security'" :class="activeTab==='security' ? 'bg-white text-[#0A1628] shadow-sm' : 'text-gray-500 hover:text-gray-700'" class="px-5 py-2.5 rounded-lg text-sm font-semibold transition-all">Security</button>
    </div>

    <form action="{{ route('client.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Personal Info Tab --}}
        <div x-show="activeTab==='personal'" class="space-y-6">

            {{-- Avatar Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="font-bold text-[#0A1628] mb-5 text-lg">Profile Photo</h2>
                <div class="flex items-center gap-6">
                    <img id="avatarPreview" src="{{ $user->avatar_url }}" alt="{{ $user->name }}"
                         class="w-24 h-24 rounded-full object-cover ring-4 ring-[#C9A84C]/20">
                    <div>
                        <label for="avatar" class="cursor-pointer inline-flex items-center gap-2 bg-[#0A1628] text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-[#1a2d4a] transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Change Photo
                        </label>
                        <input type="file" id="avatar" name="avatar" accept="image/*" class="hidden"
                               onchange="document.getElementById('avatarPreview').src=URL.createObjectURL(this.files[0])">
                        <p class="text-xs text-gray-400 mt-2">JPG, PNG. Max 2MB.</p>
                    </div>
                </div>
            </div>

            {{-- Personal Details --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="font-bold text-[#0A1628] mb-5 text-lg">Personal Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#C9A84C] focus:border-transparent outline-none transition-all text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" value="{{ $user->email }}" readonly
                               class="w-full px-4 py-3 border border-gray-100 rounded-xl bg-gray-50 text-gray-400 text-sm cursor-not-allowed">
                        <p class="text-xs text-gray-400 mt-1">Contact support to change your email</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+234 800 000 0000"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#C9A84C] focus:border-transparent outline-none transition-all text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                        <input type="text" name="occupation" value="{{ old('occupation', $profile->occupation) }}" placeholder="e.g. Business Owner"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#C9A84C] focus:border-transparent outline-none transition-all text-sm">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <input type="text" name="address" value="{{ old('address', $profile->address) }}" placeholder="Your residential address"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#C9A84C] focus:border-transparent outline-none transition-all text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">State</label>
                        <select name="state" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#C9A84C] focus:border-transparent outline-none transition-all text-sm">
                            <option value="">Select State</option>
                            @foreach(['Abia','Adamawa','Akwa Ibom','Anambra','Bauchi','Bayelsa','Benue','Borno','Cross River','Delta','Ebonyi','Edo','Ekiti','Enugu','FCT-Abuja','Gombe','Imo','Jigawa','Kaduna','Kano','Katsina','Kebbi','Kogi','Kwara','Lagos','Nasarawa','Niger','Ogun','Ondo','Osun','Oyo','Plateau','Rivers','Sokoto','Taraba','Yobe','Zamfara'] as $state)
                            <option value="{{ $state }}" {{ old('state', $profile->state) === $state ? 'selected' : '' }}>{{ $state }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Next of Kin --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="font-bold text-[#0A1628] mb-5 text-lg">Next of Kin</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input type="text" name="nok_name" value="{{ old('nok_name', $profile->nok_name) }}" placeholder="Next of kin name"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#C9A84C] focus:border-transparent outline-none transition-all text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                        <input type="tel" name="nok_phone" value="{{ old('nok_phone', $profile->nok_phone) }}" placeholder="+234 800 000 0000"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#C9A84C] focus:border-transparent outline-none transition-all text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Relationship</label>
                        <select name="nok_relationship" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#C9A84C] focus:border-transparent outline-none transition-all text-sm">
                            <option value="">Select Relationship</option>
                            @foreach(['Spouse','Parent','Sibling','Child','Relative','Friend','Other'] as $rel)
                            <option value="{{ $rel }}" {{ old('nok_relationship', $profile->nok_relationship) === $rel ? 'selected' : '' }}>{{ $rel }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-[#C9A84C] text-[#0A1628] font-bold px-8 py-3 rounded-xl hover:bg-[#E8C97A] transition-all shadow-md hover:shadow-lg">
                    Save Changes
                </button>
            </div>
        </div>

        {{-- Security Tab --}}
        <div x-show="activeTab==='security'" class="space-y-6" style="display:none">

            {{-- KYC Status --}}
            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5 flex items-start gap-4">
                <svg class="w-6 h-6 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                <div>
                    <h3 class="font-semibold text-amber-800">KYC Verification</h3>
                    <p class="text-amber-700 text-sm mt-1">
                        {{ $profile->nin ? 'Your NIN/BVN has been submitted.' : 'Your identity has not been verified yet.' }}
                        Contact our support team at <span class="font-semibold">support@shefahomes.com</span> to complete KYC verification.
                    </p>
                </div>
            </div>

            {{-- Change Password --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="font-bold text-[#0A1628] mb-5 text-lg">Change Password</h2>
                <div class="space-y-5 max-w-md">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                        <input type="password" name="current_password" placeholder="••••••••"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#C9A84C] focus:border-transparent outline-none transition-all text-sm">
                        @error('current_password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                        <input type="password" name="password" placeholder="••••••••"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#C9A84C] focus:border-transparent outline-none transition-all text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                        <input type="password" name="password_confirmation" placeholder="••••••••"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#C9A84C] focus:border-transparent outline-none transition-all text-sm">
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4 text-xs text-gray-500 space-y-1">
                        <p class="font-medium text-gray-700 mb-2">Password requirements:</p>
                        <p>• Minimum 8 characters</p>
                        <p>• At least one uppercase letter</p>
                        <p>• At least one number</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-[#0A1628] text-white font-bold px-8 py-3 rounded-xl hover:bg-[#1a2d4a] transition-all shadow-md hover:shadow-lg">
                    Update Password
                </button>
            </div>
        </div>

    </form>
</div>

@endsection
