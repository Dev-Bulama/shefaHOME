@extends('layouts.admin')

@section('title', 'Homepage Stats')

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-[#1A237E]">Homepage Stats</h2>
            <p class="text-sm text-gray-500 mt-0.5">Manage the key statistics displayed on the homepage.</p>
        </div>
        <a href="{{ route('admin.stats.create') }}"
           class="inline-flex items-center gap-2 bg-[#27AE22] hover:bg-[#b8963e] text-white text-sm font-semibold px-4 py-2.5 rounded-lg transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Stat
        </a>
    </div>

    {{-- Drag-to-reorder hint --}}
    <div class="flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-600 text-xs px-4 py-2.5 rounded-lg">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4M17 8v12m0 0l4-4m-4 4l-4-4"/>
        </svg>
        Tip: Adjust the Sort Order field to control display order. Lower numbers appear first.
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Icon</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Label</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Value</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Sort Order</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($stats as $stat)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="w-10 h-10 bg-[#1A237E]/5 rounded-lg flex items-center justify-center text-xl">
                            {{ $stat->icon }}
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $stat->label }}</td>
                    <td class="px-6 py-4">
                        <span class="text-base font-bold text-[#27AE22]">{{ $stat->value }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $stat->sort_order }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.stats.edit', $stat) }}"
                               class="text-[#1A237E] hover:text-[#27AE22] text-sm font-medium transition-colors">Edit</a>
                            <form action="{{ route('admin.stats.destroy', $stat) }}" method="POST"
                                  x-data onsubmit="return confirm('Are you sure you want to delete this stat?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium transition-colors">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            <p class="text-gray-500 text-sm">No stats yet. <a href="{{ route('admin.stats.create') }}" class="text-[#27AE22] hover:underline">Add the first one.</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
