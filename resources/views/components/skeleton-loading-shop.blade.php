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

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #000;
        }
    </style>

    <!-- Shop Page Skeleton Container -->
    <div class="max-w-7xl mx-auto px-4 py-8 relative" id="shop-skeleton">

        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

            <!-- ==================== SIDEBAR FILTER SKELETON ==================== -->
            <div class="md:col-span-3">
                <div class="bg-white p-6 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.08)] border border-gray-100 mb-6 relative overflow-hidden">
                    
                    <!-- Shimmer Overlay for Sidebar -->
                    <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/70 to-transparent animate-shimmer z-20 pointer-events-none"></div>

                    <!-- Title Placeholder -->
                    <div class="h-6 bg-gray-200 rounded-md w-36 mb-6"></div>

                    <!-- Category Heading & Input Placeholder -->
                    <div class="h-4 bg-gray-200 rounded-md w-20 mb-3"></div>
                    <div class="w-full h-10 bg-gray-200 rounded-lg mb-4"></div>

                    <!-- Categories Scroll List Placeholder -->
                    <div class="space-y-3 mb-4 border-b border-gray-100 pb-4">
                        @foreach(range(1, 6) as $cat)
                            <div class="flex items-center gap-3">
                                <div class="w-4 h-4 rounded-full bg-gray-200 flex-shrink-0"></div>
                                <div class="h-4 bg-gray-200 rounded-md w-24"></div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Price Slider Heading & Range Placeholder -->
                    <div class="h-4 bg-gray-200 rounded-md w-16 mt-4 mb-3"></div>
                    <div class="w-full h-3 bg-gray-200 rounded-lg mb-2"></div>
                    <div class="flex justify-between items-center mt-2">
                        <div class="h-3 bg-gray-200 rounded-md w-10"></div>
                        <div class="h-4 bg-gray-200 rounded-md w-14"></div>
                        <div class="h-3 bg-gray-200 rounded-md w-12"></div>
                    </div>

                    <!-- Search Button Placeholder -->
                    <div class="w-full h-10 bg-gray-200 rounded-md mt-6"></div>
                </div>
            </div>


            <!-- ==================== MAIN PRODUCTS SECTION SKELETON ==================== -->
            <div class="md:col-span-9">
                
                <!-- Section Header Placeholder -->
                <div class="mb-6">
                    <div class="h-8 bg-gray-200 rounded-md w-48 mb-2"></div>
                    <div class="h-4 bg-gray-200 rounded-md w-64"></div>
                </div>

                <!-- Products Grid Skeleton -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                    
                    @foreach(range(1, 4) as $product)
                        <div class="bg-white rounded-[10px] p-3 shadow-[0_4px_12px_rgba(0,0,0,0.08)] border border-gray-100 h-full flex flex-col justify-between relative overflow-hidden">
                            
                            <!-- Shimmer Overlay for Product Card -->
                            <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/70 to-transparent animate-shimmer z-20 pointer-events-none"></div>

                            <div>
                                <!-- Image Placeholder -->
                                <div class="w-full aspect-square bg-gray-200 rounded-md mb-3"></div>
                                
                                <!-- Product Title Placeholder -->
                                <div class="h-4 bg-gray-200 rounded-md w-5/6 mx-auto mb-3"></div>
                                
                                <!-- Product Price Placeholder -->
                                <div class="h-5 bg-gray-200 rounded-md w-1/2 mx-auto mb-3"></div>
                            </div>

                            <!-- Buy Button Placeholder -->
                            <div class="w-full h-9 bg-gray-200 rounded mt-2"></div>
                        </div>
                    @endforeach

                </div>

                <!-- Pagination Skeleton Placeholder -->
                <div class="flex justify-center mt-8 gap-2">
                    <div class="w-8 h-8 bg-gray-200 rounded-md"></div>
                    <div class="w-8 h-8 bg-gray-200 rounded-md"></div>
                    <div class="w-8 h-8 bg-gray-200 rounded-md"></div>
                </div>

            </div>

        </div>
    </div>

</div>