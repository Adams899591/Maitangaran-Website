   <!-- Our Products Section -->
    {{-- <section class="bg-[#f8f9fa] py-12" id="shop">
      <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
        <h2 class="mb-6 text-center text-2xl sm:text-3xl text-black font-bold tracking-wide uppercase">
          Our Products
        </h2>

        <!-- Products Grid -->
        <div id="append-featured-product" class="grid grid-cols-2 md:grid-cols-4 gap-4">


          {{-- Card 1 Note: Very important --}}
          <div data-aos="fade-up" data-aos-duration="5000">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)]">
              
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
              <a href="{{route("single-product")}}">
                <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

          <!-- Product Card 2 -->
          <div data-aos="fade-up" data-aos-duration="5000">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)]">
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
          <div data-aos="fade-up" data-aos-duration="5000">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)]">
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
          <div data-aos="fade-up" data-aos-duration="5000">
            <div class="group relative bg-white rounded-[10px] overflow-hidden p-3 text-center transition-transform duration-300 hover:-translate-y-1 shadow-[0_4px_12px_rgba(0,0,0,0.1)]">
              <div class="relative overflow-hidden aspect-square">
                <img 
                  {{-- src="{{asset("images/banner.png")}}"  --}}
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

        </div>
      </div>
    </section> --}}


    <!-- Load More Button Section -->
    {{-- <section>
      <div id="Featured-load-More-Btn" class="text-center mt-2 px-4">
        <button class="bg-black hover:bg-gray-800 text-white border-none font-bold py-3 px-6 rounded shadow-md w-full min-[701px]:w-[40%] transition-colors duration-200 cursor-pointer uppercase tracking-wider text-sm">
          Load More
        </button>
      </div>
    </section> --}}