@extends('layouts.investor')

@section('page-title', 'My Returns')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-gray-800">Returns</h1>
            <p class="text-sm text-gray-500 mt-0.5">Your investment return payment history.</p>
        </div>
        <a href="{{ route('investor.returns.statement') }}" target="_blank"
            class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Download Statement
        </a>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <p class="text-xs text-gray-500 font-medium">Total Returns Received</p>
            <p class="text-2xl font-bold text-green-600 mt-1">₦{{ number_format($summary['total_received'] ?? 0) }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <p class="text-xs text-gray-500 font-medium">Pending Returns</p>
            <p class="text-2xl font-bold text-amber-500 mt-1">₦{{ number_format($summary['pending'] ?? 0) }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <p class="text-xs text-gray-500 font-medium">Returns This Year</p>
            <p class="text-2xl font-bold text-blue-600 mt-1">₦{{ number_format($summary['this_year'] ?? 0) }}</p>
        </div>
    </div>

    {{-- Timeline --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-700">Payment Timeline</h3>
        </div>

        @forelse($returns ?? [] as $ret)
        <div class="px-6 py-4 border-b border-gray-50 hover:bg-gray-50 transition">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 {{ $ret->status === 'paid' ? 'bg-green-100' : 'bg-yellow-100' }}">
                        <svg class="w-5 h-5 {{ $ret->status === 'paid' ? 'text-green-600' : 'text-yellow-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($ret->status === 'paid')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            @endif
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">₦{{ number_format($ret->amount) }}</p>
                        <p class="text-xs text-gray-400">{{ $ret->period ?? 'Return Payment' }} &bull; {{ $ret->payment_date?->format('M d, Y') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    @if($ret->reference)
                    <span class="font-mono text-xs text-gray-400">{{ $ret->reference }}</span>
                    @endif
                    <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $ret->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ ucfirst($ret->status) }}
                    </span>
                </div>
            </div>
            @if($ret->notes)
            <p class="mt-2 ml-14 text-xs text-gray-400">{{ $ret->notes }}</p>
            @endif
        </div>
        @empty
        <div class="px-6 py-12 text-center text-gray-400">
            <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm">No returns recorded yet.</p>
        </div>
        @endforelse
    </div>

    @if(isset($returns) && $returns->hasPages())
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-4 py-4">
        {{ $returns->links() }}
    </div>
    @endif
</div>
@endsection
