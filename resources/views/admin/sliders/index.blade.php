@extends('layouts.admin')

@section('page-title', 'Sliders')

@section('content')
<div class="space-y-4">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h1 class="text-xl font-bold text-gray-800">Homepage Sliders</h1>
        <a href="{{ route('admin.sliders.create') }}"
            class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Slider
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <p class="text-sm text-gray-500">Drag rows to reorder sliders. Changes are saved automatically.</p>
        </div>

        <ul id="sortableList" class="divide-y divide-gray-100">
            @forelse($sliders ?? [] as $slider)
            <li class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 transition cursor-grab active:cursor-grabbing"
                data-id="{{ $slider->id }}">
                <div class="text-gray-300 hover:text-gray-500 flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/>
                    </svg>
                </div>
                <div class="flex-shrink-0">
                    @if($slider->image)
                    <img src="{{ Storage::url($slider->image) }}" alt="{{ $slider->title }}"
                        class="w-24 h-14 object-cover rounded-lg"/>
                    @else
                    <div class="w-24 h-14 bg-gray-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-medium text-gray-800 truncate">{{ $slider->title }}</p>
                    @if($slider->subtitle)
                    <p class="text-xs text-gray-400 truncate mt-0.5">{{ $slider->subtitle }}</p>
                    @endif
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-xs px-2 py-0.5 rounded-full {{ $slider->position ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-500' }}">
                            {{ $slider->position ?? 'Center' }}
                        </span>
                        <span class="text-xs px-2 py-0.5 rounded-full {{ $slider->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                            {{ $slider->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                    <a href="{{ route('admin.sliders.edit', $slider) }}"
                        class="text-xs text-blue-600 hover:text-blue-800 font-medium px-3 py-1.5 border border-blue-100 rounded-lg hover:bg-blue-50 transition">Edit</a>
                    <form method="POST" action="{{ route('admin.sliders.destroy', $slider) }}"
                        onsubmit="return confirm('Delete this slider?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-medium px-3 py-1.5 border border-red-100 rounded-lg hover:bg-red-50 transition">Delete</button>
                    </form>
                </div>
            </li>
            @empty
            <li class="px-6 py-12 text-center">
                <svg class="w-10 h-10 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-gray-400 text-sm">No sliders yet. Add one to get started.</p>
            </li>
            @endforelse
        </ul>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
const list = document.getElementById('sortableList');
if (list) {
    Sortable.create(list, {
        animation: 150,
        ghostClass: 'bg-amber-50',
        onEnd: function () {
            const ids = [...list.querySelectorAll('[data-id]')].map(el => el.dataset.id);
            fetch('{{ route('admin.sliders.reorder') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ ids })
            });
        }
    });
}
</script>
@endpush
