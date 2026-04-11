{{-- Overlapping Search Bar --}}
<div class="relative z-20 -mt-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-2xl shadow-[#0A1628]/20 border border-gray-100 overflow-hidden"
             x-data="{
                 state: '',
                 type: '',
                 status: '',
                 search() {
                     const params = new URLSearchParams();
                     if (this.state) params.append('state', this.state);
                     if (this.type) params.append('type', this.type);
                     if (this.status) params.append('status', this.status);
                     window.location.href = '{{ route('properties.index') }}?' + params.toString();
                 }
             }">

            {{-- Top bar accent --}}
            <div class="h-1 bg-gradient-to-r from-[#0A1628] via-[#C9A84C] to-[#0A1628]"></div>

            <div class="p-6 lg:p-8">
                <div class="flex flex-col lg:flex-row gap-4 items-end">

                    {{-- State Select --}}
                    <div class="flex-1 min-w-0">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            <svg class="inline w-3.5 h-3.5 mr-1 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Location
                        </label>
                        <select x-model="state"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#C9A84C] focus:border-[#C9A84C] transition-all appearance-none cursor-pointer">
                            <option value="">All States</option>
                            @foreach($states ?? [] as $stateOption)
                                <option value="{{ $stateOption }}">{{ $stateOption }}</option>
                            @endforeach
                            @if(empty($states))
                                <option value="Lagos">Lagos</option>
                                <option value="Abuja">Abuja</option>
                                <option value="Rivers">Rivers</option>
                                <option value="Ogun">Ogun</option>
                                <option value="Oyo">Oyo</option>
                                <option value="Kano">Kano</option>
                                <option value="Delta">Delta</option>
                                <option value="Enugu">Enugu</option>
                            @endif
                        </select>
                    </div>

                    {{-- Divider --}}
                    <div class="hidden lg:block w-px h-12 bg-gray-200 self-end mb-1"></div>

                    {{-- Property Type Select --}}
                    <div class="flex-1 min-w-0">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            <svg class="inline w-3.5 h-3.5 mr-1 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Property Type
                        </label>
                        <select x-model="type"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#C9A84C] focus:border-[#C9A84C] transition-all appearance-none cursor-pointer">
                            <option value="">All Types</option>
                            @foreach($propertyTypes ?? [] as $pt)
                                <option value="{{ $pt->id ?? $pt }}">{{ $pt->name ?? $pt }}</option>
                            @endforeach
                            @if(empty($propertyTypes))
                                <option value="land">Land</option>
                                <option value="estate">Estate</option>
                                <option value="residential">Residential</option>
                                <option value="commercial">Commercial</option>
                            @endif
                        </select>
                    </div>

                    {{-- Divider --}}
                    <div class="hidden lg:block w-px h-12 bg-gray-200 self-end mb-1"></div>

                    {{-- Status Select --}}
                    <div class="flex-1 min-w-0">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            <svg class="inline w-3.5 h-3.5 mr-1 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Status
                        </label>
                        <select x-model="status"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#C9A84C] focus:border-[#C9A84C] transition-all appearance-none cursor-pointer">
                            <option value="">All Status</option>
                            <option value="available">Available</option>
                            <option value="selling_fast">Selling Fast</option>
                            <option value="sold_out">Sold Out</option>
                            <option value="coming_soon">Coming Soon</option>
                        </select>
                    </div>

                    {{-- Search Button --}}
                    <div class="flex-shrink-0">
                        <button @click="search()"
                                class="w-full lg:w-auto bg-[#C9A84C] hover:bg-[#b8943d] text-[#0A1628] font-bold px-8 py-3.5 rounded-xl flex items-center justify-center gap-2 transition-all hover:scale-105 hover:shadow-lg hover:shadow-[#C9A84C]/30 group">
                            <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Search Properties
                        </button>
                    </div>
                </div>

                {{-- Quick links --}}
                <div class="mt-4 flex flex-wrap gap-2 items-center">
                    <span class="text-xs text-gray-400 font-medium">Popular:</span>
                    @foreach([['Lagos Land', 'state=Lagos&type=land'], ['Abuja Estate', 'state=Abuja&type=estate'], ['Affordable Plots', 'status=available'], ['Selling Fast', 'status=selling_fast']] as [$label, $query])
                    <a href="{{ route('properties.index') }}?{{ $query }}"
                       class="text-xs bg-gray-100 hover:bg-[#0A1628] hover:text-white text-gray-600 px-3 py-1.5 rounded-full transition-all">
                        {{ $label }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
