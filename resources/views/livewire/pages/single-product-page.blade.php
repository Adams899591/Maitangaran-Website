


















<div>
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if($isLoading)
                <x-skeleton-loading2 />
            @elseif($networkError || !$product)
                   <x-fetch-error retry-action="fetchSingleProduct" />
            @else
                @php
                    $allImages = $this->getAllImages();
                    
                    // Get current active variant if selected
                    $variants = $product['Variants'] ?? [];
                    $selectedVariant = collect($variants)->firstWhere('ID', $selectedVariantId);

                    // Determine active price: Variant Rate if chosen, otherwise Base SellingPrice
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
                    $selectedImage = collect($allImages)->firstWhere('ID', $selectedImageId) 
                        ?? collect($allImages)->firstWhere('IsFeatured', true) 
                        ?? ($allImages[0] ?? null);

                    $featuredImage = $selectedImage['FullImageUrl'] ?? ($product['ImagePath'] ?? null);
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- Image Section -->
                    <div class="bg-white rounded-xl shadow-lg p-6 h-full flex flex-col justify-between">
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

                        <!-- Thumbnails -->
                       @if(count($allImages) > 1)
                            <div class="mt-4 flex flex-wrap gap-2">
                                @forelse($allImages as $img)
                                    <div 
                                        wire:click="selectImage('{{ $img['ID'] }}')" 
                                        class="w-[22%] h-20 bg-gray-900 rounded-md overflow-hidden flex items-center justify-center relative cursor-pointer border-2 {{ $selectedImageId === $img['ID'] ? 'border-indigo-600 ring-2 ring-indigo-300' : 'border-transparent' }}"
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
                    <div>  
                        <div class="bg-white rounded-xl shadow-lg p-6 h-full flex flex-col justify-between">  
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
                                                <span class="text-indigo-600 font-semibold">{{ $selectedVariant['Attribute'] ?? 'Default / None' }}</span>
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
                                                        class="px-4 py-2 text-sm font-medium rounded-lg transition-colors focus:outline-none 
                                                            {{ $isSelected ? 'border-2 border-indigo-600 bg-indigo-50 text-indigo-700 shadow-sm' : 'border border-gray-300 bg-white text-gray-700 hover:bg-gray-50' }}
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

                            <!-- Session Error Alert -->
                            @if (session()->has('error'))
                                <div class="my-4 flex items-center justify-between gap-4 rounded-xl border border-red-200 bg-red-50 p-4 text-red-800 shadow-sm">
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
                            <form wire:submit.prevent="addToCart" class="space-y-6 mt-4">
                                @if($stockLevel > 0)
                                    <!-- Quantity Picker -->  
                                    <div class="flex items-center gap-2 mb-4">  
                                        <button type="button" wire:click="adjustQty(-1)" class="bg-slate-700 hover:bg-slate-800 text-white border-none px-3 py-1.5 rounded text-base transition-colors">-</button>  
                                        <input type="number" wire:model="quantity" min="1" max="{{ $stockLevel }}" class="w-16 text-center border border-gray-300 rounded-md py-1.5 focus:outline-none focus:ring-2 focus:ring-slate-700" />  
                                        <button type="button" wire:click="adjustQty(1)" class="bg-slate-700 hover:bg-slate-800 text-white border-none px-3 py-1.5 rounded text-base transition-colors">+</button>  
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" wire:loading.attr="disabled" wire:target="addToCart" class="w-full bg-slate-700 hover:bg-slate-800 disabled:opacity-50 disabled:cursor-not-allowed text-white border-none py-3 px-6 rounded-lg font-semibold text-base transition-all duration-200 shadow-md">
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
</div>