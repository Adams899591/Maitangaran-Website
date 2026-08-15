<div class="max-w-3xl mx-auto px-4 py-4 md:py-24 text-center">
  <div class="bg-white rounded-2xl shadow-[0_4px_24px_rgba(0,0,0,0.06)] border border-gray-100 p-8 md:p-12">
    
    <!-- Animated Success Check Icon -->
    <div class="flex justify-center mb-6">
      <div class="relative flex items-center justify-center w-20 h-20 bg-emerald-50 rounded-full animate-bounce duration-1000 border border-emerald-100">
        <svg class="w-10 h-10 text-emerald-600 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
        </svg>
      </div>
    </div>

    <!-- Heading & Main Description -->
    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Order Placed Successfully!</h2>
    <p class="text-sm md:text-base text-gray-600 mt-2 max-w-lg mx-auto leading-relaxed">
      Your order has been saved, but processing is on hold until payment is received. Please complete your payment to start your package processing and delivery. You can view your status and make payment from your dashboard.
    </p>

    <!-- Call to Action Buttons -->
    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
      <a 
        href="{{route("shop")}}" 
        wire:navigate
        class="w-full sm:w-auto px-6 py-3 border border-gray-900 text-gray-900 hover:bg-gray-900 hover:text-white font-semibold text-sm rounded-lg transition-colors text-center"
      >
        Continue Shopping
      </a>

      <a 
        href="{{route("order-ladger")}}" 
        wire:navigate
        class="w-full sm:w-auto px-8 py-3.5 bg-black hover:bg-gray-800 text-white font-bold text-sm rounded-lg transition-colors text-center shadow-md"
      >
        Track My Order
      </a>
    </div>

    <!-- Subtle Email Receipt Notice (Light font weight, unbolded) -->
    <div class="mt-10 pt-6 border-t border-gray-50">
      <p class="text-xs text-gray-400 font-light tracking-wide">
        A receipt and order confirmation summary will be sent to your registered e-mail once your payment is successful.
      </p>
    </div>

  </div>
</div>
