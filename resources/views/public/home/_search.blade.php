{{-- Overlapping Search Bar --}}
@php
// Pass property types as JSON for Alpine.js filtering
$ptJson = ($propertyTypes ?? collect())->map(fn($pt) => [
    'id'           => $pt->id,
    'name'         => $pt->name,
    'listing_type' => $pt->listing_type ?? null,
])->values()->toJson();
@endphp

<div class="relative z-20 -mt-6 sm:-mt-8">
    <div class="max-w-5xl mx-auto px-3 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-2xl shadow-[#1A237E]/20 border border-gray-100 overflow-hidden"
             x-data="{
                 listingTab: '',
                 state: '',
                 type: '',
                 allTypes: {{ $ptJson }},
                 get filteredTypes() {
                     if (!this.listingTab) return this.allTypes;
                     return this.allTypes.filter(pt => {
                         if (!pt.listing_type) return true;
                         if (pt.listing_type === 'buy_and_rent') return this.listingTab === 'rent' || this.listingTab === 'buy';
                         return pt.listing_type === this.listingTab;
                     });
                 },
                 setTab(tab) {
                     this.listingTab = tab;
                     this.type = '';
                 },
                 search() {
                     const params = new URLSearchParams();
                     if (this.state) params.append('state', this.state);
                     if (this.type)  params.append('type',  this.type);
                     if (this.listingTab) params.append('status', this.listingTab);
                     window.location.href = '{{ route('properties.index') }}?' + params.toString();
                 }
             }">

            {{-- Top colour bar --}}
            <div class="h-1 bg-gradient-to-r from-[#1A237E] via-[#27AE22] to-[#1A237E]"></div>

            <div class="p-4 sm:p-6 lg:p-8">

                {{-- Listing Category Tabs --}}
                <div class="flex flex-wrap gap-2 mb-5">
                    <button @click="setTab('')"
                            :class="listingTab === '' ? 'bg-[#1A237E] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                            class="px-5 py-2 rounded-full text-sm font-semibold transition-all">
                        All
                    </button>
                    <button @click="setTab('rent')"
                            :class="listingTab === 'rent' ? 'bg-sky-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                            class="px-5 py-2 rounded-full text-sm font-semibold transition-all">
                        For Rent
                    </button>
                    <button @click="setTab('buy')"
                            :class="listingTab === 'buy' ? 'bg-violet-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                            class="px-5 py-2 rounded-full text-sm font-semibold transition-all">
                        For Sale
                    </button>
                    <button @click="setTab('shortlet')"
                            :class="listingTab === 'shortlet' ? 'bg-pink-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                            class="px-5 py-2 rounded-full text-sm font-semibold transition-all">
                        Short Let
                    </button>
                </div>

                {{-- Filters Row --}}
                <div class="flex flex-col lg:flex-row gap-3 sm:gap-4 items-stretch lg:items-end">

                    {{-- Location --}}
                    <div class="flex-1 min-w-0">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5 sm:mb-2">
                            <svg class="inline w-3.5 h-3.5 mr-1 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Location
                        </label>
                        <select x-model="state"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 sm:px-4 py-2.5 sm:py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#27AE22] focus:border-[#27AE22] transition-all appearance-none cursor-pointer text-sm sm:text-base">
                            <option value="">All States</option>
                            @foreach($states ?? [] as $stateOption)
                                <option value="{{ $stateOption }}">{{ $stateOption }}</option>
                            @endforeach
                            @if(($states ?? collect())->isEmpty())
                                <option value="Lagos">Lagos</option>
                                <option value="Ogun">Ogun</option>
                                <option value="Abuja">Abuja</option>
                                <option value="Rivers">Rivers</option>
                                <option value="Oyo">Oyo</option>
                            @endif
                        </select>
                    </div>

                    {{-- Divider --}}
                    <div class="hidden lg:block w-px h-12 bg-gray-200 self-end mb-1"></div>

                    {{-- Property Type — filtered by selected listing tab --}}
                    <div class="flex-1 min-w-0">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5 sm:mb-2">
                            <svg class="inline w-3.5 h-3.5 mr-1 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Property Type
                        </label>
                        <select x-model="type"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 sm:px-4 py-2.5 sm:py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#27AE22] focus:border-[#27AE22] transition-all appearance-none cursor-pointer text-sm sm:text-base">
                            <option value="">All Types</option>
                            <template x-for="pt in filteredTypes" :key="pt.id">
                                <option :value="pt.id" x-text="pt.name"></option>
                            </template>
                        </select>
                    </div>

                    {{-- Search Button --}}
                    <div class="flex-shrink-0">
                        <button @click="search()"
                                class="w-full lg:w-auto bg-[#27AE22] hover:bg-[#1D9418] text-white font-bold px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl flex items-center justify-center gap-2 transition-all hover:scale-105 hover:shadow-lg hover:shadow-[#27AE22]/30 group">
                            <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Search Properties
                        </button>
                    </div>
                </div>

                {{-- Quick links --}}
                <div class="mt-3 sm:mt-4 flex flex-wrap gap-2 items-center">
                    <span class="text-xs text-gray-400 font-medium">Popular:</span>
                    <a href="{{ route('properties.index') }}?status=rent"
                       class="text-xs bg-sky-50 hover:bg-sky-600 hover:text-white text-sky-700 border border-sky-100 px-3 py-1.5 rounded-full transition-all">
                        For Rent
                    </a>
                    <a href="{{ route('properties.index') }}?status=buy"
                       class="text-xs bg-violet-50 hover:bg-violet-600 hover:text-white text-violet-700 border border-violet-100 px-3 py-1.5 rounded-full transition-all">
                        For Sale
                    </a>
                    <a href="{{ route('properties.index') }}?status=shortlet"
                       class="text-xs bg-pink-50 hover:bg-pink-500 hover:text-white text-pink-700 border border-pink-100 px-3 py-1.5 rounded-full transition-all">
                        Short Let
                    </a>
                    <a href="{{ route('properties.index') }}?state=Lagos"
                       class="text-xs bg-gray-100 hover:bg-[#1A237E] hover:text-white text-gray-600 px-3 py-1.5 rounded-full transition-all">
                        Lagos Properties
                    </a>
                    <a href="{{ route('properties.index') }}?state=Ogun"
                       class="text-xs bg-gray-100 hover:bg-[#1A237E] hover:text-white text-gray-600 px-3 py-1.5 rounded-full transition-all">
                        Ogun Properties
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
