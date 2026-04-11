@extends('layouts.admin')

@section('page-title', 'Add Team Member')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-bold text-gray-800">Add Team Member</h1>
        <a href="{{ route('admin.team.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back</a>
    </div>

    <form method="POST" action="{{ route('admin.team.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">

            {{-- Photo Upload --}}
            <div class="flex flex-col items-center gap-4">
                <div class="relative">
                    <img id="photoPreview" src="#" alt=""
                        class="w-24 h-24 rounded-full object-cover border-4 border-amber-100 hidden"/>
                    <div id="photoPlaceholder"
                        class="w-24 h-24 rounded-full bg-gray-100 border-4 border-gray-200 flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <input type="file" name="photo" id="photoInput" accept="image/*" class="hidden" onchange="previewPhoto(this)"/>
                    <label for="photoInput" class="cursor-pointer text-sm text-amber-600 font-medium border border-amber-200 rounded-lg px-4 py-2 hover:bg-amber-50 transition">
                        Upload Photo
                    </label>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none @error('name') border-red-400 @enderror"/>
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Job Role / Title <span class="text-red-500">*</span></label>
                    <input type="text" name="role" value="{{ old('role') }}" required
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none @error('role') border-red-400 @enderror"/>
                    @error('role')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                    <select name="department" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">
                        <option value="">Select department…</option>
                        <option value="Management"  {{ old('department') == 'Management'  ? 'selected' : '' }}>Management</option>
                        <option value="Sales"       {{ old('department') == 'Sales'       ? 'selected' : '' }}>Sales</option>
                        <option value="Marketing"   {{ old('department') == 'Marketing'   ? 'selected' : '' }}>Marketing</option>
                        <option value="Finance"     {{ old('department') == 'Finance'     ? 'selected' : '' }}>Finance</option>
                        <option value="Legal"       {{ old('department') == 'Legal'       ? 'selected' : '' }}>Legal</option>
                        <option value="Operations"  {{ old('department') == 'Operations'  ? 'selected' : '' }}>Operations</option>
                        <option value="Engineering" {{ old('department') == 'Engineering' ? 'selected' : '' }}>Engineering</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">LinkedIn URL</label>
                    <input type="url" name="linkedin" value="{{ old('linkedin') }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                    <textarea name="bio" rows="4"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">{{ old('bio') }}</textarea>
                </div>
                <div class="flex items-center gap-3">
                    <input type="hidden" name="is_active" value="0"/>
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                        class="w-4 h-4 text-amber-500 rounded border-gray-300 focus:ring-amber-400"/>
                    <label for="is_active" class="text-sm font-medium text-gray-700">Visible on website</label>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 mt-4">
            <a href="{{ route('admin.team.index') }}" class="px-5 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition">Cancel</a>
            <button type="submit" class="px-6 py-2.5 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-lg font-semibold transition shadow-sm">Save Member</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const p = document.getElementById('photoPreview');
            p.src = e.target.result; p.classList.remove('hidden');
            document.getElementById('photoPlaceholder').classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
