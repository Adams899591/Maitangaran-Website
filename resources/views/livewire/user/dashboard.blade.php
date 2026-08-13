<div class="space-y-8">
      
  <!-- User Identification Header Section -->
  <div class="bg-white rounded-2xl shadow-[0_4px_24px_rgba(0,0,0,0.06)] border border-gray-100 p-6 md:p-8 flex flex-col sm:flex-row items-center gap-6">
    <!-- Icon Avatar (No photo needed) -->
    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center border border-gray-200 shrink-0">
      <svg class="w-10 h-10 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
      </svg>
    </div>
    
    <div class="text-center sm:text-left flex-1">
      <div class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200 mb-2">
        Verified Customer
      </div>
      <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">{{$user->CustomerName}}</h2>
      <p class="text-sm text-gray-500 mt-0.5">{{$user->Email}}</p>
    </div>
  </div>

  <!-- Quick Navigation Tabs -->
  <div>
    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-3">Quick Navigation</h3>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
      
      <!-- Main Shop Tab -->
      <a href="{{route("shop")}}" wire:navigate class="bg-white p-4 rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-gray-100 hover:border-black transition-all text-center group">
        <div class="w-10 h-10 mx-auto mb-2 bg-gray-50 rounded-lg flex items-center justify-center group-hover:bg-black group-hover:text-white transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
          </svg>
        </div>
        <span class="text-xs font-bold text-gray-900">Main Shop</span>
      </a>

      <!-- Cart -->
      <a href="{{route("cart")}}" wire:navigate class="bg-white p-4 rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-gray-100 hover:border-black transition-all text-center group">
        <div class="w-10 h-10 mx-auto mb-2 bg-gray-50 rounded-lg flex items-center justify-center group-hover:bg-black group-hover:text-white transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
          </svg>
        </div>
        <span class="text-xs font-bold text-gray-900">Cart</span>
      </a>

      <!-- Order Ledger Tab -->
      <a href="{{route("order-ladger")}}" class="bg-white p-4 rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-gray-100 hover:border-black transition-all text-center group" wire:navigate>
        <div class="w-10 h-10 mx-auto mb-2 bg-gray-50 rounded-lg flex items-center justify-center group-hover:bg-black group-hover:text-white transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
          </svg>
        </div>
        <span class="text-xs font-bold text-gray-900">Order Ledger</span>
      </a>

      <!-- Track Order Tab -->
      <a href="{{route("contact")}}" wire:navigate class="bg-white p-4 rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-gray-100 hover:border-black transition-all text-center group">
        <div class="w-10 h-10 mx-auto mb-2 bg-gray-50 rounded-lg flex items-center justify-center group-hover:bg-black group-hover:text-white transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
          </svg>
        </div>
        <span class="text-xs font-bold text-gray-900">Contact Us</span>
      </a>



      <!-- My Profile Tab -->
      <a href="{{route("profile")}}" class="bg-white p-4 rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-gray-100 hover:border-black transition-all text-center group" wire:navigate>
        <div class="w-10 h-10 mx-auto mb-2 bg-gray-50 rounded-lg flex items-center justify-center group-hover:bg-black group-hover:text-white transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.654 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
        <span class="text-xs font-bold text-gray-900">My Profile</span>
      </a>

    </div>
  </div>

</div>
