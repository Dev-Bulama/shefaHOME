@extends('layouts.admin')

@section('page-title', 'Awards & Recognition')

@section('content')
<div class="space-y-4">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h1 class="text-xl font-bold text-gray-800">Awards &amp; Recognition</h1>
        <a href="{{ route('admin.awards.create') }}"
           class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Award
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide border-b border-gray-100">
                        <th class="px-4 py-3 text-left">Image</th>
                        <th class="px-4 py-3 text-left">Title</th>
                        <th class="px-4 py-3 text-left">Year</th>
                        <th class="px-4 py-3 text-left">Sort</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($awards ?? [] as $award)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            @if($award->image)
                            <img src="{{ Storage::url($award->image) }}" alt="{{ $award->title }}"
                                 class="w-16 h-12 object-cover rounded-lg border border-gray-100"/>
                            @else
                            <div class="w-16 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $award->title }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $award->year }}</td>
                        <td class="px-4 py-3 text-gray-400">{{ $award->sort_order ?? 0 }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.awards.edit', $award) }}"
                                   class="text-blue-600 hover:text-blue-800 text-xs font-medium">Edit</a>
                                <form method="POST" action="{{ route('admin.awards.destroy', $award) }}"
                                      onsubmit="return confirm('Delete this award?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-10 text-center text-gray-400">No awards found. Add your first award!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(isset($awards) && method_exists($awards, 'hasPages') && $awards->hasPages())
        <div class="px-4 py-4 border-t border-gray-100">{{ $awards->withQueryString()->links() }}</div>
        @endif
    </div>
</div>
@endsection