@extends('layouts.admin')

@section('title', 'Newsletter Subscribers')

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div>
                <h2 class="text-xl font-bold text-[#0A1628]">Newsletter Subscribers</h2>
                <p class="text-sm text-gray-500 mt-0.5">Manage all newsletter subscriptions.</p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-[#0A1628] text-[#C9A84C]">
                {{ $subscribers->total() ?? 0 }} total
            </span>
        </div>
        <div class="flex items-center gap-3">
            {{-- Export button (disabled) --}}
            <div class="relative group">
                <button type="button" disabled
                        class="inline-flex items-center gap-2 bg-gray-100 text-gray-400 text-sm font-semibold px-4 py-2.5 rounded-lg cursor-not-allowed select-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Export CSV
                </button>
                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2.5 py-1.5 bg-gray-800 text-white text-xs rounded-lg
                            opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap z-10">
                    Coming soon
                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Search / Filter Bar --}}
    <div class="bg-white rounded-xl shadow-sm p-4">
        <form method="GET" action="{{ route('admin.newsletter.index') }}" class="flex items-center gap-3 flex-wrap">
            <div class="flex-1 min-w-[220px] relative">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search by email or name..."
                       class="w-full pl-9 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C] transition">
            </div>
            <select name="status"
                    class="border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C9A84C]/40 focus:border-[#C9A84C] transition bg-white">
                <option value="">All Statuses</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            <button type="submit"
                    class="bg-[#0A1628] hover:bg-[#0d1f38] text-white text-sm font-semibold px-4 py-2.5 rounded-lg transition-colors">
                Filter
            </button>
            @if(request()->hasAny(['search', 'status']))
            <a href="{{ route('admin.newsletter.index') }}"
               class="text-sm text-gray-500 hover:text-gray-700 font-medium transition-colors">
                Clear
            </a>
            @endif
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Subscribed</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($subscribers as $subscriber)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-[#0A1628]/10 flex items-center justify-center flex-shrink-0">
                                <span class="text-xs font-bold text-[#0A1628]">
                                    {{ strtoupper(substr($subscriber->email, 0, 1)) }}
                                </span>
                            </div>
                            <span class="text-sm font-medium text-gray-900">{{ $subscriber->email }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $subscriber->name ?? '—' }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $subscriber->created_at->format('M d, Y') }}
                        <span class="block text-xs text-gray-400">{{ $subscriber->created_at->diffForHumans() }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $subscriber->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                            {{ $subscriber->is_active ? 'Active' : 'Unsubscribed' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <form action="{{ route('admin.newsletter.destroy', $subscriber) }}" method="POST"
                              x-data onsubmit="return confirm('Remove {{ $subscriber->email }} from the list? This cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium transition-colors">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-gray-500 text-sm">No subscribers found{{ request('search') ? ' matching your search' : '' }}.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if(isset($subscribers) && $subscribers->hasPages())
    <div class="flex justify-end">
        {{ $subscribers->withQueryString()->links() }}
    </div>
    @endif

</div>
@endsection
