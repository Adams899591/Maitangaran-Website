











{{-- <div>
  <div class="max-w-7xl mx-auto px-4 py-8 relative">

    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

      <!-- ==================== SIDEBAR FILTER ==================== -->
      <div class="md:col-span-3">
        <div class="bg-white p-6 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.15)] mb-6">
          <h5 class="text-lg font-bold text-gray-900 mb-4">Filter Products</h5>

          <form wire:submit.prevent="searchCategory">
            <h6 class="font-bold text-gray-800 text-sm mb-3">Category</h6>

            <!-- Slim Scrollable Container for Categories -->
            <div class="max-h-48 overflow-y-auto pr-2 space-y-2.5 custom-scrollbar mb-4 border-b border-gray-100 pb-3">
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Shoe" name="category" wire:model="category" class="accent-black" /> Shoes
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Pullover" name="category" wire:model="category" class="accent-black" /> Pullover
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Watches" name="category" wire:model="category" class="accent-black" /> Watches
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Cloth" name="category" wire:model="category" class="accent-black" /> Cloths
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Bag" name="category" wire:model="category" class="accent-black" /> Bags
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Jewelry" name="category" wire:model="category" class="accent-black" /> Jewelry
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Electronics" name="category" wire:model="category" class="accent-black" /> Electronics
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Sunglasses" name="category" wire:model="category" class="accent-black" /> Sunglasses
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Perfumes" name="category" wire:model="category" class="accent-black" /> Perfumes
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Belts" name="category" wire:model="category" class="accent-black" /> Belts
              </label>
            </div>

            <h6 class="font-bold text-gray-800 text-sm mt-3 mb-2">Price</h6>
            <input 
              type="range" 
              name="rangePrice" 
              wire:model.defer="rangePrice"
              class="w-full accent-black cursor-pointer" 
              id="priceRange" 
              min="2000" 
              max="20000" 
              value="9000" 
              oninput="updatePriceDisplay()" 
            />
            
            <div class="flex justify-between text-xs text-gray-500 mt-1">
              <span>&#8358;2,000</span>
              <span id="priceValue" class="font-bold text-gray-800">&#8358;9,000</span>
              <span>&#8358;20,000</span>
            </div>

            <!-- Main Search Button with In-Line Livewire Spinner -->
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
        <p class="text-sm font-semibold text-gray-600 mb-6">Here you can check out our products</p>

        <!-- Products Grid -->
        <div id="SearchProductsinput" class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">

          <!-- CARD 1: WITH IMAGE -->
          <div data-aos="fade-up" data-aos-duration="5000">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div>
                <div class="relative overflow-hidden aspect-square rounded-md">
                  <img 
                    src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=600&auto=format&fit=crop" 
                    alt="Designer Men Sneakers" 
                    class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                  >
                </div>
                
                <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                  Designer Men Sneakers
                </div>
                
                <div class="text-[15px] sm:text-[20px] text-black my-2 flex items-center justify-center gap-1 font-bold">
                  <span class="text-lg sm:text-xl">&#8358;</span>
                  <span>42,500</span>
                </div>
              </div>

              <a href="">
                  <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                    Buy Now
                  </button>
              </a>
            </div>
          </div>

          <!-- CARD 2: NO IMAGE / FALLBACK COMPONENT -->
          <div data-aos="fade-up" data-aos-duration="5000">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div>
                <x-no-image-uploaded heightClass="aspect-square" />

                <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                  Leather Smart Watch
                </div>
                
                <div class="text-[15px] sm:text-[20px] text-black my-2 flex items-center justify-center gap-1 font-bold">
                  <span class="text-lg sm:text-xl">&#8358;</span>
                  <span>18,000</span>
                </div>
              </div>

               <a href="">
                  <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                    Buy Now
                  </button>
              </a>
            </div>
          </div>

          <!-- CARD 3: WITH IMAGE -->
          <div data-aos="fade-up" data-aos-duration="5000">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div>
                <div class="relative overflow-hidden aspect-square rounded-md">
                  <img 
                    src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=600&auto=format&fit=crop" 
                    alt="Luxury Leather Handbag" 
                    class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                  >
                </div>
                
                <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                  Luxury Leather Handbag
                </div>
                
                <div class="text-[15px] sm:text-[20px] text-black my-2 flex items-center justify-center gap-1 font-bold">
                  <span class="text-lg sm:text-xl">&#8358;</span>
                  <span>25,000</span>
                </div>
              </div>

              <a href="single.product.php?GetSingleProductId=3" class="block mt-2">
                <button class="w-full bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

          <!-- CARD 4: NO IMAGE / FALLBACK COMPONENT -->
          <div data-aos="fade-up" data-aos-duration="5000">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div>
                <x-no-image-uploaded heightClass="aspect-square" />

                <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                  Cotton Pullover Hoodie
                </div>
                
                <div class="text-[15px] sm:text-[20px] text-black my-2 flex items-center justify-center gap-1 font-bold">
                  <span class="text-lg sm:text-xl">&#8358;</span>
                  <span>12,000</span>
                </div>
              </div>

              <a href="single.product.php?GetSingleProductId=4" class="block mt-2">
                <button class="w-full bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

        </div>

        <!-- Pagination Container -->
        <div class="flex justify-center mt-8">
          <ul id="pagination-container" class="inline-flex gap-1"></ul>
        </div>

      </div>

    </div>
  </div>

  <!-- Custom CSS for a clean scrollbar on the category list -->
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

  <!-- JavaScript for Sidebar Price Display -->
  <script>
    function updatePriceDisplay() {
      const slider = document.getElementById('priceRange');
      const display = document.getElementById('priceValue');
      display.textContent = `₦${parseInt(slider.value).toLocaleString()}`;
    }
  </script>

</div> --}}









{{-- <div>
  <div class="max-w-7xl mx-auto px-4 py-8 relative">

    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

      <!-- ==================== SIDEBAR FILTER ==================== -->
      <div class="md:col-span-3">
        <div class="bg-white p-6 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.15)] mb-6">
          <h5 class="text-lg font-bold text-gray-900 mb-4">Filter Products</h5>

          <form wire:submit.prevent="searchCategory">
            <h6 class="font-bold text-gray-800 text-sm mb-2">Category</h6>

            <!-- NEW: Category Search Input with Search/Loading Icon -->
            <div class="relative mb-3">
              <input 
                type="text" 
                wire:model.live.debounce.300ms="categorySearch"
                placeholder="Search categories..." 
                class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block pl-3 pr-9 py-2 outline-none transition-all"
              />
              <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <!-- Search Icon (Default) -->
                <svg wire:loading.remove wire:target="categorySearch" class="w-4 h-4 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607z" />
                </svg>

                <!-- Loading Spinner (While searching/filtering categories) -->
                <svg wire:loading wire:target="categorySearch" class="animate-spin w-4 h-4 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
              </div>
            </div>

            <!-- Slim Scrollable Container for Categories -->
            <div class="max-h-48 overflow-y-auto pr-2 space-y-2.5 custom-scrollbar mb-4 border-b border-gray-100 pb-3">
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Shoe" name="category" wire:model="category" class="accent-black" /> Shoes
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Pullover" name="category" wire:model="category" class="accent-black" /> Pullover
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Watches" name="category" wire:model="category" class="accent-black" /> Watches
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Cloth" name="category" wire:model="category" class="accent-black" /> Cloths
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Bag" name="category" wire:model="category" class="accent-black" /> Bags
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Jewelry" name="category" wire:model="category" class="accent-black" /> Jewelry
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Electronics" name="category" wire:model="category" class="accent-black" /> Electronics
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Sunglasses" name="category" wire:model="category" class="accent-black" /> Sunglasses
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Perfumes" name="category" wire:model="category" class="accent-black" /> Perfumes
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Belts" name="category" wire:model="category" class="accent-black" /> Belts
              </label>
            </div>

            <h6 class="font-bold text-gray-800 text-sm mt-3 mb-2">Price</h6>
            <input 
              type="range" 
              name="rangePrice" 
              wire:model.defer="rangePrice"
              class="w-full accent-black cursor-pointer" 
              id="priceRange" 
              min="2000" 
              max="20000" 
              value="9000" 
              oninput="updatePriceDisplay()" 
            />
            
            <div class="flex justify-between text-xs text-gray-500 mt-1">
              <span>&#8358;2,000</span>
              <span id="priceValue" class="font-bold text-gray-800">&#8358;9,000</span>
              <span>&#8358;20,000</span>
            </div>

            <!-- Main Search Button -->
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
        <p class="text-sm font-semibold text-gray-600 mb-6">Here you can check out our products</p>

        <!-- Products Grid -->
        <div id="SearchProductsinput" class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">

          <!-- CARD 1: WITH IMAGE -->
          <div data-aos="fade-up" data-aos-duration="5000">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div>
                <div class="relative overflow-hidden aspect-square rounded-md">
                  <img 
                    src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=600&auto=format&fit=crop" 
                    alt="Designer Men Sneakers" 
                    class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                  >
                </div>
                
                <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                  Designer Men Sneakers
                </div>
                
                <div class="text-[15px] sm:text-[20px] text-black my-2 flex items-center justify-center gap-1 font-bold">
                  <span class="text-lg sm:text-xl">&#8358;</span>
                  <span>42,500</span>
                </div>
              </div>

              <a href="">
                  <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                    Buy Now
                  </button>
              </a>
            </div>
          </div>

          <!-- CARD 2: NO IMAGE / FALLBACK COMPONENT -->
          <div data-aos="fade-up" data-aos-duration="5000">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div>
                <x-no-image-uploaded heightClass="aspect-square" />

                <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                  Leather Smart Watch
                </div>
                
                <div class="text-[15px] sm:text-[20px] text-black my-2 flex items-center justify-center gap-1 font-bold">
                  <span class="text-lg sm:text-xl">&#8358;</span>
                  <span>18,000</span>
                </div>
              </div>

               <a href="">
                  <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                    Buy Now
                  </button>
              </a>
            </div>
          </div>

          <!-- CARD 3: WITH IMAGE -->
          <div data-aos="fade-up" data-aos-duration="5000">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div>
                <div class="relative overflow-hidden aspect-square rounded-md">
                  <img 
                    src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=600&auto=format&fit=crop" 
                    alt="Luxury Leather Handbag" 
                    class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                  >
                </div>
                
                <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                  Luxury Leather Handbag
                </div>
                
                <div class="text-[15px] sm:text-[20px] text-black my-2 flex items-center justify-center gap-1 font-bold">
                  <span class="text-lg sm:text-xl">&#8358;</span>
                  <span>25,000</span>
                </div>
              </div>

              <a href="single.product.php?GetSingleProductId=3" class="block mt-2">
                <button class="w-full bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

          <!-- CARD 4: NO IMAGE / FALLBACK COMPONENT -->
          <div data-aos="fade-up" data-aos-duration="5000">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div>
                <x-no-image-uploaded heightClass="aspect-square" />

                <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                  Cotton Pullover Hoodie
                </div>
                
                <div class="text-[15px] sm:text-[20px] text-black my-2 flex items-center justify-center gap-1 font-bold">
                  <span class="text-lg sm:text-xl">&#8358;</span>
                  <span>12,000</span>
                </div>
              </div>

              <a href="single.product.php?GetSingleProductId=4" class="block mt-2">
                <button class="w-full bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

        </div>

        <!-- Pagination Container -->
        <div class="flex justify-center mt-8">
          <ul id="pagination-container" class="inline-flex gap-1"></ul>
        </div>

      </div>

    </div>
  </div>

  <!-- Custom CSS for a clean scrollbar on the category list -->
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

  <!-- JavaScript for Sidebar Price Display -->
  <script>
    function updatePriceDisplay() {
      const slider = document.getElementById('priceRange');
      const display = document.getElementById('priceValue');
      display.textContent = `₦${parseInt(slider.value).toLocaleString()}`;
    }
  </script>

</div> --}}









<div>
  <x-skeleton-loading-shop/>
  <div class="max-w-7xl mx-auto px-4 py-8 relative">

    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

      <!-- ==================== SIDEBAR FILTER ==================== -->
      <div class="md:col-span-3">
        <div class="bg-white p-6 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.15)] mb-6">
          <h5 class="text-lg font-bold text-gray-900 mb-4">Filter Products</h5>

          <form wire:submit.prevent="searchCategory">
            <h6 class="font-bold text-gray-800 text-sm mb-2">Category</h6>

            <!-- NEW: Category Search Input with Interactive Black Button & White Icon -->
            <div class="relative mb-3 flex items-center">
              <input 
                type="text" 
                wire:model.defer="categorySearch"
                placeholder="Search categories..." 
                class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block pl-3 pr-11 py-2 outline-none transition-all"
              />
              
              <!-- Black Button Wrapper on the Right -->
              <button 
                type="button" 
                wire:click="filterCategories"
                wire:loading.attr="disabled"
                class="absolute right-1 top-1 bottom-1 bg-black hover:bg-gray-800 disabled:opacity-75 text-white px-2.5 rounded-md flex items-center justify-center transition-colors cursor-pointer"
                title="Search Categories"
              >
                <!-- Default White Search Icon -->
                <svg wire:loading.remove wire:target="filterCategories" class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607z" />
                </svg>

                <!-- Loading White Spinner (When Clicked) -->
                <svg wire:loading wire:target="filterCategories" class="animate-spin w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
              </button>
            </div>

            <!-- Slim Scrollable Container for Categories -->
            <div class="max-h-48 overflow-y-auto pr-2 space-y-2.5 custom-scrollbar mb-4 border-b border-gray-100 pb-3">
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Shoe" name="category" wire:model="category" class="accent-black" /> Shoes
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Pullover" name="category" wire:model="category" class="accent-black" /> Pullover
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Watches" name="category" wire:model="category" class="accent-black" /> Watches
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Cloth" name="category" wire:model="category" class="accent-black" /> Cloths
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Bag" name="category" wire:model="category" class="accent-black" /> Bags
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Jewelry" name="category" wire:model="category" class="accent-black" /> Jewelry
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Electronics" name="category" wire:model="category" class="accent-black" /> Electronics
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Sunglasses" name="category" wire:model="category" class="accent-black" /> Sunglasses
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Perfumes" name="category" wire:model="category" class="accent-black" /> Perfumes
              </label>
              <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer hover:text-black">
                <input type="radio" value="Belts" name="category" wire:model="category" class="accent-black" /> Belts
              </label>
            </div>

            <h6 class="font-bold text-gray-800 text-sm mt-3 mb-2">Price</h6>
            <input 
              type="range" 
              name="rangePrice" 
              wire:model.defer="rangePrice"
              class="w-full accent-black cursor-pointer" 
              id="priceRange" 
              min="2000" 
              max="20000" 
              value="9000" 
              oninput="updatePriceDisplay()" 
            />
            
            <div class="flex justify-between text-xs text-gray-500 mt-1">
              <span>&#8358;2,000</span>
              <span id="priceValue" class="font-bold text-gray-800">&#8358;9,000</span>
              <span>&#8358;20,000</span>
            </div>

            <!-- Main Search Button -->
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
        <p class="text-sm font-semibold text-gray-600 mb-6">Here you can check out our products</p>

        <!-- Products Grid -->
        <div id="SearchProductsinput" class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">

          <!-- CARD 1: WITH IMAGE -->
          <div data-aos="fade-up" data-aos-duration="5000">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div>
                <div class="relative overflow-hidden aspect-square rounded-md">
                  <img 
                    src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=600&auto=format&fit=crop" 
                    alt="Designer Men Sneakers" 
                    class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                  >
                </div>
                
                <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                  Designer Men Sneakers
                </div>
                
                <div class="text-[15px] sm:text-[20px] text-black my-2 flex items-center justify-center gap-1 font-bold">
                  <span class="text-lg sm:text-xl">&#8358;</span>
                  <span>42,500</span>
                </div>
              </div>

              <a href="">
                  <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                    Buy Now
                  </button>
              </a>
            </div>
          </div>

          <!-- CARD 2: NO IMAGE / FALLBACK COMPONENT -->
          <div data-aos="fade-up" data-aos-duration="5000">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div>
                <x-no-image-uploaded heightClass="aspect-square" />

                <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                  Leather Smart Watch
                </div>
                
                <div class="text-[15px] sm:text-[20px] text-black my-2 flex items-center justify-center gap-1 font-bold">
                  <span class="text-lg sm:text-xl">&#8358;</span>
                  <span>18,000</span>
                </div>
              </div>

               <a href="">
                  <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                    Buy Now
                  </button>
              </a>
            </div>
          </div>

          <!-- CARD 3: WITH IMAGE -->
          <div data-aos="fade-up" data-aos-duration="5000">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div>
                <div class="relative overflow-hidden aspect-square rounded-md">
                  <img 
                    src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=600&auto=format&fit=crop" 
                    alt="Luxury Leather Handbag" 
                    class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                  >
                </div>
                
                <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                  Luxury Leather Handbag
                </div>
                
                <div class="text-[15px] sm:text-[20px] text-black my-2 flex items-center justify-center gap-1 font-bold">
                  <span class="text-lg sm:text-xl">&#8358;</span>
                  <span>25,000</span>
                </div>
              </div>

              <a href="single.product.php?GetSingleProductId=3" class="block mt-2">
                <button class="w-full bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

          <!-- CARD 4: NO IMAGE / FALLBACK COMPONENT -->
          <div data-aos="fade-up" data-aos-duration="5000">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div>
                <x-no-image-uploaded heightClass="aspect-square" />

                <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                  Cotton Pullover Hoodie
                </div>
                
                <div class="text-[15px] sm:text-[20px] text-black my-2 flex items-center justify-center gap-1 font-bold">
                  <span class="text-lg sm:text-xl">&#8358;</span>
                  <span>12,000</span>
                </div>
              </div>

              <a href="single.product.php?GetSingleProductId=4" class="block mt-2">
                <button class="w-full bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

        </div>

        <!-- Pagination Container -->
        <div class="flex justify-center mt-8">
          <ul id="pagination-container" class="inline-flex gap-1"></ul>
        </div>

      </div>

    </div>
  </div>

  <!-- Custom CSS for a clean scrollbar on the category list -->
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

  <!-- JavaScript for Sidebar Price Display -->
  <script>
    function updatePriceDisplay() {
      const slider = document.getElementById('priceRange');
      const display = document.getElementById('priceValue');
      display.textContent = `₦${parseInt(slider.value).toLocaleString()}`;
    }
  </script>

   
</div>