<div>
    <!-- Reduced py-12 to py-6 and removed min-h-screen force -->
    <div class="bg-gray-50 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if($isLoading)
                <x-skeleton-loading2 />
            @elseif($networkError || !$product)
                <x-fetch-error retry-action="fetchSingleProduct" />
            @else
                @php
                    $galleryImages = $this->getGalleryImages();
                    
                    // Get current active variant if selected
                    $variants = $product['Variants'] ?? [];
                    $selectedVariant = collect($variants)->firstWhere('ID', $selectedVariantId);

                    // Determine active price
                    if ($selectedVariant) {
                        $sellingPrice = $selectedVariant['Rate'] ?? $product['SellingPrice'] ?? 0;
                        $onlineRate = $selectedVariant['OnlineRate'] ?? 0;
                    } else {
                        $sellingPrice = $product['SellingPrice'] ?? 0;
                        $onlineRate = $product['OnlineRate'] ?? 0;
                    }

                    $hasDiscount = $onlineRate > 0 && $onlineRate < $sellingPrice;
                    $displayPrice = $hasDiscount ? $onlineRate : $sellingPrice;
                    $stockLevel = $this->getAvailableStock();

                    // Selected image logic
                    $selectedImage = collect($galleryImages)->firstWhere('ID', $selectedImageId) 
                        ?? collect($galleryImages)->firstWhere('IsFeatured', true) 
                        ?? ($galleryImages[0] ?? null);

                    $featuredImage = $selectedImage['FullImageUrl'] ?? ($product['ImagePath'] ?? null);
                @endphp

                <!-- Changed items-start to items-stretch so both cards equal each other's height -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
                    
                    <!-- Image Section -->
                    <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col justify-start h-full">
                        @if($featuredImage)
                            <div class="product-image mb-4 w-full h-[400px] bg-gray-900 rounded-lg overflow-hidden flex items-center justify-center relative">
                                <div class="absolute inset-0 filter blur-xl opacity-40 scale-110 overflow-hidden pointer-events-none flex items-center justify-center">
                                    <img src="{{ $featuredImage }}" alt="" class="w-full h-full object-cover">
                                </div>
                                <img 
                                    src="{{ $featuredImage }}" 
                                    alt="{{ $product['ProductName'] }}" 
                                    class="relative z-10 w-full h-full object-contain rounded-lg shadow-md"
                                >
                            </div>
                        @else
                            <div class="mb-4 w-full h-[400px] bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
                                <x-no-image-uploaded-single heightClass="aspect-square" />
                            </div>
                        @endif

                        <!-- Dynamic Thumbnails -->
                       @if(count($galleryImages) > 1)
                            <div class="mt-4 flex flex-wrap gap-2">
                                @forelse($galleryImages as $img)
                                    <div 
                                        wire:click="selectImage('{{ $img['ID'] }}')" 
                                        class="w-[22%] h-20 bg-gray-900 rounded-md overflow-hidden flex items-center justify-center relative cursor-pointer border-2 {{ $selectedImageId === $img['ID'] ? 'border-slate-600 ring-2 ring-slate-300' : 'border-transparent' }}"
                                    >
                                        <img 
                                            src="{{ $img['FullImageUrl'] ?? '' }}" 
                                            alt="Thumbnail" 
                                            class="w-full h-full object-cover shadow-sm hover:scale-105 transition-all duration-200"
                                        >
                                    </div>
                                @empty
                                    <div class="w-full text-center text-xs text-gray-400 py-2">No images available</div>
                                @endforelse
                            </div>
                        @endif
                    </div>  

                    <!-- Product Specs & Form Section -->
                    <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col justify-between h-full">  
                        <div>
                            <!-- Product Title -->
                            <h1 class="text-3xl font-semibold text-gray-900 mb-2">{{ $product['ProductName'] }}</h1>  
                            
                            <!-- Price Display -->
                            <div class="flex items-center gap-2 my-2 text-black text-2xl font-medium"> 
                                <span class="font-bold">₦ {{ number_format($displayPrice) }}</span>
                                @if($hasDiscount)
                                    <span class="text-sm text-red-500 line-through">₦ {{ number_format($sellingPrice) }}</span>
                                @endif
                            </div>  

                            <!-- Stock / Availability Badge -->
                            <div class="mb-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $stockLevel > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    <span class="w-2 h-2 mr-1.5 {{ $stockLevel > 0 ? 'bg-green-500' : 'bg-red-500' }} rounded-full"></span>
                                    {{ $stockLevel > 0 ? number_format($stockLevel) . ' items left in stock' : 'Out of stock' }}
                                </span>
                            </div>

                            <!-- Description -->
                            @if(!empty($product['Description']))
                                <div class="text-gray-600 font-medium text-base leading-relaxed mb-6">  
                                    {{ $product['Description'] }}
                                </div>  
                            @else
                                <div class="text-gray-400 font-normal text-sm italic mb-6">     
                                    No description available for this product.
                                </div>  
                            @endif

                            <!-- Dynamic Product Variants Section -->
                            @if(!empty($variants))
                                <div class="mt-6 space-y-4 border-t border-b border-gray-200 py-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Select Option
                                        </label>

                                        <!-- Selected Variant Label -->
                                        <p class="text-xs text-gray-500 mb-3 truncate max-w-full">
                                            <span class="font-medium text-gray-700">Selected Option:</span> 
                                            <span class="text-red-600 font-semibold">{{ $selectedVariant['Attribute'] ?? 'Default / None' }}</span>
                                        </p>

                                        <!-- Variant Buttons -->
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($variants as $v)
                                                @php
                                                    $vStock = $v['Qty'] ?? $v['StockLevel'] ?? 0;
                                                    $isOut = $vStock <= 0;
                                                    $isSelected = $selectedVariantId === $v['ID'];
                                                    $vName = $v['Attribute'] ?? $v['Value'] ?? 'Option ' . ($loop->index + 1);
                                                @endphp

                                                <button 
                                                    type="button" 
                                                    wire:click="selectVariant('{{ $v['ID'] }}')"
                                                    @if($isOut) disabled @endif
                                                    class="px-4 py-2 text-sm font-medium rounded-lg transition-colors focus:outline-none cursor-pointer
                                                        {{ $isSelected ? 'border-2 border-slate-600 bg-slate-50 text-slate-700 shadow-sm' : 'border border-gray-300 bg-white text-gray-700 hover:bg-gray-50' }}
                                                        {{ $isOut ? 'border-gray-200 bg-gray-100 text-gray-400 cursor-not-allowed line-through' : '' }}"
                                                >
                                                    {{ $vName }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>

                        <!-- Bottom Section containing errors and Cart Form -->
                        <div class="mt-auto pt-4">
                            <!-- Session Error Alert -->
                            @if (session()->has('error'))
                                <div class="mb-4 flex items-center justify-between gap-4 rounded-xl border border-red-200 bg-red-50 p-4 text-red-800 shadow-sm">
                                    <div class="flex items-center gap-3">
                                        <svg class="h-5 w-5 flex-shrink-0 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                        </svg>
                                        <span class="text-sm font-medium">{{ session('error') }}</span>
                                    </div>

                                    <a href="{{ route('login') }}" class="inline-flex flex-shrink-0 items-center gap-1 rounded-lg bg-red-600 px-3.5 py-2 text-xs font-semibold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors" wire:navigate >
                                        Log In
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                        </svg>
                                    </a>
                                </div>
                            @endif

                            <!-- Add to Cart Form -->
                            <form wire:submit.prevent="addToCart" class="space-y-6">
                                @if($stockLevel > 0)
                                    <!-- Quantity Picker -->  
                                    <div class="flex items-center gap-2 mb-4">  
                                        <button type="button" wire:click="adjustQty(-1)" class="bg-slate-700 hover:bg-slate-800 text-white border-none px-3 py-1.5 rounded text-base transition-colors cursor-pointer">-</button>  
                                        <input type="number" wire:model="quantity" min="1" max="{{ $stockLevel }}" class="w-16 text-center border border-gray-300 rounded-md py-1.5 focus:outline-none focus:ring-2 focus:ring-slate-700" />  
                                        <button type="button" wire:click="adjustQty(1)" class="bg-slate-700 hover:bg-slate-800 text-white border-none px-3 py-1.5 rounded text-base transition-colors cursor-pointer">+</button>  
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" wire:loading.attr="disabled" wire:target="addToCart" class="w-full bg-slate-700 hover:bg-slate-800 disabled:opacity-50 disabled:cursor-not-allowed text-white border-none py-3 px-6 rounded-lg font-semibold text-base transition-all duration-200 shadow-md cursor-pointer">
                                        <span wire:loading.remove wire:target="addToCart" class="inline">Add to Cart</span>
                                        <span wire:loading wire:target="addToCart" class="inline-flex items-center justify-center gap-2 w-full">
                                            <svg class="animate-spin h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            <span>Adding...</span>
                                        </span>
                                    </button> 
                                @else
                                    <button type="button" disabled class="w-full bg-gray-300 text-gray-500 cursor-not-allowed border-none py-3 px-6 rounded-lg font-semibold text-base shadow-none">
                                        Out of Stock
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>  

                </div>  

            @endif

        </div>  
    </div>


    

    <!-- CUSTOMER REVIEWS SECTION -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 pb-12">
        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
            <div class="pb-6 mb-8 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 tracking-tight">Customer Reviews</h2>
                <p class="text-xs text-gray-500 mt-1">Real feedback from verified purchasers</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Rating Summary Box -->
                <div class="lg:col-span-4 bg-slate-50/70 border border-slate-100 rounded-xl p-6 flex flex-col items-center justify-center text-center">
                    @php
                        $avgRating = number_format($reviewStats['AverageRating'] ?? 0, 1);
                        $totalReviews = $reviewStats['ReviewCount'] ?? 0;
                    @endphp

                    <span class="text-5xl font-black text-gray-900 tracking-tight">{{ $avgRating }}</span>
                    
                    <div class="flex items-center gap-1 my-3">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= round($avgRating) ? 'text-amber-400' : 'text-gray-200' }} shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    
                    <span class="text-xs text-gray-500 font-medium">
                        Based on {{ $totalReviews }} {{ Str::plural('rating', $totalReviews) }}
                    </span>
                </div>

                <!-- Rating Breakdown Progress Bars -->
                <div class="lg:col-span-4 space-y-2.5 flex flex-col justify-center py-2">
                    @foreach([5, 4, 3, 2, 1] as $star)
                        @php
                            $countKey = "Rating{$star}Count";
                            $starCount = $reviewStats[$countKey] ?? 0;
                            $percentage = $totalReviews > 0 ? round(($starCount / $totalReviews) * 100) : 0;
                        @endphp
                        <div class="flex items-center text-xs text-gray-600 gap-3">
                            <span class="w-12 font-medium">{{ $star }} stars</span>
                            <div class="flex-1 h-2 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-amber-400 rounded-full transition-all duration-300" style="width: {{ $percentage }}%;"></div>
                            </div>
                            <span class="w-8 text-right {{ $percentage > 0 ? 'text-gray-700 font-semibold' : 'text-gray-400' }} font-mono">
                                {{ $percentage }}%
                            </span>
                        </div>
                    @endforeach
                </div>

                <!-- Review Cards Carousel / Empty State -->
                <div class="lg:col-span-4 w-full overflow-hidden">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Recent Reviews</span>
                        
                        @if(!empty($reviews))
                            <div class="flex items-center gap-1">
                                <button onclick="document.getElementById('reviews-container').scrollBy({left: -260, behavior: 'smooth'})" class="p-1 rounded-lg border border-gray-200 text-gray-600 hover:bg-slate-50 transition" aria-label="Previous review">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                </button>
                                <button onclick="document.getElementById('reviews-container').scrollBy({left: 260, behavior: 'smooth'})" class="p-1 rounded-lg border border-gray-200 text-gray-600 hover:bg-slate-50 transition" aria-label="Next review">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div id="reviews-container" class="flex gap-4 overflow-x-auto scroll-smooth snap-x snap-mandatory no-scrollbar pb-2">
                        @forelse($reviews as $review)
                            <div class="min-w-[240px] max-w-[280px] shrink-0 snap-start bg-white border border-gray-100 rounded-xl p-4 shadow-sm space-y-2.5">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center shrink-0">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-xs text-gray-900 leading-tight">
                                                {{ $review['UserName'] ?? $review['User']['Name'] ?? 'Anonymous' }}
                                            </h4>
                                            @if($review['IsVerified'] ?? true)
                                                <div class="flex items-center gap-1 mt-0.5">
                                                    <svg class="w-3 h-3 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                                    <span class="text-[10px] font-medium text-emerald-700">Verified Buyer</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @if(!empty($review['CreatedAt']))
                                        <span class="text-[10px] text-gray-400 font-medium">
                                            {{ \Carbon\Carbon::parse($review['CreatedAt'])->format('M d, Y') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="flex items-center gap-0.5">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-3.5 h-3.5 {{ $i <= ($review['Rating'] ?? 0) ? 'text-amber-400' : 'text-gray-200' }} shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>

                                <p class="text-xs text-gray-600 leading-relaxed">
                                    "{{ $review['Comment'] ?? $review['ReviewText'] ?? 'No comment provided.' }}"
                                </p>
                            </div>
                        @empty
                            <div class="w-full bg-slate-50 border border-dashed border-slate-200 rounded-xl p-6 text-center">
                                <p class="text-xs text-gray-500 font-medium">No customer reviews yet for this product.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>


</div>















