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

    <!-- Cart Page Skeleton Container -->
    <div class="max-w-7xl mx-auto px-4 py-8 md:py-12" id="cart-skeleton">
        
        <!-- Header Skeleton (Title & Subtitle) -->
        <div class="mb-8 text-center flex flex-col items-center">
            <div class="h-8 bg-gray-200 rounded-md w-48 mb-2"></div>
            <div class="h-4 bg-gray-200 rounded-md w-72"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left Column: Cart Table Skeleton (8 Cols) -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.08)] border border-gray-100 overflow-hidden relative">
                    <!-- Shimmer Overlay for Table Card -->
                    <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/70 to-transparent animate-shimmer z-20 pointer-events-none"></div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[600px]">
                            
                            <!-- Table Header Placeholder -->
                            <thead>
                                <tr class="bg-black text-white text-xs uppercase tracking-wider">
                                    <th class="py-4 px-6 font-semibold">Product</th>
                                    <th class="py-4 px-6 font-semibold">Price</th>
                                    <th class="py-4 px-6 font-semibold text-center">Quantity</th>
                                    <th class="py-4 px-6 font-semibold text-right">Subtotal</th>
                                </tr>
                            </thead>

                            <!-- Table Rows Skeleton Placeholder -->
                            <tbody class="divide-y divide-gray-100">
                                @foreach(range(1, 3) as $item)
                                    <tr>
                                        <!-- Product Column -->
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-4">
                                                <div class="w-16 h-16 flex-shrink-0 bg-gray-200 rounded-lg"></div>
                                                <div class="space-y-2">
                                                    <div class="h-4 bg-gray-200 rounded-md w-36"></div>
                                                    <div class="h-3 bg-gray-200 rounded-md w-16"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <!-- Price Column -->
                                        <td class="py-4 px-6">
                                            <div class="h-4 bg-gray-200 rounded-md w-20"></div>
                                        </td>
                                        <!-- Quantity Controls Column -->
                                        <td class="py-4 px-6">
                                            <div class="flex flex-col items-center gap-2">
                                                <div class="w-24 h-8 bg-gray-200 rounded-md"></div>
                                                <div class="w-16 h-5 bg-gray-200 rounded"></div>
                                            </div>
                                        </td>
                                        <!-- Subtotal Column -->
                                        <td class="py-4 px-6 text-right">
                                            <div class="h-4 bg-gray-200 rounded-md w-24 ml-auto"></div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Column: Order Summary Skeleton (4 Cols) -->
            <div class="lg:col-span-4">
                <div class="bg-white p-6 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.08)] border border-gray-100 relative overflow-hidden">
                    <!-- Shimmer Overlay for Summary Card -->
                    <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/70 to-transparent animate-shimmer z-20 pointer-events-none"></div>

                    <!-- Summary Header -->
                    <div class="h-6 bg-gray-200 rounded-md w-36 pb-4 mb-4 border-b border-gray-100"></div>

                    <!-- Line items -->
                    <div class="py-4 space-y-4 border-b border-gray-100">
                        <div class="flex justify-between">
                            <div class="h-4 bg-gray-200 rounded-md w-20"></div>
                            <div class="h-4 bg-gray-200 rounded-md w-8"></div>
                        </div>
                        <div class="flex justify-between">
                            <div class="h-4 bg-gray-200 rounded-md w-20"></div>
                            <div class="h-4 bg-gray-200 rounded-md w-24"></div>
                        </div>
                    </div>

                    <!-- Total Payable -->
                    <div class="flex justify-between items-center py-4 my-2">
                        <div class="h-5 bg-gray-200 rounded-md w-28"></div>
                        <div class="h-6 bg-gray-200 rounded-md w-28"></div>
                    </div>

                    <!-- Checkout Button Skeleton -->
                    <div class="w-full h-12 bg-gray-200 rounded-md mt-2"></div>
                </div>
            </div>

        </div>
    </div>

</div>