<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Returns Statement — SHEFAHOMES</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body class="bg-white font-sans text-gray-800">

<div class="max-w-3xl mx-auto p-8">

    {{-- Letterhead --}}
    <div class="flex items-start justify-between pb-6 border-b-2 border-amber-500 mb-6">
        <div>
            @if(!empty($settings['logo']))
            <img src="{{ Storage::url($settings['logo']) }}" class="h-12 object-contain mb-2"/>
            @endif
            <h1 class="text-2xl font-bold text-gray-900">SHEFAHOMES</h1>
            <p class="text-sm text-gray-500">{{ $settings['address'] ?? 'Lagos, Nigeria' }}</p>
            <p class="text-sm text-gray-500">{{ $settings['email'] ?? '' }} &bull; {{ $settings['phone_1'] ?? '' }}</p>
        </div>
        <div class="text-right">
            <h2 class="text-lg font-semibold text-amber-600">RETURNS STATEMENT</h2>
            <p class="text-sm text-gray-500 mt-1">Date: {{ now()->format('M d, Y') }}</p>
            <p class="text-sm text-gray-500">Ref: STMT-{{ str_pad(auth()->id(), 5, '0', STR_PAD_LEFT) }}-{{ now()->format('Ymd') }}</p>
        </div>
    </div>

    {{-- Investor Details --}}
    <div class="grid grid-cols-2 gap-6 mb-6 p-4 bg-gray-50 rounded-xl">
        <div>
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Investor Details</p>
            <p class="font-semibold text-gray-800">{{ $investor->name }}</p>
            <p class="text-sm text-gray-600">{{ $investor->email }}</p>
            <p class="text-sm text-gray-600">{{ $investor->phone ?? '' }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Account Summary</p>
            @php $tier = $investor->investorProfile?->tier ?? 'bronze'; @endphp
            <p class="text-sm"><span class="text-gray-500">Tier:</span> <span class="font-semibold capitalize">{{ $tier }}</span></p>
            <p class="text-sm"><span class="text-gray-500">Total Invested:</span> <span class="font-semibold">₦{{ number_format($investor->investorProfile?->total_invested ?? 0) }}</span></p>
            <p class="text-sm"><span class="text-gray-500">Total Returns:</span> <span class="font-semibold text-green-700">₦{{ number_format($totalReturns ?? 0) }}</span></p>
        </div>
    </div>

    {{-- Returns Table --}}
    <table class="w-full text-sm mb-8">
        <thead>
            <tr class="bg-amber-500 text-white">
                <th class="px-4 py-3 text-left rounded-tl-lg">#</th>
                <th class="px-4 py-3 text-left">Date</th>
                <th class="px-4 py-3 text-left">Period</th>
                <th class="px-4 py-3 text-left">Reference</th>
                <th class="px-4 py-3 text-right">Amount (₦)</th>
                <th class="px-4 py-3 text-left rounded-tr-lg">Status</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @forelse($returns ?? [] as $ret)
            @php $total += $ret->status === 'paid' ? $ret->amount : 0; @endphp
            <tr class="border-b border-gray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                <td class="px-4 py-3 text-gray-400">{{ $loop->iteration }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $ret->payment_date?->format('M d, Y') }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $ret->period ?? '—' }}</td>
                <td class="px-4 py-3 font-mono text-xs text-gray-400">{{ $ret->reference ?? '—' }}</td>
                <td class="px-4 py-3 text-right font-semibold {{ $ret->status === 'paid' ? 'text-green-700' : 'text-gray-500' }}">
                    {{ number_format($ret->amount, 2) }}
                </td>
                <td class="px-4 py-3">
                    <span class="px-2 py-0.5 rounded text-xs font-medium {{ $ret->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ ucfirst($ret->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-4 py-6 text-center text-gray-400">No returns recorded.</td></tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="bg-amber-50 border-t-2 border-amber-200 font-semibold">
                <td colspan="4" class="px-4 py-3 text-right text-gray-700">Total Received:</td>
                <td class="px-4 py-3 text-right text-green-700 text-base">{{ number_format($total, 2) }}</td>
                <td class="px-4 py-3"></td>
            </tr>
        </tfoot>
    </table>

    {{-- Footer --}}
    <div class="border-t border-gray-200 pt-4 text-xs text-gray-400 text-center">
        <p>This statement was generated on {{ now()->format('M d, Y \a\t H:i') }} and is accurate as of that date.</p>
        <p class="mt-1">SHEFAHOMES &bull; {{ $settings['address'] ?? '' }} &bull; {{ $settings['phone_1'] ?? '' }}</p>
    </div>
</div>

{{-- Print Button --}}
<div class="no-print fixed bottom-6 right-6">
    <button onclick="window.print()"
        class="bg-amber-500 hover:bg-amber-600 text-white font-semibold text-sm px-6 py-3 rounded-xl shadow-lg transition flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
        </svg>
        Print Statement
    </button>
</div>
</body>
</html>
