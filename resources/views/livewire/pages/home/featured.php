
    <!-- Our Featured Section -->
    <section class="bg-[#f8f9fa] py-12" id="shop">
      <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
        <h2 class="mb-6 text-center text-2xl sm:text-3xl text-black font-bold tracking-wide uppercase">
          Featured Products
        </h2>

        <!-- Horizontal Scrollable Container -->
        <div 
          id="append-featured-product" 
          class="flex overflow-x-auto gap-4 pb-4 snap-x snap-mandatory scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100"
        >

          {{-- Card 1 Note: Very important --}}
          <div data-aos="fade-up" data-aos-duration="5000" class="flex-none w-[220px] sm:w-[260px] md:w-[280px] snap-start">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              
              {{-- @if(!empty($product->image)) --}}
                  {{-- Normal Image View --}}
                  {{-- <div class="relative overflow-hidden aspect-square">
                    <img 
                      src="{{ $product->image }}" 
                      alt="{{ $product->name }}" 
                      class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                    >
                  </div>
              @else --}}
                  {{-- Standalone Fallback Component --}}
                  <x-no-image-uploaded heightClass="aspect-square" />
              {{-- @endif --}}

              <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                {{ $product->name ?? 'Luxury Leather Handbag' }}
              </div>
              <div class="text-[15px] sm:text-[20px] text-black mb-2 flex items-center justify-center gap-1 font-bold">
                <span class="text-lg sm:text-xl">&#8358;</span>
                <span>{{ number_format($product->price ?? 25000) }}</span>
              </div>
              <a href="single.product.php?GetSingleProductId=1">
                <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

          <!-- Product Card 2 -->
          <div data-aos="fade-up" data-aos-duration="5000" class="flex-none w-[220px] sm:w-[260px] md:w-[280px] snap-start">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div class="relative overflow-hidden aspect-square">
                <img 
                  src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=600&auto=format&fit=crop" 
                  alt="Designer Men Sneakers" 
                  class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                >
              </div>
              <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                Designer Men Sneakers
              </div>
              <div class="text-[15px] sm:text-[20px] text-black mb-2 flex items-center justify-center gap-1 font-bold">
                <span class="text-lg sm:text-xl">&#8358;</span>
                <span>42,500</span>
              </div>
              <a href="single.product.php?GetSingleProductId=2">
                 <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

          <!-- Product Card 3 -->
          <div data-aos="fade-up" data-aos-duration="5000" class="flex-none w-[220px] sm:w-[260px] md:w-[280px] snap-start">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div class="relative overflow-hidden aspect-square">
                <img 
                  src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=600&auto=format&fit=crop" 
                  alt="Classic Chronograph Watch" 
                  class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                >
              </div>
              <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                Classic Chronograph Watch
              </div>
              <div class="text-[15px] sm:text-[20px] text-black mb-2 flex items-center justify-center gap-1 font-bold">
                <span class="text-lg sm:text-xl">&#8358;</span>
                <span>18,000</span>
              </div>
              <a href="single.product.php?GetSingleProductId=3">
                <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

          <!-- Product Card 4 -->
          <div data-aos="fade-up" data-aos-duration="5000" class="flex-none w-[220px] sm:w-[260px] md:w-[280px] snap-start">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div class="relative overflow-hidden aspect-square">
                <img 
                  src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=600&auto=format&fit=crop" 
                  alt="Luxury Designer Sunglasses" 
                  class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                >
              </div>
              <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                Luxury Designer Sunglasses
              </div>
              <div class="text-[15px] sm:text-[20px] text-black mb-2 flex items-center justify-center gap-1 font-bold">
                <span class="text-lg sm:text-xl">&#8358;</span>
                <span>30,000</span>
              </div>
              <a href="single.product.php?GetSingleProductId=4">
                <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

          <!-- Product Card 5 (Added) -->
          <div data-aos="fade-up" data-aos-duration="5000" class="flex-none w-[220px] sm:w-[260px] md:w-[280px] snap-start">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div class="relative overflow-hidden aspect-square">
                <img 
                  src="https://images.unsplash.com/photo-1608231387042-66d1773070a5?q=80&w=600&auto=format&fit=crop" 
                  alt="Minimalist Running Shoes" 
                  class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                >
              </div>
              <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                Minimalist Running Shoes
              </div>
              <div class="text-[15px] sm:text-[20px] text-black mb-2 flex items-center justify-center gap-1 font-bold">
                <span class="text-lg sm:text-xl">&#8358;</span>
                <span>35,000</span>
              </div>
              <a href="single.product.php?GetSingleProductId=5">
                <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

          <!-- Product Card 6 (Added) -->
          <div data-aos="fade-up" data-aos-duration="5000" class="flex-none w-[220px] sm:w-[260px] md:w-[280px] snap-start">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)] h-full flex flex-col justify-between">
              <div class="relative overflow-hidden aspect-square">
                <img 
                  src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=600&auto=format&fit=crop" 
                  alt="Premium Tote Bag" 
                  class="w-full h-full object-cover transition-transform duration-300 scale-[1.05] md:scale-100 md:group-hover:scale-110"
                >
              </div>
              <div class="font-bold mt-3 text-[13px] sm:text-[1.1rem] text-black line-clamp-1">
                Premium Leather Tote
              </div>
              <div class="text-[15px] sm:text-[20px] text-black mb-2 flex items-center justify-center gap-1 font-bold">
                <span class="text-lg sm:text-xl">&#8358;</span>
                <span>28,500</span>
              </div>
              <a href="single.product.php?GetSingleProductId=6">
                <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

        </div>
      </div>
    </section>