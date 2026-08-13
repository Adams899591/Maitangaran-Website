<div>
   
    <!-- App Download & Promo Video Section (Compact & Soft Styling) -->
    <section class="bg-gray-100 text-gray-800 py-8 px-4 rounded-2xl max-w-7xl mx-auto my-8 border border-gray-200">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center">
        
        <!-- Left Column: Content & Buttons -->
        <div class="space-y-4 text-center lg:text-left">
          <span class="bg-black/5 text-gray-700 text-[11px] font-bold uppercase px-3 py-1 rounded-full inline-block tracking-wider border border-gray-300">
            Maitangaran Mobile App
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
