@extends('layouts.admin')

@section('page-title', 'Investor Profile')

@section('content')
<div x-data="{ showReturnModal: false }" class="space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-800">{{ $investor->name }}</h1>
            <p class="text-sm text-gray-500 mt-0.5">Investor Profile</p>
        </div>
        <div class="flex items-center gap-3">
            @if(!$investor->investorProfile?->is_verified)
            <form method="POST" action="{{ route('admin.investors.approve', $investor) }}">
                @csrf @method('PATCH')
                <button type="submit" class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Approve Investor
                </button>
            </form>
            @endif
            <a href="{{ route('admin.investors.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Personal Info --}}
        <div class="space-y-5">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="text-center mb-5">
                    <div class="w-16 h-16 rounded-full bg-amber-100 flex items-center justify-center mx-auto mb-3">
                        <span class="text-2xl font-bold text-amber-600">{{ strtoupper(substr($investor->name, 0, 1)) }}</span>
                    </div>
                    <h3 class="font-semibold text-gray-800">{{ $investor->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $investor->email }}</p>
                    @php
                        $tierColors = ['bronze' => 'bg-orange-100 text-orange-700', 'silver' => 'bg-gray-100 text-gray-600', 'gold' => 'bg-amber-100 text-amber-700', 'platinum' => 'bg-purple-100 text-purple-700'];
                        $tier = $investor->investorProfile?->tier ?? 'bronze';
                    @endphp
                    <span class="mt-2 inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $tierColors[$tier] }}">
                        {{ ucfirst($tier) }} Investor
                    </span>
                </div>
                <div class="space-y-3 text-sm border-t border-gray-100 pt-4">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Phone</span>
                        <span class="font-medium text-gray-700">{{ $investor->phone ?? '—' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Total Invested</span>
                        <span class="font-semibold text-gray-800">₦{{ number_format($investor->investorProfile?->total_invested ?? 0) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Total Returns</span>
                        <span class="font-semibold text-green-600">₦{{ number_format($investor->investorProfile?->total_returns ?? 0) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Verified</span>
                        <span class="{{ $investor->investorProfile?->is_verified ? 'text-green-600' : 'text-red-500' }} font-medium">
                            {{ $investor->investorProfile?->is_verified ? 'Yes' : 'No' }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Joined</span>
                        <span class="font-medium text-gray-700">{{ $investor->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <button @click="showReturnModal = true"
                class="w-full bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold py-2.5 rounded-xl transition shadow-sm">
                + Add Return Payment
            </button>
        </div>

        {{-- Right Panel --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Investment Portfolio --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-700">Investment Portfolio</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                                <th class="px-4 py-3 text-left">Property</th>
                                <th class="px-4 py-3 text-left">Amount (₦)</th>
                                <th class="px-4 py-3 text-left">Date</th>
                                <th class="px-4 py-3 text-left">Return %</th>
                                <th class="px-4 py-3 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($investments ?? [] as $inv)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-800">{{ $inv->property?->title ?? '—' }}</td>
                                <td class="px-4 py-3 font-medium text-gray-800">{{ number_format($inv->amount) }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $inv->investment_date?->format('M d, Y') }}</td>
                                <td class="px-4 py-3 text-green-600 font-semibold">{{ $inv->return_rate ?? 0 }}%</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $inv->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                        {{ ucfirst($inv->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="px-4 py-6 text-center text-gray-400 text-sm">No investments recorded.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Returns History --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-700">Returns History</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                                <th class="px-4 py-3 text-left">Date</th>
                                <th class="px-4 py-3 text-left">Amount (₦)</th>
                                <th class="px-4 py-3 text-left">Period</th>
                                <th class="px-4 py-3 text-left">Reference</th>
                                <th class="px-4 py-3 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($returns ?? [] as $ret)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-gray-500 whitespace-nowrap">{{ $ret->payment_date?->format('M d, Y') }}</td>
                                <td class="px-4 py-3 font-semibold text-green-600">{{ number_format($ret->amount) }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $ret->period ?? '—' }}</td>
                                <td class="px-4 py-3 font-mono text-xs text-gray-400">{{ $ret->reference ?? '—' }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $ret->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ ucfirst($ret->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="px-4 py-6 text-center text-gray-400 text-sm">No returns recorded.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Documents --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-700">Documents</h3>
                </div>
                <div class="divide-y divide-gray-50">
                    @forelse($documents ?? [] as $doc)
                    <div class="px-6 py-3 flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">{{ $doc->title }}</p>
                                <p class="text-xs text-gray-400">{{ $doc->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <a href="{{ Storage::url($doc->path) }}" target="_blank"
                            class="flex-shrink-0 text-xs text-blue-600 hover:text-blue-800 font-medium border border-blue-100 rounded-lg px-3 py-1.5 hover:bg-blue-50 transition">
                            Download
                        </a>
                    </div>
                    @empty
                    <p class="px-6 py-6 text-sm text-gray-400 text-center">No documents uploaded.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Add Return Modal --}}
    <div x-show="showReturnModal" x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50">
        <div @click.outside="showReturnModal = false" class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-base font-semibold text-gray-800">Add Return Payment</h3>
                <button @click="showReturnModal = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.investors.returns.add', $investor) }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Amount (₦)</label>
                        <input type="number" name="amount" step="0.01" min="0" required
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Period (e.g. Q1 2026)</label>
                        <input type="text" name="period"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Payment Date</label>
                        <input type="date" name="payment_date" value="{{ date('Y-m-d') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Reference</label>
                        <input type="text" name="reference"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                        <textarea name="notes" rows="2"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"></textarea>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="button" @click="showReturnModal = false"
                            class="flex-1 px-4 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition">Cancel</button>
                        <button type="submit"
                            class="flex-1 px-4 py-2.5 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-lg font-semibold transition">Add Return</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
