 
<div>

        <!-- Navbar / Header spacing if needed -->
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Image Section with rigid container dimensions to prevent layout shifting -->
                <div class="bg-white rounded-xl shadow-lg p-6 h-full flex flex-col justify-between">
                    <!-- Rigid main image container with dynamic background fill to eliminate letterboxing/white edges -->
                    <div class="product-image mb-4 w-full h-[400px] bg-gray-900 rounded-lg overflow-hidden flex items-center justify-center relative">
                        <!-- Blurred duplicate background layer to smoothly fill container gaps for uneven images -->
                        <div class="absolute inset-0 filter blur-xl opacity-40 scale-110 overflow-hidden pointer-events-none flex items-center justify-center">
                            <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff" alt="" class="w-full h-full object-cover" id="bg-blur-image">
                        </div>
                        <!-- Main Product Image cleanly contained without white side/top/bottom bars -->
                        <img 
                            src="https://images.unsplash.com/photo-1542291026-7eec264c27ff" 
                            alt="Product Image" 
                            class="relative z-10 w-full h-full object-contain rounded-lg shadow-md" 
                            id="main-image"
                        >
                    </div>  
               
                    <!-- Thumbnails with uniform container sizing -->
                    <div class="mt-4 flex flex-wrap justify-between gap-2">
                        <div class="w-[22%] h-20 bg-gray-900 rounded-md overflow-hidden flex items-center justify-center relative">
                            <img src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=600&auto=format&fit=crop" alt="Thumb 1" class="thumbnail-img w-full h-full object-cover cursor-pointer shadow-sm hover:scale-105 hover:shadow-gray-400/50 transition-all duration-200">
                            {{-- <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff" alt="Thumb 1" class="thumbnail-img w-full h-full object-cover cursor-pointer shadow-sm hover:scale-105 hover:shadow-gray-400/50 transition-all duration-200"> --}}
                        </div>
                        <div class="w-[22%] h-20 bg-gray-900 rounded-md overflow-hidden flex items-center justify-center relative">
                            <img src="https://images.unsplash.com/photo-1515955656352-a1fa3ffcd111" alt="Thumb 2" class="thumbnail-img w-full h-full object-cover cursor-pointer shadow-sm hover:scale-105 hover:shadow-gray-400/50 transition-all duration-200">
                        </div>
                        <div class="w-[22%] h-20 bg-gray-900 rounded-md overflow-hidden flex items-center justify-center relative">
                            <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30" alt="Thumb 3" class="thumbnail-img w-full h-full object-cover cursor-pointer shadow-sm hover:scale-105 hover:shadow-gray-400/50 transition-all duration-200">
                        </div>
                        <div class="w-[22%] h-20 bg-gray-900 rounded-md overflow-hidden flex items-center justify-center relative">
                            <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e" alt="Thumb 4" class="thumbnail-img w-full h-full object-cover cursor-pointer shadow-sm hover:scale-105 hover:shadow-gray-400/50 transition-all duration-200">
                        </div>
                    </div>
                </div>  

                <!-- Add to Cart Section -->
                <div>  
                    <div class="bg-white rounded-xl shadow-lg p-6 h-full flex flex-col justify-between">  
                        <div>
                            <!-- Product Title -->
                            <h1 class="text-3xl font-semibold text-gray-900 mb-2">Designer Men Sneakers</h1>  
                            
                            <!-- Price -->
                            <div class="flex items-center gap-2 my-2 text-black text-2xl font-medium"> 
                                <span class="font-bold">₦ 42,500</span> 
                            </div>  

                            <!-- Stock / Availability Badge -->
                            <div class="mb-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <span class="w-2 h-2 mr-1.5 bg-green-500 rounded-full"></span>
                                    15 items left in stock
                                </span>
                            </div>

                            <!-- Description -->
                            <div class="text-gray-600 font-bold text-base leading-relaxed mb-6">  
                                Elevate your everyday style with these premium designer sneakers, meticulously crafted for maximum comfort, durability, and a sleek contemporary look. Perfect for any casual occasion.
                            </div>  
                        </div>

                        <!-- Livewire Form Action (Static simulation) -->
                        <form wire:submit.prevent="addToCart" class="space-y-6">
                            <!-- Quantity Box -->  
                            <div class="flex items-center gap-2 mb-4">  
                                <button type="button" onclick="adjustQty(-1)" class="bg-slate-700 hover:bg-slate-800 text-white border-none px-3 py-1.5 rounded text-base transition-colors">-</button>  
                                <input type="number" id="qtyInput" value="1" min="1" class="w-16 text-center border border-gray-300 rounded-md py-1.5 focus:outline-none focus:ring-2 focus:ring-slate-700" />  
                                <button type="button" onclick="adjustQty(1)" class="bg-slate-700 hover:bg-slate-800 text-white border-none px-3 py-1.5 rounded text-base transition-colors">+</button>  
                            </div>

                            <!-- Add to Cart Button -->
                            <button type="submit" class="w-full bg-slate-700 hover:bg-slate-800 text-white border-none py-3 px-6 rounded-lg font-semibold text-base transition-all duration-200 shadow-md">
                                Add to Cart
                            </button> 
                        </form>
                    </div>  
                </div>

            </div>  
        </div>  
    </div>  

    <x-skeleton-loading2 />



    <!-- JavaScript for Changing Main Image and Blurred Background Filler -->
    <script>
        const mainImage = document.getElementById("main-image");
        const bgBlurImage = document.getElementById("bg-blur-image");
        const thumbnailImgs = document.getElementsByClassName("thumbnail-img");
        
        for (let index = 0; index < thumbnailImgs.length; index++) {
            thumbnailImgs[index].onclick = function () {
                mainImage.src = thumbnailImgs[index].src;
                bgBlurImage.src = thumbnailImgs[index].src;
            }
        }
    </script>

    <!-- JavaScript for Quantity Adjustment -->
    <script>  
        function adjustQty(change) {  
            const input = document.getElementById('qtyInput');  
            let current = parseInt(input.value);  
            if (!isNaN(current)) {  
                current = Math.max(1, current + change);  
                input.value = current;  
            }  
        }  
    </script>


 
   

</div>
