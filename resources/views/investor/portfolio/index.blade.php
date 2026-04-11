@extends('layouts.investor')

@section('page-title', 'My Portfolio')

@section('content')
<div class="space-y-6">

    <div>
        <h1 class="text-xl font-bold text-gray-800">Investment Portfolio</h1>
        <p class="text-sm text-gray-500 mt-0.5">All your property investments in one place.</p>
    </div>

    {{-- Summary --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        @php
            $summaryCards = [
                ['label' => 'Total Invested', 'value' => '₦' . number_format($summary['total_invested'] ?? 0), 'color' => 'bg-amber-50 text-amber-600'],
                ['label' => 'Active Investments', 'value' => $summary['active_count'] ?? 0, 'color' => 'bg-blue-50 text-blue-600'],
                ['label' => 'Total Returns Received', 'value' => '₦' . number_format($summary['total_returns'] ?? 0), 'color' => 'bg-green-50 text-green-600'],
            ];
        @endphp
        @foreach($summaryCards as $card)
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <p class="text-xs text-gray-500 font-medium">{{ $card['label'] }}</p>
            <p class="text-2xl font-bold {{ explode(' ', $card['color'])[1] }} mt-1">{{ $card['value'] }}</p>
        </div>
        @endforeach
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide border-b border-gray-100">
                        <th class="px-4 py-3 text-left">Property</th>
                        <th class="px-4 py-3 text-left">Amount (₦)</th>
                        <th class="px-4 py-3 text-left">Investment Date</th>
                        <th class="px-4 py-3 text-left">Maturity Date</th>
                        <th class="px-4 py-3 text-left">Return %</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Details</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($investments ?? [] as $inv)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <p class="font-medium text-gray-800">{{ $inv->property?->title ?? '—' }}</p>
                            <p class="text-xs text-gray-400">{{ $inv->property?->state }}</p>
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-800">{{ number_format($inv->amount) }}</td>
                        <td class="px-4 py-3 text-gray-500 whitespace-nowrap">{{ $inv->investment_date?->format('M d, Y') }}</td>
                        <td class="px-4 py-3 text-gray-500 whitespace-nowrap">{{ $inv->maturity_date?->format('M d, Y') ?? '—' }}</td>
                        <td class="px-4 py-3 font-semibold text-green-600">{{ $inv->return_rate ?? 0 }}%</td>
                        <td class="px-4 py-3">
                            @php
                                $colors = ['active' => 'bg-green-100 text-green-700', 'matured' => 'bg-blue-100 text-blue-700', 'pending' => 'bg-yellow-100 text-yellow-700'];
                            @endphp
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $colors[$inv->status] ?? 'bg-gray-100 text-gray-500' }}">
                                {{ ucfirst($inv->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('investor.portfolio.show', $inv) }}"
                                class="text-xs text-amber-600 hover:text-amber-700 font-medium border border-amber-200 rounded-lg px-3 py-1.5 hover:bg-amber-50 transition">
                                View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="px-4 py-12 text-center text-gray-400">No investments found. Contact your account manager to get started.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(isset($investments) && $investments->hasPages())
        <div class="px-4 py-4 border-t border-gray-100">{{ $investments->links() }}</div>
        @endif
    </div>
</div>
@endsection
