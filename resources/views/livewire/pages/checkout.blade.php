<div>
   <div class="max-w-7xl mx-auto px-4 py-8 md:py-12">
  
  <!-- Header Section -->
  <div class="mb-8 text-center">
    <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Checkout</h2>
    <p class="text-sm text-gray-500 mt-1">Please verify your shipping credentials before completing your order</p>
  </div>

  <form wire:submit.prevent="placeOrder" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- Left Column: Shipping Form -->
    <div class="lg:col-span-8 space-y-6">
      <div class="bg-white rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.08)] border border-gray-100 p-6 md:p-8">
        
        <!-- Form Header with Security Badge -->
        <div class="flex items-center justify-between pb-6 mb-6 border-b border-gray-100">
          <h3 class="text-lg font-bold text-gray-900">Shipping Credentials</h3>
          <div class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            Secure Checkout
          </div>
        </div>

        <!-- 2-Column Inputs Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          
          <!-- Full Name -->
          <div>
            <label for="fullname" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Full Name</label>
            <input 
              type="text" 
              id="fullname" 
              wire:model.blur="fullname" 
              placeholder="e.g. John Doe"
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
              wire:model.blur="email" 
              placeholder="e.g. john@example.com"
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
              wire:model.blur="phone" 
              placeholder="e.g. 08012345678"
              class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
              required
            />
            @error('phone') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
          </div>

          <!-- State of Residence -->
          <div>
            <label for="state" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">State of Residence</label>
            <select 
              id="state" 
              wire:model.blur="state" 
              class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all bg-white"
              required
            >
              <option value="">Select State</option>
              <option value="Lagos">Lagos</option>
              <option value="Abuja">Abuja (FCT)</option>
              <option value="Rivers">Rivers</option>
              <option value="Oyo">Oyo</option>
              <option value="Kano">Kano</option>
              <option value="Enugu">Enugu</option>
              <option value="Delta">Delta</option>
              <option value="Ogun">Ogun</option>
              <option value="Kaduna">Kaduna</option>
              <option value="Edo">Edo</option>
            </select>
            @error('state') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
          </div>

          <!-- Delivery Address (Full Width) -->
          <div class="md:col-span-2">
            <label for="address" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Delivery Address</label>
            <input 
              type="text" 
              id="address" 
              wire:model.blur="address" 
              placeholder="Enter your detailed street address"
              class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
              required
            />
            @error('address') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
          </div>

          <!-- Order Notes (Full Width) -->
          <div class="md:col-span-2">
            <label for="notes" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Order Notes <span class="text-gray-400 font-normal lowercase">(optional)</span></label>
            <textarea 
              id="notes" 
              wire:model.blur="notes" 
              rows="3"
              placeholder="Special instructions for delivery (e.g. call before arriving)"
              class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all resize-none"
            ></textarea>
          </div>

        </div>

        <!-- Action Buttons -->
        <div class="mt-8 pt-6 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
          
          <!-- Update Shipping Details Button -->
          <button 
            type="button" 
            wire:click="updateShippingDetails" 
            wire:loading.attr="disabled"
            wire:target="updateShippingDetails"
            class="w-full sm:w-auto px-6 py-3 border border-gray-900 text-gray-900 hover:bg-gray-900 hover:text-white font-semibold text-sm rounded-lg transition-colors cursor-pointer disabled:opacity-50 text-center"
          >
            <span wire:loading.remove wire:target="updateShippingDetails">Update Shipping Details</span>
            <span wire:loading wire:target="updateShippingDetails">Updating Details...</span>
          </button>

          <!-- Place Order and Pay Button -->
          <button 
            type="submit" 
            wire:loading.attr="disabled"
            wire:target="placeOrder"
            class="w-full sm:w-auto px-8 py-3.5 bg-black hover:bg-gray-800 text-white font-bold text-sm rounded-lg transition-colors cursor-pointer disabled:opacity-50 text-center shadow-md"
          >
            <span wire:loading.remove wire:target="placeOrder">Place Order & Pay</span>
            <span wire:loading wire:target="placeOrder">Processing Payment...</span>
          </button>

        </div>

        <!-- Subtle Paystack Security Footer Notice -->
        <div class="mt-6 text-center border-t border-gray-50 pt-4">
          <p class="text-[11px] text-gray-400 font-normal flex items-center justify-center gap-1.5">
            <svg class="w-3.5 h-3.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
            </svg>
            Secure payment processing via Paystack. Your financial details are safe and encrypted.
          </p>
        </div>

      </div>
    </div>

    <!-- Right Column: Order Summary Sidebar -->
    <div class="lg:col-span-4">
      <div class="bg-white p-6 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.08)] border border-gray-100 sticky top-6">
        <h3 class="text-lg font-bold text-gray-900 pb-4 border-b border-gray-100">Order Summary</h3>

        <div class="py-4 space-y-3 border-b border-gray-100 text-sm">
          <div class="flex justify-between text-gray-600">
            <span>Subtotal</span>
            <span class="font-semibold text-gray-900">&#8358;127,500.00</span>
          </div>
          <div class="flex justify-between text-gray-600">
            <span>Delivery Fee</span>
            <span class="font-semibold text-emerald-600">Calculated at payment</span>
          </div>
        </div>

        <div class="flex justify-between items-center py-4 text-base font-bold text-gray-900">
          <span>Total Payable</span>
          <span class="text-xl">&#8358;127,500.00</span>
        </div>

        <div class="bg-gray-50 rounded-lg p-3.5 mt-2 text-xs text-gray-500 space-y-2">
          <div class="flex items-center gap-2 text-gray-700 font-medium">
            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Free replacement on defective items
          </div>
          <div class="flex items-center gap-2 text-gray-700 font-medium">
            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Doorstep delivery nationwide
          </div>
        </div>
      </div>
    </div>

  </form>
</div>
</div>
