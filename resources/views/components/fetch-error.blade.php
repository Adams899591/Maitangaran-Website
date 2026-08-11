@props(['retryAction' => null])

@php
    // Catch both kebab-case (retry-action) and camelCase (retryAction)
    $action = $retryAction ?? $attributes->get('retry-action');
    // Extract base method name for wire:target (e.g. "fetchProducts" from "fetchProducts(1)")
    $targetMethod = $action ? Str::before($action, '(') : null;
@endphp

<div>
    <section class="bg-[#f8f9fa] py-12" id="shop-error">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">

            <div class="bg-white rounded-[10px] p-8 text-center shadow-[0_4px_12px_rgba(0,0,0,0.1)] max-w-md mx-auto my-6">
            
                <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M3 15a4 4 0 004 4h12a4 4 0 001-7.9 5 5 0 00-9.9-1.2A4.5 4.5 0 003 15z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 4h.01"></path>
                    </svg>
                </div>

                <h3 class="text-lg font-bold text-black mb-1">
                    Failed to Load Products
                </h3>
                <p class="text-sm text-gray-500 mb-6">
                    We couldn't fetch the products from the server. Please check your network connection and try again.
                </p>

                @if(!empty($action))
                    <!-- Livewire Section Reload (Does NOT refresh full page) -->
                    <button type="button" wire:click="{{ $action }}" wire:loading.attr="disabled" wire:target="{{ $targetMethod }}"
                        class="bg-black hover:bg-gray-800 disabled:opacity-50 text-white border-none py-2.5 px-6 rounded font-semibold text-sm transition-all duration-300 shadow-md hover:shadow-lg active:scale-95 cursor-pointer inline-flex items-center gap-2">
                        <svg wire:loading.remove wire:target="{{ $targetMethod }}" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <svg wire:loading wire:target="{{ $targetMethod }}" class="animate-spin w-4 h-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Try Again</span>
                    </button>
                @else
                    <!-- Full Page Reload Fallback -->
                    <button type="button" onclick="window.location.reload()" 
                        class="bg-black hover:bg-gray-800 text-white border-none py-2.5 px-6 rounded font-semibold text-sm transition-all duration-300 shadow-md hover:shadow-lg active:scale-95 cursor-pointer inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Try Again
                    </button>
                @endif

            </div>

        </div>
    </section>
</div>