<div>
    
     <!-- Discover Luxury, Style & Quality Section -->
    <section>

        <!-- Add keyframe animation inline so it moves immediately -->
        <style>
        @keyframes marquee {
            0% { transform: translateX(0%); }
            100% { transform: translateX(-50%); }
        }
        .animate-marquee-smooth {
            display: flex;
            width: max-content;
            animation: marquee 25s linear infinite;
        }
        .animate-marquee-smooth:hover {
            animation-play-state: paused; /* Pauses smoothly when user hovers */
        }
        </style>

        <!-- Sleek Infinite Marquee Ticker with Icons -->
        <div class="bg-gray-900 border-b border-gray-800 text-gray-200 py-3 text-xs sm:text-sm font-semibold tracking-wider uppercase overflow-hidden select-none">
        <div class="flex whitespace-nowrap animate-marquee-smooth">
            
            <!-- First Pass -->
            <div class="flex items-center space-x-6 shrink-0">
            <span class="flex items-center gap-2 text-amber-400 font-bold">
                <i class="fas fa-store text-base"></i> Welcome to Cartévo
            </span>
            <span class="text-gray-600 text-xs">◆</span>
            <span class="flex items-center gap-2">
                <i class="fas fa-[#D4AF37] fa-tshirt text-amber-400"></i> Quality Fashion & Footwear
            </span>
            <span class="text-gray-600 text-xs">◆</span>
            <span class="flex items-center gap-2">
                <i class="fas fa-mobile-alt text-amber-400"></i> Everyday Electronics
            </span>
            <span class="text-gray-600 text-xs">◆</span>
            <span class="flex items-center gap-2 text-amber-400 font-bold">
                <i class="fas fa-tags"></i> Unbeatable Prices
            </span>
            <span class="text-gray-600 text-xs">◆</span>
            <span class="flex items-center gap-2">
                <i class="fas fa-shipping-fast text-amber-400"></i> Fast Nationwide Delivery
            </span>
            <span class="text-gray-600 text-xs">◆</span>
            <span class="flex items-center gap-2 pr-6">
                <i class="fas fa-crown text-amber-400"></i> Where Convenience Meets Class 🔥
            </span>
            </div>

            <!-- Duplicate Pass (Ensures continuous seamless looping) -->
            <div class="flex items-center space-x-6 shrink-0" aria-hidden="true">
            <span class="flex items-center gap-2 text-amber-400 font-bold">
                <i class="fas fa-store text-base"></i> Welcome to Cartévo
            </span>
            <span class="text-gray-600 text-xs">◆</span>
            <span class="flex items-center gap-2">
                <i class="fas fa-[#D4AF37] fa-tshirt text-amber-400"></i> Quality Fashion & Footwear
            </span>
            <span class="text-gray-600 text-xs">◆</span>
            <span class="flex items-center gap-2">
                <i class="fas fa-mobile-alt text-amber-400"></i> Everyday Electronics
            </span>
            <span class="text-gray-600 text-xs">◆</span>
            <span class="flex items-center gap-2 text-amber-400 font-bold">
                <i class="fas fa-tags"></i> Unbeatable Prices
            </span>
            <span class="text-gray-600 text-xs">◆</span>
            <span class="flex items-center gap-2">
                <i class="fas fa-shipping-fast text-amber-400"></i> Fast Nationwide Delivery
            </span>
            <span class="text-gray-600 text-xs">◆</span>
            <span class="flex items-center gap-2 pr-6">
                <i class="fas fa-crown text-amber-400"></i> Where Convenience Meets Class 🔥
            </span>
            </div>

        </div>
        </div>

        <!-- Hero Section -->
        <div class="py-[60px] px-5 text-center bg-gradient-to-r from-gray-100 to-gray-200">
            <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl sm:text-4xl font-bold text-black mb-3.5">
                Discover Luxury, Style & Quality
            </h1>
            <p class="text-base sm:text-lg text-gray-600 mb-6">
                Explore our finest collection of bags, shoes, watches, and fashion accessories tailored just for you.
            </p>
            <a href="#shop">
                <button class="bg-black hover:bg-gray-800 text-white px-6 py-3 border-none rounded-full font-semibold transition-colors duration-300 cursor-pointer shadow-md">
                Shop Now
                </button>
            </a>
            </div>
        </div>
    </section>

</div>
