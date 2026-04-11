@extends('layouts.admin')

@section('page-title', 'Clients')

@section('content')
<div class="space-y-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h1 class="text-xl font-bold text-gray-800">Clients</h1>
        <p class="text-sm text-gray-500">Total: <span class="font-semibold text-gray-700">{{ $clients->total() ?? 0 }}</span></p>
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('admin.clients.index') }}"
        class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex flex-wrap gap-3 items-end">
        <div class="flex-1 min-w-[180px]">
            <label class="block text-xs font-medium text-gray-600 mb-1">Search</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Name, email, client ID…"
                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
        </div>
        <div class="min-w-[140px]">
            <label class="block text-xs font-medium text-gray-600 mb-1">State</label>
            <input type="text" name="state" value="{{ request('state') }}" placeholder="e.g. Lagos"
                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">Search</button>
            <a href="{{ route('admin.clients.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold px-4 py-2 rounded-lg transition">Reset</a>
        </div>
    </form>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide border-b border-gray-100">
                        <th class="px-4 py-3 text-left">Client ID</th>
                        <th class="px-4 py-3 text-left">Name</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Phone</th>
                        <th class="px-4 py-3 text-left">State</th>
                        <th class="px-4 py-3 text-left">Properties</th>
                        <th class="px-4 py-3 text-left">Joined</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($clients ?? [] as $client)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <span class="font-mono text-xs bg-gray-100 px-2 py-1 rounded text-gray-600">{{ $client->client_id ?? 'SH-' . str_pad($client->id, 4, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $client->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $client->email }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $client->phone ?? '—' }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $client->state ?? '—' }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-full text-xs font-bold
                                {{ ($client->properties_count ?? 0) > 0 ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ $client->properties_count ?? 0 }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-400 whitespace-nowrap">{{ $client->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.clients.show', $client) }}"
                                class="text-xs text-blue-600 hover:text-blue-800 font-medium">View Profile</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="px-4 py-10 text-center text-gray-400">No clients found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(isset($clients) && $clients->hasPages())
        <div class="px-4 py-4 border-t border-gray-100">{{ $clients->withQueryString()->links() }}</div>
        @endif
    </div>
</div>
@endsection
