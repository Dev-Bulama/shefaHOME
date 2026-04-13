@extends('layouts.client')

@section('title', 'My Documents')
@section('page-title', 'My Documents')

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h2 class="text-[#1A237E] text-2xl font-bold font-['Playfair_Display']">My Documents</h2>
            <p class="text-gray-500 text-sm mt-0.5">
                {{ $documents->count() }} {{ Str::plural('document', $documents->count()) }} in your portfolio
            </p>
        </div>
    </div>

    {{-- Documents Grid --}}
    @if($documents->isEmpty())
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 py-20 px-8 text-center">
        <div class="max-w-sm mx-auto">
            <div class="w-24 h-24 mx-auto mb-5 bg-gray-50 rounded-full flex items-center justify-center border-4 border-gray-100">
                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="text-[#1A237E] text-xl font-bold font-['Playfair_Display'] mb-2">No Documents Yet</h3>
            <p class="text-gray-500 text-sm leading-relaxed">
                Your property documents will appear here once they've been issued and uploaded by SHEFAHOMES.
            </p>
            <p class="text-gray-400 text-xs mt-3">Contact support if you believe documents are missing.</p>
        </div>
    </div>
    @else
    @php
        $typeConfig = [
            'offer_letter'     => ['label' => 'Offer Letter',     'color' => 'bg-blue-100 text-blue-700',   'icon_color' => 'text-blue-500'],
            'receipt'          => ['label' => 'Receipt',          'color' => 'bg-green-100 text-green-700', 'icon_color' => 'text-green-500'],
            'allotment_letter' => ['label' => 'Allotment Letter', 'color' => 'bg-purple-100 text-purple-700','icon_color' => 'text-purple-500'],
            'c_of_o'           => ['label' => 'C of O',           'color' => 'bg-[#27AE22]/10 text-[#b8963e]', 'icon_color' => 'text-[#27AE22]'],
            'id'               => ['label' => 'ID Document',      'color' => 'bg-gray-100 text-gray-600',   'icon_color' => 'text-gray-500'],
            'proof_of_address' => ['label' => 'Proof of Address', 'color' => 'bg-teal-100 text-teal-700',   'icon_color' => 'text-teal-500'],
            'other'            => ['label' => 'Document',         'color' => 'bg-gray-100 text-gray-600',   'icon_color' => 'text-gray-500'],
        ];
    @endphp
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($documents as $document)
        @php
            $typeKey = strtolower(str_replace([' ', '-'], '_', $document->document_type ?? 'other'));
            $config = $typeConfig[$typeKey] ?? $typeConfig['other'];
            $isPdf = str_contains(strtolower($document->file_path ?? $document->file_url ?? ''), '.pdf');
            $ext = strtoupper(pathinfo($document->file_path ?? $document->file_url ?? 'doc', PATHINFO_EXTENSION) ?: 'DOC');
        @endphp
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200 p-5 group">

            {{-- Document Icon & Badge --}}
            <div class="flex items-start justify-between mb-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center
                    {{ $isPdf ? 'bg-red-50' : 'bg-blue-50' }} flex-shrink-0">
                    @if($isPdf)
                    <svg class="w-7 h-7 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                    </svg>
                    @else
                    <svg class="w-7 h-7 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                    </svg>
                    @endif
                </div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $config['color'] }}">
                    {{ $config['label'] }}
                </span>
            </div>

            {{-- Document Info --}}
            <div class="mb-4">
                <h4 class="text-[#1A237E] font-bold text-sm leading-snug mb-1 line-clamp-2">
                    {{ $document->title ?? ucwords(str_replace('_', ' ', $typeKey)) }}
                </h4>
                @if($document->property)
                <p class="text-gray-500 text-xs flex items-center gap-1">
                    <svg class="w-3 h-3 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    {{ $document->property->name ?? '' }}
                </p>
                @endif
                <p class="text-gray-400 text-xs mt-1 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Uploaded {{ $document->created_at ? \Carbon\Carbon::parse($document->created_at)->format('M j, Y') : 'N/A' }}
                </p>
            </div>

            {{-- File Format Tag & Download --}}
            <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                <span class="text-xs text-gray-400 font-mono font-semibold bg-gray-100 px-2 py-0.5 rounded">
                    {{ $ext }}
                </span>
                <a href="{{ route('client.documents.download', $document->id) }}"
                   class="inline-flex items-center gap-1.5 bg-[#1A237E] hover:bg-[#152238] text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Download
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- Upload Section --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-[#1A237E]/5 border-b border-gray-100 px-6 py-4 flex items-center gap-3">
            <div class="w-8 h-8 bg-[#27AE22]/10 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                </svg>
            </div>
            <div>
                <h3 class="text-[#1A237E] font-bold text-base font-['Playfair_Display']">Upload Supporting Documents</h3>
                <p class="text-gray-500 text-xs">Submit KYC documents &mdash; National ID, proof of address, etc.</p>
            </div>
        </div>

        <div class="p-6" x-data="{
            files: [],
            dragOver: false,
            handleDrop(e) {
                this.dragOver = false;
                this.files = Array.from(e.dataTransfer.files);
            },
            handleInput(e) {
                this.files = Array.from(e.target.files);
            },
            removeFile(i) {
                this.files.splice(i, 1);
            }
        }">
            <form action="{{ route('client.documents.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5">
                            Document Type <span class="text-red-500">*</span>
                        </label>
                        <select name="document_type" required
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 focus:ring-2 focus:ring-[#27AE22]/30 focus:border-[#27AE22] outline-none bg-white">
                            <option value="">Select document type...</option>
                            <option value="id">National ID / International Passport / Driver's License</option>
                            <option value="proof_of_address">Proof of Address (Utility Bill, Bank Statement)</option>
                            <option value="other">Other Supporting Document</option>
                        </select>
                        @error('document_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5">
                            Document Title <span class="text-gray-400 font-normal">(optional)</span>
                        </label>
                        <input type="text" name="title"
                               placeholder="e.g. National ID Card"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 focus:ring-2 focus:ring-[#27AE22]/30 focus:border-[#27AE22] outline-none">
                    </div>
                </div>

                {{-- Drag & Drop File Input --}}
                <div class="mb-5">
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5">
                        File(s) <span class="text-red-500">*</span>
                    </label>
                    <div class="border-2 border-dashed rounded-xl p-8 text-center cursor-pointer transition-colors"
                         :class="dragOver ? 'border-[#27AE22] bg-[#27AE22]/5' : 'border-gray-200 hover:border-[#27AE22]/50 hover:bg-gray-50'"
                         @click="$refs.fileInput.click()"
                         @dragover.prevent="dragOver = true"
                         @dragleave="dragOver = false"
                         @drop.prevent="handleDrop($event)">
                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <p class="text-gray-600 text-sm font-medium">Click to upload or drag & drop</p>
                        <p class="text-gray-400 text-xs mt-1">PDF, JPG, PNG up to 10MB per file</p>
                        <input type="file" x-ref="fileInput" name="files[]" multiple
                               accept=".pdf,.jpg,.jpeg,.png"
                               @change="handleInput($event)"
                               class="hidden">
                    </div>

                    {{-- Selected Files List --}}
                    <div x-show="files.length > 0" class="mt-3 space-y-2">
                        <template x-for="(file, index) in files" :key="index">
                            <div class="flex items-center justify-between bg-gray-50 border border-gray-100 rounded-lg px-3 py-2">
                                <div class="flex items-center gap-2 min-w-0">
                                    <svg class="w-4 h-4 text-[#27AE22] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-gray-700 text-xs font-medium truncate" x-text="file.name"></span>
                                    <span class="text-gray-400 text-xs flex-shrink-0" x-text="(file.size / 1024).toFixed(1) + ' KB'"></span>
                                </div>
                                <button type="button" @click="removeFile(index)" class="text-gray-400 hover:text-red-500 transition-colors flex-shrink-0 ml-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </template>
                    </div>
                    @error('files.*')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="flex items-center gap-3">
                    <button type="submit"
                            class="inline-flex items-center gap-2 bg-[#27AE22] hover:bg-[#b8963e] text-white font-semibold px-6 py-3 rounded-xl transition-colors text-sm shadow-md shadow-[#27AE22]/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        Upload Document(s)
                    </button>
                    <p class="text-gray-400 text-xs">Our team will review and categorize your submission.</p>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
