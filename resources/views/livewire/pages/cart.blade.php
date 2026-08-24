<div class="max-w-7xl mx-auto px-4 py-8 md:py-12">
  
  <!-- Header Title -->
  <div class="mb-8 text-center flex flex-col items-center">
    <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Your Cart</h2>
    <p class="text-sm text-gray-500 mt-1">Review your selected items and manage quantities</p>
    
    @if(count($cartItems) > 0)
      <button 
        wire:click="clearCart" 
        class="mt-3 text-xs text-red-600 hover:text-red-800 font-bold uppercase tracking-wider cursor-pointer"
      >
        Clear All Items
      </button>
    @endif
  </div>

  <!-- Loading State -->
  @if($isLoading)
    <x-skeleton-loading-cart />

  <!-- Error State -->
  @elseif($networkError)
    <x-fetch-error retry-action="fetchCart" />

  <!-- Empty Cart State -->
  @elseif(count($cartItems) === 0)
    <div class="text-center py-16 bg-white rounded-xl border border-gray-100 shadow-sm max-w-lg mx-auto">
      <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
        </svg>
      </div>
      <h3 class="text-lg font-bold text-gray-900">Your bag is empty</h3>
      <p class="text-xs text-gray-500 mt-1 mb-6">Looks like you haven't added anything to your cart yet.</p>
      <a href="{{ route('shop') }}" class="bg-black text-white text-xs font-bold px-6 py-3 rounded-lg uppercase tracking-wider">
        Continue Shopping
      </a>
    </div>

  <!-- Active Cart Items Grid -->
  @else
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
      
      <!-- Cart Table -->
      <div class="lg:col-span-8">
        <div class="bg-white rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.08)] border border-gray-100 overflow-hidden">
          <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[600px]">
              
              <thead>
                <tr class="bg-black text-white text-xs uppercase tracking-wider">
                  <th class="py-4 px-6 font-semibold">Product</th>
                  <th class="py-4 px-6 font-semibold">Price</th>
                  <th class="py-4 px-6 font-semibold text-center">Quantity</th>
                  <th class="py-4 px-6 font-semibold text-right">Subtotal</th>
                </tr>
              </thead>

              <tbody class="divide-y divide-gray-100 text-sm text-gray-800">
                @foreach($cartItems as $item)
                  @php
                    $itemId = $item['ID'];
                    $rate = (float)($item['Rate'] ?? 0);
                    $qty = (int)($quantities[$itemId] ?? $item['Quantity']);
                    $itemSubtotal = $rate * $qty;
                  @endphp

                  <tr wire:key="cart-item-{{ $itemId }}" class="hover:bg-gray-50/50 transition-colors">
                    <td class="py-4 px-6">
                      <div class="flex items-center gap-4">
                        <div class="w-16 h-16 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 aspect-square">
                          @if(!empty($item['ImageUrl']))
                            <img src="{{ $this->imageDomain . $item['ImageUrl'] }}" alt="{{ $item['ProductName'] }}" class="w-full h-full object-cover" />
                          @else
                            <x-no-image-uploaded heightClass="h-full" />
                          @endif
                        </div>
                        <div>
                          <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider block">
                            {{ $item['VariantLabel'] ?? 'Item' }}
                          </span>
                          <h6 class="font-bold text-gray-900 line-clamp-1">{{ $item['ProductName'] }}</h6>
                          <button 
                            type="button" 
                            wire:click="removeItem('{{ $itemId }}')" 
                            wire:loading.attr="disabled"
                            class="text-xs text-red-600 hover:text-red-800 font-semibold underline cursor-pointer mt-1 disabled:opacity-50"
                          >
                            <span wire:loading.remove wire:target="removeItem('{{ $itemId }}')">Remove</span>
                            <span wire:loading wire:target="removeItem('{{ $itemId }}')">Removing...</span>
                          </button>
                        </div>
                      </div>
                    </td>

                    <td class="py-4 px-6 font-semibold whitespace-nowrap">&#8358;{{ number_format($rate) }}</td>

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
                            wire:model.defer="quantities.{{ $itemId }}" 
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
                          wire:click="updateQuantity('{{ $itemId }}')" 
                          wire:loading.attr="disabled"
                          wire:target="updateQuantity('{{ $itemId }}')"
                          class="text-xs bg-gray-900 hover:bg-black text-white px-3 py-1 rounded transition-colors font-medium cursor-pointer disabled:opacity-50"
                        >
                          <span wire:loading.remove wire:target="updateQuantity('{{ $itemId }}')">Update</span>
                          <span wire:loading wire:target="updateQuantity('{{ $itemId }}')">Updating...</span>
                        </button>
                      </div>
                    </td>

                    <td class="py-4 px-6 text-right font-bold text-gray-900 whitespace-nowrap">
                      &#8358;{{ number_format($itemSubtotal) }}
                    </td>
                  </tr>
                @endforeach
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
              <span class="font-semibold text-gray-900">{{ $totalQuantity }}</span>
            </div>
            <div class="flex justify-between text-gray-600">
              <span>Subtotal</span>
              <span class="font-semibold text-gray-900">&#8358;{{ number_format($subtotal) }}</span>
            </div>
          </div>

          <div class="flex justify-between items-center py-4 text-base font-bold text-gray-900">
            <span>Total Payable</span>
            <span class="text-xl">&#8358;{{ number_format($totalAmount) }}</span>
          </div>


          <!-- Session Error Alert -->
          @if (session()->has('error'))
              <div class="mb-4 flex items-center justify-between gap-4 rounded-xl border border-red-200 bg-red-50 p-4 text-red-800 shadow-sm">
                  <div class="flex items-center gap-3">
                      <svg class="h-5 w-5 flex-shrink-0 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                      </svg>
                      <span class="text-[11px] sm:text-xs font-medium">{{ session('error') }}</span>
                  </div>

                  <a href="{{ route('login') }}" class="inline-flex flex-shrink-0 items-center gap-1 rounded-lg bg-red-600 px-3.5 py-2 text-xs font-semibold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors" wire:navigate >
                      Log In
                      <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                      </svg>
                  </a>
              </div>
          @endif

          <button
            {{-- href="{{ route('shipping-details') }}" --}}
          wire:click='proceedToCheckout'
            class="block w-full text-center bg-black hover:bg-gray-800 text-white font-bold py-3.5 px-4 rounded-md transition-colors duration-300 text-sm shadow-sm cursor-pointer mt-2"
          >
            Proceed to Checkout
          </button>

        </div> 
      </div>

    </div>
  @endif
</div>