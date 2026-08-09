<div>

  <section class="bg-[#f8f9fa] py-12" id="shop">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
      
      <h2 class="mb-6 text-center text-2xl sm:text-3xl text-black font-bold tracking-wide uppercase">
        Our Products
      </h2>

      <!-- 1. INITIAL LOADING STATE (SKELETON GRID) -->
      @if($isLoading && $page === 1)
      <x-skeleton-loading/>
        {{-- <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
          @for ($i = 0; $i < 8; $i++)
            <div>
              <div class="relative bg-white rounded-[10px] overflow-hidden p-3 text-center shadow-[0_4px_12px_rgba(0,0,0,0.1)] animate-pulse">
                <!-- White Shimmer Wave Overlay -->
                <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/70 to-transparent animate-shimmer z-10 pointer-events-none"></div>

                <!-- Image Placeholder -->
                <div class="w-full aspect-square bg-gray-200 rounded-md mb-3"></div>

                <!-- Title Line Skeleton -->
                <div class="h-4 sm:h-5 bg-gray-200 rounded w-3/4 mx-auto mt-3 mb-2"></div>

                <!-- Price Line Skeleton -->
                <div class="h-5 sm:h-6 bg-gray-200 rounded w-1/2 mx-auto mb-2"></div>

                <!-- Button Placeholder Skeleton -->
                <div class="h-9 bg-gray-200 rounded w-24 mx-auto mt-2.5"></div>
              </div>
            </div>
          @endfor
        </div> --}}

      <!-- 2. NETWORK ERROR STATE -->
      @elseif($networkError && count($products) === 0)
      <x-fetch-error/>
        {{-- <div class="bg-white rounded-[10px] p-8 text-center shadow-[0_4px_12px_rgba(0,0,0,0.1)] max-w-md mx-auto my-6 border border-red-100">
          <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h12a4 4 0 001-7.9 5 5 0 00-9.9-1.2A4.5 4.5 0 003 15z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 4h.01"></path>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-gray-900 mb-1">Failed to load products</h3>
          <p class="text-xs sm:text-sm text-gray-500 mb-5">We couldn't reach the server. Please check your internet connection.</p>
          <button 
            wire:click="fetchProducts(1)" 
            class="bg-black hover:bg-gray-800 text-white border-none py-2 px-6 rounded-full font-bold text-xs tracking-wider transition-all duration-300 cursor-pointer uppercase shadow-md active:scale-95"
          >
            Retry
          </button>
        </div> --}}

      <!-- 3. EMPTY PRODUCT STATE -->
      @elseif(count($products) === 0)
        <x-empty-section-state heightClass="h-44" message="No fresh batch items or our products discovered." />
      <!-- 4. PRODUCT GRID -->
      @else
        <div id="append-featured-product" class="grid grid-cols-2 md:grid-cols-4 gap-4">
          @foreach($products as $product)
            @php
              $sellingPrice = (float)($product['SellingPrice'] ?? 0);
              $onlineRate   = isset($product['OnlineRate']) ? (float)$product['OnlineRate'] : null;
              $hasDiscount  = $onlineRate && $onlineRate < $sellingPrice;
            @endphp

            <div data-aos="fade-up" data-aos-duration="1000">
              <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)]">
                
                <!-- Image or Fallback Component -->
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

                <!-- Product Name -->
                <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                  {{ $product['ProductName'] ?? 'Product Name' }}
                </div>

                <!-- Pricing Section with Discount Logic -->
                <div class="text-[15px] sm:text-[20px] text-black mb-2 flex items-center justify-center gap-1 font-bold">
                  @if($hasDiscount)
                    <span class="text-sm sm:text-lg font-black">&#8358;{{ number_format($onlineRate) }}</span>
                    <span class="text-xs sm:text-sm text-red-600 line-through font-semibold">&#8358;{{ number_format($sellingPrice) }}</span>
                  @else
                    <span class="text-lg sm:text-xl">&#8358;</span>
                    <span>{{ number_format($sellingPrice) }}</span>
                  @endif
                </div>

                <!-- Action Button -->
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

  <!-- 5. DYNAMIC LOAD MORE BUTTON SECTION -->
  @if($hasMore && count($products) > 0)
    <section>
        <div id="Featured-load-More-Btn" class="text-center mt-2 px-4 mb-8">
            <button 
            wire:click="loadMore"
            wire:loading.attr="disabled"
            class="bg-black hover:bg-gray-800 text-white border-none font-bold py-3 px-6 rounded shadow-md w-full min-[701px]:w-[40%] transition-all duration-200 cursor-pointer uppercase tracking-wider text-sm inline-flex items-center justify-center gap-2"
            >
            <!-- Loading Spinner Icon -->
            <svg 
                wire:loading 
                wire:target="loadMore" 
                class="animate-spin h-4 w-4 text-white" 
                fill="none" 
                viewBox="0 0 24 24"
            >
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>

            <!-- Default Text State -->
            <span wire:loading.remove wire:target="loadMore">
                Load More
            </span>

            <!-- Active Loading Text State -->
            <span wire:loading wire:target="loadMore">
                Fetching Products...
            </span>
            </button>
        </div>
    </section>
  @endif


</div>

