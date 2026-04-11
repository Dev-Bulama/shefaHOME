@extends('layouts.admin')

@section('page-title', 'Inquiries')

@section('content')
<div class="space-y-4">
    <h1 class="text-xl font-bold text-gray-800">Inquiries</h1>

    {{-- Status Tabs --}}
    @php
        $tabs = ['all' => 'All', 'new' => 'New', 'read' => 'Read', 'replied' => 'Replied', 'closed' => 'Closed'];
        $current = request('status', 'all');
        $tabColors = ['all' => 'bg-gray-600', 'new' => 'bg-blue-500', 'read' => 'bg-yellow-500', 'replied' => 'bg-green-500', 'closed' => 'bg-gray-400'];
    @endphp
    <div class="flex flex-wrap gap-2">
        @foreach($tabs as $key => $label)
        <a href="{{ route('admin.inquiries.index', array_merge(request()->except('status', 'page'), ['status' => $key === 'all' ? null : $key])) }}"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition
            {{ $current === $key || ($key === 'all' && !request('status')) ? 'bg-gray-800 text-white shadow-sm' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' }}">
            {{ $label }}
            @if(isset($counts[$key]))
            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full text-xs font-bold
                {{ $current === $key || ($key === 'all' && !request('status')) ? 'bg-white text-gray-800' : $tabColors[$key] . ' text-white' }}">
                {{ $counts[$key] }}
            </span>
            @endif
        </a>
        @endforeach
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('admin.inquiries.index') }}" class="flex gap-3">
        <input type="hidden" name="status" value="{{ request('status') }}"/>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, subject…"
            class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
        <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">Search</button>
    </form>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide border-b border-gray-100">
                        <th class="px-4 py-3 text-left">Name</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Subject</th>
                        <th class="px-4 py-3 text-left">Property</th>
                        <th class="px-4 py-3 text-left">Date</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($inquiries ?? [] as $inquiry)
                    <tr class="hover:bg-gray-50 {{ $inquiry->status === 'new' ? 'font-semibold' : '' }}">
                        <td class="px-4 py-3 text-gray-800">{{ $inquiry->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $inquiry->email }}</td>
                        <td class="px-4 py-3 text-gray-700 max-w-[180px] truncate">{{ $inquiry->subject }}</td>
                        <td class="px-4 py-3 text-gray-500 max-w-[120px] truncate">{{ $inquiry->property?->title ?? '—' }}</td>
                        <td class="px-4 py-3 text-gray-400 whitespace-nowrap">{{ $inquiry->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-3">
                            @php
                                $sc = ['new'=>'bg-blue-100 text-blue-700','read'=>'bg-yellow-100 text-yellow-700','replied'=>'bg-green-100 text-green-700','closed'=>'bg-gray-100 text-gray-600'];
                            @endphp
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $sc[$inquiry->status] ?? 'bg-gray-100 text-gray-600' }}">
                                {{ ucfirst($inquiry->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="text-xs text-blue-600 hover:text-blue-800 font-medium">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="px-4 py-10 text-center text-gray-400">No inquiries found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(isset($inquiries) && $inquiries->hasPages())
        <div class="px-4 py-4 border-t border-gray-100">{{ $inquiries->withQueryString()->links() }}</div>
        @endif
    </div>
</div>
@endsection
