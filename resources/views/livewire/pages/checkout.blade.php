<div>
  <div class="max-w-4xl mx-auto px-4 py-8 md:py-12">
  
    <!-- Header Section -->
    <div class="mb-8 text-center">
      <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Select Courier & Review</h2>
      <p class="text-sm text-gray-500 mt-1">Choose your preferred shipping provider and review order summary</p>
    </div>

    <!-- Notification Banners -->
    @if (session()->has('message'))
      <div class="mb-6 p-4 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-800 text-sm font-medium flex items-center gap-2">
        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        {{ session('message') }}
      </div>
    @endif

    @error('shipping')
      <div class="mb-6 p-4 rounded-xl border border-red-200 bg-red-50 text-red-800 text-sm font-medium flex items-center gap-2">
        <svg class="w-5 h-5 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        {{ $message }}
      </div>
    @enderror

    <div class="bg-white rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.08)] border border-gray-100 p-6 md:p-8">
      
      <!-- Form Header -->
      <div class="flex items-center justify-between pb-6 mb-6 border-b border-gray-100">
        <h3 class="text-lg font-bold text-gray-900">Shipping Options</h3>
        <div class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
          Step 2 of 3
        </div>
      </div>

      <form wire:submit.prevent="processCheckout" class="space-y-6">
        
        <!-- Courier Options List -->
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-3">Available Couriers</label>
          
          <div class="space-y-3">
            @forelse ($shippingRates as $rate)
              <label 
                wire:key="courier-{{ $rate['courierId'] }}"
                class="flex items-center justify-between p-4 rounded-xl border transition-all cursor-pointer {{ $selectedCourierId === $rate['courierId'] ? 'border-black bg-gray-50 ring-1 ring-black' : 'border-gray-200 hover:border-gray-300 bg-white' }}"
              >
                <div class="flex items-center gap-4">
                  <input 
                    type="radio" 
                    name="courier_selection" 
                    value="{{ $rate['courierId'] }}" 
                    wire:model.live="selectedCourierId"
                    class="w-4 h-4 text-black focus:ring-black border-gray-300"
                  />
                  
                  @if(!empty($rate['courierImage']))
                    <img src="{{ $rate['courierImage'] }}" alt="{{ $rate['courierName'] }}" class="w-10 h-10 object-contain rounded-md" />
                  @endif

                  <div>
                    <div class="flex items-center gap-2">
                      <p class="text-sm font-bold text-gray-900">{{ $rate['courierName'] }}</p>
                      @if($rate['isCodAvailable'] ?? false)
                        <span class="text-[10px] uppercase px-2 py-0.5 bg-blue-50 text-blue-700 rounded font-semibold border border-blue-100">COD</span>
                      @endif
                    </div>
                    <p class="text-xs text-gray-500 mt-0.5">Estimated Delivery: <span class="font-medium text-gray-700">{{ $rate['deliveryEta'] }}</span></p>
                  </div>
                </div>

                <div class="text-right">
                  <p class="text-base font-bold text-gray-900">₦{{ number_format($rate['total'], 2) }}</p>
                  @if(($rate['vat'] ?? 0) > 0)
                    <p class="text-[11px] text-gray-400">+ ₦{{ number_format($rate['vat'], 2) }} VAT</p>
                  @endif
                </div>
              </label>
            @empty
              <div class="p-6 text-center border border-dashed border-gray-200 rounded-xl">
                <p class="text-sm text-gray-500">No available courier options found for this delivery address right now.</p>
              </div>
            @endforelse
          </div>
          @error('selectedCourierId') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Order Notes -->
        <div>
          <label for="notes" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Order / Delivery Notes (Optional)</label>
          <textarea 
            id="notes" 
            wire:model.defer="notes" 
            rows="3"
            placeholder="e.g. Please wrap properly, or call upon arrival"
            class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
          ></textarea>
        </div>

        <!-- Buttons Row -->
        <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-between gap-4">
          <!-- Back to Address -->
          <a 
            href="" 
            class="px-6 py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-sm rounded-lg transition-colors cursor-pointer text-center"
          >
            &larr; Back to Address
          </a>

          <!-- Submit Checkout -->
          <button 
            type="submit" 
            wire:loading.attr="disabled"
            wire:target="processCheckout"
            class="px-8 py-3.5 bg-black hover:bg-gray-800 text-white font-bold text-sm rounded-lg transition-colors cursor-pointer disabled:opacity-50 shadow-md flex items-center justify-center gap-2 whitespace-nowrap"
          >
            <svg wire:loading wire:target="processCheckout" class="animate-spin h-4 w-4 text-white shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>

            <span wire:loading.remove wire:target="processCheckout">Proceed to Final Payment</span>
            <span wire:loading wire:target="processCheckout">Processing Checkout...</span>

            <svg wire:loading.remove wire:target="processCheckout" class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
          </button>
        </div>

      </form>

    </div>
  </div>
</div>