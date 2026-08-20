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

</div>
