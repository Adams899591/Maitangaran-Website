


<div>
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- 1. SKELETON LOADING STATE -->
            @if($isLoading)
                <x-skeleton-loading2 />

            <!-- 2. NETWORK ERROR STATE -->
            @elseif($networkError)
                <x-fetch-error />

            <!-- 3. EMPTY STATE / PRODUCT NOT FOUND -->
            @elseif(!$product)
                <x-empty-section-state heightClass="h-44" message="Product not found or unavailable." />

            <!-- 4. PRODUCT CONTENT SECTION -->
            @else
                @php
                    // Raw Pricing computation (Variant vs Main product)
                    $rawOnline  = (float)($selectedVariant['OnlineRate'] ?? $product['OnlineRate'] ?? 0);
                    $rawSelling = (float)($selectedVariant['SellingPrice'] ?? $product['SellingPrice'] ?? 0);

                    // Check discount
                    $hasDiscount = ($rawOnline > 0 && $rawOnline < $rawSelling);
                    $currentPrice = $hasDiscount ? $rawOnline : $rawSelling;

                    // Compute stock level
                    $currentStock = $selectedVariant 
                        ? ($selectedVariant['StockLevel'] ?? $selectedVariant['Qty'] ?? 0) 
                        : ($product['StockLevel'] ?? 0);

                    // Collect features list
                    $featuresList = !empty($product['Features']) 
                        ? array_map('trim', explode(',', $product['Features'])) 
                        : [];

                    // Collect gallery images
                    $galleryImages = $product['Images'] ?? [];
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- Left Column: Image & Thumbnails Section -->
                    <div class="bg-white rounded-xl shadow-lg p-6 h-full flex flex-col justify-between">
                        <div>
                            <!-- Main Product Container -->
                            <div class="product-image mb-4 w-full h-[400px] bg-gray-900 rounded-lg overflow-hidden flex items-center justify-center relative">
                                @if($activeImageUrl)
                                    <!-- Blurred Duplicate Background Filler -->
                                    <div class="absolute inset-0 filter blur-xl opacity-40 scale-110 overflow-hidden pointer-events-none flex items-center justify-center">
                                        <img src="{{ $activeImageUrl }}" alt="" class="w-full h-full object-cover">
                                    </div>
                                    <!-- Active Image -->
                                    <img 
                                        src="{{ $activeImageUrl }}" 
                                        alt="{{ $product['ProductName'] ?? 'Product Image' }}" 
                                        class="relative z-10 w-full h-full object-contain rounded-lg shadow-md"
                                    >
                                @else
                                    <x-no-image-uploaded heightClass="h-full w-full" />
                                @endif
                            </div>  
                   
                            <!-- Thumbnails Section -->
                            @if(count($galleryImages) > 0)
                                <div class="mt-4 flex flex-wrap gap-2">
                                    @foreach($galleryImages as $img)
                                        @php
                                            $imgUrl = $img['FullImageUrl'] ?? $img['ImagePath'] ?? '';
                                            $isSelected = ($activeImageUrl === $imgUrl);
                                        @endphp

                                        <div 
                                            wire:click="selectImage('{{ $imgUrl }}')"
                                            class="w-[22%] h-20 bg-gray-900 rounded-md overflow-hidden flex items-center justify-center relative cursor-pointer border-2 transition-all duration-200 {{ $isSelected ? 'border-black scale-105' : 'border-transparent opacity-80 hover:opacity-100' }}"
                                        >
                                            <img 
                                                src="{{ $imgUrl }}" 
                                                alt="Thumbnail" 
                                                class="w-full h-full object-cover"
                                            >
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>  

                    <!-- Right Column: Add to Cart & Product Info Section -->
                    <div>  
                        <div class="bg-white rounded-xl shadow-lg p-6 h-full flex flex-col justify-between">  
                            <div>
                                <!-- Product Title -->
                                <h1 class="text-3xl font-semibold text-gray-900 mb-2">
                                    {{ $product['ProductName'] ?? 'Product Title' }}
                                </h1>  
                                
                                <!-- Price display -->
                                <div class="flex items-center gap-2 my-2 text-black text-2xl font-medium"> 
                                    <span class="font-bold">&#8358; {{ number_format($currentPrice) }}</span>
                                    
                                    @if($hasDiscount)
                                        <span class="text-base text-red-500 line-through font-normal">
                                            &#8358; {{ number_format($rawSelling) }}
                                        </span>
                                    @endif
                                </div>  

                                <!-- Stock / Availability Badge -->
                                <div class="mb-4">
                                    @if($currentStock > 0)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <span class="w-2 h-2 mr-1.5 bg-green-500 rounded-full"></span>
                                            {{ $currentStock }} {{ $product['Units'] ?? 'items' }} left in stock
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <span class="w-2 h-2 mr-1.5 bg-red-500 rounded-full"></span>
                                            Out of Stock
                                        </span>
                                    @endif
                                </div>

                                <!-- Variants Picker (If variants exist) -->
                                @if(!empty($product['Variants']))
                                    <div class="mb-5">
                                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Options</span>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($product['Variants'] as $variant)
                                                @php
                                                    $isVarSelected = ($selectedVariant['ID'] ?? null) === ($variant['ID'] ?? null);
                                                @endphp
                                                <button 
                                                    type="button"
                                                    wire:click="selectVariant({{ json_encode($variant) }})"
                                                    class="px-4 py-2 rounded-lg text-xs font-bold border transition-all {{ $isVarSelected ? 'bg-black text-white border-black' : 'bg-white text-gray-800 border-gray-300 hover:border-gray-400' }}"
                                                >
                                                    {{ $variant['Attribute'] ?? 'Option' }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Description -->
                                <div class="text-gray-600 font-medium text-base leading-relaxed mb-6">  
                                    {{ $product['Description'] ?? 'No description available for this product.' }}
                                </div>

                                <!-- Features / Highlights -->
                                @if(count($featuresList) > 0)
                                    <div class="mb-6">
                                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Highlights</span>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($featuresList as $feature)
                                                <span class="bg-gray-100 text-gray-800 text-xs px-2.5 py-1 rounded-md font-medium">
                                                    ✓ {{ $feature }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Livewire Form Action -->
                            <form wire:submit.prevent="addToCart" class="space-y-6">
                                <!-- Quantity Controls -->  
                                <div class="flex items-center gap-2 mb-4">  
                                    <button 
                                        type="button" 
                                        wire:click="adjustQuantity(-1)"
                                        class="bg-slate-700 hover:bg-slate-800 text-white border-none px-3 py-1.5 rounded text-base transition-colors"
                                    >-</button>  

                                    <input 
                                        type="number" 
                                        wire:model="quantity" 
                                        readonly
                                        class="w-16 text-center border border-gray-300 rounded-md py-1.5 focus:outline-none" 
                                    />  

                                    <button 
                                        type="button" 
                                        wire:click="adjustQuantity(1)"
                                        class="bg-slate-700 hover:bg-slate-800 text-white border-none px-3 py-1.5 rounded text-base transition-colors"
                                    >+</button>  
                                </div>

                                <!-- Add to Cart Button -->
                                <button 
                                    type="submit" 
                                    @if($currentStock <= 0) disabled @endif
                                    class="w-full bg-slate-700 hover:bg-slate-800 disabled:bg-gray-400 disabled:cursor-not-allowed text-white border-none py-3 px-6 rounded-lg font-semibold text-base transition-all duration-200 shadow-md"
                                >
                                    {{ $currentStock > 0 ? 'Add to Cart' : 'Out of Stock' }}
                                </button> 
                            </form>
                        </div>  
                    </div>

                </div>  
            @endif

        </div>  
    </div>  
</div>
   

