 {{-- <footer class="bg-black text-gray-300 pt-12 pb-8 mt-16 border-t border-neutral-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Responsive Footer Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
        
        <!-- Column 1: Company Info -->
        <div class="space-y-4">
          <!-- Logo from Laravel Assets -->
          {{-- <a class="inline-block no-underline" href="{{ url('/') }}"> --}}
            <img src="{{ asset('images/logo.png') }}" alt="MAITANGARAN Logo" class="h-10 w-auto object-contain brightness-0 invert">
          {{-- </a> --}}
          <p class="text-xs sm:text-sm text-gray-400 leading-relaxed max-w-sm">
            Your trusted fashion partner since 2021. Bringing you premium quality and timeless designs.
          </p>
          <!-- Social Icons (Monochrome) -->
          <div class="flex items-center space-x-4 pt-2">
            <a href="tel:+2349018827571" class="text-gray-400 hover:text-white transition-colors duration-200" aria-label="Viber">
              <i class="fa-brands fa-viber text-2xl"></i>
            </a>
            <a href="http://www.facebook.com/Usman Adams" target="_blank" class="text-gray-400 hover:text-white transition-colors duration-200" aria-label="Facebook">
              <i class="fa-brands fa-facebook text-2xl"></i>
            </a>
            <a href="https://www.linkedin.com/in/usman-adams-7a5900352" target="_blank" class="text-gray-400 hover:text-white transition-colors duration-200" aria-label="LinkedIn">
              <i class="fa-brands fa-linkedin text-2xl"></i>
            </a>
            <a href="https://wa.me/2349018827571" target="_blank" class="text-gray-400 hover:text-white transition-colors duration-200" aria-label="WhatsApp">
              <i class="fa-brands fa-whatsapp text-2xl"></i>
            </a>
            <a href="https://github.com/Adams899591" target="_blank" class="text-gray-400 hover:text-white transition-colors duration-200" aria-label="GitHub">
              <i class="fa-brands fa-github text-2xl"></i>
            </a>
          </div>
        </div>

        <!-- Column 2: Quick Links -->
        <div>
          <h5 class="text-white font-bold text-sm uppercase tracking-wider mb-4 border-b border-neutral-800 pb-2 inline-block sm:border-none sm:pb-0">Quick Links</h5>
          <ul class="space-y-2.5 list-none p-0 m-0 text-sm">
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors no-underline block py-0.5">Home</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors no-underline block py-0.5">Shop</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors no-underline block py-0.5">Orders</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors no-underline block py-0.5">Wishlist</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors no-underline block py-0.5">Contact</a></li>
          </ul>
        </div>

        <!-- Column 3: Help -->
        <div>
          <h5 class="text-white font-bold text-sm uppercase tracking-wider mb-4 border-b border-neutral-800 pb-2 inline-block sm:border-none sm:pb-0">Help & Info</h5>
          <ul class="space-y-2.5 list-none p-0 m-0 text-sm">
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors no-underline block py-0.5">FAQs</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors no-underline block py-0.5">Shipping Info</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors no-underline block py-0.5">Return Policy</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors no-underline block py-0.5">Privacy Policy</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition-colors no-underline block py-0.5">Terms & Conditions</a></li>
          </ul>
        </div>

        <!-- Column 4: Newsletter -->
        <div>
          <h5 class="text-white font-bold text-sm uppercase tracking-wider mb-4 border-b border-neutral-800 pb-2 inline-block sm:border-none sm:pb-0">Newsletter</h5>
          <p class="text-xs sm:text-sm text-gray-400 mb-4 leading-relaxed">
            Subscribe to receive updates, access to exclusive deals, and more.
          </p>
          <form class="flex flex-col gap-2.5 w-full">
            <input 
              type="email" 
              class="w-full px-3.5 py-2 text-sm bg-neutral-900 border border-neutral-800 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-white transition-colors" 
              placeholder="Enter your email" 
              required
            >
            <button 
              type="submit" 
              class="w-full px-4 py-2 bg-white text-black hover:bg-gray-200 text-sm font-bold rounded-lg transition-colors cursor-pointer tracking-wide uppercase"
            >
              Subscribe
            </button>
          </form>
        </div>

      </div>

      <!-- Bottom Footer Row -->
      <div class="flex flex-col sm:flex-row items-center justify-between border-t border-neutral-900 pt-6 mt-10 gap-4 text-center sm:text-left">
        <div class="text-gray-500 text-xs">
          © 2025 MAITANGARAN. All rights reserved.
        </div>
        <!-- Payment Badges using Web URLs -->
        <div class="flex items-center space-x-3 bg-neutral-900 px-3 py-1.5 rounded-lg border border-neutral-800">
          <img src="https://raw.githubusercontent.com/aaronfagan/svg-credit-card-payment-icons/master/mono/visa.svg" alt="Visa" width="36" class="h-5 object-contain brightness-200 opacity-80 hover:opacity-100 transition-opacity">
          <img src="https://raw.githubusercontent.com/aaronfagan/svg-credit-card-payment-icons/master/mono/mastercard.svg" alt="Mastercard" width="36" class="h-5 object-contain brightness-200 opacity-80 hover:opacity-100 transition-opacity">
          <img src="https://raw.githubusercontent.com/aaronfagan/svg-credit-card-payment-icons/master/mono/paypal.svg" alt="PayPal" width="36" class="h-5 object-contain brightness-200 opacity-80 hover:opacity-100 transition-opacity">
        </div>
      </div>

    </div>
  </footer> --}}