<div>

    
    <section class="bg-[#f8f9fa] py-12" id="shop-error">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">

        <!-- Error Card Container inside the Grid Layout -->
        <div class="bg-white rounded-[10px] p-8 text-center shadow-[0_4px_12px_rgba(0,0,0,0.1)] max-w-md mx-auto my-6">
        
        <!-- Cloud Icon with Error State -->
        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M3 15a4 4 0 004 4h12a4 4 0 001-7.9 5 5 0 00-9.9-1.2A4.5 4.5 0 003 15z">
            </path>
            <!-- Cross Line / Warning slash -->
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 4h.01"></path>
            </svg>
        </div>

        <!-- Error Message -->
        <h3 class="text-lg font-bold text-black mb-1">
            Failed to Load Products
        </h3>
        <p class="text-sm text-gray-500 mb-6">
            We couldn't fetch the products from the server. Please check your network connection and try again.
        </p>

        <!-- Retry / Reload Action Button -->
        <button onclick="window.location.reload()" 
            class="bg-black hover:bg-gray-800 text-white border-none py-2.5 px-6 rounded font-semibold text-sm transition-all duration-300 shadow-md hover:shadow-lg active:scale-95 cursor-pointer inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            Try Again
        </button>

        </div>

    </div>
    </section>


</div>