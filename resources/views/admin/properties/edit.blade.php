@extends('layouts.admin')

@section('page-title', 'Edit Property')

@section('content')
<div x-data="propertyForm()" class="space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-800">Edit Property</h1>
            <p class="text-sm text-gray-500 mt-0.5">{{ $property->title }}</p>
        </div>
        <a href="{{ route('admin.properties.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back to Properties</a>
    </div>

    <form method="POST" action="{{ route('admin.properties.update', $property) }}" enctype="multipart/form-data" id="propertyForm">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="border-b border-gray-100 flex overflow-x-auto">
                @foreach(['basic' => 'Basic Info', 'pricing' => 'Pricing', 'media' => 'Media', 'settings' => 'Settings'] as $tab => $label)
                <button type="button" @click="activeTab = '{{ $tab }}'"
                    :class="activeTab === '{{ $tab }}' ? 'border-b-2 border-amber-500 text-amber-600' : 'text-gray-500 hover:text-gray-700'"
                    class="px-6 py-4 text-sm font-medium whitespace-nowrap transition focus:outline-none">
                    {{ $label }}
                </button>
                @endforeach
            </div>

            {{-- Basic Info --}}
            <div x-show="activeTab === 'basic'" class="p-6 space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Property Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $property->title) }}" required
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none @error('title') border-red-400 @enderror"/>
                        @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">State <span class="text-red-500">*</span></label>
                        <input type="text" name="state" value="{{ old('state', $property->state) }}" required
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none @error('state') border-red-400 @enderror"/>
                        @error('state')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">City / LGA <span class="text-red-500">*</span></label>
                        <input type="text" name="lga" value="{{ old('lga', $property->lga) }}" required
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none @error('lga') border-red-400 @enderror"/>
                        @error('lga')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Property Type <span class="text-red-500">*</span></label>
                        <select name="property_type_id" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">
                            <option value="">Select type…</option>
                            @foreach($propertyTypes as $pt)
                            <option value="{{ $pt->id }}" {{ old('property_type_id', $property->property_type_id) == $pt->id ? 'selected' : '' }}>{{ $pt->name }}</option>
                            @endforeach
                        </select>
                        @error('property_type_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estate</label>
                        <select name="estate_id" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">
                            <option value="">No estate</option>
                            @foreach($estates as $estate)
                            <option value="{{ $estate->id }}" {{ old('estate_id', $property->estate_id) == $estate->id ? 'selected' : '' }}>{{ $estate->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Plot Sizes (comma-separated)</label>
                        <input type="text" name="plot_sizes" value="{{ old('plot_sizes', is_array($property->plot_sizes) ? implode(', ', $property->plot_sizes) : $property->plot_sizes) }}"
                            placeholder="e.g. 300sqm, 450sqm"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Short Summary <span class="text-red-500">*</span></label>
                        <textarea name="short_description" rows="2" required maxlength="500"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none @error('short_description') border-red-400 @enderror">{{ old('short_description', $property->short_description) }}</textarea>
                        @error('short_description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <div id="descriptionEditor" class="border border-gray-200 rounded-lg min-h-[200px]">{!! old('description', $property->description) !!}</div>
                        <input type="hidden" name="description" id="descriptionInput"/>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Address / Landmark</label>
                        <input type="text" name="address" value="{{ old('address', $property->address) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Google Maps URL</label>
                        <input type="url" name="map_url" value="{{ old('map_url', $property->map_url) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Virtual Tour URL</label>
                        <input type="url" name="tour_url" value="{{ old('tour_url', $property->tour_url) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                </div>
            </div>

            {{-- Pricing --}}
            <div x-show="activeTab === 'pricing'" class="p-6 space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price From (₦) <span class="text-red-500">*</span></label>
                        <input type="number" name="price_from" value="{{ old('price_from', $property->price_from) }}" step="0.01" min="0" required
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none @error('price_from') border-red-400 @enderror"/>
                        @error('price_from')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price To (₦) <span class="text-xs text-gray-400">optional</span></label>
                        <input type="number" name="price_to" value="{{ old('price_to', $property->price_to) }}" step="0.01" min="0"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Initial Deposit (₦)</label>
                        <input type="number" name="initial_deposit" value="{{ old('initial_deposit', $property->initial_deposit) }}" step="0.01" min="0"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Service Charge (₦/yr)</label>
                        <input type="number" name="service_charge" value="{{ old('service_charge', $property->service_charge) }}" step="0.01" min="0"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <label class="block text-sm font-medium text-gray-700">Payment Plans</label>
                        <button type="button" @click="addPlan()"
                            class="text-xs bg-amber-500 hover:bg-amber-600 text-white px-3 py-1.5 rounded-lg font-medium transition">
                            + Add Plan
                        </button>
                    </div>
                    <div class="space-y-3">
                        <template x-for="(plan, index) in plans" :key="index">
                            <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1">Plan Name</label>
                                        <input type="text" x-model="plan.name"
                                            class="w-full border border-gray-200 rounded px-2 py-1.5 text-sm focus:ring-1 focus:ring-amber-400 focus:outline-none bg-white"/>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1">Duration (months)</label>
                                        <input type="number" x-model="plan.duration" min="1"
                                            class="w-full border border-gray-200 rounded px-2 py-1.5 text-sm focus:ring-1 focus:ring-amber-400 focus:outline-none bg-white"/>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1">Monthly (₦)</label>
                                        <input type="number" x-model="plan.monthly_amount" step="0.01"
                                            class="w-full border border-gray-200 rounded px-2 py-1.5 text-sm focus:ring-1 focus:ring-amber-400 focus:outline-none bg-white"/>
                                    </div>
                                    <div class="flex items-end">
                                        <button type="button" @click="removePlan(index)"
                                            class="w-full text-xs text-red-500 hover:text-red-700 border border-red-200 rounded px-2 py-1.5 transition">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <p x-show="plans.length === 0" class="text-sm text-gray-400 text-center py-4 border border-dashed border-gray-200 rounded-lg">
                            No payment plans added.
                        </p>
                    </div>
                    <input type="hidden" name="payment_plans_json" :value="JSON.stringify(plans)"/>
                </div>
            </div>

            {{-- Media --}}
            <div x-show="activeTab === 'media'" class="p-6 space-y-5">
                {{-- Current Cover --}}
                @if($property->cover_image)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Cover Image</label>
                    <img src="{{ Storage::url($property->cover_image) }}" class="h-40 object-cover rounded-xl border"/>
                </div>
                @endif
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Replace Cover Image</label>
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center">
                        <img id="coverPreview" src="#" alt="" class="mx-auto mb-3 h-40 object-cover rounded-lg hidden"/>
                        <p id="coverPlaceholder" class="text-gray-400 text-sm mb-3">Click to select a new cover image</p>
                        <input type="file" name="cover_image" id="coverImage" accept="image/*" class="hidden" onchange="previewCover(this)"/>
                        <label for="coverImage" class="cursor-pointer bg-amber-500 hover:bg-amber-600 text-white text-sm px-4 py-2 rounded-lg font-medium transition">Choose Image</label>
                    </div>
                </div>

                {{-- Gallery --}}
                @if($property->gallery && count($property->gallery))
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Gallery</label>
                    <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                        @foreach($property->gallery as $img)
                        <div class="relative group">
                            <img src="{{ Storage::url($img) }}" class="h-20 w-full object-cover rounded-lg"/>
                            <label class="absolute top-1 right-1 cursor-pointer">
                                <input type="checkbox" name="remove_gallery[]" value="{{ $img }}"
                                    class="w-4 h-4 rounded bg-white opacity-0 group-hover:opacity-100 transition"/>
                                <span class="block w-5 h-5 bg-red-500 text-white text-xs flex items-center justify-center rounded opacity-0 group-hover:opacity-100 transition">×</span>
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Hover over an image to check it for removal.</p>
                </div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Add More Gallery Images</label>
                    <input type="file" name="gallery[]" multiple accept="image/*"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100"/>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Video URL</label>
                    <input type="url" name="video_url" value="{{ old('video_url', $property->video_url) }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Brochure (PDF) — leave blank to keep existing</label>
                    <input type="file" name="brochure" accept=".pdf"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100"/>
                </div>
            </div>

            {{-- Settings --}}
            <div x-show="activeTab === 'settings'" class="p-6 space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                        <select name="status" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">
                            <optgroup label="Listing Type">
                                @foreach(['rent' => 'Rent', 'buy' => 'Buy', 'buy_and_rent' => 'Buy and Rent', 'shortlet' => 'Shortlet'] as $val => $lbl)
                                <option value="{{ $val }}" {{ old('status', $property->status) == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                                @endforeach
                            </optgroup>
                            <optgroup label="Availability">
                                @foreach(['available' => 'Available', 'sold_out' => 'Sold Out', 'coming_soon' => 'Coming Soon'] as $val => $lbl)
                                <option value="{{ $val }}" {{ old('status', $property->status) == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">URL Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $property->slug) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $property->meta_title) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                        <textarea name="meta_description" rows="2" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">{{ old('meta_description', $property->meta_description) }}</textarea>
                    </div>
                    <div class="flex items-center gap-3">
                        <input type="hidden" name="is_featured" value="0"/>
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $property->is_featured) ? 'checked' : '' }}
                            class="w-4 h-4 text-amber-500 rounded border-gray-300 focus:ring-amber-400"/>
                        <label for="is_featured" class="text-sm font-medium text-gray-700">Feature on homepage</label>
                    </div>
                    <div class="flex items-center gap-3">
                        <input type="hidden" name="is_active" value="0"/>
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $property->is_active) ? 'checked' : '' }}
                            class="w-4 h-4 text-amber-500 rounded border-gray-300 focus:ring-amber-400"/>
                        <label for="is_active" class="text-sm font-medium text-gray-700">Active (visible on website)</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.properties.index') }}" class="px-5 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition">Cancel</a>
            <button type="submit" onclick="syncDescription()"
                class="px-6 py-2.5 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-lg font-semibold transition shadow-sm">
                Update Property
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css">
<script>
function propertyForm() {
    return {
        activeTab: 'basic',
        plans: @json(old('payment_plans_json') ? json_decode(old('payment_plans_json'), true) : json_decode($property->payment_plans ?? '[]', true)),
        addPlan() { this.plans.push({ name: '', duration: '', monthly_amount: '' }); },
        removePlan(i) { this.plans.splice(i, 1); }
    };
}
const quill = new Quill('#descriptionEditor', {
    theme: 'snow',
    modules: { toolbar: [['bold','italic','underline'],['blockquote'],['link'],['image'],[{list:'ordered'},{list:'bullet'}],[{header:[1,2,3,false]}]] }
});
function syncDescription() {
    document.getElementById('descriptionInput').value = quill.root.innerHTML;
}
function previewCover(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const p = document.getElementById('coverPreview');
            p.src = e.target.result; p.classList.remove('hidden');
            document.getElementById('coverPlaceholder').classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
document.getElementById('propertyForm').addEventListener('submit', syncDescription);
</script>
@endpush
