@extends('layouts.admin')

@section('page-title', 'Inquiry Detail')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-bold text-gray-800">Inquiry Detail</h1>
        <a href="{{ route('admin.inquiries.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Main Card --}}
        <div class="md:col-span-2 space-y-5">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">{{ $inquiry->subject }}</h2>
                        <p class="text-sm text-gray-500 mt-0.5">Received {{ $inquiry->created_at->format('M d, Y \a\t h:i A') }}</p>
                    </div>
                    @php
                        $sc = ['new'=>'bg-blue-100 text-blue-700','read'=>'bg-yellow-100 text-yellow-700','replied'=>'bg-green-100 text-green-700','closed'=>'bg-gray-100 text-gray-600'];
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $sc[$inquiry->status] ?? 'bg-gray-100 text-gray-600' }}">
                        {{ ucfirst($inquiry->status) }}
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Name</p>
                        <p class="font-medium text-gray-800 mt-0.5">{{ $inquiry->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Email</p>
                        <a href="mailto:{{ $inquiry->email }}" class="font-medium text-blue-600 hover:underline mt-0.5 block">{{ $inquiry->email }}</a>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Phone</p>
                        <p class="font-medium text-gray-800 mt-0.5">{{ $inquiry->phone ?? '—' }}</p>
                    </div>
                    @if($inquiry->property)
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Property of Interest</p>
                        <a href="{{ route('admin.properties.edit', $inquiry->property) }}" class="font-medium text-blue-600 hover:underline mt-0.5 block">{{ $inquiry->property->title }}</a>
                    </div>
                    @endif
                </div>

                <div class="border-t border-gray-100 pt-4">
                    <p class="text-xs text-gray-400 uppercase tracking-wide mb-2">Message</p>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $inquiry->message }}</p>
                </div>
            </div>

            {{-- Admin Notes --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">Admin Notes</h3>
                <form method="POST" action="{{ route('admin.inquiries.status', $inquiry) }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="action" value="notes"/>
                    <textarea name="admin_notes" rows="4" placeholder="Add internal notes here…"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none mb-3">{{ old('admin_notes', $inquiry->admin_notes) }}</textarea>
                    <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                        Save Notes
                    </button>
                </form>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="space-y-5">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">Update Status</h3>
                <form method="POST" action="{{ route('admin.inquiries.status', $inquiry) }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="action" value="status"/>
                    <select name="status" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none mb-3">
                        @foreach(['new' => 'New', 'read' => 'Read', 'replied' => 'Replied', 'closed' => 'Closed'] as $val => $lbl)
                        <option value="{{ $val }}" {{ $inquiry->status == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                        Update Status
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">Quick Reply</h3>
                <a href="mailto:{{ $inquiry->email }}?subject=Re: {{ urlencode($inquiry->subject) }}"
                    class="flex items-center justify-center gap-2 w-full bg-blue-50 hover:bg-blue-100 text-blue-700 text-sm font-medium px-4 py-2 rounded-lg transition border border-blue-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Reply via Email
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
