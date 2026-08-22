<div class="max-w-7xl mx-auto px-4 py-8 md:py-12">
    <!-- Header Section -->
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight">My Reviews</h2>
            <p class="text-sm text-gray-500 mt-1">Products you have already reviewed</p>
        </div>

        <button 
            wire:click="fetchUserAlreadyReview" 
            class="inline-flex items-center justify-center px-4 py-2 bg-black text-white text-xs font-bold rounded-lg hover:bg-gray-800 transition-colors cursor-pointer self-start sm:self-auto"
        >
            <svg wire:loading.class="animate-spin" wire:target="fetchUserAlreadyReview" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            Refresh Reviews
        </button>
    </div>

    <!-- Loading State -->
    @if($isLoading)
        <div class="py-16 text-center text-gray-500 bg-white rounded-xl border border-gray-100 shadow-sm">
            <svg class="animate-spin h-8 w-8 text-black mx-auto mb-3" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="text-sm font-medium">Loading your reviews...</p>
        </div>

    <!-- Empty State -->
    @elseif(count($reviews) === 0)
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm py-16 text-center">
            <div class="max-w-xs mx-auto">
                <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
                <h3 class="text-base font-bold text-gray-900">No Completed Reviews</h3>
                <p class="text-xs text-gray-400 mt-1">You haven't submitted any product reviews yet.</p>
            </div>
        </div>

    <!-- Cards Grid -->
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($reviews as $item)
                <div class="bg-white rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.06)] border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition-shadow">
                    
                    <div>
                        <!-- Header & Verified Badge -->
                        <div class="flex items-start justify-between gap-2 mb-3">
                            <h3 class="font-bold text-gray-900 text-base leading-snug line-clamp-2">
                                {{ $item['ProductName'] ?? 'Product Review' }}
                            </h3>
                            @if(!empty($item['IsVerifiedPurchase']))
                                <span class="shrink-0 inline-flex items-center gap-1 text-[10px] font-semibold bg-green-50 text-green-700 px-2 py-0.5 rounded-full border border-green-200">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Verified
                                </span>
                            @endif
                        </div>

                        <!-- Rating Stars -->
                        <div class="flex items-center gap-1 mb-3">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg 
                                    class="w-4 h-4 {{ $i <= ($item['Rating'] ?? 0) ? 'text-amber-400 fill-amber-400' : 'text-gray-200 fill-gray-200' }}" 
                                    viewBox="0 0 20 20"
                                >
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                            <span class="text-xs font-bold text-gray-700 ml-1">{{ $item['Rating'] ?? 0 }}/5</span>
                        </div>

                        <!-- Comment -->
                        <p class="text-sm text-gray-600 bg-gray-50 p-3 rounded-lg border border-gray-100 italic">
                            "{{ trim($item['Comment'] ?? '') }}"
                        </p>
                    </div>

                    <!-- Footer: Date & Author -->
                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-400">
                        <span class="font-medium text-gray-700">{{ $item['CustomerName'] ?? 'Anonymous' }}</span>
                        <span>
                            @if(!empty($item['DateCreated']))
                                {{ \Carbon\Carbon::parse($item['DateCreated'])->format('M d, Y') }}
                            @endif
                        </span>
                    </div>

                </div>
            @endforeach
        </div>
    @endif
</div>
