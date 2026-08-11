
{{-- <div>
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
                    // Find featured image or default to the first one
                    $featuredImage = collect($images)->firstWhere('IsFeatured', true)['FullImageUrl'] ?? ($images[0]['FullImageUrl'] ?? 'https://images.unsplash.com/photo-1542291026-7eec264c27ff');
                    
                    $sellingPrice = $product['SellingPrice'] ?? 0;
                    $onlineRate = $product['OnlineRate'] ?? 0;
                    $hasDiscount = $onlineRate > 0 && $onlineRate < $sellingPrice;
                    $displayPrice = $hasDiscount ? $onlineRate : $sellingPrice;
                    $stockLevel = $product['StockLevel'] ?? 0;
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- Image Section -->
                    <div class="bg-white rounded-xl shadow-lg p-6 h-full flex flex-col justify-between">
                        <div class="product-image mb-4 w-full h-[400px] bg-gray-900 rounded-lg overflow-hidden flex items-center justify-center relative">
                            <div class="absolute inset-0 filter blur-xl opacity-40 scale-110 overflow-hidden pointer-events-none flex items-center justify-center">
                                <img src="{{ $featuredImage }}" alt="" class="w-full h-full object-cover" id="bg-blur-image">
                            </div>
                            <img 
                                src="{{ $featuredImage }}" 
                                alt="{{ $product['ProductName'] }}" 
                                class="relative z-10 w-full h-full object-contain rounded-lg shadow-md" 
                                id="main-image"
                            >
                        </div>  
                   
                        <!-- Thumbnails -->
                        <div class="mt-4 flex flex-wrap justify-between gap-2">
                            @forelse($images as $img)
                                <div class="w-[22%] h-20 bg-gray-900 rounded-md overflow-hidden flex items-center justify-center relative">
                                    <img src="https://swiftclouderp.com/folio/4df94d86-89a3-44b5/maitangarantextiles/products/b832f712-614a-4c0b-b233-b3e2697c597d/55f46be9-2974-42aa-8f48-5e081a16bd6a.jpg" alt="Thumbnail" class="thumbnail-img w-full h-full object-cover cursor-pointer shadow-sm hover:scale-105 hover:shadow-gray-400/50 transition-all duration-200">
                                </div>
                            @empty
                                <div class="w-full text-center text-xs text-gray-400 py-2">No additional images available</div>
                            @endforelse
                        </div>
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

                                <!-- Description (Only rendered if available from API) -->
                                @if(!empty($product['Description']))
                                    <div class="text-gray-600 font-bold text-base leading-relaxed mb-6">  
                                        {{ $product['Description'] }}
                                    </div>  
                                @else
                                    <div class="text-gray-600 font-bold text-base leading-relaxed mb-6">  
                                        Elevate your everyday style with this premium quality piece, meticulously crafted for maximum comfort, durability, and a sleek contemporary look.
                                    </div>  
                                @endif
                            </div>

                            <!-- Livewire Form Action -->
                            <form wire:submit.prevent="addToCart" class="space-y-6">
                                @if($stockLevel > 0)
                                    <!-- Quantity Box (Active only when in stock) -->  
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
                                    <!-- Out of Stock Button State -->
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

    <!-- JavaScript for Changing Main Image and Blurred Background Filler on Thumbnail Click -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mainImage = document.getElementById("main-image");
            const bgBlurImage = document.getElementById("bg-blur-image");
            
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('thumbnail-img')) {
                    if (mainImage) mainImage.src = event.target.src;
                    if (bgBlurImage) bgBlurImage.src = event.target.src;
                }
            });
        });
    </script>
</div> --}}








{{-- <div>
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
                    // Find featured image or default to the first one
                    $featuredImage = collect($images)->firstWhere('IsFeatured', true)['FullImageUrl'] ?? ($images[0]['FullImageUrl'] ?? 'https://images.unsplash.com/photo-1542291026-7eec264c27ff');
                    
                    $sellingPrice = $product['SellingPrice'] ?? 0;
                    $onlineRate = $product['OnlineRate'] ?? 0;
                    $hasDiscount = $onlineRate > 0 && $onlineRate < $sellingPrice;
                    $displayPrice = $hasDiscount ? $onlineRate : $sellingPrice;
                    $stockLevel = $product['StockLevel'] ?? 0;
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- Image Section -->
                    <div class="bg-white rounded-xl shadow-lg p-6 h-full flex flex-col justify-between">
                        <div class="product-image mb-4 w-full h-[400px] bg-gray-900 rounded-lg overflow-hidden flex items-center justify-center relative">
                            <div class="absolute inset-0 filter blur-xl opacity-40 scale-110 overflow-hidden pointer-events-none flex items-center justify-center">
                                <img src="{{ $featuredImage }}" alt="" class="w-full h-full object-cover" id="bg-blur-image">
                            </div>
                            <img 
                                src="{{ $featuredImage }}" 
                                alt="{{ $product['ProductName'] }}" 
                                class="relative z-10 w-full h-full object-contain rounded-lg shadow-md" 
                                id="main-image"
                            >
                        </div>  
                   
                        <!-- Thumbnails -->
                        <div class="mt-4 flex flex-wrap justify-between gap-2">
                            @forelse($images as $img)
                                <div class="w-[22%] h-20 bg-gray-900 rounded-md overflow-hidden flex items-center justify-center relative">
                                    <img src="{{ $img['FullImageUrl'] ?? '' }}" alt="Thumbnail" class="thumbnail-img w-full h-full object-cover cursor-pointer shadow-sm hover:scale-105 hover:shadow-gray-400/50 transition-all duration-200">
                                </div>
                            @empty
                                <div class="w-full text-center text-xs text-gray-400 py-2">No additional images available</div>
                            @endforelse
                        </div>
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

                                <!-- Description (Only rendered if available from API) -->
                                @if(!empty($product['Description']))
                                    <div class="text-gray-600 font-bold text-base leading-relaxed mb-6">  
                                        {{ $product['Description'] }}
                                    </div>  
                                @else
                                    <div class="text-gray-600 font-bold text-base leading-relaxed mb-6">  
                                        Elevate your everyday style with this premium quality piece, meticulously crafted for maximum comfort, durability, and a sleek contemporary look.
                                    </div>  
                                @endif
                            </div>

                            <!-- Livewire Form Action -->
                            <form wire:submit.prevent="addToCart" class="space-y-6">
                                @if($stockLevel > 0)
                                    <!-- Quantity Box (Active only when in stock) -->  
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
                                    <!-- Out of Stock Button State -->
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

    <!-- JavaScript for Changing Main Image and Blurred Background Filler on Thumbnail Click -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mainImage = document.getElementById("main-image");
            const bgBlurImage = document.getElementById("bg-blur-image");
            
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('thumbnail-img')) {
                    if (mainImage) mainImage.src = event.target.src;
                    if (bgBlurImage) bgBlurImage.src = event.target.src;
                }
            });
        });
    </script>
</div> --}}




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
                    // Find featured image or fallback to the first available image
                    $featuredImage = collect($images)->firstWhere('IsFeatured', true)['FullImageUrl'] 
                        ?? ($images[0]['FullImageUrl'] ?? ($product['ImagePath'] ?? null));


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
                                    <img src="{{ $featuredImage }}" alt="" class="w-full h-full object-cover" id="bg-blur-image">
                                </div>
                                <img 
                                    src="{{ $featuredImage }}" 
                                    alt="{{ $product['ProductName'] }}" 
                                    class="relative z-10 w-full h-full object-contain rounded-lg shadow-md" 
                                    id="main-image"
                                >
                            </div>
                        @else
                            <div class="mb-4 w-full h-[400px] bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
                                <x-no-image-uploaded-single heightClass="aspect-square" />
                            </div>
                        @endif
                   

                        <!-- Thumbnails (Only show if more than 1 image exists) -->
                       @if(count($images) > 1)
                            <!-- Thumbnails -->
                            <div class="mt-4 flex flex-wrap justify-between gap-2">
                                @forelse($images as $img)
                                    <div class="w-[22%] h-20 bg-gray-900 rounded-md overflow-hidden flex items-center justify-center relative">
                                        <img src="{{ $img['FullImageUrl'] ?? '' }}" alt="Thumbnail" class="thumbnail-img w-full h-full object-cover cursor-pointer shadow-sm hover:scale-105 hover:shadow-gray-400/50 transition-all duration-200">
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

                                <!-- Description (Only rendered if available from API) -->
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
                                    <!-- Quantity Box (Active only when in stock) -->  
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
                                    <!-- Out of Stock Button State -->
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

    <!-- JavaScript for Changing Main Image and Blurred Background Filler on Thumbnail Click -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mainImage = document.getElementById("main-image");
            const bgBlurImage = document.getElementById("bg-blur-image");
            
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('thumbnail-img')) {
                    if (mainImage) mainImage.src = event.target.src;
                    if (bgBlurImage) bgBlurImage.src = event.target.src;
                }
            });
        });
    </script>
</div>