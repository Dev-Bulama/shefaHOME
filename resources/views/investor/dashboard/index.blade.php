@extends('layouts.investor')

@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Welcome Card --}}
    <div class="bg-gradient-to-r from-amber-500 to-amber-600 rounded-2xl p-6 text-white shadow-lg">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <p class="text-amber-100 text-sm">Welcome back,</p>
                <h1 class="text-2xl font-bold mt-0.5">{{ auth()->user()->name }}</h1>
                <p class="text-amber-100 text-sm mt-1">Last login: {{ auth()->user()->last_login_at?->diffForHumans() ?? 'Never' }}</p>
            </div>
            @php
                $tier = auth()->user()->investorProfile?->tier ?? 'bronze';
                $tierColors = ['bronze' => 'bg-orange-700', 'silver' => 'bg-slate-500', 'gold' => 'bg-yellow-600', 'platinum' => 'bg-purple-700'];
            @endphp
            <div class="flex-shrink-0">
                <span class="inline-block px-4 py-2 rounded-full text-sm font-bold tracking-wide bg-white/20 border border-white/30 backdrop-blur-sm uppercase">
                    {{ ucfirst($tier) }} Investor
                </span>
            </div>
        </div>
    </div>

    {{-- KPI Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @php
            $kpis = [
                ['label' => 'Total Invested', 'value' => '₦' . number_format($kpis['total_invested'] ?? 0), 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'text-amber-500 bg-amber-50'],
                ['label' => 'Total Returns', 'value' => '₦' . number_format($kpis['total_returns'] ?? 0), 'icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'color' => 'text-green-500 bg-green-50'],
                ['label' => 'Active Investments', 'value' => $kpis['active_investments'] ?? 0, 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'color' => 'text-blue-500 bg-blue-50'],
                ['label' => 'ROI', 'value' => ($kpis['roi'] ?? 0) . '%', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 'color' => 'text-purple-500 bg-purple-50'],
            ];
        @endphp
        @foreach($kpis as $kpi)
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl {{ explode(' ', $kpi['color'])[1] }} flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 {{ explode(' ', $kpi['color'])[0] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $kpi['icon'] }}"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">{{ $kpi['label'] }}</p>
                <p class="text-xl font-bold text-gray-800 mt-0.5">{{ $kpi['value'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Portfolio Chart --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Portfolio Breakdown</h3>
            <canvas id="portfolioChart" height="220"></canvas>
        </div>

        {{-- Account Manager --}}
        <div class="space-y-4">
            @if(!empty($accountManager))
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Your Account Manager</h3>
                <div class="flex items-center gap-4">
                    @if($accountManager->photo)
                    <img src="{{ Storage::url($accountManager->photo) }}" class="w-14 h-14 rounded-full object-cover border-2 border-amber-100"/>
                    @else
                    <div class="w-14 h-14 rounded-full bg-amber-100 flex items-center justify-center text-xl font-bold text-amber-600">
                        {{ strtoupper(substr($accountManager->name, 0, 1)) }}
                    </div>
                    @endif
                    <div>
                        <p class="font-semibold text-gray-800">{{ $accountManager->name }}</p>
                        <p class="text-xs text-gray-500">{{ $accountManager->role }}</p>
                    </div>
                </div>
                <div class="mt-4 space-y-2">
                    <a href="mailto:{{ $accountManager->email }}"
                        class="flex items-center gap-2 text-sm text-blue-600 hover:text-blue-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        {{ $accountManager->email }}
                    </a>
                    @if($accountManager->phone)
                    <a href="tel:{{ $accountManager->phone }}"
                        class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        {{ $accountManager->phone }}
                    </a>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Recent Returns --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-sm font-semibold text-gray-700">Recent Returns</h3>
            <a href="{{ route('investor.returns.index') }}" class="text-xs text-amber-600 hover:text-amber-700 font-medium">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                        <th class="px-4 py-3 text-left">Date</th>
                        <th class="px-4 py-3 text-left">Period</th>
                        <th class="px-4 py-3 text-left">Amount (₦)</th>
                        <th class="px-4 py-3 text-left">Reference</th>
                        <th class="px-4 py-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($recentReturns ?? [] as $ret)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-500 whitespace-nowrap">{{ $ret->payment_date?->format('M d, Y') }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $ret->period ?? '—' }}</td>
                        <td class="px-4 py-3 font-semibold text-green-600">{{ number_format($ret->amount) }}</td>
                        <td class="px-4 py-3 font-mono text-xs text-gray-400">{{ $ret->reference ?? '—' }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $ret->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($ret->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-gray-400 text-sm">No returns yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
(function () {
    const data = @json($portfolioData ?? []);
    if (!data.length) return;
    new Chart(document.getElementById('portfolioChart'), {
        type: 'doughnut',
        data: {
            labels: data.map(d => d.label),
            datasets: [{ data: data.map(d => d.value), backgroundColor: ['#f59e0b','#3b82f6','#10b981','#8b5cf6','#ef4444','#f97316'], borderWidth: 2, borderColor: '#fff' }]
        },
        options: {
            responsive: true,
            cutout: '65%',
            plugins: {
                legend: { position: 'bottom', labels: { padding: 16, font: { size: 12 } } }
            }
        }
    });
})();
</script>
@endpush
