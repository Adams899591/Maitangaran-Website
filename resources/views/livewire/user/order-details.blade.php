<div class="max-w-5xl mx-auto px-4 py-8 md:py-12 space-y-8">
  
  <!-- Back to Ledger Navigation -->
  <div>
    <a href="#ledger" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-black transition-colors">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
      </svg>
      Back to Order Ledger
    </a>
  </div>

  <!-- 1. Dark Blue Header Overview Section -->
  <div class="bg-slate-900 text-white rounded-2xl p-6 md:p-8 shadow-lg flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
    <div class="space-y-1">
      <div class="flex items-center gap-3 flex-wrap">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-500/20 text-amber-300 border border-amber-500/30">
          Unpaid & Active
        </span>
        <span class="text-xs text-slate-400 font-mono">ID: ORD-984210385920</span>
      </div>
      <div class="text-3xl md:text-4xl font-extrabold tracking-tight pt-1">
        &#8358;44,000.00
      </div>
      <p class="text-xs text-slate-400">
        Listed on August 26, 2026
      </p>
    </div>

    <!-- Top Action Buttons (Optional quick cancel) -->
    <div class="flex items-center gap-3 w-full md:w-auto">
      <button 
        type="button" 
        wire:click="cancelOrder" 
        class="flex-1 md:flex-none px-4 py-2 bg-slate-800 hover:bg-red-600 text-slate-200 hover:text-white text-xs font-bold rounded-lg transition-colors border border-slate-700 cursor-pointer"
      >
        Cancel Order
      </button>
    </div>
  </div>

  <!-- 2. Delivery Address Section -->
  <div class="bg-white rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-gray-100 p-6">
    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Delivery Address</h3>
    <div class="flex items-start gap-3">
      <div class="p-2 bg-gray-50 rounded-lg text-gray-700 mt-0.5">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
      </div>
      <div>
        <h4 class="font-bold text-gray-900 text-sm">John Doe</h4>
        <p class="text-sm text-gray-600 mt-0.5">15 Admiralty Way, Lekki Phase 1, Lagos State</p>
      </div>
    </div>
  </div>

  <!-- 3. Ordered Items Table Section -->
  <div class="bg-white rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.08)] border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
      <h3 class="font-bold text-gray-900 text-sm">Item Ordered</h3>
      <span class="text-xs font-semibold text-gray-500">2 Items</span>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse min-w-[600px]">
        <thead>
          <tr class="bg-black text-white text-xs uppercase tracking-wider">
            <th class="py-3 px-6 font-semibold">Product Details</th>
            <th class="py-3 px-6 font-semibold text-center">Quantity</th>
            <th class="py-3 px-6 font-semibold text-right">Unit Price</th>
            <th class="py-3 px-6 font-semibold text-right">Subtotal</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm text-gray-800">
          
          <!-- Item Row -->
          <tr class="hover:bg-gray-50/50 transition-colors">
            <td class="py-4 px-6">
              <div class="flex items-center gap-3">
                <div class="w-12 h-12 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                  <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=600&auto=format&fit=crop" alt="Product" class="w-full h-full object-cover"/>
                </div>
                <div>
                  <h6 class="font-bold text-gray-900 text-sm line-clamp-1">Designer Men Sneakers</h6>
                  <span class="text-xs text-gray-400 font-mono">SKU: SNK-9482</span>
                </div>
              </div>
            </td>
            <td class="py-4 px-6 text-center font-semibold text-gray-900">2</td>
            <td class="py-4 px-6 text-right font-medium text-gray-600">&#8358;22,000.00</td>
            <td class="py-4 px-6 text-right font-bold text-gray-900">&#8358;44,000.00</td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>

  <!-- 4. Subtotal & Balance Due Summary Card -->
  <div class="bg-white rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.08)] border border-gray-100 p-6 md:p-8 space-y-4">
    <div class="space-y-3 pb-4 border-b border-gray-100 text-sm">
      <div class="flex justify-between text-gray-600">
        <span>Subtotal</span>
        <span class="font-semibold text-gray-900">&#8358;44,000.00</span>
      </div>
      <div class="flex justify-between text-gray-600">
        <span>Total Paid</span>
        <span class="font-semibold text-emerald-600">&#8358;0.00</span>
      </div>
    </div>

    <!-- Balance Due -->
    <div class="flex justify-between items-center py-2 text-base font-bold text-gray-900">
      <span class="text-lg">Balance Due</span>
      <span class="text-2xl text-red-600">&#8358;44,000.00</span>
    </div>

    <!-- 5. Two Action Buttons at Bottom -->
    <div class="flex flex-col sm:flex-row gap-4 pt-4">
      <button 
        type="button" 
        wire:click="cancelOrder" 
        class="flex-1 bg-white hover:bg-red-50 text-red-600 border border-red-200 font-bold py-3.5 px-6 rounded-lg transition-colors text-sm shadow-sm cursor-pointer text-center"
      >
        Cancel Order
      </button>

      <button 
        type="button" 
        wire:click="payNow" 
        class="flex-1 bg-black hover:bg-gray-800 text-white font-bold py-3.5 px-6 rounded-lg transition-colors text-sm shadow-sm cursor-pointer text-center"
      >
        Pay Now (&#8358;44,000.00)
      </button>
    </div>
  </div>

</div>
