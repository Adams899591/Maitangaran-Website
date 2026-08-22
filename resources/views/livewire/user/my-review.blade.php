<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    
    <!-- LEFT CARD: Pending Review -->
    <a href="{{route("pending-review")}}" class="relative flex flex-col p-6 rounded-xl border-2 border-gray-200 hover:border-black transition-all bg-white group cursor-pointer" wire:navigate>
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-800 group-hover:bg-black group-hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <span class="inline-flex items-center gap-1 text-[11px] font-bold text-amber-700 bg-amber-50 px-2.5 py-1 rounded-full border border-amber-200">
                Pending Review
            </span>
        </div>

        <span class="text-base font-bold text-gray-900 mb-1 group-hover:text-black">Pending Reviews</span>
        <span class="text-xs text-gray-500 leading-relaxed mb-4">Share your feedback on items you recently purchased and received.</span>
        
        <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between text-xs font-bold text-black group-hover:underline">
            <span>View Pending Items</span>
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
        </div>
    </a>

    <!-- RIGHT CARD: Completed Reviews -->
    <a href="{{route("completed-review")}}" class="relative flex flex-col p-6 rounded-xl border-2 border-gray-200 hover:border-black transition-all bg-white group cursor-pointer"   wire:navigate>
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-800 group-hover:bg-black group-hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">
                Reviewed
            </span>
        </div>

        <span class="text-base font-bold text-gray-900 mb-1 group-hover:text-black">My Reviews</span>
        <span class="text-xs text-gray-500 leading-relaxed mb-4">View, edit, or check ratings on all the products you have reviewed.</span>
        
        <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between text-xs font-bold text-black group-hover:underline">
            <span>View History</span>
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
        </div>
    </a>

</div>