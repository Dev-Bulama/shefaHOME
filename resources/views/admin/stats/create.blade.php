@extends('layouts.admin')

@section('title', 'Add Stat')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    {{-- Page Header --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.stats.index') }}"
           class="text-gray-400 hover:text-[#1A237E] transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h2 class="text-xl font-bold text-[#1A237E]">Add Stat</h2>
            <p class="text-sm text-gray-500 mt-0.5">Create a new homepage statistic.</p>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form action="{{ route('admin.stats.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Label --}}
            <div>
                <label for="label" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Label <span class="text-red-500">*</span>
                </label>
                <input type="text" id="label" name="label" value="{{ old('label') }}" required
                       placeholder="e.g. Families Housed"
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22]/40 focus:border-[#27AE22] transition @error('label') border-red-400 @enderror">
                @error('label')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Value --}}
            <div>
                <label for="value" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Value <span class="text-red-500">*</span>
                </label>
                <input type="text" id="value" name="value" value="{{ old('value') }}" required
                       placeholder="e.g. 5,000+"
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22]/40 focus:border-[#27AE22] transition @error('value') border-red-400 @enderror">
                <p class="text-xs text-gray-400 mt-1">Include formatting like commas and symbols (e.g. "5,000+", "₦2B", "98%").</p>
                @error('value')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Icon --}}
            <div>
                <label for="icon" class="block text-sm font-semibold text-gray-700 mb-1.5">Icon</label>
                <div class="flex items-center gap-3">
                    <input type="text" id="icon" name="icon" value="{{ old('icon') }}"
                           placeholder="e.g. 🏠 or fa-home"
                           class="flex-1 border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22]/40 focus:border-[#27AE22] transition @error('icon') border-red-400 @enderror">
                    <div id="iconPreviewBox" class="w-10 h-10 bg-[#1A237E]/5 rounded-lg flex items-center justify-center text-xl border border-gray-200 flex-shrink-0">
                        ?
                    </div>
                </div>
                <p class="text-xs text-gray-400 mt-1">Use an emoji (e.g. 🏠 🏗️ 👨‍👩‍👧‍👦) or a CSS class name for an icon library.</p>
                @error('icon')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Sort Order --}}
            <div>
                <label for="sort_order" class="block text-sm font-semibold text-gray-700 mb-1.5">Sort Order</label>
                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22]/40 focus:border-[#27AE22] transition @error('sort_order') border-red-400 @enderror">
                <p class="text-xs text-gray-400 mt-1">Lower numbers appear first.</p>
                @error('sort_order')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="bg-[#27AE22] hover:bg-[#b8963e] text-white text-sm font-semibold px-6 py-2.5 rounded-lg transition-colors shadow-sm">
                    Save Stat
                </button>
                <a href="{{ route('admin.stats.index') }}"
                   class="text-gray-500 hover:text-gray-700 text-sm font-medium transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.getElementById('icon').addEventListener('input', function() {
        document.getElementById('iconPreviewBox').textContent = this.value || '?';
    });
</script>
@endpush
