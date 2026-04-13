@extends('layouts.admin')

@section('page-title', 'Navigation Menus')
@section('breadcrumb', 'Manage header & footer navigation links')

@section('content')
<div x-data="{ showForm: false, editItem: null, editMode: false }" class="space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-800">Navigation Menus</h1>
            <p class="text-sm text-gray-500 mt-0.5">Add custom links to the site header and footer navigation.</p>
        </div>
        <button @click="showForm = !showForm; editMode = false; editItem = null"
            class="inline-flex items-center gap-2 px-4 py-2 bg-[#27AE22] text-[#1A237E] text-sm font-semibold rounded-lg hover:bg-[#4ADE80] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Menu Item
        </button>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">{{ session('success') }}</div>
    @endif

    {{-- Add / Edit Form --}}
    <div x-show="showForm" x-transition class="bg-white rounded-xl shadow-sm border border-gray-100 p-6" style="display:none;">
        <h2 class="text-base font-semibold text-gray-800 mb-5" x-text="editMode ? 'Edit Menu Item' : 'Add New Menu Item'"></h2>

        {{-- ADD FORM --}}
        <form x-show="!editMode" method="POST" action="{{ route('admin.navigation.store') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Label <span class="text-red-500">*</span></label>
                    <input type="text" name="label" required placeholder="e.g. Our Services"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">URL <span class="text-red-500">*</span></label>
                    <input type="text" name="url" required placeholder="e.g. /our-services or https://..."
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Location <span class="text-red-500">*</span></label>
                    <select name="location" required
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">
                        <option value="header">Header Navigation</option>
                        <option value="footer">Footer</option>
                        <option value="both">Both</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Parent Item <span class="text-gray-400">(optional sub-menu)</span></label>
                    <select name="parent_id"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">
                        <option value="">— Top level —</option>
                        @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end gap-6 pb-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="opens_new_tab" value="1" class="w-4 h-4 text-amber-500 rounded border-gray-300"/>
                        <span class="text-sm text-gray-700">Open in new tab</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-amber-500 rounded border-gray-300"/>
                        <span class="text-sm text-gray-700">Active</span>
                    </label>
                </div>
            </div>
            <div class="flex gap-3 mt-5">
                <button type="submit" class="px-6 py-2 bg-[#1A237E] text-white text-sm font-semibold rounded-lg hover:bg-[#1A237E]/90 transition">
                    Add Item
                </button>
                <button type="button" @click="showForm=false" class="px-6 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">
                    Cancel
                </button>
            </div>
        </form>

        {{-- EDIT FORM --}}
        <form x-show="editMode" method="POST" :action="`/admin/navigation/${editItem?.id}`">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Label</label>
                    <input type="text" name="label" :value="editItem?.label" required
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">URL</label>
                    <input type="text" name="url" :value="editItem?.url" required
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                    <select name="location"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">
                        <option value="header" :selected="editItem?.location === 'header'">Header Navigation</option>
                        <option value="footer" :selected="editItem?.location === 'footer'">Footer</option>
                        <option value="both" :selected="editItem?.location === 'both'">Both</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Parent Item</label>
                    <select name="parent_id"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">
                        <option value="">— Top level —</option>
                        @foreach($items as $item)
                        <option value="{{ $item->id }}" :selected="editItem?.parent_id == {{ $item->id }}">{{ $item->label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end gap-6 pb-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="opens_new_tab" value="1" :checked="editItem?.opens_new_tab"
                            class="w-4 h-4 text-amber-500 rounded border-gray-300"/>
                        <span class="text-sm text-gray-700">Open in new tab</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" :checked="editItem?.is_active"
                            class="w-4 h-4 text-amber-500 rounded border-gray-300"/>
                        <span class="text-sm text-gray-700">Active</span>
                    </label>
                </div>
            </div>
            <div class="flex gap-3 mt-5">
                <button type="submit" class="px-6 py-2 bg-[#27AE22] text-[#1A237E] text-sm font-semibold rounded-lg hover:bg-[#4ADE80] transition">
                    Save Changes
                </button>
                <button type="button" @click="showForm=false; editMode=false; editItem=null"
                    class="px-6 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">
                    Cancel
                </button>
            </div>
        </form>
    </div>

    {{-- Items Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        @if($items->isEmpty())
        <div class="text-center py-16 text-gray-400">
            <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h7"/>
            </svg>
            <p class="text-sm font-medium">No menu items yet.</p>
            <p class="text-xs mt-1">Add your first item using the button above.</p>
        </div>
        @else

        {{-- Header section --}}
        @php
            $headerItems = $items->filter(fn($i) => in_array($i->location, ['header','both']));
            $footerItems = $items->filter(fn($i) => in_array($i->location, ['footer','both']));
        @endphp

        @foreach([['Header Navigation', $headerItems, 'bg-blue-50 text-blue-700'], ['Footer Links', $footerItems, 'bg-gray-50 text-gray-700']] as [$sectionTitle, $sectionItems, $badge])
        @if($sectionItems->isNotEmpty())
        <div class="border-b border-gray-100 last:border-0">
            <div class="px-6 py-3 bg-gray-50 border-b border-gray-100 flex items-center gap-2">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">{{ $sectionTitle }}</span>
                <span class="text-xs px-2 py-0.5 rounded-full {{ $badge }}">{{ $sectionItems->count() }} items</span>
            </div>
            <table class="w-full text-sm">
                <thead class="bg-gray-50/50 text-xs text-gray-500 uppercase">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium">Label</th>
                        <th class="px-6 py-3 text-left font-medium hidden sm:table-cell">URL</th>
                        <th class="px-6 py-3 text-left font-medium hidden md:table-cell">Parent</th>
                        <th class="px-6 py-3 text-center font-medium">Status</th>
                        <th class="px-6 py-3 text-right font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($sectionItems as $item)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-3.5 font-medium text-gray-800">
                            {{ $item->label }}
                            @if($item->opens_new_tab)
                            <svg class="w-3 h-3 inline ml-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            @endif
                        </td>
                        <td class="px-6 py-3.5 text-gray-500 hidden sm:table-cell">
                            <span class="font-mono text-xs">{{ Str::limit($item->url, 45) }}</span>
                        </td>
                        <td class="px-6 py-3.5 text-gray-500 hidden md:table-cell">
                            {{ $item->parent?->label ?? '—' }}
                        </td>
                        <td class="px-6 py-3.5 text-center">
                            @if($item->is_active)
                            <span class="inline-flex items-center gap-1 text-xs font-medium text-green-700 bg-green-50 px-2 py-0.5 rounded-full">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Active
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 text-xs font-medium text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full">
                                <span class="w-1.5 h-1.5 bg-gray-400 rounded-full"></span> Hidden
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-3.5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button
                                    @click="editItem = {{ json_encode(['id'=>$item->id,'label'=>$item->label,'url'=>$item->url,'location'=>$item->location,'parent_id'=>$item->parent_id,'opens_new_tab'=>$item->opens_new_tab,'is_active'=>$item->is_active]) }}; editMode = true; showForm = true"
                                    class="text-xs px-3 py-1.5 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
                                    Edit
                                </button>
                                <form method="POST" action="{{ route('admin.navigation.destroy', $item->id) }}"
                                    onsubmit="return confirm('Delete this menu item?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs px-3 py-1.5 rounded-lg border border-red-100 text-red-500 hover:bg-red-50 transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @if($item->children->isNotEmpty())
                    @foreach($item->children as $child)
                    <tr class="bg-gray-50/30 hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-2.5 text-gray-600 pl-10">
                            <span class="text-gray-300 mr-1">└</span> {{ $child->label }}
                        </td>
                        <td class="px-6 py-2.5 text-gray-400 hidden sm:table-cell">
                            <span class="font-mono text-xs">{{ Str::limit($child->url, 45) }}</span>
                        </td>
                        <td class="px-6 py-2.5 text-gray-400 hidden md:table-cell text-xs">sub-item</td>
                        <td class="px-6 py-2.5 text-center">
                            @if($child->is_active)
                            <span class="inline-flex items-center gap-1 text-xs font-medium text-green-700 bg-green-50 px-2 py-0.5 rounded-full">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Active
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 text-xs font-medium text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full">Hidden</span>
                            @endif
                        </td>
                        <td class="px-6 py-2.5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button
                                    @click="editItem = {{ json_encode(['id'=>$child->id,'label'=>$child->label,'url'=>$child->url,'location'=>$child->location,'parent_id'=>$child->parent_id,'opens_new_tab'=>$child->opens_new_tab,'is_active'=>$child->is_active]) }}; editMode = true; showForm = true"
                                    class="text-xs px-3 py-1.5 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
                                    Edit
                                </button>
                                <form method="POST" action="{{ route('admin.navigation.destroy', $child->id) }}"
                                    onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs px-3 py-1.5 rounded-lg border border-red-100 text-red-500 hover:bg-red-50 transition">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        @endforeach

        @endif
    </div>

    {{-- Help card --}}
    <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 text-sm text-blue-800">
        <p class="font-semibold mb-1">How navigation works</p>
        <ul class="list-disc list-inside space-y-1 text-xs text-blue-700">
            <li>The navbar is <strong>fully driven by this list</strong> — every link shown on the website comes from here.</li>
            <li><strong>Top-level items</strong> with no parent appear directly in the navigation bar.</li>
            <li><strong>Items with children</strong> (sub-items) automatically render as dropdowns.</li>
            <li><strong>Footer</strong> items appear in the footer quick-links column.</li>
            <li>You can add, edit, reorder (by sort_order), enable/disable any link including the default ones.</li>
            <li>Use <code>#</code> as the URL for a dropdown parent that has no destination of its own.</li>
        </ul>
    </div>

</div>
@endsection
