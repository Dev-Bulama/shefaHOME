@extends('layouts.admin')

@section('page-title', 'Applications')

@section('content')
<div class="space-y-4">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-800">Applications</h1>
            <p class="text-sm text-gray-500 mt-0.5">
                For: <span class="font-medium text-gray-700">{{ $job->title }}</span>
                <span class="ml-2 px-2 py-0.5 rounded-full text-xs font-medium {{ $job->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                    {{ $job->is_active ? 'Active' : 'Closed' }}
                </span>
            </p>
        </div>
        <a href="{{ route('admin.careers.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back to Jobs</a>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide border-b border-gray-100">
                        <th class="px-4 py-3 text-left">Applicant</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Phone</th>
                        <th class="px-4 py-3 text-left">Date Applied</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">CV / Resume</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($applications ?? [] as $app)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $app->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $app->email }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $app->phone ?? '—' }}</td>
                        <td class="px-4 py-3 text-gray-500 whitespace-nowrap">{{ $app->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-3">
                            <form method="POST" action="{{ route('admin.careers.applications.update-status', $app) }}">
                                @csrf @method('PATCH')
                                <select name="status" onchange="this.form.submit()"
                                    class="border border-gray-200 rounded-lg px-2 py-1 text-xs focus:ring-2 focus:ring-amber-400 focus:outline-none
                                    {{ match($app->status) {
                                        'new' => 'bg-blue-50 text-blue-700 border-blue-200',
                                        'reviewed' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                        'shortlisted' => 'bg-purple-50 text-purple-700 border-purple-200',
                                        'hired' => 'bg-green-50 text-green-700 border-green-200',
                                        'rejected' => 'bg-red-50 text-red-700 border-red-200',
                                        default => 'bg-gray-50 text-gray-700',
                                    } }}">
                                    @foreach(['new' => 'New', 'reviewed' => 'Reviewed', 'shortlisted' => 'Shortlisted', 'hired' => 'Hired', 'rejected' => 'Rejected'] as $val => $lbl)
                                    <option value="{{ $val }}" {{ $app->status == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td class="px-4 py-3">
                            @if($app->cv_path)
                            <a href="{{ Storage::url($app->cv_path) }}" target="_blank"
                                class="inline-flex items-center gap-1 text-xs text-blue-600 hover:text-blue-800 font-medium">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Download CV
                            </a>
                            @else
                            <span class="text-gray-400 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.careers.applications.show', $app) }}" class="text-xs text-blue-600 hover:text-blue-800 font-medium">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="px-4 py-10 text-center text-gray-400">No applications yet for this position.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(isset($applications) && $applications->hasPages())
        <div class="px-4 py-4 border-t border-gray-100">{{ $applications->links() }}</div>
        @endif
    </div>
</div>
@endsection
