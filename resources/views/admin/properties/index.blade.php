@extends('layouts.admin')

@section('page-title', 'Properties')

@section('content')
<div class="space-y-4">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h1 class="text-xl font-bold text-gray-800">All Properties</h1>
        <a href="{{ route('admin.properties.create') }}"
           class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Property
        </a>
    </div>

    {{-- Filters --}}
    <form method="GET" action="{{ route('admin.properties.index') }}"
          class="bg-white rounded-xl shadow p-4 flex flex-wrap gap-3 items-end">
        <div class="flex-1 min-w-[180px]">
            <label class="block text-xs font-medium text-gray-600 mb-1">Search</label>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Title, location…"
                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-yellow-400 focus:outline-none"/>
        </div>
        <div class="min-w-[140px]">
            <label class="block text-xs font-medium text-gray-600 mb-1">State</label>
            <select name="state" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                <option value="">All States</option>
                @foreach ($states ?? [] as $state)
                <option value="{{ $state }}" {{ request('state') == $state ? 'selected' : '' }}>{{ $state }}</option>
                @endforeach
            </select>
        </div>
        <div class="min-w-[140px]">
            <label class="block text-xs font-medium text-gray-600 mb-1">Type</label>
            <select name="type" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                <option value="">All Types</option>
                <option value="residential" {{ request('type') == 'residential' ? 'selected' : '' }}>Residential</option>
                <option value="commercial"  {{ request('type') == 'commercial'  ? 'selected' : '' }}>Commercial</option>
                <option value="mixed"       {{ request('type') == 'mixed'       ? 'selected' : '' }}>Mixed Use</option>
            </select>
        </div>
        <div class="min-w-[140px]">
            <label class="block text-xs font-medium text-gray-600 mb-1">Status</label>
            <select name="status" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                <option value="">All Status</option>
                <option value="available"   {{ request('status') == 'available'   ? 'selected' : '' }}>Available</option>
                <option value="sold_out"    {{ request('status') == 'sold_out'    ? 'selected' : '' }}>Sold Out</option>
                <option value="coming_soon" {{ request('status') == 'coming_soon' ? 'selected' : '' }}>Coming Soon</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">Filter</button>
            <a href="{{ route('admin.properties.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold px-4 py-2 rounded-lg transition">Reset</a>
        </div>
    </form>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide border-b border-gray-100">
                        <th class="px-4 py-3 text-left">Image</th>
                        <th class="px-4 py-3 text-left">Title</th>
                        <th class="px-4 py-3 text-left">State</th>
                        <th class="px-4 py-3 text-left">Type</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Price (₦)</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($properties as $property)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            @if ($property->cover_image)
                            <img src="{{ Storage::url($property->cover_image) }}" alt="{{ $property->title }}"
                                 class="w-14 h-10 object-cover rounded-lg"/>
                            @else
                            <div class="w-14 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-800 max-w-[180px] truncate">{{ $property->title }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $property->state }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ ucfirst($property->type) }}</td>
                        <td class="px-4 py-3">
                            @php
                                $sc = ['available'=>'bg-green-100 text-green-700','sold_out'=>'bg-red-100 text-red-600','coming_soon'=>'bg-yellow-100 text-yellow-700'];
                                $sc = $sc[$property->status] ?? 'bg-gray-100 text-gray-600';
                            @endphp
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $sc }}">{{ ucfirst(str_replace('_',' ',$property->status)) }}</span>
                        </td>
                        <td class="px-4 py-3 text-gray-700">{{ number_format($property->price) }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.properties.edit', $property) }}"
                                   class="text-blue-600 hover:text-blue-800 text-xs font-medium">Edit</a>
                                <form method="POST" action="{{ route('admin.properties.destroy', $property) }}"
                                      onsubmit="return confirm('Delete this property?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-10 text-center text-gray-400">No properties found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($properties->hasPages())
        <div class="px-4 py-4 border-t border-gray-100">
            {{ $properties->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
