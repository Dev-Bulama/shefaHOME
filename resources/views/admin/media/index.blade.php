@extends('layouts.admin')

@section('page-title', 'Media Library')
@section('breadcrumb', 'Upload and manage images & videos')

@section('content')
<div x-data="{
    uploading: false,
    dragOver: false,
    editItem: null,
    showEdit: false,

    /* ── Upload state ─────────────────────── */
    queue: [],
    queueIndex: 0,
    queueTotal: 0,
    currentProgress: 0,
    doneCount: 0,
    failCount: 0,
    currentName: '',
    uploadErrors: [],

    get overallPercent() {
        return this.queueTotal ? Math.round(((this.doneCount + this.failCount) / this.queueTotal) * 100) : 0;
    },
    get allDone() {
        return this.queueTotal > 0 && this.queueIndex >= this.queueTotal;
    },

    handleDrop(e) {
        this.dragOver = false;
        this.startUpload(Array.from(e.dataTransfer.files));
    },
    handleFiles(files) {
        this.startUpload(Array.from(files));
    },
    startUpload(files) {
        if (!files.length) return;
        this.queue = files;
        this.queueTotal = files.length;
        this.queueIndex = 0;
        this.doneCount = 0;
        this.failCount = 0;
        this.uploadErrors = [];
        this.currentProgress = 0;
        this.currentName = '';
        this.uploading = true;
        this.uploadNext();
    },
    uploadNext() {
        if (this.queueIndex >= this.queueTotal) {
            setTimeout(() => window.location.reload(), 1800);
            return;
        }
        const file = this.queue[this.queueIndex];
        this.currentName = file.name;
        this.currentProgress = 0;

        /* Client-side size guard: warn but still attempt (server is the authority) */
        const MAX_MB = 50;
        if (file.size > MAX_MB * 1024 * 1024) {
            this.failCount++;
            this.uploadErrors.push({ name: file.name, reason: `File is ${(file.size/1048576).toFixed(1)} MB — exceeds the ${MAX_MB} MB limit.` });
            this.queueIndex++;
            this.uploadNext();
            return;
        }

        const form = new FormData();
        form.append('files[]', file);
        form.append('_token', document.querySelector('meta[name=csrf-token]').content);

        const xhr = new XMLHttpRequest();
        xhr.upload.addEventListener('progress', (e) => {
            if (e.lengthComputable) {
                this.currentProgress = Math.round((e.loaded / e.total) * 100);
            }
        });
        const next = () => { this.queueIndex++; this.uploadNext(); };
        xhr.addEventListener('load', () => {
            try {
                const data = JSON.parse(xhr.responseText);
                if (data.success || data.uploaded > 0) {
                    this.doneCount++;
                    /* Server may have returned partial errors alongside success */
                    if (data.errors && data.errors.length) {
                        data.errors.forEach(e => this.uploadErrors.push({ name: file.name, reason: e }));
                    }
                } else {
                    this.failCount++;
                    const reason = data.error
                        || (data.errors ? (Array.isArray(data.errors) ? data.errors.join(' ') : Object.values(data.errors).flat().join(' ')) : null)
                        || (data.message || `Server rejected (HTTP ${xhr.status})`);
                    this.uploadErrors.push({ name: file.name, reason });
                }
            } catch {
                this.failCount++;
                this.uploadErrors.push({ name: file.name, reason: `Unexpected server response (HTTP ${xhr.status}). File may exceed the server upload limit.` });
            }
            next();
        });
        xhr.addEventListener('error', () => {
            this.failCount++;
            this.uploadErrors.push({ name: file.name, reason: 'Network error — check your connection.' });
            next();
        });
        xhr.open('POST', '{{ route('admin.media.store') }}');
        xhr.send(form);
    }
}" class="space-y-6">

    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h1 class="text-xl font-bold text-gray-800">Media Library</h1>
            <p class="text-sm text-gray-500 mt-0.5">Upload images and videos. Click any file to copy its URL or edit details.</p>
        </div>
        <label class="inline-flex items-center gap-2 px-4 py-2 bg-[#27AE22] text-white text-sm font-semibold rounded-lg hover:bg-[#1D9418] transition cursor-pointer" :class="uploading ? 'opacity-50 pointer-events-none' : ''">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
            </svg>
            Upload Files
            <input type="file" class="hidden" multiple accept="image/*,video/*" @change="handleFiles($event.target.files)" :disabled="uploading">
        </label>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">{{ session('success') }}</div>
    @endif

    {{-- Drop Zone --}}
    <div @dragover.prevent="dragOver = true"
         @dragleave.prevent="dragOver = false"
         @drop.prevent="handleDrop($event)"
         :class="dragOver ? 'border-[#27AE22] bg-green-50' : 'border-gray-300 bg-gray-50'"
         class="border-2 border-dashed rounded-xl p-8 text-center transition-colors"
         x-show="!uploading">
        <svg class="w-10 h-10 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
        </svg>
        <p class="text-sm text-gray-500">Drag & drop images or videos here to upload</p>
        <p class="text-xs text-gray-400 mt-1">JPG, PNG, GIF, WebP, MP4, MOV — Max 50MB per file</p>
    </div>

    {{-- Upload Progress Panel --}}
    <div x-show="uploading" x-cloak class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

        {{-- Header --}}
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div x-show="!allDone">
                    <svg class="animate-spin w-5 h-5 text-[#1A237E]" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                    </svg>
                </div>
                <div x-show="allDone">
                    <svg class="w-5 h-5 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-800" x-show="!allDone">
                        Uploading file <span x-text="Math.min(queueIndex + 1, queueTotal)"></span> of <span x-text="queueTotal"></span>
                    </p>
                    <p class="text-sm font-semibold text-[#27AE22]" x-show="allDone">
                        Upload complete — reloading…
                    </p>
                    <p class="text-xs text-gray-400 mt-0.5 truncate max-w-xs" x-text="currentName" x-show="!allDone"></p>
                </div>
            </div>
            <div class="text-right text-xs flex items-center gap-4">
                <span class="text-[#27AE22] font-semibold" x-text="doneCount + ' uploaded'"></span>
                <span class="text-red-500 font-semibold" x-show="failCount > 0" x-text="failCount + ' failed'"></span>
            </div>
        </div>

        <div class="px-5 py-4 space-y-4">
            {{-- Current file bar --}}
            <div x-show="!allDone">
                <div class="flex justify-between text-xs text-gray-500 mb-1.5">
                    <span>Current file</span>
                    <span x-text="currentProgress + '%'"></span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                    <div class="bg-[#27AE22] h-2.5 rounded-full transition-all duration-150"
                         :style="'width:' + currentProgress + '%'"></div>
                </div>
            </div>

            {{-- Overall bar --}}
            <div>
                <div class="flex justify-between text-xs text-gray-500 mb-1.5">
                    <span>Overall progress</span>
                    <span x-text="(doneCount + failCount) + ' / ' + queueTotal + ' files — ' + overallPercent + '%'"></span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                    <div class="h-2.5 rounded-full transition-all duration-300"
                         :class="failCount > 0 ? 'bg-amber-500' : 'bg-[#1A237E]'"
                         :style="'width:' + overallPercent + '%'"></div>
                </div>
            </div>

            {{-- Per-file thumbnails / queue --}}
            <div class="flex flex-wrap gap-2 pt-1">
                <template x-for="(f, i) in queue" :key="i">
                    <div class="relative w-10 h-10 rounded-lg overflow-hidden border-2 flex-shrink-0 transition-all"
                         :class="{
                             'border-[#27AE22]': i < queueIndex && !uploadErrors.some(e => (e.name||e) === f.name),
                             'border-red-400':   uploadErrors.some(e => (e.name||e) === f.name) && i < queueIndex,
                             'border-[#1A237E] animate-pulse': i === queueIndex && !allDone,
                             'border-gray-200 opacity-40': i > queueIndex
                         }">
                        <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01"/>
                            </svg>
                        </div>
                        {{-- tick overlay for done --}}
                        <div x-show="i < queueIndex && !uploadErrors.some(e => (e.name||e) === f.name)"
                             class="absolute inset-0 bg-[#27AE22]/80 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        {{-- x overlay for failed --}}
                        <div x-show="uploadErrors.some(e => (e.name||e) === f.name) && i < queueIndex"
                             class="absolute inset-0 bg-red-500/80 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Error list --}}
            <div x-show="uploadErrors.length > 0" class="bg-red-50 border border-red-200 rounded-lg p-3 space-y-1.5 max-h-40 overflow-y-auto">
                <p class="text-xs font-semibold text-red-700">Failed to upload:</p>
                <template x-for="(err, i) in uploadErrors" :key="i">
                    <div class="text-xs text-red-600">
                        <span class="font-medium" x-text="err.name || err"></span>
                        <span class="text-red-400" x-show="err.reason"> — </span>
                        <span class="text-red-500" x-text="err.reason"></span>
                    </div>
                </template>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <div class="flex gap-2 flex-wrap">
        @foreach(['all' => 'All Files', 'image' => 'Images', 'video' => 'Videos'] as $key => $label)
        <a href="{{ route('admin.media.index', ['type' => $key]) }}"
           class="px-4 py-2 text-sm rounded-lg font-medium transition {{ $type === $key ? 'bg-[#1A237E] text-white' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50' }}">
            {{ $label }}
        </a>
        @endforeach
        <form method="GET" action="{{ route('admin.media.index') }}" class="flex gap-2 ml-auto">
            <input type="hidden" name="type" value="{{ $type }}">
            <input type="text" name="search" value="{{ $search }}" placeholder="Search files…"
                   class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#27AE22] focus:outline-none"/>
            <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm rounded-lg hover:bg-gray-200 transition">Search</button>
        </form>
    </div>

    {{-- Grid --}}
    @if($files->isEmpty())
    <div class="bg-white rounded-xl border border-gray-100 p-16 text-center text-gray-400">
        <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <p class="text-sm font-medium">No media files yet.</p>
        <p class="text-xs mt-1">Upload files using the button above or drag & drop them here.</p>
    </div>
    @else
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
        @foreach($files as $file)
        <div class="group relative bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-all cursor-pointer"
             @click="editItem = {{ json_encode(['id'=>$file->id,'url'=>$file->url,'original_name'=>$file->original_name,'alt_text'=>$file->alt_text,'caption'=>$file->caption,'type'=>$file->type,'human_size'=>$file->human_size]) }}; showEdit = true">

            {{-- Thumbnail --}}
            <div class="aspect-square bg-gray-50 flex items-center justify-center overflow-hidden">
                @if($file->type === 'image')
                    <img src="{{ $file->url }}" alt="{{ $file->alt_text ?? $file->original_name }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                @else
                    <div class="flex flex-col items-center gap-2 text-gray-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.87v6.26a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-xs">Video</span>
                    </div>
                @endif
            </div>

            <div class="p-2">
                <p class="text-xs text-gray-600 truncate font-medium">{{ $file->original_name }}</p>
                <p class="text-xs text-gray-400">{{ $file->human_size }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4">{{ $files->links() }}</div>
    @endif

    {{-- Edit Modal --}}
    <div x-show="showEdit" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4" style="display:none;">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden" @click.stop>
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-800" x-text="editItem?.original_name"></h3>
                <button @click="showEdit = false; editItem = null" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-6">
                {{-- Preview --}}
                <div class="bg-gray-50 rounded-xl p-3 mb-4 flex items-center justify-center min-h-[180px]">
                    <template x-if="editItem?.type === 'image'">
                        <img :src="editItem?.url" class="max-h-48 max-w-full object-contain rounded-lg">
                    </template>
                    <template x-if="editItem?.type === 'video'">
                        <video :src="editItem?.url" class="max-h-48 max-w-full rounded-lg" controls></video>
                    </template>
                </div>

                {{-- Copy URL --}}
                <div class="mb-4">
                    <label class="block text-xs font-medium text-gray-600 mb-1">File URL</label>
                    <div class="flex gap-2">
                        <input type="text" :value="editItem?.url" readonly
                               class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-xs font-mono bg-gray-50"/>
                        <button @click="navigator.clipboard.writeText(editItem?.url); $dispatch('show-toast', {message: 'URL copied!', type: 'success'})"
                                class="px-3 py-2 bg-[#1A237E] text-white text-xs rounded-lg hover:bg-[#0D1566] transition">Copy</button>
                    </div>
                </div>

                {{-- Edit form --}}
                <form method="POST" :action="`/admin/media/${editItem?.id}`" class="space-y-3">
                    @csrf @method('PATCH')
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Alt Text</label>
                        <input type="text" name="alt_text" :value="editItem?.alt_text" placeholder="Describe the image for accessibility"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#27AE22] focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Caption</label>
                        <input type="text" name="caption" :value="editItem?.caption" placeholder="Optional caption"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#27AE22] focus:outline-none"/>
                    </div>
                    <div class="flex gap-2 pt-2">
                        <button type="submit" class="flex-1 bg-[#27AE22] text-white text-sm font-semibold py-2 rounded-lg hover:bg-[#1D9418] transition">Save</button>
                        <form method="POST" :action="`/admin/media/${editItem?.id}`" class="flex-1" onsubmit="return confirm('Delete this file permanently?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full bg-red-500 text-white text-sm font-semibold py-2 rounded-lg hover:bg-red-600 transition">Delete</button>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
