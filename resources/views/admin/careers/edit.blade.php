@extends('layouts.admin')

@section('page-title', 'Edit Job')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-bold text-gray-800">Edit Job: {{ $job->title }}</h1>
        <a href="{{ route('admin.careers.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back</a>
    </div>

    <form method="POST" action="{{ route('admin.careers.update', $job) }}" id="careerForm">
        @csrf
        @method('PUT')
        @include('admin.careers._form', ['job' => $job])
        <div class="flex items-center justify-end gap-3 mt-4">
            <a href="{{ route('admin.careers.index') }}" class="px-5 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition">Cancel</a>
            <button type="submit" onclick="syncEditors()" class="px-6 py-2.5 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-lg font-semibold transition shadow-sm">
                Update Job
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css">
<script>
const descQ = new Quill('#descEditor', { theme:'snow', modules:{ toolbar:[['bold','italic'],['blockquote'],[{list:'ordered'},{list:'bullet'}],['link'],['clean']] } });
const reqQ  = new Quill('#reqEditor',  { theme:'snow', modules:{ toolbar:[['bold','italic'],['blockquote'],[{list:'ordered'},{list:'bullet'}],['link'],['clean']] } });
function syncEditors() {
    document.getElementById('descInput').value = descQ.root.innerHTML;
    document.getElementById('reqInput').value  = reqQ.root.innerHTML;
}
document.getElementById('careerForm').addEventListener('submit', syncEditors);
</script>
@endpush
