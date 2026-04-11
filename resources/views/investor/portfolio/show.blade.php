@extends('layouts.investor')

@section('page-title', 'Investment Detail')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-800">Investment Detail</h1>
            <p class="text-sm text-gray-500 mt-0.5">{{ $investment->property?->title }}</p>
        </div>
        <a href="{{ route('investor.portfolio.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back to Portfolio</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Investment Card --}}
        <div class="lg:col-span-2 space-y-5">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                @if($investment->property?->cover_image)
                <img src="{{ Storage::url($investment->property->cover_image) }}" class="w-full h-48 object-cover"/>
                @endif
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">{{ $investment->property?->title }}</h2>
                            <p class="text-sm text-gray-500">{{ $investment->property?->state }}{{ $investment->property?->city ? ', ' . $investment->property->city : '' }}</p>
                        </div>
                        @php
                            $colors = ['active' => 'bg-green-100 text-green-700', 'matured' => 'bg-blue-100 text-blue-700', 'pending' => 'bg-yellow-100 text-yellow-700'];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $colors[$investment->status] ?? 'bg-gray-100 text-gray-500' }}">
                            {{ ucfirst($investment->status) }}
                        </span>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                        @foreach([
                            ['Amount Invested', '₦' . number_format($investment->amount)],
                            ['Return Rate', $investment->return_rate . '% per annum'],
                            ['Expected Return', '₦' . number_format($investment->expected_return ?? 0)],
                            ['Investment Date', $investment->investment_date?->format('M d, Y')],
                            ['Maturity Date', $investment->maturity_date?->format('M d, Y') ?? 'Open-ended'],
                            ['Returns Received', '₦' . number_format($investment->returns_received ?? 0)],
                        ] as [$label, $value])
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-xs text-gray-500">{{ $label }}</p>
                            <p class="font-semibold text-gray-800 mt-0.5">{{ $value }}</p>
                        </div>
                        @endforeach
                    </div>

                    @if($investment->notes)
                    <div class="mt-4 p-3 bg-amber-50 rounded-lg border border-amber-100">
                        <p class="text-xs font-medium text-amber-700 mb-1">Notes</p>
                        <p class="text-sm text-amber-900">{{ $investment->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Sidebar: Return Timeline --}}
        <div>
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Return Timeline</h3>
                @if(count($returns ?? []) > 0)
                <div class="relative">
                    <div class="absolute left-3 top-0 bottom-0 w-0.5 bg-gray-100"></div>
                    <div class="space-y-4">
                        @foreach($returns as $ret)
                        <div class="relative pl-8">
                            <div class="absolute left-1.5 w-3 h-3 rounded-full border-2 {{ $ret->status === 'paid' ? 'bg-green-500 border-green-500' : 'bg-white border-gray-300' }} top-1"></div>
                            <div class="bg-gray-50 rounded-lg p-3">
                                <p class="text-xs text-gray-400">{{ $ret->payment_date?->format('M d, Y') }}</p>
                                <p class="font-semibold text-gray-800 mt-0.5">₦{{ number_format($ret->amount) }}</p>
                                <p class="text-xs text-gray-500">{{ $ret->period ?? '' }}</p>
                                <span class="inline-block mt-1 px-2 py-0.5 rounded-full text-xs font-medium {{ $ret->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($ret->status) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <p class="text-sm text-gray-400 text-center py-6">No returns recorded yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
