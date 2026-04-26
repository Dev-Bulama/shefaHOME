@extends('layouts.admin')

@section('page-title', 'Properties')

@section('content')
<div x-data="propertyIndex()" class="space-y-4">

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
        <div class="min-w-[160px]">
            <label class="block text-xs font-medium text-gray-600 mb-1">Status</label>
            <select name="status" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                <option value="">All Status</option>
                <optgroup label="Listing Type">
                    <option value="rent"         {{ request('status') == 'rent'         ? 'selected' : '' }}>Rent</option>
                    <option value="buy"          {{ request('status') == 'buy'          ? 'selected' : '' }}>Buy</option>
                    <option value="buy_and_rent" {{ request('status') == 'buy_and_rent' ? 'selected' : '' }}>Buy and Rent</option>
                    <option value="shortlet"     {{ request('status') == 'shortlet'     ? 'selected' : '' }}>Shortlet</option>
                </optgroup>
                <optgroup label="Availability">
                    <option value="available"   {{ request('status') == 'available'   ? 'selected' : '' }}>Available</option>
                    <option value="sold_out"    {{ request('status') == 'sold_out'    ? 'selected' : '' }}>Sold Out</option>
                    <option value="coming_soon" {{ request('status') == 'coming_soon' ? 'selected' : '' }}>Coming Soon</option>
                </optgroup>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">Filter</button>
            <a href="{{ route('admin.properties.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold px-4 py-2 rounded-lg transition">Reset</a>
        </div>
    </form>

    {{-- Bulk action bar (shows when rows selected) --}}
    <div x-show="selected.length > 0"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="bg-red-50 border border-red-200 rounded-xl px-5 py-3 flex items-center justify-between gap-4"
         style="display:none;">
        <span class="text-sm font-medium text-red-700">
            <span x-text="selected.length"></span> propert<span x-text="selected.length === 1 ? 'y' : 'ies'"></span> selected
        </span>
        <div class="flex items-center gap-3">
            <button @click="clearSelection()" class="text-sm text-gray-600 hover:text-gray-800 font-medium">Cancel</button>
            <button @click="bulkDelete()"
                    class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Delete Selected
            </button>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide border-b border-gray-100">
                        <th class="px-4 py-3 text-left w-10">
                            <input type="checkbox" @change="toggleAll($event)"
                                   :checked="allSelected"
                                   class="w-4 h-4 rounded border-gray-300 text-yellow-500 focus:ring-yellow-400 cursor-pointer"/>
                        </th>
                        <th class="px-4 py-3 text-left">Image</th>
                        <th class="px-4 py-3 text-left">Title</th>
                        <th class="px-4 py-3 text-left">Location</th>
                        <th class="px-4 py-3 text-left">Type</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Price From</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($properties as $property)
                    <tr class="hover:bg-gray-50" :class="selected.includes({{ $property->id }}) ? 'bg-yellow-50' : ''">
                        <td class="px-4 py-3">
                            <input type="checkbox"
                                   :value="{{ $property->id }}"
                                   x-model="selected"
                                   class="w-4 h-4 rounded border-gray-300 text-yellow-500 focus:ring-yellow-400 cursor-pointer"/>
                        </td>
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
                        <td class="px-4 py-3 font-medium text-gray-800 max-w-[200px]">
                            <div class="truncate">{{ $property->title }}</div>
                            @if($property->is_featured)
                            <span class="inline-block text-[10px] bg-yellow-100 text-yellow-700 font-semibold px-1.5 py-0.5 rounded mt-0.5">Featured</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-600 text-xs">
                            {{ $property->lga ? $property->lga.', ' : '' }}{{ $property->state }}
                        </td>
                        <td class="px-4 py-3 text-gray-600 text-xs">{{ $property->propertyType->name ?? '—' }}</td>
                        <td class="px-4 py-3">
                            @php
                                $sc = ['available'=>'bg-green-100 text-green-700','sold_out'=>'bg-red-100 text-red-600','coming_soon'=>'bg-yellow-100 text-yellow-700','rent'=>'bg-sky-100 text-sky-700','buy'=>'bg-violet-100 text-violet-700','buy_and_rent'=>'bg-amber-100 text-amber-700','shortlet'=>'bg-pink-100 text-pink-700'];
                                $cls = $sc[$property->status] ?? 'bg-gray-100 text-gray-600';
                            @endphp
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $cls }}">{{ ucfirst(str_replace('_',' ',$property->status)) }}</span>
                        </td>
                        <td class="px-4 py-3 text-gray-700 text-xs">
                            @if($property->price_from > 0)
                                ₦{{ number_format($property->price_from) }}
                            @else
                                <span class="text-gray-400 italic">On request</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.properties.edit', $property) }}"
                                   class="text-blue-600 hover:text-blue-800 text-xs font-medium">Edit</a>
                                <button type="button"
                                        @click="deleteSingle({{ $property->id }}, '{{ addslashes($property->title) }}')"
                                        class="text-red-500 hover:text-red-700 text-xs font-medium">Delete</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 py-10 text-center text-gray-400">No properties found.</td>
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

    {{-- Hidden CSRF form for single delete --}}
    <form id="deleteSingleForm" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

</div>
@endsection

@push('scripts')
<script>
function propertyIndex() {
    return {
        selected: [],

        get allSelected() {
            const checkboxes = document.querySelectorAll('tbody input[type=checkbox]');
            return checkboxes.length > 0 && this.selected.length === checkboxes.length;
        },

        toggleAll(e) {
            if (e.target.checked) {
                this.selected = Array.from(document.querySelectorAll('tbody input[type=checkbox]'))
                    .map(cb => parseInt(cb.value));
            } else {
                this.selected = [];
            }
        },

        clearSelection() {
            this.selected = [];
        },

        deleteSingle(id, title) {
            if (!confirm(`Delete "${title}"?\n\nThis action cannot be undone.`)) return;

            const form = document.getElementById('deleteSingleForm');
            form.action = `/admin/properties/${id}`;
            form.submit();
        },

        async bulkDelete() {
            if (this.selected.length === 0) return;
            const count = this.selected.length;
            if (!confirm(`Delete ${count} selected propert${count === 1 ? 'y' : 'ies'}?\n\nThis action cannot be undone.`)) return;

            try {
                const res = await fetch('{{ route('admin.properties.bulk-destroy') }}', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ ids: this.selected }),
                });
                const data = await res.json();
                if (data.success) {
                    window.location.reload();
                } else {
                    alert('Something went wrong. Please try again.');
                }
            } catch (e) {
                alert('Network error. Please try again.');
            }
        },
    };
}
</script>
@endpush
