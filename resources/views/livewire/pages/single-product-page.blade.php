<div>
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if($isLoading)
                <x-skeleton-loading2 />
            @elseif($networkError || !$product)
                <x-fetch-error />
                <div class="text-center mt-4">
                    <button wire:click="fetchSingleProduct" class="bg-black text-white px-4 py-2 rounded-lg text-xs font-bold">
                        Try Again
                    </button>
                </div>
            @else
                @php
                    $images = $product['Images'] ?? [];
                    
                    // Match selected image by selectedImageId
                    $selectedImage = collect($images)->firstWhere('ID', $selectedImageId) 
                        ?? collect($images)->firstWhere('IsFeatured', true) 
                        ?? ($images[0] ?? null);

                    $featuredImage = $selectedImage['FullImageUrl'] ?? ($product['ImagePath'] ?? null);

                    $sellingPrice = $product['SellingPrice'] ?? 0;
                    $onlineRate = $product['OnlineRate'] ?? 0;
                    $hasDiscount = $onlineRate > 0 && $onlineRate < $sellingPrice;
                    $displayPrice = $hasDiscount ? $onlineRate : $sellingPrice;
                    $stockLevel = $product['StockLevel'] ?? 0;
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
                       @if(count($images) > 1)
                            <div class="mt-4 flex flex-wrap justify-between gap-2">
                                @forelse($images as $img)
                                    <div 
                                        wire:click="selectImage('{{ $img['ID'] }}')" 
                                        class="w-[22%] h-20 bg-gray-900 rounded-md overflow-hidden flex items-center justify-center relative cursor-pointer border-2 {{ $selectedImageId === $img['ID'] ? 'border-slate-700' : 'border-transparent' }}"
                                    >
                                        <img 
                                            src="{{ $img['FullImageUrl'] ?? '' }}" 
                                            alt="Thumbnail" 
                                            class="w-full h-full object-cover shadow-sm hover:scale-105 transition-all duration-200"
                                        >
                                    </div>
                                @empty
                                    <div class="w-full text-center text-xs text-gray-400 py-2">No additional images available</div>
                                @endforelse
                            </div>
                        @endif
                    </div>  

                    <!-- Add to Cart Section -->
                    <div>  
                        <div class="bg-white rounded-xl shadow-lg p-6 h-full flex flex-col justify-between">  
                            <div>
                                <!-- Product Title -->
                                <h1 class="text-3xl font-semibold text-gray-900 mb-2">{{ $product['ProductName'] }}</h1>  
                                
                                <!-- Price -->
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
                                        {{ $stockLevel > 0 ? $stockLevel . ' items left in stock' : 'Out of stock' }}
                                    </span>
                                </div>

                                <!-- Description -->
                                @if(!empty($product['Description']))
                                    <div class="text-gray-600 font-bold text-base leading-relaxed mb-6">  
                                        {{ $product['Description'] }}
                                    </div>  
                                @else
                                    <div class="text-gray-600 font-bold text-base leading-relaxed mb-6">     
                                        No description made for this product.
                                    </div>  
                                @endif
                            </div>

                            <!-- Livewire Form Action -->
                            <form wire:submit.prevent="addToCart" class="space-y-6">
                                @if($stockLevel > 0)
                                    <!-- Quantity Box -->  
                                    <div class="flex items-center gap-2 mb-4">  
                                        <button type="button" wire:click="adjustQty(-1)" class="bg-slate-700 hover:bg-slate-800 text-white border-none px-3 py-1.5 rounded text-base transition-colors">-</button>  
                                        <input type="number" wire:model="quantity" min="1" max="{{ $stockLevel }}" class="w-16 text-center border border-gray-300 rounded-md py-1.5 focus:outline-none focus:ring-2 focus:ring-slate-700" />  
                                        <button type="button" wire:click="adjustQty(1)" class="bg-slate-700 hover:bg-slate-800 text-white border-none px-3 py-1.5 rounded text-base transition-colors">+</button>  
                                    </div>

                                    <!-- Add to Cart Button -->
                                    <button type="submit" class="w-full bg-slate-700 hover:bg-slate-800 text-white border-none py-3 px-6 rounded-lg font-semibold text-base transition-all duration-200 shadow-md">
                                        Add to Cart
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