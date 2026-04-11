@extends('layouts.client')

@section('title', 'Make Payment')
@section('page-title', 'Make Payment')

@section('breadcrumb')
    <a href="{{ route('client.dashboard') }}" class="hover:text-[#C9A84C]">Dashboard</a>
    <span class="mx-1">/</span>
    <a href="{{ route('client.payments.index') }}" class="hover:text-[#C9A84C]">Payments</a>
    <span class="mx-1">/</span> Make Payment
@endsection

@section('content')
@php
    $totalPrice  = $payment->total_price ?? 0;
    $amountPaid  = $payment->amount_paid ?? 0;
    $balance     = $payment->balance ?? 0;
    $installment = $payment->installment_amount ?? $balance;
    $progressPct = $totalPrice > 0 ? min(100, round(($amountPaid / $totalPrice) * 100)) : 0;
@endphp

<div x-data="{
    paymentMethod: 'bank_transfer',
    amount: {{ $installment }},
    proofFile: null,
    proofPreview: null,
    isSubmitting: false,
    handleFile(e) {
        const file = e.target.files[0];
        if (!file) return;
        this.proofFile = file;
        const reader = new FileReader();
        reader.onload = (ev) => { this.proofPreview = ev.target.result; };
        reader.readAsDataURL(file);
    }
}">
<div class="space-y-6">

    {{-- Page Header --}}
    <div>
        <nav class="flex items-center gap-2 text-xs text-gray-400 mb-3">
            <a href="{{ route('client.dashboard') }}" class="hover:text-[#C9A84C] transition-colors">Dashboard</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('client.payments.index') }}" class="hover:text-[#C9A84C] transition-colors">Payments</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-[#0A1628] font-medium">Make Payment</span>
        </nav>
        <h2 class="text-[#0A1628] text-2xl font-bold font-['Playfair_Display']">Make Payment</h2>
        <p class="text-gray-500 text-sm mt-0.5">Complete your instalment payment for {{ $property->name ?? 'your property' }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 items-start">

        {{-- Left Panel: Payment Form --}}
        <div class="lg:col-span-3 space-y-5">

            {{-- Property Info Card --}}
            <div class="bg-white rounded-2xl shadow-sm p-5">
                <h3 class="text-[#0A1628] font-bold text-sm mb-4 pb-3 border-b border-gray-100 font-['Playfair_Display']">Property Information</h3>
                <div class="flex items-start gap-4">
                    @if($property && $property->cover_image_url)
                    <img src="{{ $property->cover_image_url }}" alt="{{ $property->name }}"
                         class="w-20 h-16 object-cover rounded-xl flex-shrink-0">
                    @else
                    <div class="w-20 h-16 bg-[#0A1628]/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-8 h-8 text-[#0A1628]/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="text-[#0A1628] font-bold text-base leading-snug">{{ $property->name ?? 'Property' }}</p>
                        <p class="text-gray-500 text-xs mt-0.5">
                            {{ $property->lga ?? '' }}{{ ($property->lga && $property->state) ? ', ' : '' }}{{ $property->state ?? '' }}
                        </p>
                        <div class="flex items-center gap-4 mt-2 flex-wrap">
                            <div>
                                <span class="text-gray-400 text-xs">Total Price</span>
                                <p class="text-[#0A1628] font-bold text-sm">₦{{ number_format($totalPrice, 0) }}</p>
                            </div>
                            <div>
                                <span class="text-gray-400 text-xs">Balance Due</span>
                                <p class="text-red-500 font-bold text-sm">₦{{ number_format($balance, 0) }}</p>
                            </div>
                            <div>
                                <span class="text-gray-400 text-xs">Plan</span>
                                <p class="text-[#0A1628] font-semibold text-sm">{{ $payment->payment_plan ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Payment Form --}}
            <form action="{{ route('client.payments.store') }}" method="POST" enctype="multipart/form-data"
                  @submit.prevent="isSubmitting = true; $el.submit()">
                @csrf
                <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                <input type="hidden" name="payment_method" :value="paymentMethod">

                <div class="bg-white rounded-2xl shadow-sm p-5 space-y-5">

                    {{-- Amount to Pay --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5">
                            Amount to Pay (₦)
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-semibold text-lg">₦</span>
                            <input type="number"
                                   name="amount"
                                   x-model="amount"
                                   min="1000"
                                   max="{{ $balance }}"
                                   step="1000"
                                   required
                                   class="w-full pl-8 pr-4 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#C9A84C]/30 focus:border-[#C9A84C] outline-none text-[#0A1628] font-bold text-lg transition-all"
                                   placeholder="{{ number_format($installment, 0) }}">
                        </div>
                        <p class="text-xs text-gray-400 mt-1">
                            Minimum: ₦1,000 &nbsp;|&nbsp; Maximum (full balance): ₦{{ number_format($balance, 0) }}
                        </p>
                        @error('amount')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Payment Method Tabs --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-2">
                            Payment Method
                        </label>
                        <div class="flex rounded-xl border border-gray-200 p-1 bg-gray-50">
                            <button type="button"
                                    @click="paymentMethod = 'bank_transfer'"
                                    :class="paymentMethod === 'bank_transfer'
                                        ? 'bg-white text-[#0A1628] shadow-sm font-semibold'
                                        : 'text-gray-400 hover:text-gray-600'"
                                    class="flex-1 flex items-center justify-center gap-2 py-2.5 px-3 rounded-lg text-sm transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                                Bank Transfer
                            </button>
                            <button type="button"
                                    @click="paymentMethod = 'paystack'"
                                    :class="paymentMethod === 'paystack'
                                        ? 'bg-white text-[#0A1628] shadow-sm font-semibold'
                                        : 'text-gray-400 hover:text-gray-600'"
                                    class="flex-1 flex items-center justify-center gap-2 py-2.5 px-3 rounded-lg text-sm transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                Pay Online
                            </button>
                        </div>
                    </div>

                    {{-- Bank Transfer Tab Content --}}
                    <div x-show="paymentMethod === 'bank_transfer'" x-transition>
                        {{-- Bank Details --}}
                        <div class="bg-[#0A1628]/5 border border-[#0A1628]/10 rounded-xl p-4 mb-4">
                            <p class="text-[#0A1628] font-bold text-xs uppercase tracking-wide mb-3">Bank Transfer Details</p>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-500 text-sm">Bank Name</span>
                                    <span class="text-[#0A1628] font-semibold text-sm">GTBank (Guaranty Trust Bank)</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500 text-sm">Account Number</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[#0A1628] font-bold text-sm font-mono">0123456789</span>
                                        <button type="button"
                                                @click="navigator.clipboard.writeText('0123456789'); $dispatch('show-toast', {message: 'Account number copied!', type: 'success'})"
                                                class="text-[#C9A84C] hover:text-[#b8963e] transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500 text-sm">Account Name</span>
                                    <span class="text-[#0A1628] font-semibold text-sm">SHEFAHOMES Ltd</span>
                                </div>
                                <div class="pt-2 border-t border-[#0A1628]/10">
                                    <span class="text-gray-500 text-sm">Payment Reference</span>
                                    <p class="text-[#C9A84C] font-bold text-sm font-mono">{{ auth()->user()->id }}-{{ $payment->id }}-{{ date('Ymd') }}</p>
                                    <p class="text-gray-400 text-xs mt-0.5">Use this as your transfer narration/description</p>
                                </div>
                            </div>
                        </div>

                        {{-- Upload Proof --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5">
                                Upload Payment Proof <span class="text-red-500">*</span>
                            </label>
                            <div class="border-2 border-dashed border-gray-200 hover:border-[#C9A84C] rounded-xl p-5 text-center transition-colors cursor-pointer"
                                 @click="$refs.proofInput.click()">
                                <template x-if="proofPreview">
                                    <div class="space-y-2">
                                        <img :src="proofPreview" class="max-h-32 mx-auto rounded-lg object-contain">
                                        <p class="text-xs text-gray-400" x-text="proofFile ? proofFile.name : ''"></p>
                                        <p class="text-xs text-[#C9A84C] font-semibold">Click to change</p>
                                    </div>
                                </template>
                                <template x-if="!proofPreview">
                                    <div class="space-y-2">
                                        <svg class="w-10 h-10 text-gray-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                        <p class="text-gray-500 text-sm font-medium">Upload bank teller or screenshot</p>
                                        <p class="text-gray-400 text-xs">PNG, JPG, PDF up to 5MB</p>
                                    </div>
                                </template>
                            </div>
                            <input type="file"
                                   x-ref="proofInput"
                                   name="proof_of_payment"
                                   accept="image/*,application/pdf"
                                   @change="handleFile($event)"
                                   class="hidden">
                            @error('proof_of_payment')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div class="mt-5">
                            <button type="submit"
                                    :disabled="isSubmitting"
                                    class="w-full flex items-center justify-center gap-2 bg-[#C9A84C] hover:bg-[#b8963e] disabled:opacity-60 disabled:cursor-not-allowed text-white font-bold py-3.5 px-4 rounded-xl transition-colors shadow-md shadow-[#C9A84C]/20 text-sm">
                                <svg x-show="!isSubmitting" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <svg x-show="isSubmitting" class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                <span x-text="isSubmitting ? 'Submitting...' : 'Submit Payment Proof'"></span>
                            </button>
                            <p class="text-center text-xs text-gray-400 mt-2">
                                Your payment will be verified by our team within 24 hours.
                            </p>
                        </div>
                    </div>

                    {{-- Paystack Online Tab Content --}}
                    <div x-show="paymentMethod === 'paystack'" x-transition class="space-y-4">
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <p class="text-blue-700 font-semibold text-sm">Secure Online Payment</p>
                                    <p class="text-blue-600 text-xs mt-0.5">
                                        Pay securely via Paystack. Supports debit/credit cards, bank transfer, USSD.
                                        Payment is confirmed instantly.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <button type="button"
                                id="paystack-btn"
                                @click="payWithPaystack()"
                                :disabled="!amount || amount < 1000"
                                class="w-full flex items-center justify-center gap-2 bg-[#0A1628] hover:bg-[#152238] disabled:opacity-50 disabled:cursor-not-allowed text-white font-bold py-3.5 px-4 rounded-xl transition-colors text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Pay ₦<span x-text="parseFloat(amount || 0).toLocaleString('en-NG')"></span> with Paystack
                        </button>
                        <p class="text-center text-xs text-gray-400">
                            Powered by Paystack &mdash; 100% secure payments
                        </p>
                    </div>

                </div>
            </form>
        </div>

        {{-- Right Panel: Payment Summary --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm p-5 lg:sticky lg:top-6">
                <h3 class="text-[#0A1628] font-bold text-base font-['Playfair_Display'] mb-4 pb-3 border-b border-gray-100">
                    Payment Summary
                </h3>

                {{-- Summary Breakdown --}}
                <div class="space-y-3 mb-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 text-sm">Property</span>
                        <span class="text-[#0A1628] font-semibold text-sm text-right max-w-[160px] truncate">{{ $property->name ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 text-sm">Total Price</span>
                        <span class="text-[#0A1628] font-bold text-sm">₦{{ number_format($totalPrice, 0) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 text-sm">Previously Paid</span>
                        <span class="text-[#C9A84C] font-bold text-sm">₦{{ number_format($amountPaid, 0) }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">Outstanding Balance</span>
                        <span class="text-red-500 font-bold text-sm">₦{{ number_format($balance, 0) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 font-semibold text-sm">Amount to Pay</span>
                        <span class="text-[#0A1628] font-bold text-lg" x-text="'₦' + parseFloat(amount || 0).toLocaleString('en-NG')">₦{{ number_format($installment, 0) }}</span>
                    </div>
                </div>

                {{-- Progress Bar --}}
                <div class="mb-4">
                    <div class="flex justify-between text-xs text-gray-500 mb-1.5">
                        <span>Completion</span>
                        <span class="text-[#C9A84C] font-bold">{{ $progressPct }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2">
                        <div class="bg-[#C9A84C] h-2 rounded-full" style="width: {{ $progressPct }}%"></div>
                    </div>
                </div>

                {{-- Note on fees --}}
                <div class="bg-amber-50 border border-amber-100 rounded-xl p-3">
                    <p class="text-amber-700 text-xs font-semibold mb-1">Important Notes</p>
                    <ul class="text-amber-600 text-xs space-y-1 list-disc list-inside">
                        <li>Bank transfer payments are verified within 24 hours.</li>
                        <li>Online payments via Paystack may include a small processing fee.</li>
                        <li>Always use your reference number as narration.</li>
                        <li>Contact support if payment is not confirmed after 48 hours.</li>
                    </ul>
                </div>

                {{-- Support Contact --}}
                <div class="mt-4 pt-4 border-t border-gray-100 text-center">
                    <p class="text-xs text-gray-400">Having issues?</p>
                    <a href="{{ route('contact') }}" class="text-[#C9A84C] text-xs font-semibold hover:underline">
                        Contact Support &rarr;
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
@endsection

@push('scripts')
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
function payWithPaystack() {
    const amount = document.querySelector('[name="amount"]') ? parseInt(document.querySelector('[name="amount"]').value) : 0;
    if (!amount || amount < 1000) {
        alert('Please enter a valid amount (minimum ₦1,000)');
        return;
    }

    const handler = PaystackPop.setup({
        key: '{{ config("services.paystack.public_key", "pk_test_xxxxxxxxxx") }}',
        email: '{{ auth()->user()->email }}',
        amount: amount * 100, // Paystack uses kobo
        currency: 'NGN',
        ref: '{{ auth()->user()->id }}-{{ $payment->id }}-' + Date.now(),
        metadata: {
            payment_id: '{{ $payment->id }}',
            property_id: '{{ $property->id ?? "" }}',
            client_id: '{{ auth()->user()->id }}'
        },
        callback: function(response) {
            // Redirect to verification route after payment
            window.location.href = '{{ route("client.payments.verify") }}?reference=' + response.reference + '&payment_id={{ $payment->id }}';
        },
        onClose: function() {
            console.log('Payment window closed');
        }
    });
    handler.openIframe();
}
</script>
@endpush
