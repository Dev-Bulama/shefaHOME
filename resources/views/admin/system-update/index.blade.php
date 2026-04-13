@extends('layouts.admin')
@section('page-title', 'System Update')
@section('breadcrumb', 'Admin / System Update')

@section('content')
<div class="max-w-3xl">
    <div class="bg-amber-50 border border-amber-200 rounded-xl p-5 mb-6 flex gap-4">
        <svg class="w-6 h-6 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        <div>
            <p class="font-semibold text-amber-800 text-sm">Important: Read Before Updating</p>
            <ul class="text-amber-700 text-sm mt-1 list-disc list-inside space-y-1">
                <li>Upload a <strong>.zip</strong> file containing updated application files</li>
                <li>The system will <strong>automatically run migrations</strong> and clear all caches</li>
                <li>Files protected from overwrite: <code class="bg-amber-100 px-1 rounded">.env</code>, <code class="bg-amber-100 px-1 rounded">storage/</code>, <code class="bg-amber-100 px-1 rounded">vendor/</code></li>
                <li>Always <strong>backup your database</strong> before applying updates</li>
                <li>Maximum file size: <strong>100MB</strong></li>
            </ul>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Upload Update Package</h2>
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm mb-4 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm mb-4">{{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.system-update.upload') }}" method="POST" enctype="multipart/form-data"
              x-data="{ fileName: '', uploading: false, dragOver: false }"
              @submit="uploading = true">
            @csrf
            <div @dragover.prevent="dragOver = true"
                 @dragleave.prevent="dragOver = false"
                 @drop.prevent="dragOver = false; fileName = $event.dataTransfer.files[0]?.name; $refs.fileInput.files = $event.dataTransfer.files"
                 :class="dragOver ? 'border-[#27AE22] bg-amber-50' : 'border-gray-300 bg-gray-50'"
                 class="border-2 border-dashed rounded-xl p-10 text-center cursor-pointer transition-colors mb-4"
                 @click="$refs.fileInput.click()">
                <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                <p class="text-gray-600 text-sm" x-show="!fileName">Drop your <strong>.zip</strong> here or <span class="text-[#27AE22] font-semibold">click to browse</span></p>
                <p class="text-[#27AE22] font-semibold text-sm" x-show="fileName" x-text="'Selected: ' + fileName"></p>
                <p class="text-gray-400 text-xs mt-1">Maximum 100MB ZIP file</p>
                <input type="file" name="update_zip" accept=".zip" class="hidden" x-ref="fileInput" @change="fileName = $event.target.files[0]?.name" required>
            </div>
            <button type="submit" :disabled="uploading"
                    class="w-full bg-[#1A237E] text-white font-semibold py-3 rounded-xl hover:bg-[#0D1566] transition-colors disabled:opacity-50 flex items-center justify-center gap-2">
                <template x-if="!uploading">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                        Upload &amp; Apply Update
                    </span>
                </template>
                <template x-if="uploading">
                    <span class="flex items-center gap-2">
                        <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                        Applying update... please wait
                    </span>
                </template>
            </button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Update History</h2>
        @if(!empty($updateHistory))
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-3 text-left">Filename</th>
                            <th class="px-4 py-3 text-left">Applied At</th>
                            <th class="px-4 py-3 text-left">Applied By</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach(array_reverse($updateHistory) as $update)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-800">{{ $update['filename'] }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $update['applied_at'] }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $update['applied_by'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-8 text-gray-400">
                <svg class="w-10 h-10 mx-auto mb-2 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <p class="text-sm">No updates have been applied yet</p>
            </div>
        @endif
    </div>
</div>
@endsection
