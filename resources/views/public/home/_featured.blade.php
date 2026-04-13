{{-- Featured Properties --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center mb-14" data-reveal>
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Premium Selection</span>
            <h2 class="font-display text-4xl md:text-5xl font-bold text-[#1A237E] mb-4">Our Featured <span class="text-[#27AE22]">Estates</span></h2>
            <p class="text-gray-500 text-lg max-w-2xl mx-auto">Handpicked premium real estate investments with government-approved titles and flexible payment plans.</p>
            <div class="mt-6 flex items-center justify-center gap-2">
                <div class="h-px w-16 bg-gray-200"></div>
                <div class="w-2 h-2 rounded-full bg-[#27AE22]"></div>
                <div class="h-px w-16 bg-gray-200"></div>
            </div>
        </div>

        {{-- Property Grid --}}
        @if($featuredProperties->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredProperties as $index => $property)
            <article class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl hover:shadow-[#1A237E]/15 transition-all duration-500 hover:-translate-y-2 flex flex-col"
                     data-reveal
                     style="transition-delay: {{ $index * 100 }}ms">

                {{-- Image Container --}}
                <div class="relative overflow-hidden h-64 flex-shrink-0">
                    <img src="{{ $property->cover_image_url }}"
                         alt="{{ $property->name }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                         loading="lazy"
                         onerror="this.src='https://picsum.photos/seed/{{ $property->id }}/600/400'">

                    {{-- Overlay gradient --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1A237E]/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    {{-- Status Badge --}}
                    @php
                        $statusClasses = [
                            'available'    => 'bg-emerald-500 text-white',
                            'selling_fast' => 'bg-orange-500 text-white',
                            'sold_out'     => 'bg-red-500 text-white',
                            'coming_soon'  => 'bg-blue-500 text-white',
                        ];
                        $statusLabels = [
                            'available'    => 'Available',
                            'selling_fast' => 'Selling Fast',
                            'sold_out'     => 'Sold Out',
                            'coming_soon'  => 'Coming Soon',
                        ];
                        $badgeClass = $statusClasses[$property->status] ?? 'bg-gray-500 text-white';
                        $badgeLabel = $statusLabels[$property->status] ?? ucfirst($property->status);
                    @endphp
                    <span class="absolute top-4 left-4 {{ $badgeClass }} text-xs font-bold px-3 py-1.5 rounded-full shadow-md">
                        {{ $badgeLabel }}
                    </span>

                    {{-- Featured badge --}}
                    @if($property->is_featured)
                    <span class="absolute top-4 right-4 bg-[#27AE22] text-[#1A237E] text-xs font-bold px-3 py-1.5 rounded-full shadow-md">
                        ★ Featured
                    </span>
                    @endif

                    {{-- Quick view on hover --}}
                    <div class="absolute inset-0 flex items-end justify-center pb-4 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                        <a href="{{ route('properties.show', $property->slug) }}"
                           class="bg-white text-[#1A237E] font-semibold text-sm px-6 py-2.5 rounded-full hover:bg-[#27AE22] transition-colors shadow-lg">
                            Quick View
                        </a>
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-6 flex flex-col flex-1">
                    {{-- Type --}}
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-[#27AE22] text-xs font-semibold uppercase tracking-wider">
                            {{ $property->propertyType->name ?? 'Estate' }}
                        </span>
                        <span class="text-gray-300">•</span>
                        <span class="text-gray-400 text-xs">{{ $property->state ?? '' }}</span>
                    </div>

                    {{-- Name --}}
                    <h3 class="font-display text-xl font-bold text-[#1A237E] mb-2 group-hover:text-[#27AE22] transition-colors leading-snug">
                        {{ $property->name }}
                    </h3>

                    {{-- Location --}}
                    <div class="flex items-center gap-1.5 text-gray-500 text-sm mb-4">
                        <svg class="w-4 h-4 text-[#27AE22] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>{{ $property->location }}, {{ $property->state }}</span>
                    </div>

                    {{-- Plot sizes --}}
                    @if(!empty($property->plot_sizes_array))
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach(array_slice($property->plot_sizes_array, 0, 4) as $size)
                        <span class="bg-gray-100 text-gray-600 text-xs font-medium px-2.5 py-1 rounded-lg">
                            {{ $size }}
                        </span>
                        @endforeach
                        @if(count($property->plot_sizes_array) > 4)
                        <span class="bg-gray-100 text-gray-400 text-xs px-2.5 py-1 rounded-lg">+{{ count($property->plot_sizes_array) - 4 }} more</span>
                        @endif
                    </div>
                    @endif

                    {{-- Price + CTA --}}
                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                        <div>
                            <p class="text-xs text-gray-400 mb-0.5">Starting from</p>
                            <p class="text-[#27AE22] font-bold text-xl font-display">{{ $property->formatted_price }}</p>
                        </div>
                        <a href="{{ route('properties.show', $property->slug) }}"
                           class="bg-[#1A237E] hover:bg-[#27AE22] text-white hover:text-[#1A237E] font-semibold text-sm px-5 py-2.5 rounded-xl transition-all hover:shadow-md group-hover:bg-[#27AE22] group-hover:text-[#1A237E]">
                            View Estate
                            <svg class="inline w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        @else
        <div class="text-center py-20 text-gray-400">
            <svg class="w-16 h-16 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <p class="text-lg">No featured properties at the moment.</p>
        </div>
        @endif

        {{-- View All Button --}}
        <div class="text-center mt-12" data-reveal>
            <a href="{{ route('properties.index') }}"
               class="inline-flex items-center gap-2 bg-[#1A237E] hover:bg-[#27AE22] text-white hover:text-[#1A237E] font-bold px-10 py-4 rounded-full transition-all hover:scale-105 hover:shadow-xl shadow-[#1A237E]/20 shadow-lg">
                View All Properties
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
