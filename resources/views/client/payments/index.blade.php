@extends('layouts.client')

@section('title', 'Payment History')
@section('page-title', 'Payment History')

@section('content')
@php
    $totalPortfolio = $totalPrice ?? 0;
    $paid = $totalPaid ?? 0;
    $balance = $totalBalance ?? 0;
    $portfolioPct = $totalPortfolio > 0 ? min(100, round(($paid / $totalPortfolio) * 100)) : 0;
@endphp

<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h2 class="text-[#0A1628] text-2xl font-bold font-['Playfair_Display']">Payment History</h2>
            <p class="text-gray-500 text-sm mt-0.5">Track all your property payments and instalments</p>
        </div>
    </div>

    {{-- Portfolio Progress Bar --}}
    <div class="bg-white rounded-2xl shadow-sm p-5">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-[#0A1628] font-bold text-sm font-['Playfair_Display']">Overall Portfolio Progress</h3>
            <span class="text-[#C9A84C] font-bold text-sm">{{ $portfolioPct }}% paid</span>
        </div>
        <div class="w-full bg-gray-100 rounded-full h-3 mb-2">
            <div class="bg-gradient-to-r from-[#C9A84C] to-[#E8C97A] h-3 rounded-full transition-all duration-700"
                 style="width: {{ $portfolioPct }}%"></div>
        </div>
        <div class="flex justify-between text-xs text-gray-400">
            <span>₦{{ number_format($paid, 0) }} paid</span>
            <span>₦{{ number_format($totalPortfolio, 0) }} total</span>
        </div>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        {{-- Total Paid --}}
        <div class="bg-white rounded-xl border-t-4 border-[#C9A84C] shadow-sm p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-500 text-xs font-medium uppercase tracking-wide">Total Paid</p>
                    <p class="text-[#0A1628] text-2xl font-bold mt-1">₦{{ number_format($paid, 0) }}</p>
                    <p class="text-gray-400 text-xs mt-1">Across all properties</p>
                </div>
                <div class="w-10 h-10 bg-[#C9A84C]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Balance Remaining --}}
        <div class="bg-white rounded-xl border-t-4 border-red-400 shadow-sm p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-500 text-xs font-medium uppercase tracking-wide">Balance Remaining</p>
                    <p class="text-[#0A1628] text-2xl font-bold mt-1">₦{{ number_format($balance, 0) }}</p>
                    <p class="text-gray-400 text-xs mt-1">Outstanding balance</p>
                </div>
                <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Portfolio Value --}}
        <div class="bg-white rounded-xl border-t-4 border-[#0A1628] shadow-sm p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-500 text-xs font-medium uppercase tracking-wide">Portfolio Value</p>
                    <p class="text-[#0A1628] text-2xl font-bold mt-1">₦{{ number_format($totalPortfolio, 0) }}</p>
                    <p class="text-gray-400 text-xs mt-1">Total investment value</p>
                </div>
                <div class="w-10 h-10 bg-[#0A1628]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-[#0A1628]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Payments Table --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-[#0A1628] font-bold text-base font-['Playfair_Display']">All Payments</h3>
            <span class="text-xs text-gray-400">{{ $payments->total() }} {{ Str::plural('record', $payments->total()) }}</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm min-w-[700px]">
                <thead>
                    <tr class="bg-gray-50 text-left">
                        <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Reference</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Property</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Plan</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Total</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Paid</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Balance</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Status</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($payments as $payment)
                    @php
                        $status = strtolower($payment->status ?? 'active');
                        $badgeConfig = match($status) {
                            'completed' => ['class' => 'bg-green-100 text-green-700', 'label' => 'Completed'],
                            'defaulted' => ['class' => 'bg-red-100 text-red-600',   'label' => 'Defaulted'],
                            default     => ['class' => 'bg-blue-100 text-blue-700', 'label' => 'Active'],
                        };
                    @endphp
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-4">
                            <span class="text-gray-600 text-xs font-mono">{{ $payment->reference ?? '—' }}</span>
                        </td>
                        <td class="px-5 py-4 max-w-[160px]">
                            <span class="text-[#0A1628] font-semibold text-xs block truncate">
                                {{ $payment->property->name ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <span class="text-gray-500 text-xs">{{ $payment->payment_plan ?? '—' }}</span>
                        </td>
                        <td class="px-5 py-4">
                            <span class="text-[#0A1628] font-semibold text-xs">₦{{ number_format($payment->total_price, 0) }}</span>
                        </td>
                        <td class="px-5 py-4">
                            <span class="text-[#C9A84C] font-semibold text-xs">₦{{ number_format($payment->amount_paid, 0) }}</span>
                        </td>
                        <td class="px-5 py-4">
                            <span class="text-red-500 font-semibold text-xs">₦{{ number_format($payment->balance, 0) }}</span>
                        </td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $badgeConfig['class'] }}">
                                {{ $badgeConfig['label'] }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('client.payments.receipt', $payment->id) }}"
                                   class="inline-flex items-center gap-1 text-[#0A1628] hover:text-[#C9A84C] text-xs font-semibold transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Receipt
                                </a>
                                @if($payment->balance > 0)
                                <a href="{{ route('client.payments.make', $payment->id) }}"
                                   class="inline-flex items-center gap-1 bg-[#C9A84C] hover:bg-[#b8963e] text-white text-xs font-semibold px-2.5 py-1 rounded-lg transition-colors">
                                    Pay
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-5 py-16 text-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            </div>
                            <p class="text-gray-500 text-sm font-medium">No payment records found</p>
                            <p class="text-gray-400 text-xs mt-1">Your payment history will appear here.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($payments->hasPages())
        <div class="px-5 py-4 border-t border-gray-100">
            {{ $payments->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
