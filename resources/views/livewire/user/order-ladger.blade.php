<div class="max-w-7xl mx-auto px-4 py-8 md:py-12">
  
  <!-- Section Title -->
  <div class="mb-8 text-center sm:text-left flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
      <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Order Ledger</h2>
      <p class="text-sm text-gray-500 mt-1">Track your past orders, payment statuses, and view invoices</p>
    </div>
    
    <!-- Refresh Button -->
    <button 
      wire:click="fetchUserOrders" 
      class="inline-flex items-center justify-center px-4 py-2 bg-black text-white text-xs font-bold rounded-lg hover:bg-gray-800 transition-colors cursor-pointer self-start sm:self-auto"
    >
      <svg wire:loading.class="animate-spin" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
      </svg>
      Refresh Ledger
    </button>
  </div>

  <!-- Order Ledger Table Section -->
  <div class="bg-white rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.08)] border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse min-w-[750px]">
        
        <!-- Table Header -->
        <thead>
          <tr class="bg-black text-white text-xs uppercase tracking-wider">
            <th class="py-4 px-6 font-semibold w-16">SN</th>
            <th class="py-4 px-6 font-semibold">Date</th>
            <th class="py-4 px-6 font-semibold">Total</th>
            <th class="py-4 px-6 font-semibold">Payment Status</th>
            <th class="py-4 px-6 font-semibold">Order Status</th>
            <th class="py-4 px-6 font-semibold">Delivery Address</th>
            <th class="py-4 px-6 font-semibold text-center">Action</th>
          </tr>
        </thead>

        <!-- Table Body -->
        <tbody class="divide-y divide-gray-100 text-sm text-gray-800">
          
          @if($isLoading)
            <tr>
              <td colspan="7" class="py-12 text-center text-gray-500">
                <svg class="animate-spin h-6 w-6 text-black mx-auto mb-2" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Loading orders...
              </td>
            </tr>
          @elseif(count($orders) === 0)
            <tr>
              <td colspan="7" class="py-16 text-center">
                <div class="max-w-xs mx-auto">
                  <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
                  <h3 class="text-base font-bold text-gray-900">No Orders Found</h3>
                  <p class="text-xs text-gray-400 mt-1">Your ledger is currently empty. Any new invoices or placement balances will show up right here.</p>
                </div>
              </td>
            </tr>
          @else
            @foreach($orders as $index => $item)
              @php
                // Payment Status Calculation
                $amountPaid = $item['AmountPaid'] ?? 0;
                $total = $item['Total'] ?? 0;

                if ($amountPaid >= $total && $total > 0) {
                    $paymentStatus = 'Paid';
                    $paymentClass = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                } elseif ($amountPaid > 0) {
                    $paymentStatus = 'Partial';
                    $paymentClass = 'bg-amber-50 text-amber-700 border-amber-200';
                } else {
                    $paymentStatus = 'Unpaid';
                    $paymentClass = 'bg-gray-100 text-gray-600 border-gray-200';
                }

                // Order Status Parsing
                $statusCode = $item['Status'] ?? null;
                if ($statusCode === 0) {
                    $orderStatus = 'Cancelled';
                    $statusClass = 'text-red-500';
                } elseif ($statusCode === 2) {
                    $orderStatus = 'Processing';
                    $statusClass = 'text-blue-500';
                } else {
                    $orderStatus = 'Active';
                    $statusClass = 'text-amber-500';
                }

                // Date formatting
                $dateFormatted = !empty($item['Date']) ? explode('T', $item['Date'])[0] : 'N/A';
              @endphp

              <tr wire:key="ledger-{{ $item['InvoiceID'] ?? $index }}" class="hover:bg-gray-50/50 transition-colors">
                <td class="py-4 px-6 font-bold text-gray-500">{{ $index + 1 }}</td>
                <td class="py-4 px-6 whitespace-nowrap font-medium text-gray-900">{{ $dateFormatted }}</td>
                <td class="py-4 px-6 font-bold text-gray-900 whitespace-nowrap">&#8358;{{ number_format($total, 2) }}</td>
                
                <td class="py-4 px-6 whitespace-nowrap">
                  <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold border {{ $paymentClass }}">
                    {{ $paymentStatus }}
                  </span>
                </td>

                <td class="py-4 px-6 whitespace-nowrap font-bold text-xs {{ $statusClass }}">
                  {{ $orderStatus }}
                </td>

                <td class="py-4 px-6 text-gray-600 max-w-xs truncate" title="{{ $item['Address'] ?? '' }}">
                  {{ $item['Address'] ?? 'N/A' }}
                </td>

                <td class="py-4 px-6 text-center whitespace-nowrap">
                  <button 
                    type="button" 
                    wire:click="viewInvoice('{{ $item['InvoiceID'] ?? '' }}')" 
                    class="inline-flex items-center justify-center p-2 bg-gray-100 hover:bg-black hover:text-white text-gray-700 rounded-lg transition-colors cursor-pointer"
                    title="View Invoice & Details"
                  >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                  </button>
                </td>
              </tr>
            @endforeach
          @endif

        </tbody>
        
      </table>
    </div>
  </div>


</div>
