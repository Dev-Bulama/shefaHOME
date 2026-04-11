@extends('layouts.investor')

@section('page-title', 'Documents')

@section('content')
<div class="space-y-6">

    <div>
        <h1 class="text-xl font-bold text-gray-800">My Documents</h1>
        <p class="text-sm text-gray-500 mt-0.5">All documents related to your investments.</p>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">{{ session('success') }}</div>
    @endif

    @php
        $typeIcons = [
            'agreement'     => ['icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'color' => 'text-blue-500 bg-blue-50'],
            'statement'     => ['icon' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'color' => 'text-green-500 bg-green-50'],
            'certificate'   => ['icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z', 'color' => 'text-amber-500 bg-amber-50'],
            'default'       => ['icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'color' => 'text-gray-500 bg-gray-50'],
        ];
    @endphp

    @if(count($documents ?? []) > 0)
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm divide-y divide-gray-50">
        @foreach($documents as $doc)
        @php $iconData = $typeIcons[$doc->document_type] ?? $typeIcons['default']; @endphp
        <div class="p-5 flex items-center gap-4 hover:bg-gray-50 transition">
            <div class="w-11 h-11 rounded-xl {{ explode(' ', $iconData['color'])[1] }} flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 {{ explode(' ', $iconData['color'])[0] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $iconData['icon'] }}"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-medium text-gray-800 truncate">{{ $doc->title }}</p>
                <div class="flex items-center gap-3 mt-0.5">
                    <span class="text-xs text-gray-400">{{ ucfirst(str_replace('_', ' ', $doc->document_type)) }}</span>
                    <span class="text-xs text-gray-300">&bull;</span>
                    <span class="text-xs text-gray-400">{{ $doc->created_at->format('M d, Y') }}</span>
                    @if($doc->file_size)
                    <span class="text-xs text-gray-300">&bull;</span>
                    <span class="text-xs text-gray-400">{{ number_format($doc->file_size / 1024, 1) }} KB</span>
                    @endif
                </div>
            </div>
            <a href="{{ Storage::url($doc->path) }}" target="_blank" download
                class="flex-shrink-0 inline-flex items-center gap-1.5 text-xs text-amber-600 hover:text-amber-700 font-medium border border-amber-200 rounded-lg px-3 py-2 hover:bg-amber-50 transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Download
            </a>
        </div>
        @endforeach
    </div>
    @else
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-12 text-center">
        <svg class="w-12 h-12 text-gray-200 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        <p class="text-gray-500 text-sm">No documents yet. Documents from your account manager will appear here.</p>
    </div>
    @endif
</div>
@endsection
