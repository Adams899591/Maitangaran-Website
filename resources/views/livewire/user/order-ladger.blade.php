<div class="max-w-7xl mx-auto px-4 py-8 md:py-12">
  
  <!-- Section Title -->
  <div class="mb-8 text-center sm:text-left flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
      <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Order Ledger</h2>
      <p class="text-sm text-gray-500 mt-1">Track your past orders, payment statuses, and view invoices</p>
    </div>
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
            <th class="py-4 px-6 font-semibold">Delivery Address</th>
            <th class="py-4 px-6 font-semibold text-center">Action</th>
          </tr>
        </thead>

        <!-- Table Body -->
        <tbody class="divide-y divide-gray-100 text-sm text-gray-800">
          
          <!-- Row 1 -->
          <tr wire:key="ledger-1" class="hover:bg-gray-50/50 transition-colors">
            <td class="py-4 px-6 font-bold text-gray-500">1</td>
            <td class="py-4 px-6 whitespace-nowrap font-medium text-gray-900">Oct 24, 2026</td>
            <td class="py-4 px-6 font-bold text-gray-900 whitespace-nowrap">&#8358;42,500.00</td>
            <td class="py-4 px-6 whitespace-nowrap">
              <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                Paid
              </span>
            </td>
            <td class="py-4 px-6 text-gray-600 max-w-xs truncate" title="15 Admiralty Way, Lekki Phase 1, Lagos">
              15 Admiralty Way, Lekki Phase 1, Lagos
            </td>
            <td class="py-4 px-6 text-center whitespace-nowrap">
              <button 
                type="button" 
                wire:click="viewInvoice(1)" 
                class="inline-flex items-center justify-center p-2 bg-gray-100 hover:bg-black hover:text-white text-gray-700 rounded-lg transition-colors cursor-pointer"
                title="View Invoice & Details"
              >
                <!-- Eye/Invoice Icon -->
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
              </button>
            </td>
          </tr>

          <!-- Row 2 -->
          <tr wire:key="ledger-2" class="hover:bg-gray-50/50 transition-colors">
            <td class="py-4 px-6 font-bold text-gray-500">2</td>
            <td class="py-4 px-6 whitespace-nowrap font-medium text-gray-900">Nov 02, 2026</td>
            <td class="py-4 px-6 font-bold text-gray-900 whitespace-nowrap">&#8358;85,000.00</td>
            <td class="py-4 px-6 whitespace-nowrap">
              <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                Pending
              </span>
            </td>
            <td class="py-4 px-6 text-gray-600 max-w-xs truncate" title="4B Wuse Zone 4, Abuja">
              4B Wuse Zone 4, Abuja
            </td>
            <td class="py-4 px-6 text-center whitespace-nowrap">
              <button 
                type="button" 
                wire:click="viewInvoice(2)" 
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

          <!-- Row 3 -->
          <tr wire:key="ledger-3" class="hover:bg-gray-50/50 transition-colors">
            <td class="py-4 px-6 font-bold text-gray-500">3</td>
            <td class="py-4 px-6 whitespace-nowrap font-medium text-gray-900">Nov 15, 2026</td>
            <td class="py-4 px-6 font-bold text-gray-900 whitespace-nowrap">&#8358;35,000.00</td>
            <td class="py-4 px-6 whitespace-nowrap">
              <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                Paid
              </span>
            </td>
            <td class="py-4 px-6 text-gray-600 max-w-xs truncate" title="Plot 12 Ikenegbu Layout, Owerri">
              Plot 12 Ikenegbu Layout, Owerri
            </td>
            <td class="py-4 px-6 text-center whitespace-nowrap">
              <button 
                type="button" 
                wire:click="viewInvoice(3)" 
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

        </tbody>
      </table>
    </div>
  </div>

</div>
