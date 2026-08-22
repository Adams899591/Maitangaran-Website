
<div class="max-w-7xl mx-auto px-4 py-8 md:py-12">
  
  <!-- Section Title & Refresh -->
  <div class="mb-8 text-center sm:text-left flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
      <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Write a Review</h2>
      <p class="text-sm text-gray-500 mt-1">Products from your recent orders that are ready to be reviewed</p>
    </div>
    
    <button 
      wire:click="fetchUserAvailableReview" 
      class="inline-flex items-center justify-center px-4 py-2 bg-black text-white text-xs font-bold rounded-lg hover:bg-gray-800 transition-colors cursor-pointer self-start sm:self-auto"
    >
      <svg wire:loading.class="animate-spin" wire:target="fetchUserAvailableReview" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
      </svg>
      Refresh Products
    </button>
  </div>

  <!-- Table Container -->
  <div class="bg-white rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.08)] border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse min-w-[650px]">
        
        <!-- Table Header -->
        <thead>
          <tr class="bg-black text-white text-xs uppercase tracking-wider">
            <th class="py-4 px-6 font-semibold w-16">SN</th>
            <th class="py-4 px-6 font-semibold">Product</th>
            <th class="py-4 px-6 font-semibold">Price</th>
            {{-- <th class="py-4 px-6 font-semibold">Category ID</th> --}}
            <th class="py-4 px-6 font-semibold text-center">Action</th>
          </tr>
        </thead>

        <!-- Table Body -->
        <tbody class="divide-y divide-gray-100 text-sm text-gray-800">
          
          @if($isLoading)
            <tr>
              <td colspan="5" class="py-12 text-center text-gray-500">
                <svg class="animate-spin h-6 w-6 text-black mx-auto mb-2" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Loading items for review...
              </td>
            </tr>
          @elseif(count($products) === 0)
            <tr>
              <td colspan="5" class="py-16 text-center">
                <div class="max-w-xs mx-auto">
                  <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                  </svg>
                  <h3 class="text-base font-bold text-gray-900">No Products Available</h3>
                  <p class="text-xs text-gray-400 mt-1">Only paid orders are eligible for product reviews. Once payment is successfully processed, available products will appear on this list.</p>
                </div>
              </td>
            </tr>
          @else
            @foreach($products as $index => $item)
              @php
                $hasImage = !empty($item['SmallImage']);
                $imageUrl = $hasImage ? $imageDomain . $item['SmallImage'] : null;
                $price = $item['SellingPrice'] ?? $item['OnlineRate'] ?? 0;
              @endphp

              <tr wire:key="prod-{{ $item['ID'] ?? $index }}" class="hover:bg-gray-50/50 transition-colors">
                <!-- Index -->
                <td class="py-4 px-6 font-bold text-gray-500">{{ $index + 1 }}</td>
                
                <!-- Product Details -->
                <td class="py-4 px-6">
                  <div class="flex items-center gap-3">
                    @if($hasImage)
                      <img 
                        src="{{ $imageUrl }}" 
                        alt="{{ $item['ProductName'] ?? 'Product' }}" 
                        class="w-12 h-12 rounded-lg object-cover border border-gray-200 shrink-0"
                      />
                    @else
                      <div class="w-12 h-12 rounded-lg bg-gray-100 border border-gray-200 flex flex-col items-center justify-center shrink-0 text-gray-400 p-1">
                        <svg class="w-6 h-6 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-[9px] font-medium leading-none text-center">No Image</span>
                      </div>
                    @endif
                    <div>
                      <p class="font-bold text-gray-900 line-clamp-1">{{ $item['ProductName'] ?? 'N/A' }}</p>
                      <span class="text-xs text-gray-500">Unit: {{ $item['Units'] ?? 'N/A' }}</span>
                    </div>
                  </div>
                </td>

                <!-- Price -->
                <td class="py-4 px-6 font-bold text-gray-900 whitespace-nowrap">
                  &#8358;{{ number_format($price, 2) }}
                </td>

                <!-- Action Button -->
                <td class="py-4 px-6 text-center whitespace-nowrap">
                  <button 
                    type="button" 
                    wire:click="writeReview('{{ $item['ID'] }}')" 
                    class="inline-flex items-center justify-center px-3 py-1.5 bg-black hover:bg-gray-800 text-white text-xs font-semibold rounded-lg transition-colors cursor-pointer gap-1.5 shadow-sm"
                  >
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Write Review
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
