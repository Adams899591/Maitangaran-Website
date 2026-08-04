<div>

    <!-- Hero Banner Section (Updated Premium Styling) -->
    <header class="bg-gray-100/80 border-b border-gray-200 overflow-hidden">
      <div class="w-full">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 lg:max-w-7xl lg:mx-auto lg:px-8 lg:py-20 items-center">
          
          <!-- Text Container -->
          <div class="flex flex-col items-start justify-center order-1 px-4 sm:px-6 lg:px-0 py-10 lg:py-0">
            <span class="text-gray-800 font-bold tracking-wider uppercase text-[11px] md:text-xs mb-4 bg-gray-900/5 px-3.5 py-1.5 rounded-full border border-gray-300/60 shadow-sm">
              New Collection Available
            </span>
            <h5 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-gray-900 mb-5 leading-[1.15]">
              Discover Timeless Elegance & Premium Fabrics
            </h5>
            <p class="text-base sm:text-lg text-gray-600 mb-8 font-normal leading-relaxed max-w-xl">
              Elevate your style with Maitangaran's exclusive collection of luxurious traditional and contemporary fabrics crafted for perfection.
            </p>
            <div class="flex flex-wrap gap-3.5 w-full sm:w-auto">
              <a href="{{ route('shop') }}" class="bg-gray-900 hover:bg-black text-white font-bold px-7 py-3.5 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 no-underline flex items-center justify-center gap-2 flex-1 sm:flex-initial text-sm" wire:navigate>
                <span>Shop Now</span>
                <i class="fas fa-arrow-right text-xs"></i>
              </a>
              <a href="{{ route('about') }}" class="bg-white hover:bg-gray-50 text-gray-900 border border-gray-300 font-bold px-7 py-3.5 rounded-xl shadow-sm transition-all duration-300 no-underline flex items-center justify-center flex-1 sm:flex-initial text-sm"  wire:navigate>
                Learn More
              </a>
            </div>
          </div>

          <!-- Image Container -->
          <div class="w-full relative flex justify-center lg:justify-end order-2 pb-8 lg:pb-0">
            <div class="relative w-full max-w-lg lg:max-w-none rounded-2xl overflow-hidden shadow-xl border border-gray-300/80 bg-gray-200">
              <img src="https://images.unsplash.com/photo-1768758533474-5cd148638a98?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Maitangaran Fabrics Banner" class="w-full h-[320px] sm:h-[400px] lg:h-[480px] object-cover object-center">
            </div>
          </div>

        </div>
      </div>
    </header>


    
    <!-- Discover Luxury, Style & Quality Section -->
    <section>

        <!-- Add keyframe animation inline so it moves immediately -->
        <style>
        @keyframes marquee {
            0% { transform: translateX(0%); }
            100% { transform: translateX(-50%); }
        }
        .animate-marquee-smooth {
            display: flex;
            width: max-content;
            animation: marquee 25s linear infinite;
        }
        .animate-marquee-smooth:hover {
            animation-play-state: paused; /* Pauses smoothly when user hovers */
        }
        </style>

        <!-- Sleek Infinite Marquee Ticker with Icons -->
        <div class="bg-gray-900 border-b border-gray-800 text-gray-200 py-3 text-xs sm:text-sm font-semibold tracking-wider uppercase overflow-hidden select-none">
        <div class="flex whitespace-nowrap animate-marquee-smooth">
            
            <!-- First Pass -->
            <div class="flex items-center space-x-6 shrink-0">
            <span class="flex items-center gap-2 text-amber-400 font-bold">
                <i class="fas fa-store text-base"></i> Welcome to Cartévo
            </span>
            <span class="text-gray-600 text-xs">◆</span>
            <span class="flex items-center gap-2">
                <i class="fas fa-[#D4AF37] fa-tshirt text-amber-400"></i> Quality Fashion & Footwear
            </span>
            <span class="text-gray-600 text-xs">◆</span>
            <span class="flex items-center gap-2">
                <i class="fas fa-mobile-alt text-amber-400"></i> Everyday Electronics
            </span>
            <span class="text-gray-600 text-xs">◆</span>
            <span class="flex items-center gap-2 text-amber-400 font-bold">
                <i class="fas fa-tags"></i> Unbeatable Prices
            </span>
            <span class="text-gray-600 text-xs">◆</span>
            <span class="flex items-center gap-2">
                <i class="fas fa-shipping-fast text-amber-400"></i> Fast Nationwide Delivery
            </span>
            <span class="text-gray-600 text-xs">◆</span>
            <span class="flex items-center gap-2 pr-6">
                <i class="fas fa-crown text-amber-400"></i> Where Convenience Meets Class 🔥
            </span>
            </div>

            <!-- Duplicate Pass (Ensures continuous seamless looping) -->
            <div class="flex items-center space-x-6 shrink-0" aria-hidden="true">
            <span class="flex items-center gap-2 text-amber-400 font-bold">
                <i class="fas fa-store text-base"></i> Welcome to Cartévo
            </span>
            <span class="text-gray-600 text-xs">◆</span>
            <span class="flex items-center gap-2">
                <i class="fas fa-[#D4AF37] fa-tshirt text-amber-400"></i> Quality Fashion & Footwear
            </span>
            <span class="text-gray-600 text-xs">◆</span>
            <span class="flex items-center gap-2">
                <i class="fas fa-mobile-alt text-amber-400"></i> Everyday Electronics
            </span>
            <span class="text-gray-600 text-xs">◆</span>
            <span class="flex items-center gap-2 text-amber-400 font-bold">
                <i class="fas fa-tags"></i> Unbeatable Prices
            </span>
            <span class="text-gray-600 text-xs">◆</span>
            <span class="flex items-center gap-2">
                <i class="fas fa-shipping-fast text-amber-400"></i> Fast Nationwide Delivery
            </span>
            <span class="text-gray-600 text-xs">◆</span>
            <span class="flex items-center gap-2 pr-6">
                <i class="fas fa-crown text-amber-400"></i> Where Convenience Meets Class 🔥
            </span>
            </div>

        </div>
        </div>

        <!-- Hero Section -->
        <div class="py-[60px] px-5 text-center bg-gradient-to-r from-gray-100 to-gray-200">
            <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl sm:text-4xl font-bold text-black mb-3.5">
                Discover Luxury, Style & Quality
            </h1>
            <p class="text-base sm:text-lg text-gray-600 mb-6">
                Explore our finest collection of bags, shoes, watches, and fashion accessories tailored just for you.
            </p>
            <a href="#shop">
                <button class="bg-black hover:bg-gray-800 text-white px-6 py-3 border-none rounded-full font-semibold transition-colors duration-300 cursor-pointer shadow-md">
                Shop Now
                </button>
            </a>
            </div>
        </div>
    </section>




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
                <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer w-full">
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
                <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer w-full">
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
                <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer w-full">
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
                <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer w-full">
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
                <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer w-full">
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
                <button class="bg-black hover:bg-gray-800 text-white border-none py-2 px-5 rounded font-semibold text-sm transition-all duration-300 mt-2.5 md:mt-0 md:opacity-0 md:translate-y-[20px] md:group-hover:opacity-100 md:group-hover:translate-y-0 cursor-pointer w-full">
                  Buy Now
                </button>
              </a>
            </div>
          </div>

        </div>
      </div>
    </section>



   <!-- Our Products Section -->
    <section class="bg-[#f8f9fa] py-12" id="shop">
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
              <a href="single.product.php?GetSingleProductId=1">
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
    </section>


    <!-- Load More Button Section -->
    <section>
      <div id="Featured-load-More-Btn" class="text-center mt-2 px-4">
        <button class="bg-black hover:bg-gray-800 text-white border-none font-bold py-3 px-6 rounded shadow-md w-full min-[701px]:w-[40%] transition-colors duration-200 cursor-pointer uppercase tracking-wider text-sm">
          Load More
        </button>
      </div>
    </section>




    <!-- App Download & Promo Video Section (Compact & Soft Styling) -->
    <section class="bg-gray-100 text-gray-800 py-8 px-4 rounded-2xl max-w-7xl mx-auto my-8 border border-gray-200">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center">
        
        <!-- Left Column: Content & Buttons -->
        <div class="space-y-4 text-center lg:text-left">
          <span class="bg-black/5 text-gray-700 text-[11px] font-bold uppercase px-3 py-1 rounded-full inline-block tracking-wider border border-gray-300">
            Cartévo Mobile App
          </span>
          
          <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-black">
            Shop Smarter On Our App
          </h2>
          
          <p class="text-gray-600 text-sm max-w-lg mx-auto lg:mx-0">
            Enjoy app-exclusive discounts, real-time order tracking, fast checkout, and instant flash sale notifications.
          </p>

          <!-- Compact App Highlights -->
          <div class="grid grid-cols-2 gap-2 text-xs font-semibold text-gray-700 max-w-md mx-auto lg:mx-0 text-left pt-1">
            <div class="flex items-center gap-1.5">
              <i class="fas fa-check-circle text-black text-sm"></i>
              <span>Live Order Tracking</span>
            </div>
            <div class="flex items-center gap-1.5">
              <i class="fas fa-check-circle text-black text-sm"></i>
              <span>App-Only Discounts</span>
            </div>
            <div class="flex items-center gap-1.5">
              <i class="fas fa-check-circle text-black text-sm"></i>
              <span>1-Tap Fast Checkout</span>
            </div>
            <div class="flex items-center gap-1.5">
              <i class="fas fa-check-circle text-black text-sm"></i>
              <span>24/7 Priority Support</span>
            </div>
          </div>

          <!-- Store Download Badges -->
          <div class="flex flex-wrap gap-3 justify-center lg:justify-start pt-2">
            <!-- Google Play Store Button -->
            <a href="#" target="_blank" class="inline-flex items-center bg-black hover:bg-gray-800 text-white px-4 py-2 rounded-lg transition-all duration-300 shadow-sm hover:-translate-y-0.5">
              <i class="fab fa-google-play text-xl mr-2 text-white"></i>
              <div class="text-left">
                <div class="text-[9px] uppercase tracking-wider text-gray-300">GET IT ON</div>
                <div class="text-xs font-bold leading-tight">Google Play</div>
              </div>
            </a>

            <!-- Apple App Store Button -->
            <a href="#" target="_blank" class="inline-flex items-center bg-black hover:bg-gray-800 text-white px-4 py-2 rounded-lg transition-all duration-300 shadow-sm hover:-translate-y-0.5">
              <i class="fab fa-apple text-2xl mr-2 text-white"></i>
              <div class="text-left">
                <div class="text-[9px] uppercase tracking-wider text-gray-300">DOWNLOAD ON THE</div>
                <div class="text-xs font-bold leading-tight">App Store</div>
              </div>
            </a>
          </div>
        </div>

        <!-- Right Column: Compact Promo Video Mockup -->
        <div class="flex justify-center items-center">
          <div class="relative w-full max-w-[360px] rounded-xl overflow-hidden border border-gray-300 shadow-md group">
            
            <!-- Compact Video Container -->
            <video 
              class="w-full h-[220px] sm:h-[260px] object-cover" 
              autoplay 
              loop 
              muted 
              playsinline
              poster="https://images.unsplash.com/photo-1556742049-0a670f4a4587?q=80&w=600&auto=format&fit=crop"
            >
              <source src="{{asset("images/demo.mp4")}}" type="video/mp4">
              Your browser does not support the video tag.
            </video>

            <!-- Minimal Glass Overlay Badge -->
            <div class="absolute bottom-3 left-3 right-3 bg-black/70 backdrop-blur-sm p-2 px-3 rounded-lg flex items-center justify-between">
              <div class="flex items-center gap-2">
                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                <span class="text-[11px] font-semibold text-white">Maitangaran App Demo</span>
              </div>
              <span class="text-[10px] text-gray-300 font-mono">PROMO</span>
            </div>

          </div>
        </div>

      </div>
    </section>

</div>