<div>
  <div class="max-w-4xl mx-auto px-4 py-8 md:py-12">
  
    <!-- Header Section -->
    <div class="mb-8 text-center">
      <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Shipping Information</h2>
      <p class="text-sm text-gray-500 mt-1">Verify or update your saved delivery address to proceed with shipping options</p>
    </div>

    <!-- Notification Banners -->
    @if (session()->has('message'))
      <div class="mb-6 p-4 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-800 text-sm font-medium flex items-center gap-2">
        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        {{ session('message') }}
      </div>
    @endif

    @if (session()->has('error'))
      <div class="mb-6 p-4 rounded-xl border border-red-200 bg-red-50 text-red-800 text-sm font-medium">
        {{ session('error') }}
      </div>
    @endif

    <div class="bg-white rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.08)] border border-gray-100 p-6 md:p-8">
      
      <!-- Form Header -->
      <div class="flex items-center justify-between pb-6 mb-6 border-b border-gray-100">
        <h3 class="text-lg font-bold text-gray-900">Delivery Details</h3>
        <div class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
          </svg>
          Step 1 of 3
        </div>
      </div>

      <!-- Shipping Update Form -->
      <form wire:submit.prevent="updateShippingDetails" class="space-y-6">
        
        <!-- 2-Column Inputs Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          
          <!-- Full Name -->
          <div>
            <label for="fullname" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Full Name</label>
            <input 
              type="text" 
              id="fullname" 
              wire:model.live="fullname" 
              placeholder="e.g. Jane Doe"
              class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
              required
            />
            @error('fullname') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
          </div>

          <!-- Email Address -->
          <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Email Address</label>
            <input 
              type="email" 
              id="email" 
              wire:model.live="email" 
              placeholder="e.g. jane.doe@example.com"
              class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
              required
            />
            @error('email') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
          </div>

          <!-- Phone Number -->
          <div>
            <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Phone Number</label>
            <input 
              type="tel" 
              id="phone" 
              wire:model.live="phone" 
              placeholder="e.g. +2348012345678"
              class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
              required
            />
            @error('phone') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
          </div>

          <!-- State of Residence -->
          <div>
            <label for="state" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">State of Residence</label>
            <input 
              type="text" 
              id="state" 
              wire:model.live="state" 
              placeholder="e.g. Abuja"
              class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
              required
            />
            @error('state') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
          </div>


          <!-- Delivery Address (Full Width) -->
          <div class="md:col-span-2">
            <label for="address" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Delivery Address</label>
            <input 
              type="text" 
              id="address" 
              wire:model.live="address" 
              placeholder="e.g. 42 Marina Road, Lagos"
              class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
              required
            />
            @error('address') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
          </div>

        </div>

        <!-- Submit & Navigation Button -->
        <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-end">
        <button 
            type="submit" 
            wire:loading.attr="disabled"
            wire:target="updateShippingDetails"
            class="w-full sm:w-auto px-8 py-3.5 bg-black hover:bg-gray-800 text-white font-bold text-sm rounded-lg transition-colors cursor-pointer disabled:opacity-50 shadow-md flex items-center justify-center gap-2 whitespace-nowrap"
        >
            <!-- Loading Spinner (Shown on the SAME line on the left when loading) -->
            <svg wire:loading wire:target="updateShippingDetails" class="animate-spin h-4 w-4 text-white shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>

            <!-- Dynamic Button Text (Stays on the same line) -->
            <span wire:loading.remove wire:target="updateShippingDetails">Save &amp; Choose Shipping Courier</span>
            <span wire:loading wire:target="updateShippingDetails">Saving Shipping Details...</span>

            <!-- Default Arrow Icon (Hidden during loading) -->
            <svg wire:loading.remove wire:target="updateShippingDetails" class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
        </button>
        </div>
 
      </form>

    </div>
  </div>
</div>
