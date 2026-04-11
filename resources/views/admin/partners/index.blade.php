@extends('layouts.admin')

@section('title', 'Partners & Sponsors')

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-[#0A1628]">Partners & Sponsors</h2>
            <p class="text-sm text-gray-500 mt-0.5">Manage company partners and sponsors displayed on the site.</p>
        </div>
        <a href="{{ route('admin.partners.create') }}"
           class="inline-flex items-center gap-2 bg-[#C9A84C] hover:bg-[#b8963e] text-white text-sm font-semibold px-4 py-2.5 rounded-lg transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Partner
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Logo</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Website</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Sort Order</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Active</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($partners as $partner)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        @if($partner->logo)
                            <img src="{{ Storage::url($partner->logo) }}"
                                 alt="{{ $partner->name }}"
                                 class="h-10 w-20 object-contain rounded border border-gray-100 bg-gray-50 p-1">
                        @else
                            <div class="h-10 w-20 bg-gray-100 rounded flex items-center justify-center text-gray-400 text-xs">No logo</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $partner->name }}</td>
                    <td class="px-6 py-4 text-sm">
                        @if($partner->website)
                            <a href="{{ $partner->website }}" target="_blank" rel="noopener noreferrer"
                               class="text-[#C9A84C] hover:underline truncate max-w-[180px] block">
                                {{ $partner->website }}
                            </a>
                        @else
                            <span class="text-gray-400">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $partner->sort_order }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $partner->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                            {{ $partner->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.partners.edit', $partner) }}"
                               class="text-[#0A1628] hover:text-[#C9A84C] text-sm font-medium transition-colors">Edit</a>
                            <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST"
                                  x-data onsubmit="return confirm('Are you sure you want to delete this partner?')">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/>
                            </svg>
                            <p class="text-gray-500 text-sm">No partners found. <a href="{{ route('admin.partners.create') }}" class="text-[#C9A84C] hover:underline">Add the first one.</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if(isset($partners) && $partners->hasPages())
    <div class="flex justify-end">
        {{ $partners->links() }}
    </div>
    @endif

</div>
@endsection
