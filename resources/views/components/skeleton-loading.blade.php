<div>

    <!-- Custom Shimmer Wave Animation CSS -->
    <style>
    @keyframes shimmer {
        100% {
        transform: translateX(100%);
        }
    }
    .animate-shimmer {
        animation: shimmer 1.8s infinite;
    }
    </style>


    <section class="bg-[#f8f9fa] py-12" id="shop-skeleton">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
        
        <!-- Skeleton Grid matching grid-cols-2 md:grid-cols-4 -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        <!-- Skeleton Card (Repeated 4 times to match layout) -->
        @for ($i = 0; $i < 4; $i++)
            <div>
            <div class="relative bg-white rounded-[10px] overflow-hidden p-3 text-center shadow-[0_4px_12px_rgba(0,0,0,0.1)] animate-pulse">
                
                <!-- White Wave/Shimmer Overlay flowing across the top -->
                <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/70 to-transparent animate-shimmer z-10 pointer-events-none"></div>

                <!-- Image Placeholder (Aspect Square) -->
                <div class="w-full aspect-square bg-gray-200 rounded-md mb-3"></div>

                <!-- Title Line Skeleton -->
                <div class="h-4 sm:h-5 bg-gray-200 rounded w-3/4 mx-auto mt-3 mb-2"></div>

                <!-- Price Line Skeleton -->
                <div class="h-5 sm:h-6 bg-gray-200 rounded w-1/2 mx-auto mb-2"></div>

                <!-- Button Placeholder Skeleton -->
                <div class="h-9 bg-gray-200 rounded w-24 mx-auto mt-2.5"></div>

            </div>
            </div>
        @endfor

        </div>
    </div>
    </section>

</div>