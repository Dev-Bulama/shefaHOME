@extends('layouts.admin')

@section('title', 'Virtual Tours')

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-[#1A237E]">Virtual Tours</h2>
            <p class="text-sm text-gray-500 mt-0.5">Manage property virtual tours and embedded experiences.</p>
        </div>
        <a href="{{ route('admin.virtual-tours.create') }}"
           class="inline-flex items-center gap-2 bg-[#27AE22] hover:bg-[#b8963e] text-white text-sm font-semibold px-4 py-2.5 rounded-lg transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Tour
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Thumbnail</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Property</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Active</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($tours as $tour)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        @if($tour->thumbnail)
                            <img src="{{ Storage::url($tour->thumbnail) }}"
                                 alt="{{ $tour->title }}"
                                 class="h-12 w-20 object-cover rounded-lg border border-gray-100">
                        @else
                            <div class="h-12 w-20 bg-gray-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M15 10l4.553-2.069A1 1 0 0121 8.845v6.31a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm font-medium text-gray-900">{{ $tour->title }}</p>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $tour->property?->name ?? '—' }}
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $typeColors = [
                                'youtube'    => 'bg-red-100 text-red-700',
                                'matterport' => 'bg-blue-100 text-blue-700',
                                'other'      => 'bg-gray-100 text-gray-600',
                            ];
                            $typeColor = $typeColors[$tour->type] ?? 'bg-gray-100 text-gray-600';
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $typeColor }}">
                            {{ ucfirst($tour->type) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $tour->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                            {{ $tour->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.virtual-tours.edit', $tour) }}"
                               class="text-[#1A237E] hover:text-[#27AE22] text-sm font-medium transition-colors">Edit</a>
                            <form action="{{ route('admin.virtual-tours.destroy', $tour) }}" method="POST"
                                  x-data onsubmit="return confirm('Are you sure you want to delete this virtual tour?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium transition-colors">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M15 10l4.553-2.069A1 1 0 0121 8.845v6.31a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-gray-500 text-sm">No virtual tours yet.
                                <a href="{{ route('admin.virtual-tours.create') }}" class="text-[#27AE22] hover:underline">Add the first one.</a>
                            </p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if(isset($tours) && $tours->hasPages())
    <div class="flex justify-end">
        {{ $tours->links() }}
    </div>
    @endif

</div>
@endsection
