@extends('layouts.admin')

@section('page-title', 'Team Members')
@section('breadcrumb', 'Drag cards to reorder')

@section('content')
<div class="space-y-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-xl font-bold text-gray-800">Team Members</h1>
            <p class="text-sm text-gray-500 mt-0.5">Drag cards to reorder. Changes save automatically.</p>
        </div>
        <a href="{{ route('admin.team.create') }}"
            class="inline-flex items-center gap-2 bg-[#27AE22] hover:bg-[#1D9418] text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Member
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">{{ session('success') }}</div>
    @endif

    @if(($members ?? collect())->isEmpty())
    <div class="bg-white rounded-xl border border-gray-100 p-16 text-center text-gray-400">
        <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
        </svg>
        <p class="text-sm font-medium">No team members yet.</p>
        <a href="{{ route('admin.team.create') }}" class="text-[#27AE22] text-sm mt-1 inline-block">Add your first member →</a>
    </div>
    @else

    <div id="teamGrid"
         class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
        @foreach($members as $member)
        <div class="team-card group relative bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-all cursor-grab active:cursor-grabbing select-none"
             data-id="{{ $member->id }}">

            {{-- Drag handle indicator --}}
            <div class="absolute top-2 left-2 z-10 opacity-0 group-hover:opacity-60 transition-opacity">
                <svg class="w-4 h-4 text-white drop-shadow" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 6a2 2 0 100-4 2 2 0 000 4zM8 14a2 2 0 100-4 2 2 0 000 4zM8 22a2 2 0 100-4 2 2 0 000 4zM16 6a2 2 0 100-4 2 2 0 000 4zM16 14a2 2 0 100-4 2 2 0 000 4zM16 22a2 2 0 100-4 2 2 0 000 4z"/>
                </svg>
            </div>

            {{-- Status badges --}}
            <div class="absolute top-2 right-2 z-10 flex flex-col gap-1">
                @if($member->is_featured)
                <span class="bg-[#27AE22] text-white text-xs px-1.5 py-0.5 rounded-full font-medium leading-none">★</span>
                @endif
                @if(!$member->is_active)
                <span class="bg-gray-500 text-white text-xs px-1.5 py-0.5 rounded-full font-medium leading-none">Off</span>
                @endif
            </div>

            {{-- Photo --}}
            <div class="aspect-square bg-gray-100 overflow-hidden">
                <img src="{{ $member->photo_url }}" alt="{{ $member->name }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            </div>

            {{-- Info --}}
            <div class="p-3">
                <p class="text-xs font-bold text-gray-800 truncate">{{ $member->name }}</p>
                <p class="text-xs text-[#27AE22] truncate mt-0.5">{{ $member->position }}</p>
                @if($member->department)
                <p class="text-xs text-gray-400 truncate">{{ $member->department }}</p>
                @endif
            </div>

            {{-- Hover overlay with actions --}}
            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2 pointer-events-none group-hover:pointer-events-auto">
                <a href="{{ route('admin.team.edit', $member) }}"
                   class="bg-white text-gray-800 text-xs font-semibold px-3 py-1.5 rounded-lg hover:bg-gray-100 transition"
                   onclick="event.stopPropagation()">
                    Edit
                </a>
                <form method="POST" action="{{ route('admin.team.destroy', $member) }}"
                      onsubmit="return confirm('Delete {{ addslashes($member->name) }}?')"
                      onclick="event.stopPropagation()">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white text-xs font-semibold px-3 py-1.5 rounded-lg hover:bg-red-600 transition">
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.3/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const grid = document.getElementById('teamGrid');
    if (!grid) return;

    let saveTimeout;

    Sortable.create(grid, {
        animation: 200,
        ghostClass: 'opacity-40',
        dragClass: 'shadow-2xl',
        onEnd: function () {
            clearTimeout(saveTimeout);
            saveTimeout = setTimeout(saveOrder, 300);
        }
    });

    function saveOrder() {
        const ids = [...grid.querySelectorAll('.team-card')].map(el => el.dataset.id);
        fetch('{{ route('admin.team.reorder') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
            },
            body: JSON.stringify({ ids })
        }).then(r => r.json()).then(data => {
            if (data.success) {
                window.dispatchEvent(new CustomEvent('show-toast', { detail: { message: 'Order saved', type: 'success' } }));
            }
        }).catch(() => {
            window.dispatchEvent(new CustomEvent('show-toast', { detail: { message: 'Failed to save order', type: 'error' } }));
        });
    }
});
</script>
@endpush
