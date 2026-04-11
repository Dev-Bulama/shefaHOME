@extends('layouts.admin')

@section('page-title', 'Add FAQ')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-bold text-gray-800">Add FAQ</h1>
        <a href="{{ route('admin.faqs.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back</a>
    </div>

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.faqs.store') }}">
        @csrf
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">
                    <option value="">-- Select Category --</option>
                    @foreach(['General', 'Properties', 'Payment', 'Investment', 'Legal', 'Support'] as $cat)
                    <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                @error('category')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Question <span class="text-red-500">*</span></label>
                <input type="text" name="question" value="{{ old('question') }}" required
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none @error('question') border-red-400 @enderror"
                    placeholder="Enter the question…"/>
                @error('question')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Answer <span class="text-red-500">*</span></label>
                <textarea name="answer" rows="5" required
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none @error('answer') border-red-400 @enderror"
                    placeholder="Enter the answer…">{{ old('answer') }}</textarea>
                @error('answer')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                    class="w-32 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                <p class="text-xs text-gray-400 mt-1">Lower numbers appear first.</p>
            </div>

            <div class="flex items-center gap-3">
                <input type="hidden" name="is_active" value="0"/>
                <input type="checkbox" name="is_active" id="is_active" value="1"
                    {{ old('is_active', true) ? 'checked' : '' }}
                    class="w-4 h-4 text-amber-500 rounded border-gray-300 focus:ring-amber-400"/>
                <label for="is_active" class="text-sm font-medium text-gray-700">Show on website</label>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 mt-4">
            <a href="{{ route('admin.faqs.index') }}" class="px-5 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition">Cancel</a>
            <button type="submit" class="px-6 py-2.5 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-lg font-semibold transition shadow-sm">Save FAQ</button>
        </div>
    </form>
</div>
@endsection
