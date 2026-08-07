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

      <!-- Shop Room Tab -->
      <a href="/shop-room" wire:navigate class="bg-white p-4 rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-gray-100 hover:border-black transition-all text-center group">
        <div class="w-10 h-10 mx-auto mb-2 bg-gray-50 rounded-lg flex items-center justify-center group-hover:bg-black group-hover:text-white transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
          </svg>
        </div>
        <span class="text-xs font-bold text-gray-900">Shop Room</span>
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
      <a href="{{route("orders-details")}}" wire:navigate class="bg-white p-4 rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-gray-100 hover:border-black transition-all text-center group">
        <div class="w-10 h-10 mx-auto mb-2 bg-gray-50 rounded-lg flex items-center justify-center group-hover:bg-black group-hover:text-white transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
          </svg>
        </div>
        <span class="text-xs font-bold text-gray-900">Track Order</span>
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
