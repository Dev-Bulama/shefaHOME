@extends('layouts.admin')

@section('title', 'Property Types')

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-[#0A1628]">Property Types</h2>
            <p class="text-sm text-gray-500 mt-0.5">Categorise listings by property type (e.g. Apartment, Duplex, Land).</p>
        </div>
        <a href="{{ route('admin.property-types.create') }}"
           class="inline-flex items-center gap-2 bg-[#C9A84C] hover:bg-[#b8963e] text-white text-sm font-semibold px-4 py-2.5 rounded-lg transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Type
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Icon</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Slug</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Properties</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($propertyTypes as $type)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="w-10 h-10 bg-[#0A1628]/5 rounded-lg flex items-center justify-center text-xl">
                            {{ $type->icon ?: '🏠' }}
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $type->name }}</td>
                    <td class="px-6 py-4">
                        <code class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded font-mono">{{ $type->slug }}</code>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs">
                        {{ Str::limit($type->description, 80) ?: '—' }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-[#0A1628]/10 text-[#0A1628]">
                            {{ $type->properties_count ?? $type->properties()->count() }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.property-types.edit', $type) }}"
                               class="text-[#0A1628] hover:text-[#C9A84C] text-sm font-medium transition-colors">Edit</a>
                            <form action="{{ route('admin.property-types.destroy', $type) }}" method="POST"
                                  x-data onsubmit="return confirm('Are you sure you want to delete this property type? This may affect existing listings.')">
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
                                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <p class="text-gray-500 text-sm">No property types yet.
                                <a href="{{ route('admin.property-types.create') }}" class="text-[#C9A84C] hover:underline">Add the first one.</a>
                            </p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if(isset($propertyTypes) && $propertyTypes->hasPages())
    <div class="flex justify-end">
        {{ $propertyTypes->links() }}
    </div>
    @endif

</div>
@endsection
