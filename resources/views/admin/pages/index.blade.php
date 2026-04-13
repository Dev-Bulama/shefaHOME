@extends('layouts.admin')

@section('page-title', 'Page Content')
@section('breadcrumb', 'Edit content for each public page')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-800">Page Content</h1>
            <p class="text-sm text-gray-500 mt-0.5">Edit the text, headings, and content for each public page.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($pages as $page)
        <a href="{{ route('admin.pages.edit', $page['slug']) }}"
           class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md hover:border-[#27AE22]/40 transition-all group">
            <div class="flex items-start justify-between">
                <div class="w-10 h-10 bg-[#1A237E]/8 rounded-xl flex items-center justify-center group-hover:bg-[#27AE22]/10 transition-colors">
                    <svg class="w-5 h-5 text-[#1A237E] group-hover:text-[#27AE22] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <span class="text-xs text-gray-400 bg-gray-50 px-2 py-1 rounded-full">{{ $page['fields'] }} fields</span>
            </div>
            <h3 class="font-semibold text-gray-800 mt-3">{{ $page['name'] }}</h3>
            <p class="text-xs text-gray-500 mt-0.5 font-mono">/{{ $page['slug'] }}</p>
            <div class="mt-3 flex items-center gap-1 text-xs text-[#27AE22] font-medium">
                Edit content
                <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </a>
        @endforeach
    </div>

</div>
@endsection
