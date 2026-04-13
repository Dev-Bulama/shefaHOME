@extends('layouts.client')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Welcome Banner --}}
    <div class="relative overflow-hidden bg-[#1A237E] rounded-2xl px-6 py-8 shadow-xl">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 400 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="350" cy="50" r="120" fill="#27AE22"/>
                <circle cx="50" cy="180" r="80" fill="#27AE22"/>
            </svg>
        </div>
        <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <p class="text-[#27AE22] text-sm font-medium mb-1">Welcome back,</p>
                <h2 class="text-white text-2xl lg:text-3xl font-bold font-['Playfair_Display']">
                    {{ auth()->user()->name }}
                </h2>
                <p class="text-gray-400 text-sm mt-1">Here's your property portfolio overview</p>
            </div>
            <div class="flex-shrink-0">
                <div class="inline-flex flex-col items-center bg-white/10 border border-[#27AE22]/30 rounded-xl px-5 py-3">
                    <span class="text-gray-400 text-xs uppercase tracking-widest mb-1">Client ID</span>
                    <span class="text-[#27AE22] text-lg font-bold font-mono tracking-widest">
                        CLT-{{ str_pad(auth()->user()->id, 5, '0', STR_PAD_LEFT) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- KPI Stat Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        {{-- My Properties --}}
        <div class="bg-white rounded-xl border-t-4 border-[#1A237E] shadow-sm hover:shadow-md transition-shadow p-5">
            <div class="flex items-start justify-between mb-3">
                <div>
                    <p class="text-gray-500 text-xs font-medium uppercase tracking-wide">My Properties</p>
                    <p class="text-[#1A237E] text-3xl font-bold mt-1">{{ $profile->properties->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-[#27AE22]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>
            <a href="{{ route('client.properties.index') }}" class="text-xs text-[#27AE22] hover:underline font-medium">View all &rarr;</a>
        </div>

        {{-- Total Paid --}}
        <div class="bg-white rounded-xl border-t-4 border-[#27AE22] shadow-sm hover:shadow-md transition-shadow p-5">
            <div class="flex items-start justify-between mb-3">
                <div>
                    <p class="text-gray-500 text-xs font-medium uppercase tracking-wide">Total Paid</p>
                    <p class="text-[#1A237E] text-2xl font-bold mt-1">
                        ₦{{ number_format($profile->payments->sum('amount_paid'), 0) }}
                    </p>
                </div>
                <div class="w-10 h-10 bg-[#27AE22]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-400">Across all properties</p>
        </div>

        {{-- Outstanding Balance --}}
        <div class="bg-white rounded-xl border-t-4 border-red-400 shadow-sm hover:shadow-md transition-shadow p-5">
            <div class="flex items-start justify-between mb-3">
                <div>
                    <p class="text-gray-500 text-xs font-medium uppercase tracking-wide">Outstanding</p>
                    <p class="text-[#1A237E] text-2xl font-bold mt-1">
                        ₦{{ number_format($profile->payments->sum('balance'), 0) }}
                    </p>
                </div>
                <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-400">Remaining balance</p>
        </div>

        {{-- Documents --}}
        <div class="bg-white rounded-xl border-t-4 border-blue-400 shadow-sm hover:shadow-md transition-shadow p-5">
            <div class="flex items-start justify-between mb-3">
                <div>
                    <p class="text-gray-500 text-xs font-medium uppercase tracking-wide">Documents</p>
                    <p class="text-[#1A237E] text-3xl font-bold mt-1">{{ $profile->documents->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
            <a href="{{ route('client.documents.index') }}" class="text-xs text-blue-500 hover:underline font-medium">View all &rarr;</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Payment Progress Card --}}
        <div class="lg:col-span-1">
            @if($activePayment)
            @php
                $totalPrice = $activePayment->total_price ?? 1;
                $amountPaid = $activePayment->amount_paid ?? 0;
                $progressPct = $totalPrice > 0 ? min(100, round(($amountPaid / $totalPrice) * 100)) : 0;
            @endphp
            <div class="bg-white rounded-xl shadow-sm p-5 h-full">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-[#1A237E] font-bold text-base font-['Playfair_Display']">Payment Progress</h3>
                    <span class="text-xs bg-[#27AE22]/10 text-[#27AE22] font-semibold px-2.5 py-1 rounded-full">Active</span>
                </div>

                <p class="text-sm text-gray-700 font-medium mb-1 truncate">
                    {{ $activePayment->property->name ?? 'Property' }}
                </p>
                <p class="text-gray-400 text-xs mb-4">
                    {{ $activePayment->payment_plan ?? 'Instalment Plan' }}
                </p>

                {{-- Progress Bar --}}
                <div class="mb-2">
                    <div class="flex justify-between text-xs text-gray-500 mb-1.5">
                        <span>₦{{ number_format($amountPaid, 0) }} paid</span>
                        <span class="font-bold text-[#27AE22]">{{ $progressPct }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-3">
                        <div class="bg-[#27AE22] h-3 rounded-full transition-all duration-700 ease-out"
                             style="width: {{ $progressPct }}%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-400 mt-1.5">
                        <span>Total: ₦{{ number_format($totalPrice, 0) }}</span>
                        <span>Balance: ₦{{ number_format($activePayment->balance ?? 0, 0) }}</span>
                    </div>
                </div>

                @if($activePayment->next_due_date)
                <div class="mt-4 flex items-center gap-2 bg-amber-50 border border-amber-200 rounded-lg px-3 py-2.5">
                    <svg class="w-4 h-4 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-amber-700 text-xs font-semibold">Next Payment Due</p>
                        <p class="text-amber-600 text-xs">{{ \Carbon\Carbon::parse($activePayment->next_due_date)->format('D, M j, Y') }}</p>
                    </div>
                </div>
                @endif

                <a href="{{ route('client.payments.make', $activePayment->id) }}"
                   class="mt-4 w-full inline-flex items-center justify-center gap-2 bg-[#27AE22] hover:bg-[#b8963e] text-white text-sm font-semibold px-4 py-2.5 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                    Make Payment
                </a>
            </div>
            @else
            <div class="bg-white rounded-xl shadow-sm p-5 h-full flex flex-col items-center justify-center text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <p class="text-gray-500 text-sm font-medium">No Active Payment</p>
                <p class="text-gray-400 text-xs mt-1">You have no active payment plans at this time.</p>
                <a href="{{ route('client.payments.index') }}" class="mt-3 text-[#27AE22] text-xs font-semibold hover:underline">View Payment History</a>
            </div>
            @endif
        </div>

        {{-- Recent Transactions --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-[#1A237E] font-bold text-base font-['Playfair_Display']">Recent Transactions</h3>
                <a href="{{ route('client.payments.index') }}" class="text-xs text-[#27AE22] font-semibold hover:underline">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-left">
                            <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Date</th>
                            <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Property</th>
                            <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Amount</th>
                            <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide hidden sm:table-cell">Reference</th>
                            <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($recentPayments as $payment)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-5 py-3.5 text-gray-600 text-xs whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($payment->payment_date ?? $payment->created_at)->format('M j, Y') }}
                            </td>
                            <td class="px-5 py-3.5 max-w-[160px]">
                                <span class="text-[#1A237E] font-medium text-xs truncate block">
                                    {{ $payment->property->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-[#1A237E] font-semibold text-xs whitespace-nowrap">
                                ₦{{ number_format($payment->amount_paid, 0) }}
                            </td>
                            <td class="px-5 py-3.5 text-gray-500 text-xs font-mono hidden sm:table-cell">
                                {{ $payment->reference ?? '—' }}
                            </td>
                            <td class="px-5 py-3.5">
                                @php
                                    $status = strtolower($payment->status ?? 'active');
                                    $badgeClass = match($status) {
                                        'completed' => 'bg-green-100 text-green-700',
                                        'defaulted' => 'bg-red-100 text-red-600',
                                        default => 'bg-blue-100 text-blue-700',
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold {{ $badgeClass }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center text-gray-400 text-sm">
                                <svg class="w-8 h-8 mx-auto mb-2 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                No transactions yet
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white rounded-xl shadow-sm p-5">
        <h3 class="text-[#1A237E] font-bold text-base font-['Playfair_Display'] mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            @if($activePayment)
            <a href="{{ route('client.payments.make', $activePayment->id) }}"
               class="flex items-center gap-3 bg-[#27AE22] hover:bg-[#b8963e] text-white px-4 py-3.5 rounded-xl font-semibold text-sm transition-colors group">
                <div class="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Make Payment</p>
                    <p class="text-white/70 text-xs font-normal">Pay your instalment</p>
                </div>
            </a>
            @else
            <a href="{{ route('client.payments.index') }}"
               class="flex items-center gap-3 bg-[#27AE22] hover:bg-[#b8963e] text-white px-4 py-3.5 rounded-xl font-semibold text-sm transition-colors">
                <div class="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">View Payments</p>
                    <p class="text-white/70 text-xs font-normal">Payment history</p>
                </div>
            </a>
            @endif

            <a href="{{ route('client.documents.index') }}"
               class="flex items-center gap-3 border-2 border-[#1A237E] text-[#1A237E] hover:bg-[#1A237E] hover:text-white px-4 py-3.5 rounded-xl font-semibold text-sm transition-all group">
                <div class="w-9 h-9 bg-[#1A237E]/10 group-hover:bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">View Documents</p>
                    <p class="text-current opacity-60 text-xs font-normal">Your property docs</p>
                </div>
            </a>

            <a href="{{ route('properties.index') }}"
               class="flex items-center gap-3 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-3.5 rounded-xl font-semibold text-sm transition-colors">
                <div class="w-9 h-9 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Browse Properties</p>
                    <p class="text-gray-500 text-xs font-normal">Explore estates</p>
                </div>
            </a>
        </div>
    </div>

</div>
@endsection
