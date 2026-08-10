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

    <!-- Single Product Page Skeleton Container -->
    <div class="bg-gray-50 min-h-screen py-12" id="product-skeleton">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Left Column: Image Gallery Skeleton -->
                <div class="bg-white rounded-xl shadow-lg p-6 h-full flex flex-col justify-between relative overflow-hidden">
                    <!-- Shimmer Overlay for Card -->
                    <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/70 to-transparent animate-shimmer z-20 pointer-events-none"></div>

                    <div>
                        <!-- Main Image Placeholder (400px height) -->
                        <div class="w-full h-[400px] bg-gray-200 rounded-lg mb-4"></div>
                        
                        <!-- Thumbnails Placeholder (4 blocks at 22% width, 80px height) -->
                        <div class="mt-4 flex flex-wrap justify-between gap-2">
                            <div class="w-[22%] h-20 bg-gray-200 rounded-md"></div>
                            <div class="w-[22%] h-20 bg-gray-200 rounded-md"></div>
                            <div class="w-[22%] h-20 bg-gray-200 rounded-md"></div>
                            <div class="w-[22%] h-20 bg-gray-200 rounded-md"></div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Product Details Skeleton -->
                <div>  
                    <div class="bg-white rounded-xl shadow-lg p-6 h-full flex flex-col justify-between relative overflow-hidden">  
                        <!-- Shimmer Overlay for Card -->
                        <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/70 to-transparent animate-shimmer z-20 pointer-events-none"></div>

                        <div>
                            <!-- Title Placeholder -->
                            <div class="h-8 bg-gray-200 rounded-md w-3/4 mb-4"></div>  
                            
                            <!-- Price Placeholder -->
                            <div class="h-7 bg-gray-200 rounded-md w-1/3 my-3"></div>  

                            <!-- Stock Badge Placeholder -->
                            <div class="h-6 bg-gray-200 rounded-full w-36 mb-6"></div>

                            <!-- Description Line Placeholders -->
                            <div class="space-y-2 mb-6">
                                <div class="h-4 bg-gray-200 rounded w-full"></div>
                                <div class="h-4 bg-gray-200 rounded w-full"></div>
                                <div class="h-4 bg-gray-200 rounded w-4/5"></div>
                            </div>  
                        </div>

                        <!-- Quantity Input & Button Area -->
                        <div class="space-y-6 pt-4">
                            <!-- Quantity Controls Skeleton -->
                            <div class="flex items-center gap-2 mb-4">  
                                <div class="w-8 h-8 bg-gray-200 rounded"></div>  
                                <div class="w-16 h-8 bg-gray-200 rounded-md"></div>  
                                <div class="w-8 h-8 bg-gray-200 rounded"></div>  
                            </div>

                            <!-- Add to Cart Button Skeleton -->
                            <div class="w-full h-12 bg-gray-200 rounded-lg"></div> 
                        </div>
                    </div>  
                </div>

            </div>  
        </div>  
    </div>

</div>