<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-5">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Job Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $job?->title) }}" required
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none @error('title') border-red-400 @enderror"/>
                    @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                    <input type="text" name="department" value="{{ old('department', $job?->department) }}"
                        placeholder="e.g. Sales"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                    <input type="text" name="location" value="{{ old('location', $job?->location) }}"
                        placeholder="e.g. Lagos, Nigeria"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Employment Type</label>
                    <select name="type" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">
                        @foreach(['full_time' => 'Full Time', 'part_time' => 'Part Time', 'contract' => 'Contract', 'internship' => 'Internship'] as $val => $lbl)
                        <option value="{{ $val }}" {{ old('type', $job?->type) == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Salary Range</label>
                    <input type="text" name="salary_range" value="{{ old('salary_range', $job?->salary_range) }}"
                        placeholder="e.g. ₦150,000 – ₦250,000/month"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Job Summary</label>
                <textarea name="summary" rows="2"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">{{ old('summary', $job?->summary) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Full Description</label>
                <div id="descEditor" class="border border-gray-200 rounded-lg min-h-[200px]">{!! old('description', $job?->description) !!}</div>
                <input type="hidden" name="description" id="descInput"/>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Requirements</label>
                <div id="reqEditor" class="border border-gray-200 rounded-lg min-h-[200px]">{!! old('requirements', $job?->requirements) !!}</div>
                <input type="hidden" name="requirements" id="reqInput"/>
            </div>
        </div>
    </div>

    <div class="space-y-5">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 space-y-4">
            <h3 class="text-sm font-semibold text-gray-700">Settings</h3>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Application Deadline</label>
                <input type="date" name="deadline"
                    value="{{ old('deadline', $job?->deadline?->format('Y-m-d')) }}"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Application Email (override)</label>
                <input type="email" name="application_email" value="{{ old('application_email', $job?->application_email) }}"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none"/>
            </div>
            <div class="flex items-center gap-3">
                <input type="hidden" name="is_active" value="0"/>
                <input type="checkbox" name="is_active" id="is_active" value="1"
                    {{ old('is_active', $job?->is_active ?? true) ? 'checked' : '' }}
                    class="w-4 h-4 text-amber-500 rounded border-gray-300 focus:ring-amber-400"/>
                <label for="is_active" class="text-sm font-medium text-gray-700">Active (accepting applications)</label>
            </div>
        </div>
    </div>
</div>
