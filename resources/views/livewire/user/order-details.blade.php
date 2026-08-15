<div class="max-w-5xl mx-auto px-4 py-8 md:py-12 space-y-8">
  
 

  <!-- Back to Ledger Navigation -->
  <div>
    <a href="{{ route('order-ladger') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-black transition-colors" wire:navigate>
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
      </svg>
      Back to Order Ledger
    </a>
  </div>

  @if($isLoading)
    <div class="bg-white rounded-2xl p-12 text-center text-gray-500 border border-gray-100">
      <svg class="animate-spin h-8 w-8 text-black mx-auto mb-3" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
      </svg>
      Loading order details...
    </div>
  @elseif(!$orderData)
    <div class="bg-white rounded-2xl p-12 text-center border border-gray-100">
      <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
      </svg>
      <h3 class="text-base font-bold text-gray-900">Order Not Found</h3>
      <p class="text-xs text-gray-400 mt-1">The requested order details could not be retrieved.</p>
    </div>
  @else
    @php
      $status = $orderData['Status'] ?? null;
      $total = $orderData['Total'] ?? 0;
      $amountPaid = $orderData['AmountPaid'] ?? 0;
      $balanceDue = max(0, $total - $amountPaid);

      // Order Status Label & Style
      if ($status === 0) {
          $statusLabel = 'Cancelled';
          $statusBadge = 'bg-rose-500/20 text-rose-300 border-rose-500/30';
      } elseif ($status === 2) {
          $statusLabel = 'Processing';
          $statusBadge = 'bg-blue-500/20 text-blue-300 border-blue-500/30';
      } else {
          $statusLabel = 'Active';
          $statusBadge = 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30';
      }

      // Payment Status Label
      if ($amountPaid >= $total && $total > 0) {
          $paymentStatus = 'Paid';
          $paymentBadge = 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30';
      } elseif ($amountPaid > 0) {
          $paymentStatus = 'Partial';
          $paymentBadge = 'bg-blue-500/20 text-blue-300 border-blue-500/30';
      } else {
          $paymentStatus = 'Unpaid';
          $paymentBadge = 'bg-amber-500/20 text-amber-300 border-amber-500/30';
      }

      $isCancelled = $status === 0;
      $isProcessing = $status === 2;
      $isFullyPaid = $paymentStatus === 'Paid';

      $canPay = !$isCancelled && !$isFullyPaid && !$isProcessing;
      $canCancel = !$isCancelled && !$isFullyPaid && !$isProcessing && $paymentStatus === 'Unpaid';

      $dateFormatted = !empty($orderData['Date']) ? date('M d, Y', strtotime($orderData['Date'])) : 'N/A';
    @endphp

    <!-- 1. Header Overview Section -->
    <div class="bg-slate-900 text-white rounded-2xl p-6 md:p-8 shadow-lg flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
      <div class="space-y-1">
        <div class="flex items-center gap-3 flex-wrap">
          <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $statusBadge }}">
            {{ $statusLabel }}
          </span>
          <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $paymentBadge }}">
            {{ $paymentStatus }}
          </span>
          <span class="text-xs text-slate-400 font-mono">ID: {{ $orderData['InvoiceID'] ?? '' }}</span>
        </div>
        <div class="text-3xl md:text-4xl font-extrabold tracking-tight pt-1">
          &#8358;{{ number_format($total, 2) }}
        </div>
        <p class="text-xs text-slate-400">
          Listed on {{ $dateFormatted }}
        </p>
      </div>

      <!-- Quick Cancel Button -->
      @if($canCancel)
        <div class="flex items-center gap-3 w-full md:w-auto">
          <button 
            type="button" 
            wire:click="cancelOrder" 
            wire:loading.attr="disabled"
            class="flex-1 md:flex-none px-4 py-2 bg-slate-800 hover:bg-red-600 text-slate-200 hover:text-white text-xs font-bold rounded-lg transition-colors border border-slate-700 cursor-pointer disabled:opacity-50"
          >
            <span wire:loading.remove wire:target="cancelOrder">Cancel Order</span>
            <span wire:loading wire:target="cancelOrder">Cancelling...</span>
          </button>
        </div>
      @endif
    </div>

    <!-- 2.5. Shipment Details Card -->
    <div class="bg-white rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-gray-100 p-6 space-y-4">
      
      <!-- Header & Status -->
      <div class="flex items-center justify-between pb-3 border-b border-gray-100">
        <div class="flex items-center gap-2">
          <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
          </svg>
          <h3 class="text-xs font-bold uppercase tracking-wider text-gray-500">Delivery Details</h3>
        </div>

        <!-- Status Badge -->
        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold border uppercase tracking-wider bg-amber-50 text-amber-700 border-amber-200">
          Awaiting Payment
        </span>
      </div>

      <!-- Content Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 pt-1">
        
        <!-- Courier Service -->
        <div class="flex items-center gap-3">
          <img 
            src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80" 
            alt="Courier Avatar" 
            class="w-11 h-11 object-cover rounded-lg border border-gray-100 bg-gray-50 p-0.5 shadow-sm"
          />
          <div>
            <p class="text-xs text-gray-400 font-medium">Courier Service</p>
            <p class="text-sm font-semibold text-gray-800 capitalize">
              Fez Delivery
            </p>
          </div>
        </div>

        <!-- Shipping Fee -->
        <div>
          <p class="text-xs text-gray-400 font-medium">Shipping Fee</p>
          <p class="text-sm font-bold text-gray-900">&#8358;7,791.25</p>
        </div>

        <!-- Courier Name -->
        <div>
          <p class="text-xs text-gray-400 font-medium">Courier Name</p>
          <p class="text-sm font-semibold text-gray-800">
            Joshua
          </p>
        </div>

        <!-- Order Date -->
        <div>
          <p class="text-xs text-gray-400 font-medium">Order Date</p>
          <p class="text-sm font-semibold text-gray-800">
            Aug 15, 2026 • 09:37 PM
          </p>
        </div>

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
          <p class="text-sm text-gray-800 font-medium mt-0.5">{{ $orderData['Address'] ?? 'N/A' }}</p>
        </div>
      </div>

      @if(!empty($orderData['Notes']))
        <div class="mt-4 pt-4 border-t border-gray-100">
          <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-1">Order Notes</h4>
          <p class="text-sm text-gray-600 italic">"{{ $orderData['Notes'] }}"</p>
        </div>
      @endif
    </div>

    <!-- 3. Ordered Items Table Section -->
    <div class="bg-white rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.08)] border border-gray-100 overflow-hidden">
      <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
        <h3 class="font-bold text-gray-900 text-sm">Items Ordered</h3>
        <span class="text-xs font-semibold text-gray-500">{{ count($orderData['Items'] ?? []) }} Item(s)</span>
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
            @forelse($orderData['Items'] ?? [] as $index => $item)
              <tr class="hover:bg-gray-50/50 transition-colors">
                <td class="py-4 px-6">
                  <div>
                    <h6 class="font-bold text-gray-900 text-sm">{{ $item['ProductName'] ?? 'Product' }}</h6>
                    <span class="text-xs text-gray-400 font-mono">SKU: {{ $item['ProductID'] ?? 'N/A' }}</span>
                  </div>
                </td>
                <td class="py-4 px-6 text-center font-semibold text-gray-900">{{ $item['Qty'] ?? 1 }}</td>
                <td class="py-4 px-6 text-right font-medium text-gray-600">&#8358;{{ number_format($item['Rate'] ?? 0, 2) }}</td>
                <td class="py-4 px-6 text-right font-bold text-gray-900">&#8358;{{ number_format($item['Amount'] ?? 0, 2) }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="py-6 text-center text-gray-400 text-sm">No items found for this order.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- 4. Subtotal & Balance Due Summary Card -->
    <div class="bg-white rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.08)] border border-gray-100 p-6 md:p-8 space-y-4">
      <div class="space-y-3 pb-4 border-b border-gray-100 text-sm">
        <div class="flex justify-between text-gray-600">
          <span>Subtotal</span>
          <span class="font-semibold text-gray-900">&#8358;{{ number_format($total, 2) }}</span>
        </div>
        <div class="flex justify-between text-gray-600">
          <span>Total Paid</span>
          <span class="font-semibold text-emerald-600">&#8358;{{ number_format($amountPaid, 2) }}</span>
        </div>
      </div>

      <!-- Balance Due -->
      <div class="flex justify-between items-center py-2 text-base font-bold text-gray-900">
        <span class="text-lg">Balance Due</span>
        <span class="text-2xl {{ $balanceDue > 0 ? 'text-red-600' : 'text-emerald-600' }}">
          &#8358;{{ number_format($balanceDue, 2) }}
        </span>
      </div>


            <!-- Flash Messages -->
      @if (session()->has('success'))
        <div class="p-4 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl text-sm font-semibold">
          {{ session('success') }}
        </div>
      @endif

      @if (session()->has('error'))
        <div class="p-4 bg-red-50 text-red-700 border border-red-200 rounded-xl text-sm font-semibold">
          {{ session('error') }}
        </div>
      @endif

      <!-- 5. Bottom Action Buttons -->
      @if($canPay || $canCancel)
        <div class="flex flex-col sm:flex-row gap-4 pt-4">
          @if($canCancel)
            <button 
              type="button" 
              wire:click="cancelOrder" 
              wire:loading.attr="disabled"
              class="flex-1 bg-white hover:bg-red-50 text-red-600 border border-red-200 font-bold py-3.5 px-6 rounded-lg transition-colors text-sm shadow-sm cursor-pointer text-center disabled:opacity-50"
            >
              <span wire:loading.remove wire:target="cancelOrder">Cancel Order</span>
              <span wire:loading wire:target="cancelOrder">Cancelling...</span>
            </button>
          @endif

          @if($canPay)
            <button 
              type="button" 
              wire:click="payNow" 
              wire:loading.attr="disabled"
              class="flex-1 bg-black hover:bg-gray-800 text-white font-bold py-3.5 px-6 rounded-lg transition-colors text-sm shadow-sm cursor-pointer text-center disabled:opacity-50"
            >
              <span wire:loading.remove wire:target="payNow">Pay Now (&#8358;{{ number_format($balanceDue, 2) }})</span>
              <span wire:loading wire:target="payNow">Initializing Payment...</span>
            </button>
          @endif
        </div>
      @endif

    </div>
  @endif


</div>
