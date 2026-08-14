



<div wire:init="fetchProducts">
  
  <!-- SKELETON LOADER STATE (Shows immediately while API fetch or search runs) -->
  @if($isLoading && count($products) === 0)
    <x-skeleton-loading-shop/>
  @else

  <div class="max-w-7xl mx-auto px-4 py-8 relative">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

      <!-- ==================== SIDEBAR FILTER ==================== -->
      <div class="md:col-span-3">
        <div class="bg-white p-6 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.15)] mb-6">
          <h5 class="text-lg font-bold text-gray-900 mb-4">Filter Products</h5>

          <form wire:submit.prevent="searchCategory">
            <h6 class="font-bold text-gray-800 text-sm mb-2">Category</h6>

            <!-- SEARCH INPUT & MAGNIFYING ICON BUTTON -->
            <div class="relative mb-3 flex items-center">
              <input 
                type="text" 
                wire:model="categorySearch"
                placeholder="Search products..." 
                class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block pl-3 pr-11 py-2 outline-none transition-all"
              />
              
              <button 
                type="submit" 
                wire:loading.attr="disabled"
                class="absolute right-1 top-1 bottom-1 bg-black hover:bg-gray-800 disabled:opacity-75 text-white px-2.5 rounded-md flex items-center justify-center transition-colors cursor-pointer"
                title="Search Products"
              >
                <!-- Search Icon -->
                <svg wire:loading.remove wire:target="searchCategory" class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607z" />
                </svg>
                <!-- Spinner Icon while loading -->
                <svg wire:loading wire:target="searchCategory" class="animate-spin w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
              </button>
            </div>

            {{-- <div class="max-h-48 overflow-y-auto pr-2 space-y-2.5 custom-scrollbar mb-4 border-b border-gray-100 pb-3">
              @forelse($categories as $cat)
                <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                  <input 
                    type="radio" 
                    value="{{ $cat['Category'] ?? '' }}" 
                    name="category" 
                    wire:model="category" 
                    wire:change="searchByCategory"
                    class="accent-black" 
                  /> 
                  <span>{{ $cat['Category'] ?? 'Unnamed Category' }}</span>
                </label>
              @empty
                <p class="text-xs text-gray-400">No categories found.</p>
              @endforelse
           </div> --}}

<div class="max-h-48 overflow-y-auto pr-2 space-y-2.5 custom-scrollbar mb-4 border-b border-gray-100 pb-3">
  @forelse($categories as $cat)
    <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
      <input 
        type="radio" 
        value="{{ $cat['ID'] ?? '' }}" 
        name="category" 
        wire:model="category" 
        wire:change="searchByCategory"
        class="accent-black" 
      /> 
      <span>{{ $cat['Category'] ?? 'Unnamed Category' }}</span>
    </label>
  @empty
    <p class="text-xs text-gray-400">No categories found.</p>
  @endforelse
</div>


            <h6 class="font-bold text-gray-800 text-sm mt-3 mb-2">Price</h6>
            <input 
              type="range" 
              name="rangePrice" 
              wire:model="rangePrice"
              wire:change="searchByPrice"
              class="w-full accent-black cursor-pointer" 
              id="priceRange" 
              min="2000" 
              max="1000000" 
              value="500000" 
              oninput="updatePriceDisplay()" 
            />

            <div class="flex justify-between text-xs text-gray-500 mt-1">
              <span>&#8358;2,000</span>
              <span id="priceValue" class="font-bold text-gray-800">&#8358;500,000</span>
              <span>&#8358;1,000,000</span>
            </div>

            <button 
              type="submit" 
              wire:loading.attr="disabled"
              class="w-full mt-5 bg-black hover:bg-gray-800 disabled:opacity-75 text-white font-semibold py-2.5 px-4 rounded-md transition-colors duration-300 text-sm shadow-sm cursor-pointer flex items-center justify-center gap-2"
            >
              <svg wire:loading wire:target="searchCategory" class="animate-spin h-4 w-4 text-white shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              <span wire:loading.remove wire:target="searchCategory">Search</span>
              <span wire:loading wire:target="searchCategory">Searching...</span>
            </button>
          </form>
        </div>
      </div>

      <!-- ==================== MAIN PRODUCTS SECTION ==================== -->
      <div class="md:col-span-9">
        <h4 class="text-2xl font-bold text-gray-900 mb-1">Our Products</h4>
        <p class="text-sm font-semibold text-gray-600 mb-6">
          @if(!empty($categorySearch))
            Search results for "<span class="text-black font-bold">{{ $categorySearch }}</span>"
          @else
            Here you can check out our products
          @endif
        </p>

        <!-- Network Error State -->
        @if($networkError && count($products) === 0)
          <x-fetch-error retry-action="fetchProducts" />

        <!-- Empty / No Search Results Found State -->
        @elseif(count($products) === 0 && !$isLoading)
          <x-empty-section-state 
            heightClass="h-44" 
            message="{{ !empty($categorySearch) ? 'No search results found matching your query.' : 'No fresh batch items or our products discovered.' }}" 
          />

        <!-- Dynamic Product Display Grid -->
        @else
          <div id="SearchProductsinput" class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 min-h-[350px]">
            @foreach($currentProducts as $product)
              @php
                $sellingPrice = (float)($product['SellingPrice'] ?? 0);
                $onlineRate   = isset($product['OnlineRate']) ? (float)$product['OnlineRate'] : null;
                $hasDiscount  = $onlineRate && $onlineRate > 0 && $onlineRate < $sellingPrice;
              @endphp

              <div>
                <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
                  <div>
                    <div class="relative overflow-hidden aspect-square rounded-md">
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

                    <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                      {{ $product['ProductName'] ?? 'Product Name' }}
                    </div>

                    <div class="text-[15px] sm:text-[20px] text-black my-2 flex items-center justify-center gap-1 font-bold">
                      @if($hasDiscount)
                        <span class="text-sm sm:text-lg font-black">&#8358;{{ number_format($onlineRate) }}</span>
                        <span class="text-xs sm:text-sm text-red-600 line-through font-semibold">&#8358;{{ number_format($sellingPrice) }}</span>
                      @else
                        <span class="text-lg sm:text-xl">&#8358;</span>
                        <span>{{ number_format($sellingPrice) }}</span>
                      @endif
                    </div>
                  </div>

                  <a href="{{ route('single-product', ['id' => $product['ID'] ?? null]) }}">
                    <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                      Buy Now
                    </button>
                  </a>

                </div>
              </div>
            @endforeach
          </div>

          <!-- Dynamic Responsive Pagination Control Bar -->
          <div class="flex items-center justify-center mt-8">
            <div class="flex sm:hidden items-center justify-between w-full max-w-xs px-2 gap-2">
              <button 
                wire:click="previousPage"
                @if($currentPage === 1) disabled @endif
                class="px-3 py-1.5 rounded-md bg-gray-100 active:bg-gray-200 text-black text-xs font-bold disabled:opacity-40 disabled:cursor-not-allowed transition-colors"
              >
                Prev
              </button>

              <span class="text-xs font-bold text-gray-700 bg-gray-50 px-3 py-1.5 rounded-md border border-gray-200">
                {{ $currentPage }} / {{ $totalPages }}
              </span>

              <button 
                wire:click="nextPage"
                @if(!$hasMore && $currentPage >= $totalPages) disabled @endif
                class="px-3 py-1.5 rounded-md bg-gray-100 active:bg-gray-200 text-black text-xs font-bold disabled:opacity-40 disabled:cursor-not-allowed transition-colors"
              >
                Next
              </button>
            </div>

            <div class="hidden sm:flex items-center gap-1.5 sm:gap-2">
              <button 
                wire:click="previousPage"
                @if($currentPage === 1) disabled @endif
                class="px-3 py-1.5 rounded-md bg-gray-100 hover:bg-gray-200 text-black text-xs font-bold disabled:opacity-40 disabled:cursor-not-allowed transition-colors"
              >
                Prev
              </button>

              @foreach($paginationRange as $p)
                @if($p === '...')
                  <span class="px-2 py-1.5 text-xs font-bold text-gray-400 select-none">...</span>
                @else
                  <button 
                    wire:click="goToPage({{ $p }})"
                    class="px-3.5 py-1.5 rounded-md text-xs font-bold transition-colors {{ $currentPage === $p ? 'bg-black text-white' : 'bg-gray-100 text-black hover:bg-gray-200' }}"
                  >
                    {{ $p }}
                  </button>
                @endif
              @endforeach

              <button 
                wire:click="nextPage"
                @if(!$hasMore && $currentPage >= $totalPages) disabled @endif
                class="px-3 py-1.5 rounded-md bg-gray-100 hover:bg-gray-200 text-black text-xs font-bold disabled:opacity-40 disabled:cursor-not-allowed transition-colors"
              >
                Next
              </button>
            </div>
          </div>
        @endif

      </div>
    </div>
  </div>
  @endif

  <style>
    .custom-scrollbar::-webkit-scrollbar {
      width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
      background: #ccc;
      border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
      background: #000;
    }
  </style>

  <script>
    function updatePriceDisplay() {
        const slider = document.getElementById('priceRange');
        const display = document.getElementById('priceValue');

        if (slider && display) {
          display.textContent = `₦${parseInt(slider.value).toLocaleString()}`;
        }
    }
  </script>
</div>



