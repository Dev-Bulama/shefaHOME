@extends('layouts.admin')

@section('page-title', 'Investors')

@section('content')
<div class="space-y-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h1 class="text-xl font-bold text-gray-800">Investors</h1>
        <p class="text-sm text-gray-500">Total: <span class="font-semibold text-gray-700">{{ $investors->total() ?? 0 }}</span></p>
    </div>

    <form method="GET" action="{{ route('admin.investors.index') }}"
        class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex flex-wrap gap-3 items-end">
        <div class="flex-1 min-w-[180px]">
            <label class="block text-xs font-medium text-gray-600 mb-1">Search</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Name or email…"
                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
        </div>
        <div class="min-w-[140px]">
            <label class="block text-xs font-medium text-gray-600 mb-1">Tier</label>
            <select name="tier" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">
                <option value="">All Tiers</option>
                <option value="bronze"   {{ request('tier') == 'bronze'   ? 'selected' : '' }}>Bronze</option>
                <option value="silver"   {{ request('tier') == 'silver'   ? 'selected' : '' }}>Silver</option>
                <option value="gold"     {{ request('tier') == 'gold'     ? 'selected' : '' }}>Gold</option>
                <option value="platinum" {{ request('tier') == 'platinum' ? 'selected' : '' }}>Platinum</option>
            </select>
        </div>
        <div class="min-w-[140px]">
            <label class="block text-xs font-medium text-gray-600 mb-1">Verified</label>
            <select name="verified" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">
                <option value="">All</option>
                <option value="1" {{ request('verified') == '1' ? 'selected' : '' }}>Verified</option>
                <option value="0" {{ request('verified') == '0' ? 'selected' : '' }}>Unverified</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">Filter</button>
            <a href="{{ route('admin.investors.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold px-4 py-2 rounded-lg transition">Reset</a>
        </div>
    </form>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide border-b border-gray-100">
                        <th class="px-4 py-3 text-left">Investor</th>
                        <th class="px-4 py-3 text-left">Tier</th>
                        <th class="px-4 py-3 text-left">Total Invested (₦)</th>
                        <th class="px-4 py-3 text-left">Returns (₦)</th>
                        <th class="px-4 py-3 text-left">Verified</th>
                        <th class="px-4 py-3 text-left">Joined</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($investors ?? [] as $investor)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <p class="font-medium text-gray-800">{{ $investor->name }}</p>
                            <p class="text-xs text-gray-400">{{ $investor->email }}</p>
                        </td>
                        <td class="px-4 py-3">
                            @php
                                $tierColors = [
                                    'bronze'   => 'bg-orange-100 text-orange-700 border border-orange-200',
                                    'silver'   => 'bg-gray-100 text-gray-600 border border-gray-300',
                                    'gold'     => 'bg-amber-100 text-amber-700 border border-amber-200',
                                    'platinum' => 'bg-purple-100 text-purple-700 border border-purple-200',
                                ];
                                $tier = $investor->investorProfile?->tier ?? 'bronze';
                            @endphp
                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $tierColors[$tier] ?? 'bg-gray-100 text-gray-600' }}">
                                {{ ucfirst($tier) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-800">
                            {{ number_format($investor->investorProfile?->total_invested ?? 0) }}
                        </td>
                        <td class="px-4 py-3 text-green-600 font-medium">
                            {{ number_format($investor->investorProfile?->total_returns ?? 0) }}
                        </td>
                        <td class="px-4 py-3">
                            @if($investor->investorProfile?->is_verified)
                            <span class="inline-flex items-center gap-1 text-xs text-green-700 font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Verified
                            </span>
                            @else
                            <span class="text-xs text-gray-400">Pending</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-400 whitespace-nowrap">{{ $investor->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.investors.show', $investor) }}"
                                class="text-xs text-blue-600 hover:text-blue-800 font-medium">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="px-4 py-10 text-center text-gray-400">No investors found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(isset($investors) && $investors->hasPages())
        <div class="px-4 py-4 border-t border-gray-100">{{ $investors->withQueryString()->links() }}</div>
        @endif
    </div>
</div>
@endsection
