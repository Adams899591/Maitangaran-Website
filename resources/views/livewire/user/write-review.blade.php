<div class="max-w-3xl mx-auto px-3 sm:px-4 py-4 sm:py-4 md:py-6">
  
  <!-- Back Button & Header -->
  <div class="mb-4 sm:mb-6">
    <a wire:navigate
      href="{{ route('my-review') }}" 
      class="inline-flex items-center text-[11px] sm:text-xs font-semibold text-gray-500 hover:text-black transition-colors mb-2 sm:mb-4"
    >
      <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
      Back to Pending Reviews
    </a>
    <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">Write a Product Review</h2>
    <p class="text-xs sm:text-sm text-gray-500 mt-0.5 sm:mt-1">Share your honest feedback to help other shoppers make better decisions.</p>
  </div>

  <!-- Review Form Card -->
  <div class="bg-white rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.08)] border border-gray-100 p-4 sm:p-6 md:p-8">
    
    <!-- Error Alert -->
    @if($errorMessage)
      <div class="mb-4 sm:mb-6 p-3 sm:p-4 bg-red-50 border border-red-200 rounded-lg text-[11px] sm:text-xs text-red-700 flex items-start gap-2">
        <svg class="w-4 h-4 shrink-0 text-red-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span>{{ $errorMessage }}</span>
      </div>
    @endif

    <!-- Success Alert -->
    @if($successMessage)
      <div class="mb-4 sm:mb-6 p-3 sm:p-4 bg-emerald-50 border border-emerald-200 rounded-lg text-[11px] sm:text-xs text-emerald-700 flex items-start gap-2">
        <svg class="w-4 h-4 shrink-0 text-emerald-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        <span>{{ $successMessage }}</span>
      </div>
    @endif

    <form wire:submit.prevent="submitReview" class="space-y-4 sm:space-y-6">

      <!-- Product ID Field (Hidden/Read-only display) -->
      {{-- <div>
        <label class="block text-[11px] sm:text-xs font-semibold text-gray-700 mb-1">Product ID</label>
        <input 
          type="text" 
          wire:model="productId" 
          readonly 
          class="w-full px-3 sm:px-4 py-2 sm:py-2.5 bg-gray-100 border border-gray-200 rounded-lg text-[11px] sm:text-xs text-gray-600 cursor-not-allowed font-mono truncate"
        />
        @error('productId') <span class="text-[11px] sm:text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
      </div> --}}

      <!-- Rating (Star Selector) -->
      <div>
        <label class="block text-[11px] sm:text-xs font-semibold text-gray-700 mb-1.5 sm:mb-2">Overall Rating <span class="text-red-500">*</span></label>
        <div class="flex items-center gap-0.5 sm:gap-1">
          @for($i = 1; $i <= 5; $i++)
            <button 
              type="button" 
              wire:click="setRating({{ $i }})"
              class="p-0.5 sm:p-1 text-gray-300 hover:text-amber-400 focus:outline-none transition-colors"
            >
              <svg 
                class="w-6 h-6 sm:w-8 sm:h-8 {{ $i <= $rating ? 'text-amber-400 fill-amber-400' : 'text-gray-200' }}" 
                fill="none" 
                stroke="currentColor" 
                viewBox="0 0 24 24"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
              </svg>
            </button>
          @endfor
          <span class="ml-1.5 sm:ml-2 text-[11px] sm:text-xs font-semibold text-gray-700">({{ $rating }} / 5)</span>
        </div>
        @error('rating') <span class="text-[11px] sm:text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
      </div>

      <!-- Review Comment -->
      <div>
        <label for="comment" class="block text-[11px] sm:text-xs font-semibold text-gray-700 mb-1">Your Review (Optional)</label>
        <textarea 
          id="comment" 
          wire:model="comment" 
          rows="4" 
          maxlength="50"
          placeholder="What did you like or dislike about this product? How was the quality?"
          class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-white border border-gray-200 rounded-lg text-xs sm:text-sm text-gray-800 placeholder-gray-400 focus:border-black focus:ring-0 transition-colors resize-none"
        ></textarea>
        @error('comment') <span class="text-[11px] sm:text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
      </div>

      <!-- Info Note -->
      <div class="p-2.5 sm:p-3 bg-gray-50 border border-gray-200 rounded-lg text-[11px] sm:text-xs text-gray-500 flex items-center gap-2">
        <svg class="w-4 h-4 shrink-0 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>Your purchase will be verified automatically via your paid invoice history.</span>
      </div>

      <!-- Submit Button -->
      <div class="flex items-center justify-end gap-2 sm:gap-3 pt-1 sm:pt-2">
        <a 
          wire:navigate
          href="{{ route('my-review') }}" 
          class="px-4 sm:px-5 py-2 sm:py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-[11px] sm:text-xs font-semibold rounded-lg transition-colors"
        >
          Cancel
        </a>

        <button 
          type="submit" 
          wire:loading.attr="disabled" 
          class="inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-2.5 bg-black hover:bg-gray-800 text-white text-[11px] sm:text-xs font-bold rounded-lg transition-colors disabled:opacity-50 cursor-pointer"
        >
          <svg wire:loading wire:target="submitReview" class="animate-spin -ml-1 mr-2 h-3.5 w-3.5 sm:h-4 sm:w-4 text-white" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          Submit Review
        </button>
      </div>

    </form>
  </div>

</div>