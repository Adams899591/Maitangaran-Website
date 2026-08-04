{{-- <!DOCTYPE html>
<html lang="en">  
<head>  
  <meta charset="UTF-8" />  
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>  
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title ?? 'MAITANGARAN - Premium Fabrics Collection' }}</title> 

  <!-- FontAwesome Icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- AOS link -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <!-- SimplePagination.js -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.min.css">

  @vite(["resources/css/app.css","resources/js/app.js"])
  @livewireStyles
</head>  
<body class="bg-gray-50 m-0 p-0 font-sans antialiased flex flex-col min-h-screen" x-data="{ mobileMenuOpen: false }">

  <!-- Main Content Wrapper -->
  <div class="flex-grow">
    <!-- Navbar -->
    <nav class="bg-white sticky top-0 z-[1040] shadow-sm border-b border-gray-100 h-16 flex items-center">
      <div class="w-full px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        
        <div class="flex items-center">
          <!-- Mobile Menu Toggle Button -->
          <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-gray-700 focus:outline-none me-3 p-2 border-0 bg-transparent cursor-pointer" type="button" aria-label="Toggle Menu">
            <i class="fas fa-bars text-xl"></i>
          </button>

          <!-- Logo from Laravel Assets -->
          <a class="flex items-center no-underline" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="MAITANGARAN Logo" class="h-11 w-auto object-contain">
          </a>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden lg:flex lg:items-center lg:justify-between w-full ms-6" id="navbarNav">
          <ul class="flex items-center mb-0 list-none space-x-6 me-auto">
            <li><a class="text-black font-medium hover:text-black transition-colors no-underline" href="{{ url('/home') }}"><b>Home</b></a></li>
            <li><a class="text-black font-medium hover:text-black transition-colors no-underline" href="{{ url('/shop') }}"><b>Shop</b></a></li>
            <li><a class="text-black font-medium hover:text-black transition-colors no-underline" href="{{ url('/contact') }}"><b>Contact</b></a></li>
            <li><a class="text-black font-medium hover:text-black transition-colors no-underline" href="{{ url('/about') }}"><b>About</b></a></li>
          </ul>

          <ul class="flex items-center mb-0 list-none space-x-6">
            <li><a class="text-black font-medium hover:text-black transition-colors no-underline" href="{{ url('/trending') }}"><b>Trending</b></a></li>
            <li>
              <a class="text-black font-medium hover:text-black transition-colors no-underline flex items-center gap-1" href="{{ url('/cart') }}">
                <b>
                  <span class="text-black font-bold"><i class="fas fa-shopping-cart"></i> 0</span> 
                  Cart
                </b>
              </a>
            </li>
            <li><a class="text-black font-medium hover:text-black transition-colors no-underline" href="{{ url('/sign.in.php') }}"><b>Account</b></a></li>
          </ul>                            
        </div>
      </div>
    </nav>

    <!-- Mobile Offcanvas Menu Backdrop -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="mobileMenuOpen = false" 
         class="fixed inset-0 bg-black/50 z-[1045] lg:hidden" 
         style="display: none;"></div>

    <!-- Pure Tailwind Offcanvas Sidebar -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-in-out duration-300 transform"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         class="fixed inset-y-0 left-0 z-[1050] w-full max-w-[280px] h-screen bg-white shadow-2xl border-r border-gray-100 flex flex-col lg:hidden"
         style="display: none;">
         
         <!-- Sidebar Header -->
         <div class="bg-white px-5 py-4 flex items-center justify-between border-b border-gray-100">
           <span class="text-gray-900 font-bold text-base tracking-wide">Menu</span>
           <button @click="mobileMenuOpen = false" type="button" class="text-gray-500 hover:text-black bg-transparent border-0 text-lg cursor-pointer p-2" aria-label="Close">
             <i class="fas fa-times"></i>
           </button>
         </div>

         <!-- Sidebar Content Links -->
         <div class="p-4 overflow-y-auto flex-1">
           <ul class="flex flex-col space-y-1 list-none p-0 m-0">
             <li><a @click="mobileMenuOpen = false" class="block w-full py-3 px-4 rounded-lg text-black font-medium hover:text-white hover:bg-black transition-all no-underline" href="{{ url('/home') }}"><b>Home</b></a></li>
             <li><a @click="mobileMenuOpen = false" class="block w-full py-3 px-4 rounded-lg text-black font-medium hover:text-white hover:bg-black transition-all no-underline" href="{{ url('/shop') }}"><b>Shop</b></a></li>
             <li><a @click="mobileMenuOpen = false" class="block w-full py-3 px-4 rounded-lg text-black font-medium hover:text-white hover:bg-black transition-all no-underline" href="{{ url('/contact') }}"><b>Contact</b></a></li>
             <li><a @click="mobileMenuOpen = false" class="block w-full py-3 px-4 rounded-lg text-black font-medium hover:text-white hover:bg-black transition-all no-underline" href="{{ url('/about') }}"><b>About</b></a></li>
             <li><a @click="mobileMenuOpen = false" class="block w-full py-3 px-4 rounded-lg text-black font-medium hover:text-white hover:bg-black transition-all no-underline" href="{{ url('/trending') }}"><b>Trending</b></a></li>
             <li>
               <a @click="mobileMenuOpen = false" class="block w-full py-3 px-4 rounded-lg text-black font-medium hover:text-white hover:bg-black transition-all no-underline flex items-center justify-between" href="{{ url('/cart') }}">
                 <b>Cart</b>
                 <span class="text-black font-bold bg-gray-100 px-2.5 py-0.5 rounded-full text-sm"><i class="fas fa-shopping-cart"></i> 0</span>
               </a>
             </li>
             <li class="pt-2 border-t border-gray-100 mt-2">
               <a @click="mobileMenuOpen = false" class="block w-full py-3 px-4 rounded-lg text-black font-medium hover:text-white hover:bg-black transition-all no-underline" href="{{ url('/sign.in.php') }}"><b>Account</b></a>
             </li>
           </ul>
         </div>
    </div>

    <!-- Hero Banner Section -->
    <header class="bg-white overflow-hidden border-b border-gray-100">
      <div class="w-full">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 lg:max-w-7xl lg:mx-auto lg:px-8 lg:py-24 items-center">
          
          <!-- Text Container -->
          <div class="flex flex-col items-start justify-center order-1 px-4 sm:px-6 lg:px-0 py-8 lg:py-0">
            <span class="text-black font-bold tracking-widest uppercase text-xs md:text-sm mb-4 bg-gray-100 px-3 py-1.5 rounded-md border border-gray-200">
              New Collection Available
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-6xl font-black tracking-tight text-black mb-6 leading-[1.1]">
              Discover Timeless Elegance & Premium Fabrics
            </h1>
            <p class="text-base sm:text-lg text-gray-600 mb-8 font-normal leading-relaxed">
              Elevate your style with Maitangaran's exclusive collection of luxurious traditional and contemporary fabrics crafted for perfection.
            </p>
            <div class="flex flex-wrap gap-4 w-full sm:w-auto">
              <a href="{{ url('/shop') }}" class="bg-black hover:bg-gray-800 text-white font-semibold px-8 py-4 rounded-xl shadow-md transition-all duration-200 no-underline flex items-center justify-center gap-2 flex-1 sm:flex-initial">
                <span>Shop Now</span>
                <i class="fas fa-arrow-right text-sm"></i>
              </a>
              <a href="{{ url('/about') }}" class="bg-white hover:bg-gray-50 text-black border-2 border-black font-semibold px-8 py-4 rounded-xl transition-all duration-200 no-underline flex items-center justify-center flex-1 sm:flex-initial">
                Learn More
              </a>
            </div>
          </div>

          <!-- Image Container -->
          <div class="w-full relative flex justify-center lg:justify-end order-2">
            <div class="relative w-full rounded-none lg:rounded-2xl overflow-hidden shadow-none lg:shadow-2xl border-0 lg:border border-gray-100 bg-gray-100">
              <img src="https://images.unsplash.com/photo-1768758533474-5cd148638a98?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Maitangaran Fabrics Banner" class="w-full h-[320px] sm:h-[420px] lg:h-[520px] object-cover object-center">
            </div>
          </div>

        </div>
      </div>
    </header>

    <!-- Render the Livewire Component Content -->
    {{ $slot }}
  </div>

  <!-- Responsive Black & White Tailwind Footer -->
  <footer class="bg-black text-gray-300 pt-12 pb-8 mt-16 border-t border-neutral-800">
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
  </footer>

  <!-- AOS script -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

  @livewireScripts
</body>
</html> --}}