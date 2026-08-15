<div class="max-w-4xl mx-auto px-4 py-8 md:py-12">
  
    <!-- Header Section -->
    <div class="mb-8 text-center">
      <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Fulfillment Method</h2>
      <p class="text-sm text-gray-500 mt-1">Select how you would like to receive your items</p>
    </div>

    <div class="bg-white rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.08)] border border-gray-100 p-6 md:p-8">
      
      <!-- Form Header -->
      <div class="flex items-center justify-between pb-6 mb-6 border-b border-gray-100">
        <h3 class="text-lg font-bold text-gray-900">Choose Delivery Option</h3>
        <div class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
          </svg>
          Step 2 of 3
        </div>
      </div>

      <!-- Selection Form -->
      <form wire:submit.prevent="saveFulfillmentOption" class="space-y-6">
        
        <!-- Option Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          
          <!-- Home Delivery Option -->
          <label class="relative flex flex-col p-6 rounded-xl border-2 border-gray-200 hover:border-black cursor-pointer transition-all bg-white group has-[:checked]:border-black has-[:checked]:bg-gray-50/50">
            <div class="flex items-center justify-between mb-4">
              <!-- Delivery Icon -->
              <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-800 group-has-[:checked]:bg-black group-has-[:checked]:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                </svg>
              </div>
              <!-- Radio Input -->
              <input 
                type="radio" 
                name="fulfillment_type" 
                wire:model.live="fulfillmentType" 
                value="delivery"
                class="w-4 h-4 text-black border-gray-300 focus:ring-black"
                required
              />
            </div>
            <span class="text-base font-bold text-gray-900 mb-1">Home Delivery</span>
            <span class="text-xs text-gray-500 leading-relaxed">Have your order shipped directly to your saved delivery address via our trusted courier partners.</span>
          </label>

          <!-- Self Pickup Option -->
          <label class="relative flex flex-col p-6 rounded-xl border-2 border-gray-200 hover:border-black cursor-pointer transition-all bg-white group has-[:checked]:border-black has-[:checked]:bg-gray-50/50">
            <div class="flex items-center justify-between mb-4">
              <!-- Store / Pickup Icon -->
              <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-800 group-has-[:checked]:bg-black group-has-[:checked]:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
              </div>
              <!-- Radio Input -->
              <input 
                type="radio" 
                name="fulfillment_type" 
                wire:model.live="fulfillmentType" 
                value="pickup"
                class="w-4 h-4 text-black border-gray-300 focus:ring-black"
                required
              />
            </div>
            <span class="text-base font-bold text-gray-900 mb-1">Self Pickup</span>
            <span class="text-xs text-gray-500 leading-relaxed">Collect your items personally from our designated pickup location at no extra cost.</span>
          </label>

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

        <!-- Submit & Navigation Button -->
        <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-between">
          
          <!-- Back Button -->
          <a 
            href="{{route("shipping-details")}}" 
            class="px-6 py-3.5 bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 font-bold text-sm rounded-lg transition-colors inline-flex items-center gap-2" wire:navigate
          >
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back
          </a>

          <!-- Continue Button -->
          <button 
              type="submit" 
              wire:loading.attr="disabled"
              wire:target="saveFulfillmentOption"
              class="w-full sm:w-auto px-8 py-3.5 bg-black hover:bg-gray-800 text-white font-bold text-sm rounded-lg transition-colors cursor-pointer disabled:opacity-50 shadow-md flex items-center justify-center gap-2 whitespace-nowrap"
          >
              <!-- Loading Spinner -->
              <svg wire:loading wire:target="saveFulfillmentOption" class="animate-spin h-4 w-4 text-white shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>

              <!-- Dynamic Button Text -->
              <span wire:loading.remove wire:target="saveFulfillmentOption">Proceed to Payment</span>
              <span wire:loading wire:target="saveFulfillmentOption">Processing Option...</span>

              <!-- Default Arrow Icon -->
              <svg wire:loading.remove wire:target="saveFulfillmentOption" class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
              </svg>
          </button>
        </div>
 
      </form>

    </div>
  </div>
</div>
