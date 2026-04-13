@extends('layouts.client')

@section('title', 'Payment Receipt #' . ($payment->reference ?? $payment->id))
@section('page-title', 'Payment Receipt')

@section('content')
@php
    $totalPrice = $payment->total_price ?? 0;
    $amountPaid = $payment->amount_paid ?? 0;
    $balance    = $payment->balance ?? 0;
@endphp

<style>
    @media print {
        .print\:hidden { display: none !important; }
        .no-print { display: none !important; }
        body { background: white !important; }
        .receipt-paper {
            box-shadow: none !important;
            border: none !important;
            max-width: 100% !important;
        }
    }
</style>

{{-- Action Buttons (hidden on print) --}}
<div class="print:hidden mb-6 flex items-center justify-between">
    <a href="{{ route('client.payments.index') }}"
       class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-[#1A237E] font-semibold transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Payments
    </a>
    <button onclick="window.print()"
            class="inline-flex items-center gap-2 bg-[#27AE22] hover:bg-[#b8963e] text-white font-semibold px-5 py-2.5 rounded-xl transition-colors text-sm shadow-md shadow-[#27AE22]/20">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
        </svg>
        Download / Print PDF
    </button>
</div>

{{-- Receipt Paper --}}
<div class="receipt-paper max-w-2xl mx-auto bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

    {{-- Letterhead --}}
    <div class="bg-[#1A237E] px-8 py-8 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <svg viewBox="0 0 400 200" class="w-full h-full" fill="none">
                <circle cx="350" cy="50" r="120" fill="#27AE22"/>
                <circle cx="50" cy="180" r="80" fill="#27AE22"/>
            </svg>
        </div>
        <div class="relative flex items-start justify-between">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-[#27AE22] rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#1A237E]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-white font-bold text-2xl tracking-widest font-['Playfair_Display']">SHEFAHOMES</h1>
                        <p class="text-[#27AE22] text-xs tracking-wide">Premium Real Estate &mdash; Client Portal</p>
                    </div>
                </div>
                <div class="text-gray-400 text-xs space-y-0.5">
                    <p>SHEFAHOMES Ltd, Lagos, Nigeria</p>
                    <p>Email: info@shefahomes.com &nbsp;|&nbsp; Tel: +234 800 000 0000</p>
                    <p>RC Number: RC-XXXXXXX</p>
                </div>
            </div>
            <div class="text-right">
                <div class="bg-white/10 border border-[#27AE22]/30 rounded-xl px-4 py-3">
                    <p class="text-[#27AE22] text-xs uppercase tracking-widest mb-1">Official Receipt</p>
                    <p class="text-white font-bold text-lg font-mono">
                        {{ $payment->reference ?? 'SHF-' . str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}
                    </p>
                </div>
                @if(strtolower($payment->status ?? '') === 'completed')
                <div class="mt-2 inline-flex items-center gap-1.5 bg-green-500/20 border border-green-500/40 text-green-400 px-3 py-1.5 rounded-full text-xs font-bold">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    FULLY PAID
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Divider with wave --}}
    <div class="bg-[#27AE22] h-1"></div>

    {{-- Receipt Body --}}
    <div class="px-8 py-6 space-y-6">

        {{-- Date & Receipt Info --}}
        <div class="flex justify-between items-start flex-wrap gap-4">
            <div>
                <p class="text-gray-400 text-xs uppercase tracking-wide">Receipt Date</p>
                <p class="text-[#1A237E] font-bold text-sm">
                    {{ \Carbon\Carbon::parse($payment->updated_at ?? $payment->created_at)->format('F j, Y') }}
                </p>
            </div>
            <div class="text-right">
                <p class="text-gray-400 text-xs uppercase tracking-wide">Payment Plan</p>
                <p class="text-[#1A237E] font-bold text-sm">{{ $payment->payment_plan ?? 'N/A' }}</p>
            </div>
        </div>

        {{-- Client & Property Grid --}}
        <div class="grid grid-cols-2 gap-6">
            {{-- Client Details --}}
            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-gray-400 text-xs uppercase tracking-wide font-semibold mb-3">Client Details</p>
                <div class="space-y-1.5">
                    <div>
                        <span class="text-gray-500 text-xs">Name</span>
                        <p class="text-[#1A237E] font-semibold text-sm">{{ auth()->user()->name }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500 text-xs">Client ID</span>
                        <p class="text-[#27AE22] font-bold text-sm font-mono">
                            CLT-{{ str_pad(auth()->user()->id, 5, '0', STR_PAD_LEFT) }}
                        </p>
                    </div>
                    <div>
                        <span class="text-gray-500 text-xs">Email</span>
                        <p class="text-[#1A237E] text-sm">{{ auth()->user()->email }}</p>
                    </div>
                    @if(auth()->user()->phone)
                    <div>
                        <span class="text-gray-500 text-xs">Phone</span>
                        <p class="text-[#1A237E] text-sm">{{ auth()->user()->phone }}</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Property Details --}}
            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-gray-400 text-xs uppercase tracking-wide font-semibold mb-3">Property Details</p>
                <div class="space-y-1.5">
                    <div>
                        <span class="text-gray-500 text-xs">Property</span>
                        <p class="text-[#1A237E] font-semibold text-sm">{{ $property->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500 text-xs">Location</span>
                        <p class="text-[#1A237E] text-sm">
                            {{ $property->lga ?? '' }}{{ ($property->lga && $property->state) ? ', ' : '' }}{{ $property->state ?? 'Nigeria' }}
                        </p>
                    </div>
                    @if($property && $property->plot_size)
                    <div>
                        <span class="text-gray-500 text-xs">Plot Size</span>
                        <p class="text-[#1A237E] text-sm">{{ $property->plot_size }}</p>
                    </div>
                    @endif
                    <div>
                        <span class="text-gray-500 text-xs">Payment Plan</span>
                        <p class="text-[#1A237E] text-sm">{{ $payment->payment_plan ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Payment Breakdown Table --}}
        <div>
            <p class="text-gray-400 text-xs uppercase tracking-wide font-semibold mb-3">Payment Breakdown</p>
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-[#1A237E] text-left">
                            <th class="px-4 py-3 text-white text-xs font-semibold">Description</th>
                            <th class="px-4 py-3 text-white text-xs font-semibold text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-gray-700">
                                <p class="font-medium">Total Property Price</p>
                                <p class="text-xs text-gray-400">{{ $property->name ?? 'Property' }} — {{ $payment->payment_plan ?? 'Payment Plan' }}</p>
                            </td>
                            <td class="px-4 py-3 text-[#1A237E] font-bold text-right">₦{{ number_format($totalPrice, 0) }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-gray-700">
                                <p class="font-medium">Amount Paid (Cumulative)</p>
                                <p class="text-xs text-gray-400">Total payments made to date</p>
                            </td>
                            <td class="px-4 py-3 text-[#27AE22] font-bold text-right">(₦{{ number_format($amountPaid, 0) }})</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="px-4 py-3">
                                <p class="font-bold text-[#1A237E]">Outstanding Balance</p>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <span class="font-bold text-lg {{ $balance > 0 ? 'text-red-500' : 'text-green-600' }}">
                                    ₦{{ number_format($balance, 0) }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Status Banner --}}
        <div class="rounded-xl px-5 py-3 flex items-center gap-3
            {{ strtolower($payment->status ?? 'active') === 'completed' ? 'bg-green-50 border border-green-200' : 'bg-amber-50 border border-amber-200' }}">
            @if(strtolower($payment->status ?? 'active') === 'completed')
            <svg class="w-6 h-6 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <div>
                <p class="text-green-700 font-bold text-sm">Payment Completed</p>
                <p class="text-green-600 text-xs">This property has been fully paid. Thank you for choosing SHEFAHOMES.</p>
            </div>
            @else
            <svg class="w-6 h-6 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="text-amber-700 font-bold text-sm">Payment In Progress</p>
                <p class="text-amber-600 text-xs">
                    Outstanding balance of ₦{{ number_format($balance, 0) }}.
                    @if($payment->next_due_date)
                    Next due: {{ \Carbon\Carbon::parse($payment->next_due_date)->format('M j, Y') }}.
                    @endif
                </p>
            </div>
            @endif
        </div>

        {{-- Footer --}}
        <div class="border-t border-gray-100 pt-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <p class="text-gray-400 text-xs">This is an official receipt from SHEFAHOMES Ltd.</p>
                <p class="text-gray-400 text-xs">Generated on {{ now()->format('F j, Y \a\t g:ia') }}</p>
            </div>
            <div class="text-right">
                <p class="text-[#27AE22] font-bold text-sm font-['Playfair_Display']">SHEFAHOMES Ltd</p>
                <p class="text-gray-400 text-xs">Authorized Signature</p>
                <div class="mt-1 w-24 border-b-2 border-[#1A237E]"></div>
            </div>
        </div>
    </div>
</div>

{{-- Bottom Actions (hidden on print) --}}
<div class="print:hidden mt-6 flex flex-col sm:flex-row items-center justify-center gap-3">
    <button onclick="window.print()"
            class="inline-flex items-center gap-2 bg-[#27AE22] hover:bg-[#b8963e] text-white font-semibold px-6 py-3 rounded-xl transition-colors text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
        </svg>
        Download PDF
    </button>
    <a href="{{ route('client.payments.index') }}"
       class="inline-flex items-center gap-2 border border-gray-300 hover:border-[#1A237E] text-gray-600 hover:text-[#1A237E] font-semibold px-6 py-3 rounded-xl transition-colors text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Payments
    </a>
</div>

@endsection
