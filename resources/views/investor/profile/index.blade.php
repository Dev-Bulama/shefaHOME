@extends('layouts.investor')

@section('page-title', 'My Profile')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <h1 class="text-xl font-bold text-gray-800">My Profile</h1>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">{{ session('success') }}</div>
    @endif

    {{-- KYC Status --}}
    @php $kyc = auth()->user()->investorProfile?->kyc_status ?? 'pending'; @endphp
    <div class="rounded-xl p-4 flex items-center gap-3 {{ $kyc === 'approved' ? 'bg-green-50 border border-green-200' : ($kyc === 'under_review' ? 'bg-blue-50 border border-blue-200' : 'bg-yellow-50 border border-yellow-200') }}">
        <svg class="w-5 h-5 flex-shrink-0 {{ $kyc === 'approved' ? 'text-green-600' : ($kyc === 'under_review' ? 'text-blue-600' : 'text-yellow-600') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            @if($kyc === 'approved')
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            @else
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            @endif
        </svg>
        <div>
            <p class="text-sm font-medium {{ $kyc === 'approved' ? 'text-green-800' : ($kyc === 'under_review' ? 'text-blue-800' : 'text-yellow-800') }}">
                KYC Status: <span class="capitalize">{{ str_replace('_', ' ', $kyc) }}</span>
            </p>
            <p class="text-xs {{ $kyc === 'approved' ? 'text-green-600' : ($kyc === 'under_review' ? 'text-blue-600' : 'text-yellow-600') }}">
                @if($kyc === 'approved') Your identity has been verified.
                @elseif($kyc === 'under_review') Your documents are under review.
                @else Please complete your KYC to unlock all features.
                @endif
            </p>
        </div>
    </div>

    {{-- Profile Form --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
        <h3 class="text-sm font-semibold text-gray-700 mb-5">Personal Information</h3>
        <form method="POST" action="{{ route('investor.profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Avatar --}}
            <div class="flex items-center gap-5 mb-6">
                @if(auth()->user()->avatar)
                <img id="avatarPreview" src="{{ Storage::url(auth()->user()->avatar) }}"
                    class="w-20 h-20 rounded-full object-cover border-4 border-amber-100"/>
                @else
                <div class="relative">
                    <img id="avatarPreview" src="#" alt="" class="w-20 h-20 rounded-full object-cover border-4 border-amber-100 hidden"/>
                    <div id="avatarPlaceholder" class="w-20 h-20 rounded-full bg-amber-100 flex items-center justify-center text-3xl font-bold text-amber-600">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
                @endif
                <div>
                    <input type="file" name="avatar" id="avatarInput" accept="image/*" class="hidden" onchange="previewAvatar(this)"/>
                    <label for="avatarInput" class="cursor-pointer text-sm text-amber-600 font-medium border border-amber-200 rounded-lg px-4 py-2 hover:bg-amber-50 transition">
                        Change Photo
                    </label>
                    <p class="text-xs text-gray-400 mt-1">JPG, PNG up to 2MB</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">State</label>
                    <input type="text" name="state" value="{{ old('state', auth()->user()->state) }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Occupation</label>
                    <input type="text" name="occupation" value="{{ old('occupation', auth()->user()->occupation) }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <textarea name="address" rows="2"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">{{ old('address', auth()->user()->address) }}</textarea>
                </div>
            </div>

            <div class="mt-5 flex justify-end">
                <button type="submit" class="px-6 py-2.5 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-lg font-semibold transition shadow-sm">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    {{-- Password Change --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
        <h3 class="text-sm font-semibold text-gray-700 mb-5">Change Password</h3>
        <form method="POST" action="{{ route('investor.profile.update') }}">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                    <input type="password" name="current_password" required
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none @error('current_password') border-red-400 @enderror"/>
                    @error('current_password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input type="password" name="password" required
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none @error('password') border-red-400 @enderror"/>
                    @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2.5 text-sm text-white bg-gray-800 hover:bg-gray-900 rounded-lg font-semibold transition">
                        Update Password
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const p = document.getElementById('avatarPreview');
            p.src = e.target.result; p.classList.remove('hidden');
            const ph = document.getElementById('avatarPlaceholder');
            if (ph) ph.classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
