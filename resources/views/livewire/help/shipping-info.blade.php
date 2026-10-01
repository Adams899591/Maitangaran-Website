<div class="max-w-4xl mx-auto my-10 px-4">
  
  <!-- Page Header -->
  <div class="text-center mb-8 space-y-4">
    <span class="bg-black/5 text-gray-700 text-[11px] font-bold uppercase px-3 py-1 rounded-full inline-block tracking-wider border border-gray-300">
      Shipping Information
    </span>
    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-black">
      Shipping & Delivery Policy
    </h1>
    <p class="text-gray-500 text-sm">
      Last updated: October 1, 2026
    </p>
  </div>

  <!-- Shipping Policy Content Container -->
  <section class="bg-gray-100 text-gray-800 py-8 px-6 sm:px-10 rounded-2xl border border-gray-200 space-y-8 shadow-sm">
    
    <!-- Processing Times -->
    <div>
      <h2 class="text-xl font-bold text-black flex items-center gap-2 mb-3">
        <i class="fas fa-box text-gray-600 text-lg"></i>
        1. Order Processing Times
      </h2>
      <p class="text-gray-600 text-sm leading-relaxed">
        All orders are processed within <strong>1 to 2 business days</strong> (excluding weekends and holidays) after receiving your order confirmation email. You will receive another notification when your order has shipped. Please note that during high-volume periods or flash sales, processing times may be slightly delayed.
      </p>
    </div>

    <!-- Shipping Rates & Estimates -->
    <div>
      <h2 class="text-xl font-bold text-black flex items-center gap-2 mb-3">
        <i class="fas fa-truck text-gray-600 text-lg"></i>
        2. Shipping Rates & Delivery Estimates
      </h2>
      <p class="text-gray-600 text-sm leading-relaxed mb-3">
        Shipping charges for your order will be calculated and displayed at checkout. We offer the following delivery options:
      </p>
      <div class="overflow-x-auto mt-4">
        <table class="w-full text-sm text-left text-gray-600 border-collapse">
          <thead class="text-xs text-gray-700 uppercase bg-gray-200/50 rounded-t-lg">
            <tr>
              <th scope="col" class="px-4 py-3 rounded-tl-lg font-bold text-black">Shipping Method</th>
              <th scope="col" class="px-4 py-3 font-bold text-black">Estimated Delivery Time</th>
              <th scope="col" class="px-4 py-3 rounded-tr-lg font-bold text-black">Cost</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            <tr class="bg-white/30">
              <td class="px-4 py-3 font-medium text-gray-900">Standard Shipping</td>
              <td class="px-4 py-3">3-5 Business Days</td>
              <td class="px-4 py-3">Calculated at checkout</td>
            </tr>
            <tr class="bg-white/30">
              <td class="px-4 py-3 font-medium text-gray-900">Priority Express</td>
              <td class="px-4 py-3">1-2 Business Days</td>
              <td class="px-4 py-3">Calculated at checkout</td>
            </tr>
            <tr class="bg-white/30">
              <td class="px-4 py-3 font-medium text-gray-900">Same-Day Delivery</td>
              <td class="px-4 py-3">Order by 12 PM (Local Area Only)</td>
              <td class="px-4 py-3">Calculated at checkout</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Live Order Tracking -->
    {{-- <div>
      <h2 class="text-xl font-bold text-black flex items-center gap-2 mb-3">
        <i class="fas fa-map-marked-alt text-gray-600 text-lg"></i>
        3. Live Order Tracking
      </h2>
      <p class="text-gray-600 text-sm leading-relaxed">
        When your order has shipped, you will receive a notification containing your tracking number. For the best experience, use the <strong>Maitangaran Mobile App</strong> to access our exclusive <strong>Live Order Tracking</strong> feature. This allows you to view the real-time status and exact location of your package from dispatch to your doorstep.
      </p>
    </div> --}}

    <!-- Missing or Damaged Packages -->
    <div>
      <h2 class="text-xl font-bold text-black flex items-center gap-2 mb-3">
        <i class="fas fa-exclamation-triangle text-gray-600 text-lg"></i>
        3. Missing or Damaged Packages
      </h2>
      <p class="text-gray-600 text-sm leading-relaxed">
        In the rare event that your order arrives damaged in any way, or if your tracking shows as delivered but you have not received it, please contact us as soon as possible within 48 hours of delivery. Include your order number and a photo of the item's condition (if applicable).
      </p>
    </div>

    <!-- Contact Info -->
    <div class="bg-white/60 p-5 rounded-xl border border-gray-200 mt-6">
      <h2 class="text-lg font-bold text-black flex items-center gap-2 mb-2">
        <i class="fas fa-headset text-gray-600"></i>
        5. Delivery Support
      </h2>
      <p class="text-gray-600 text-sm leading-relaxed mb-3">
        Have a question about your shipment? Our team is ready to help:
      </p>
      <div class="text-sm font-semibold text-gray-800 space-y-1">
        <p>Email: <a href="mailto:mtextile70@yahoo.com" class="text-blue-600 hover:underline">mtextile70@yahoo.com</a></p>
        {{-- <p>App Support: Access 24/7 Priority Support directly in the Maitangaran App.</p> --}}
      </div>
    </div>

  </section>
  
  <!-- Back Button -->
  <div class="mt-8 text-center">
    <a href="{{route("home")}}" class="inline-flex items-center text-sm font-bold text-gray-600 hover:text-black transition-colors" wire:navigate>
      <i class="fas fa-arrow-left mr-2"></i>
      Return to Home
    </a>
  </div>

</div>
