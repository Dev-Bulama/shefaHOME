@extends('layouts.admin')

@section('page-title', 'Careers')

@section('content')
<div class="space-y-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h1 class="text-xl font-bold text-gray-800">Job Listings</h1>
        <a href="{{ route('admin.careers.create') }}"
            class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Post New Job
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide border-b border-gray-100">
                        <th class="px-4 py-3 text-left">Job Title</th>
                        <th class="px-4 py-3 text-left">Department</th>
                        <th class="px-4 py-3 text-left">Location</th>
                        <th class="px-4 py-3 text-left">Type</th>
                        <th class="px-4 py-3 text-left">Deadline</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Applications</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($jobs ?? [] as $job)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $job->title }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $job->department ?? '—' }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $job->location ?? '—' }}</td>
                        <td class="px-4 py-3">
                            @php
                                $typeColors = ['full_time' => 'bg-blue-100 text-blue-700', 'part_time' => 'bg-purple-100 text-purple-700', 'contract' => 'bg-orange-100 text-orange-700', 'internship' => 'bg-pink-100 text-pink-700'];
                            @endphp
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $typeColors[$job->type] ?? 'bg-gray-100 text-gray-600' }}">
                                {{ ucfirst(str_replace('_', ' ', $job->type)) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-500">
                            @if($job->deadline)
                                <span class="{{ $job->deadline->isPast() ? 'text-red-500' : '' }}">
                                    {{ $job->deadline->format('M d, Y') }}
                                </span>
                            @else
                                —
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $job->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ $job->is_active ? 'Active' : 'Closed' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.careers.applications', $job) }}"
                                class="inline-flex items-center gap-1 text-xs text-amber-600 hover:text-amber-800 font-medium border border-amber-200 rounded-lg px-3 py-1.5 hover:bg-amber-50 transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                {{ $job->applications_count ?? $job->applications()->count() }}
                            </a>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.careers.edit', $job) }}" class="text-blue-600 hover:text-blue-800 text-xs font-medium">Edit</a>
                                <form method="POST" action="{{ route('admin.careers.destroy', $job) }}" onsubmit="return confirm('Delete this job?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="px-4 py-10 text-center text-gray-400">No job listings found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(isset($jobs) && $jobs->hasPages())
        <div class="px-4 py-4 border-t border-gray-100">{{ $jobs->links() }}</div>
        @endif
    </div>
</div>
@endsection
