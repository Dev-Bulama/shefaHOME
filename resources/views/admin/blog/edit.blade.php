@extends('layouts.admin')

@section('page-title', 'Edit Post')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-bold text-gray-800">Edit Post</h1>
        <a href="{{ route('admin.blog.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back</a>
    </div>

    <form method="POST" action="{{ route('admin.blog.update', $post) }}" enctype="multipart/form-data" id="blogForm">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-5">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Post Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $post->title) }}" required
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none @error('title') border-red-400 @enderror"/>
                        @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Excerpt</label>
                        <textarea name="excerpt" rows="2"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">{{ old('excerpt', $post->excerpt) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Body Content <span class="text-red-500">*</span></label>
                        <div id="bodyEditor" class="border border-gray-200 rounded-lg min-h-[300px]">{!! old('body', $post->body) !!}</div>
                        <input type="hidden" name="body" id="bodyInput"/>
                        @error('body')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">
                    <h3 class="text-sm font-semibold text-gray-700">SEO / Meta</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $post->meta_title) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                        <textarea name="meta_description" rows="2"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">{{ old('meta_description', $post->meta_description) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">URL Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $post->slug) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                </div>
            </div>

            <div class="space-y-5">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 space-y-4">
                    <h3 class="text-sm font-semibold text-gray-700">Publish Settings</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">
                            <option value="draft"     {{ old('status', $post->status) == 'draft'     ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Published Date</label>
                        <input type="datetime-local" name="published_at"
                            value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select name="category_id" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">
                            <option value="">Select category…</option>
                            @foreach($categories ?? [] as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $post->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 space-y-4">
                    <h3 class="text-sm font-semibold text-gray-700">Featured Image</h3>
                    @if($post->featured_image)
                    <img src="{{ Storage::url($post->featured_image) }}" class="w-full h-32 object-cover rounded-lg border"/>
                    @endif
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center">
                        <img id="featuredPreview" src="#" alt="" class="mx-auto mb-2 w-full h-32 object-cover rounded-lg hidden"/>
                        <p id="featuredPlaceholder" class="text-gray-400 text-xs mb-2">Click to replace image</p>
                        <input type="file" name="featured_image" id="featuredImage" accept="image/*"
                            class="hidden" onchange="previewFeatured(this)"/>
                        <label for="featuredImage" class="cursor-pointer text-xs text-amber-600 font-medium hover:text-amber-700 border border-amber-200 rounded-lg px-3 py-1.5 transition hover:bg-amber-50">
                            Choose Image
                        </label>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.blog.index') }}" class="flex-1 text-center px-4 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition">Cancel</a>
                    <button type="submit" onclick="syncBody()" class="flex-1 px-4 py-2.5 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-lg font-semibold transition shadow-sm">
                        Update Post
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css">
<script>
const quill = new Quill('#bodyEditor', {
    theme: 'snow',
    modules: { toolbar: [['bold','italic','underline','strike'],['blockquote','code-block'],['link','image','video'],[{header:[1,2,3,false]}],[{list:'ordered'},{list:'bullet'}],[{color:[]},{background:[]}],['clean']] }
});
function syncBody() { document.getElementById('bodyInput').value = quill.root.innerHTML; }
function previewFeatured(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const p = document.getElementById('featuredPreview');
            p.src = e.target.result; p.classList.remove('hidden');
            document.getElementById('featuredPlaceholder').classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
document.getElementById('blogForm').addEventListener('submit', syncBody);
</script>
@endpush
