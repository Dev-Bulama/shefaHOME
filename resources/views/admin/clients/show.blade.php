@extends('layouts.admin')

@section('page-title', 'Client Profile')

@section('content')
<div x-data="{ showPaymentModal: false, showDocModal: false }" class="space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-800">{{ $client->name }}</h1>
            <p class="text-sm text-gray-500 mt-0.5">
                Client ID: <span class="font-mono font-semibold text-gray-700">{{ $client->client_id ?? 'SH-' . str_pad($client->id, 4, '0', STR_PAD_LEFT) }}</span>
            </p>
        </div>
        <a href="{{ route('admin.clients.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left: Personal Info --}}
        <div class="space-y-5">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center gap-4 mb-5">
                    <div class="w-16 h-16 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                        <span class="text-2xl font-bold text-amber-600">{{ strtoupper(substr($client->name, 0, 1)) }}</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">{{ $client->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $client->email }}</p>
                    </div>
                </div>
                <div class="space-y-3 text-sm">
                    @foreach([['Phone', $client->phone], ['WhatsApp', $client->whatsapp], ['State', $client->state], ['LGA', $client->lga], ['Address', $client->address], ['Occupation', $client->occupation]] as [$label, $value])
                    @if($value)
                    <div class="flex justify-between">
                        <span class="text-gray-500">{{ $label }}</span>
                        <span class="font-medium text-gray-700 text-right max-w-[160px]">{{ $value }}</span>
                    </div>
                    @endif
                    @endforeach
                    <div class="flex justify-between">
                        <span class="text-gray-500">Joined</span>
                        <span class="font-medium text-gray-700">{{ $client->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Verified</span>
                        <span class="{{ $client->email_verified_at ? 'text-green-600' : 'text-red-500' }} font-medium">
                            {{ $client->email_verified_at ? 'Yes' : 'No' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Upload Document --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">Upload Document</h3>
                <form method="POST" action="{{ route('admin.clients.documents.upload', $client) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Document Type</label>
                            <select name="document_type" class="w-full border border-gray-200 rounded-lg px-2 py-1.5 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">
                                <option value="offer_letter">Offer Letter</option>
                                <option value="receipt">Payment Receipt</option>
                                <option value="allocation">Allocation Letter</option>
                                <option value="deed">Deed of Assignment</option>
                                <option value="survey">Survey Plan</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Title</label>
                            <input type="text" name="title" class="w-full border border-gray-200 rounded-lg px-2 py-1.5 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                        </div>
                        <input type="file" name="document" required accept=".pdf,.doc,.docx,.jpg,.png"
                            class="block w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100"/>
                        <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium py-2 rounded-lg transition">Upload</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Right: Properties, Payments, Docs --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Properties --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-gray-700">Properties ({{ $client->properties->count() }})</h3>
                    <button @click="showPaymentModal = true"
                        class="text-xs text-white bg-amber-500 hover:bg-amber-600 font-medium px-3 py-1.5 rounded-lg transition">
                        + Add Payment
                    </button>
                </div>
                <div class="divide-y divide-gray-50">
                    @forelse($client->properties ?? [] as $property)
                    <div class="px-6 py-4 flex items-center gap-4">
                        @if($property->cover_image)
                        <img src="{{ Storage::url($property->cover_image) }}" class="w-16 h-12 object-cover rounded-lg flex-shrink-0"/>
                        @endif
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">{{ $property->title }}</p>
                            <p class="text-xs text-gray-400">{{ $property->state }} &bull; {{ $property->pivot?->plot_size ?? '' }}</p>
                        </div>
                        <div class="text-right">
                            @php $paid = $property->pivot?->amount_paid ?? 0; $total = $property->price ?? 1; $pct = min(100, round(($paid/$total)*100)); @endphp
                            <p class="text-xs font-semibold text-gray-700">₦{{ number_format($paid) }} / ₦{{ number_format($total) }}</p>
                            <div class="w-32 bg-gray-200 rounded-full h-2 mt-1">
                                <div class="h-2 rounded-full {{ $pct >= 100 ? 'bg-green-500' : 'bg-amber-500' }}" style="width:{{ $pct }}%"></div>
                            </div>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $pct }}% paid</p>
                        </div>
                    </div>
                    @empty
                    <p class="px-6 py-6 text-sm text-gray-400 text-center">No properties assigned.</p>
                    @endforelse
                </div>
            </div>

            {{-- Payment History --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-700">Payment History</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                                <th class="px-4 py-3 text-left">Date</th>
                                <th class="px-4 py-3 text-left">Property</th>
                                <th class="px-4 py-3 text-left">Amount (₦)</th>
                                <th class="px-4 py-3 text-left">Method</th>
                                <th class="px-4 py-3 text-left">Reference</th>
                                <th class="px-4 py-3 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($payments ?? [] as $payment)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-gray-500 whitespace-nowrap">{{ $payment->created_at->format('M d, Y') }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $payment->property?->title ?? '—' }}</td>
                                <td class="px-4 py-3 font-medium text-gray-800">{{ number_format($payment->amount) }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ ucfirst($payment->method) }}</td>
                                <td class="px-4 py-3 font-mono text-xs text-gray-400">{{ $payment->reference ?? '—' }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $payment->status === 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="px-4 py-6 text-center text-gray-400 text-sm">No payments recorded.</td></tr>
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
                            <div class="w-9 h-9 rounded-lg bg-red-50 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">{{ $doc->title }}</p>
                                <p class="text-xs text-gray-400">{{ ucfirst(str_replace('_', ' ', $doc->document_type)) }} &bull; {{ $doc->created_at->format('M d, Y') }}</p>
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

    {{-- Add Payment Modal --}}
    <div x-show="showPaymentModal" x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50">
        <div @click.outside="showPaymentModal = false" class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-base font-semibold text-gray-800">Add Payment</h3>
                <button @click="showPaymentModal = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.clients.payments.add', $client) }}" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Property</label>
                        <select name="property_id" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">
                            <option value="">Select property…</option>
                            @foreach($client->properties ?? [] as $prop)
                            <option value="{{ $prop->id }}">{{ $prop->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Amount (₦)</label>
                        <input type="number" name="amount" step="0.01" min="0" required
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                        <select name="method" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="cash">Cash</option>
                            <option value="online">Online</option>
                            <option value="cheque">Cheque</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Reference / Note</label>
                        <input type="text" name="reference" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Payment Date</label>
                        <input type="date" name="payment_date" value="{{ date('Y-m-d') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Proof of Payment (optional)</label>
                        <input type="file" name="proof" accept="image/*,.pdf"
                            class="block w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-sm file:font-medium file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100"/>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="button" @click="showPaymentModal = false"
                            class="flex-1 px-4 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition">Cancel</button>
                        <button type="submit"
                            class="flex-1 px-4 py-2.5 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-lg font-semibold transition">Add Payment</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
