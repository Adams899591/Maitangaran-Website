<div>
    
    
    <!-- Our Featured Section -->
  <section class="bg-[#f8f9fa] py-12" id="featured-shop">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
        <h2 class="mb-6 text-center text-2xl sm:text-3xl text-black font-bold tracking-wide uppercase">
        Featured Products
        </h2>

        <!-- 1. LOADING STATE -->
        @if($isLoading)
        <x-skeleton-loading />

        <!-- 2. NETWORK ERROR STATE -->
        @elseif($networkError)
        <x-fetch-error />

        <!-- 3. EMPTY STATE -->
        @elseif(count($products) === 0)
        <x-empty-section-state heightClass="h-48" message="No featured products found." />

        <!-- 4. FEATURED PRODUCTS HORIZONTAL SCROLL -->
        @else
        <div 
            id="append-featured-product" 
            class="flex overflow-x-auto gap-4 pb-4 snap-x snap-mandatory scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100"
        >
            @foreach($products as $product)
            @php
                $sellingPrice = (float)($product['SellingPrice'] ?? 0);
                $onlineRate   = isset($product['OnlineRate']) ? (float)$product['OnlineRate'] : null;
                $hasDiscount  = $onlineRate && $onlineRate < $sellingPrice;
            @endphp

            <div data-aos="fade-up" data-aos-duration="1000" class="flex-none w-[220px] sm:w-[260px] md:w-[280px] snap-start">
                <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
                
                <!-- Product Image -->
                <div class="relative overflow-hidden aspect-square">
                    @if(!empty($product['SmallImage']))
                    <img 
                        src="{{ $product['SmallImage'] }}" 
                        alt="{{ $product['ProductName'] ?? 'Product' }}" 
                        class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                    />
                    @else
                    <x-no-image-uploaded heightClass="aspect-square" />
                    @endif
                </div>

                <!-- Title -->
                <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1 uppercase">
                    {{ $product['ProductName'] ?? 'PRODUCT NAME' }}
                </div>

                <!-- Price & Discount Logic -->
                <div class="text-[15px] sm:text-[20px] text-black mb-2 flex items-center justify-center gap-1 font-bold">
                    @if($hasDiscount)
                    <span class="text-sm sm:text-lg font-black">&#8358;{{ number_format($onlineRate) }}</span>
                    <span class="text-xs sm:text-sm text-red-600 line-through font-semibold">&#8358;{{ number_format($sellingPrice) }}</span>
                    @else
                    <span class="text-lg sm:text-xl">&#8358;</span>
                    <span>{{ number_format($sellingPrice) }}</span>
                    @endif
                </div>

                <!-- Action Link -->
                <a href="{{ route('single-product', ['id' => $product['ID'] ?? null]) }}">
                  <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                    Buy Now
                  </button>
                </a>

                </div>
            </div>
            @endforeach
        </div>
        @endif

    </div>
 </section>

</div>
