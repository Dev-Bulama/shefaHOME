@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
        @php
            $cards = [
                ['label' => 'Total Properties', 'key' => 'total_properties', 'icon' => 'M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z', 'color' => 'bg-yellow-500'],
                ['label' => 'Active Clients',   'key' => 'active_clients',    'icon' => 'M17 20h5v-2a4 4 0 00-5.197-3.787M9 20H4v-2a4 4 0 015.197-3.787M15 11a4 4 0 11-8 0 4 4 0 018 0z', 'color' => 'bg-blue-500'],
                ['label' => 'Active Investors', 'key' => 'active_investors',  'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'bg-green-500'],
                ['label' => 'Open Inquiries',   'key' => 'open_inquiries',    'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z', 'color' => 'bg-red-500'],
                ['label' => 'Blog Posts',       'key' => 'blog_posts',        'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z', 'color' => 'bg-purple-500'],
                ['label' => 'Applications',     'key' => 'applications',      'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0120 9.414V19a2 2 0 01-2 2z', 'color' => 'bg-indigo-500'],
            ];
        @endphp

        @foreach ($cards as $card)
        <div class="bg-white rounded-xl shadow p-5 flex items-center gap-4">
            <div class="w-12 h-12 {{ $card['color'] }} rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}" />
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800">{{ $stats[$card['key']] ?? 0 }}</p>
                <p class="text-xs text-gray-500 leading-tight">{{ $card['label'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Charts Row --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-sm font-semibold text-gray-700 mb-4">Monthly Inquiries</h2>
            <canvas id="inquiriesChart" height="120"></canvas>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-sm font-semibold text-gray-700 mb-4">Properties by State</h2>
            <canvas id="propertiesChart" height="120"></canvas>
        </div>
    </div>

    {{-- Tables Row --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Recent Inquiries --}}
        <div class="bg-white rounded-xl shadow">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-sm font-semibold text-gray-700">Recent Inquiries</h2>
                <a href="{{ route('admin.inquiries.index') }}" class="text-xs text-yellow-600 hover:underline">View all</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                            <th class="px-4 py-3 text-left">Name</th>
                            <th class="px-4 py-3 text-left">Email</th>
                            <th class="px-4 py-3 text-left">Subject</th>
                            <th class="px-4 py-3 text-left">Date</th>
                            <th class="px-4 py-3 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($recentInquiries ?? [] as $inquiry)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $inquiry->name }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $inquiry->email }}</td>
                            <td class="px-4 py-3 text-gray-600 truncate max-w-[120px]">{{ $inquiry->subject }}</td>
                            <td class="px-4 py-3 text-gray-400">{{ $inquiry->created_at->format('M d') }}</td>
                            <td class="px-4 py-3">
                                @php
                                    $colors = ['new'=>'bg-blue-100 text-blue-700','read'=>'bg-gray-100 text-gray-600','replied'=>'bg-green-100 text-green-700','closed'=>'bg-red-100 text-red-600'];
                                    $c = $colors[$inquiry->status] ?? 'bg-gray-100 text-gray-600';
                                @endphp
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $c }}">{{ ucfirst($inquiry->status) }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="px-4 py-6 text-center text-gray-400 text-xs">No inquiries yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Recent Registrations --}}
        <div class="bg-white rounded-xl shadow">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-sm font-semibold text-gray-700">Recent Registrations</h2>
                <a href="{{ route('admin.clients.index') }}" class="text-xs text-yellow-600 hover:underline">View all</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                            <th class="px-4 py-3 text-left">Name</th>
                            <th class="px-4 py-3 text-left">Email</th>
                            <th class="px-4 py-3 text-left">Type</th>
                            <th class="px-4 py-3 text-left">Joined</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($recentRegistrations ?? [] as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $user->role === 'investor' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ ucfirst($user->role ?? 'client') }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-400">{{ $user->created_at->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="px-4 py-6 text-center text-gray-400 text-xs">No registrations yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const inquiriesData = @json($monthlyInquiries ?? []);
    const propertiesData = @json($propertiesByState ?? []);

    // Monthly Inquiries Line Chart
    new Chart(document.getElementById('inquiriesChart'), {
        type: 'line',
        data: {
            labels: inquiriesData.map(d => d.month),
            datasets: [{
                label: 'Inquiries',
                data: inquiriesData.map(d => d.count),
                borderColor: '#EAB308',
                backgroundColor: 'rgba(234,179,8,0.1)',
                borderWidth: 2,
                pointRadius: 4,
                pointBackgroundColor: '#EAB308',
                tension: 0.4,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { precision: 0 } }
            }
        }
    });

    // Properties by State Bar Chart
    new Chart(document.getElementById('propertiesChart'), {
        type: 'bar',
        data: {
            labels: propertiesData.map(d => d.state),
            datasets: [{
                label: 'Properties',
                data: propertiesData.map(d => d.count),
                backgroundColor: '#1D4ED8',
                borderRadius: 4,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { precision: 0 } }
            }
        }
    });
</script>
@endpush
