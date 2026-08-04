<div>



<div class="max-w-7xl mx-auto px-4 py-8 md:py-12">
  <!-- Title -->
  <div class="mb-8 text-center">
    <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Your Cart</h2>
    <p class="text-sm text-gray-500 mt-1">Review your selected items and manage quantities</p>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- Cart Table Section -->
    <div class="lg:col-span-8">
      <div class="bg-white rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.08)] border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse min-w-[600px]">
            
            <!-- Table Header -->
            <thead>
              <tr class="bg-black text-white text-xs uppercase tracking-wider">
                <th class="py-4 px-6 font-semibold">Product</th>
                <th class="py-4 px-6 font-semibold">Price</th>
                <th class="py-4 px-6 font-semibold text-center">Quantity</th>
                <th class="py-4 px-6 font-semibold text-right">Subtotal</th>
              </tr>
            </thead>

            <!-- Table Body -->
            <tbody class="divide-y divide-gray-100 text-sm text-gray-800">
              
              <!-- Item 1: Sneakers -->
              <tr wire:key="cart-item-1" class="hover:bg-gray-50/50 transition-colors">
                <td class="py-4 px-6">
                  <div class="flex items-center gap-4">
                    <div class="w-16 h-16 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 aspect-square">
                      <img 
                        src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=600&auto=format&fit=crop" 
                        alt="Designer Men Sneakers" 
                        class="w-full h-full object-cover"
                      />
                    </div>
                    <div>
                      <h6 class="font-bold text-gray-900 line-clamp-1">Designer Men Sneakers</h6>
                      <button 
                        type="button" 
                        wire:click="removeItem(1)" 
                        wire:loading.attr="disabled"
                        class="text-xs text-red-600 hover:text-red-800 font-semibold underline cursor-pointer mt-1 disabled:opacity-50"
                      >
                        <span wire:loading.remove wire:target="removeItem(1)">Remove</span>
                        <span wire:loading wire:target="removeItem(1)">Removing...</span>
                      </button>
                    </div>
                  </div>
                </td>
                <td class="py-4 px-6 font-semibold whitespace-nowrap">&#8358;42,500</td>
                <td class="py-4 px-6">
                  <div class="flex flex-col items-center gap-2">
                    <div class="inline-flex items-center border border-gray-300 rounded-md overflow-hidden bg-white">
                      <!-- Standard HTML Decrement -->
                      <button 
                        type="button" 
                        onclick="this.nextElementSibling.stepDown(); this.nextElementSibling.dispatchEvent(new Event('input'))" 
                        class="px-2.5 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold transition-colors cursor-pointer"
                      >-</button>
                      
                      <!-- Standard Input synced on blur/change -->
                      <input 
                        type="number" 
                        wire:model.blur="quantities.1" 
                        class="w-12 text-center text-sm font-semibold border-none focus:outline-none focus:ring-0" 
                        min="1" 
                      />
                      
                      <!-- Standard HTML Increment -->
                      <button 
                        type="button" 
                        onclick="this.previousElementSibling.stepUp(); this.previousElementSibling.dispatchEvent(new Event('input'))" 
                        class="px-2.5 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold transition-colors cursor-pointer"
                      >+</button>
                    </div>
                    
                    <!-- Manual Update Button -->
                    <button 
                      type="button" 
                      wire:click="updateQuantity(1)" 
                      wire:loading.attr="disabled"
                      wire:target="updateQuantity(1)"
                      class="text-xs bg-gray-900 hover:bg-black text-white px-3 py-1 rounded transition-colors font-medium cursor-pointer disabled:opacity-50"
                    >
                      <span wire:loading.remove wire:target="updateQuantity(1)">Update</span>
                      <span wire:loading wire:target="updateQuantity(1)">Updating...</span>
                    </button>
                  </div>
                </td>
                <td class="py-4 px-6 text-right font-bold text-gray-900 whitespace-nowrap">&#8358;42,500.00</td>
              </tr>

              <!-- Item 2: Handbag -->
              <tr wire:key="cart-item-2" class="hover:bg-gray-50/50 transition-colors">
                <td class="py-4 px-6">
                  <div class="flex items-center gap-4">
                    <div class="w-16 h-16 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 aspect-square">
                      <img 
                        src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=600&auto=format&fit=crop" 
                        alt="Luxury Leather Handbag" 
                        class="w-full h-full object-cover"
                      />
                    </div>
                    <div>
                      <h6 class="font-bold text-gray-900 line-clamp-1">Luxury Leather Handbag</h6>
                      <button 
                        type="button" 
                        wire:click="removeItem(2)" 
                        wire:loading.attr="disabled"
                        class="text-xs text-red-600 hover:text-red-800 font-semibold underline cursor-pointer mt-1 disabled:opacity-50"
                      >
                        <span wire:loading.remove wire:target="removeItem(2)">Remove</span>
                        <span wire:loading wire:target="removeItem(2)">Removing...</span>
                      </button>
                    </div>
                  </div>
                </td>
                <td class="py-4 px-6 font-semibold whitespace-nowrap">&#8358;25,000</td>
                <td class="py-4 px-6">
                  <div class="flex flex-col items-center gap-2">
                    <div class="inline-flex items-center border border-gray-300 rounded-md overflow-hidden bg-white">
                      <button 
                        type="button" 
                        onclick="this.nextElementSibling.stepDown(); this.nextElementSibling.dispatchEvent(new Event('input'))" 
                        class="px-2.5 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold transition-colors cursor-pointer"
                      >-</button>
                      
                      <input 
                        type="number" 
                        wire:model.blur="quantities.2" 
                        class="w-12 text-center text-sm font-semibold border-none focus:outline-none focus:ring-0" 
                        min="1" 
                      />
                      
                      <button 
                        type="button" 
                        onclick="this.previousElementSibling.stepUp(); this.previousElementSibling.dispatchEvent(new Event('input'))" 
                        class="px-2.5 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold transition-colors cursor-pointer"
                      >+</button>
                    </div>
                    
                    <button 
                      type="button" 
                      wire:click="updateQuantity(2)" 
                      wire:loading.attr="disabled"
                      wire:target="updateQuantity(2)"
                      class="text-xs bg-gray-900 hover:bg-black text-white px-3 py-1 rounded transition-colors font-medium cursor-pointer disabled:opacity-50"
                    >
                      <span wire:loading.remove wire:target="updateQuantity(2)">Update</span>
                      <span wire:loading wire:target="updateQuantity(2)">Updating...</span>
                    </button>
                  </div>
                </td>
                <td class="py-4 px-6 text-right font-bold text-gray-900 whitespace-nowrap">&#8358;50,000.00</td>
              </tr>

              <!-- Item 3: Luxury Chronograph Watch -->
              <tr wire:key="cart-item-3" class="hover:bg-gray-50/50 transition-colors">
                <td class="py-4 px-6">
                  <div class="flex items-center gap-4">
                    <div class="w-16 h-16 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 aspect-square">
                      <img 
                        src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?q=80&w=600&auto=format&fit=crop" 
                        alt="Minimalist Chronograph Watch" 
                        class="w-full h-full object-cover"
                      />
                    </div>
                    <div>
                      <h6 class="font-bold text-gray-900 line-clamp-1">Minimalist Chronograph Watch</h6>
                      <button 
                        type="button" 
                        wire:click="removeItem(3)" 
                        wire:loading.attr="disabled"
                        class="text-xs text-red-600 hover:text-red-800 font-semibold underline cursor-pointer mt-1 disabled:opacity-50"
                      >
                        <span wire:loading.remove wire:target="removeItem(3)">Remove</span>
                        <span wire:loading wire:target="removeItem(3)">Removing...</span>
                      </button>
                    </div>
                  </div>
                </td>
                <td class="py-4 px-6 font-semibold whitespace-nowrap">&#8358;35,000</td>
                <td class="py-4 px-6">
                  <div class="flex flex-col items-center gap-2">
                    <div class="inline-flex items-center border border-gray-300 rounded-md overflow-hidden bg-white">
                      <button 
                        type="button" 
                        onclick="this.nextElementSibling.stepDown(); this.nextElementSibling.dispatchEvent(new Event('input'))" 
                        class="px-2.5 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold transition-colors cursor-pointer"
                      >-</button>
                      
                      <input 
                        type="number" 
                        wire:model.blur="quantities.3" 
                        class="w-12 text-center text-sm font-semibold border-none focus:outline-none focus:ring-0" 
                        min="1" 
                      />
                      
                      <button 
                        type="button" 
                        onclick="this.previousElementSibling.stepUp(); this.previousElementSibling.dispatchEvent(new Event('input'))" 
                        class="px-2.5 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold transition-colors cursor-pointer"
                      >+</button>
                    </div>
                    
                    <button 
                      type="button" 
                      wire:click="updateQuantity(3)" 
                      wire:loading.attr="disabled"
                      wire:target="updateQuantity(3)"
                      class="text-xs bg-gray-900 hover:bg-black text-white px-3 py-1 rounded transition-colors font-medium cursor-pointer disabled:opacity-50"
                    >
                      <span wire:loading.remove wire:target="updateQuantity(3)">Update</span>
                      <span wire:loading wire:target="updateQuantity(3)">Updating...</span>
                    </button>
                  </div>
                </td>
                <td class="py-4 px-6 text-right font-bold text-gray-900 whitespace-nowrap">&#8358;35,000.00</td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Order Summary Card -->
    <div class="lg:col-span-4">
      <div class="bg-white p-6 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.08)] border border-gray-100 sticky top-6">
        <h3 class="text-lg font-bold text-gray-900 pb-4 border-b border-gray-100">Order Summary</h3>

        <div class="py-4 space-y-3 border-b border-gray-100 text-sm">
          <div class="flex justify-between text-gray-600">
            <span>Total Items</span>
            <span class="font-semibold text-gray-900">4</span>
          </div>
          <div class="flex justify-between text-gray-600">
            <span>Subtotal</span>
            <span class="font-semibold text-gray-900">&#8358;127,500.00</span>
          </div>
        </div>

        <div class="flex justify-between items-center py-4 text-base font-bold text-gray-900">
          <span>Total Payable</span>
          <span class="text-xl">&#8358;127,500.00</span>
        </div>

        <a 
          href="{{route('checkout')}}" 
          wire:navigate
          class="block w-full text-center bg-black hover:bg-gray-800 text-white font-bold py-3.5 px-4 rounded-md transition-colors duration-300 text-sm shadow-sm cursor-pointer mt-2"
        >
          Proceed to Checkout
        </a>
      </div>
    </div>

  </div>
</div>



</div>
