<div class="max-w-2xl mx-auto px-4 py-8 md:py-12">
  <div class="bg-white rounded-2xl shadow-[0_4px_24px_rgba(0,0,0,0.06)] border border-gray-100 p-6 md:p-10">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row items-center gap-5 pb-6 mb-8 border-b border-gray-100 text-center sm:text-left">
      <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center border border-gray-200 shrink-0">
        <svg class="w-8 h-8 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
      </div>
      <div>
        <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Account Profile</h2>
        <p class="text-sm text-gray-500 mt-0.5">Keep your destination and shipping credentials up to date</p>
      </div>
    </div>

    <!-- Profile Update Form -->
    <form wire:submit.prevent="updateProfile" class="space-y-5">
      
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        
        <!-- Full Name -->
        <div>
          <label for="fullname" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Full Name</label>
          <input 
            type="text" 
            id="fullname" 
            wire:model.blur="fullname" 
            placeholder="e.g. John Doe"
            class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
            required
          />
          @error('fullname') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Email Address -->
        <div>
          <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Email Address</label>
          <input 
            type="email" 
            id="email" 
            wire:model.blur="email" 
            placeholder="e.g. john@example.com"
            class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
            required
          />
          @error('email') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        
        <!-- Phone Number -->
        <div>
          <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Phone Number</label>
          <input 
            type="tel" 
            id="phone" 
            wire:model.blur="phone" 
            placeholder="e.g. 08012345678"
            class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
            required
          />
          @error('phone') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- State -->
        <div>
          <label for="state" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">State</label>
          <select 
            id="state" 
            wire:model.blur="state" 
            class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
            required
          >
            <option value="">Select State</option>
            <option value="Lagos">Lagos</option>
            <option value="Abuja">Abuja (FCT)</option>
            <option value="Rivers">Rivers</option>
            <option value="Oyo">Oyo</option>
            <option value="Imo">Imo</option>
          </select>
          @error('state') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

      </div>

      <!-- Delivery Address -->
      <div>
        <label for="address" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Delivery Address</label>
        <input 
          type="text" 
          id="address" 
          wire:model.blur="address" 
          placeholder="e.g. 15 Admiralty Way"
          class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
          required
        />
        @error('address') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        
        <!-- Suite / Apartment -->
        <div>
          <label for="suite" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Suite / Apartment (Optional)</label>
          <input 
            type="text" 
            id="suite" 
            wire:model.blur="suite" 
            placeholder="e.g. Apt 4B, Floor 2"
            class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
          />
          @error('suite') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Preferred Hub -->
        <div>
          <label for="hub" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Preferred Hub</label>
          <select 
            id="hub" 
            wire:model.blur="hub" 
            class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
            required
          >
            <option value="">Select Preferred Hub</option>
            <option value="Lekki Phase 1 Hub">Lekki Phase 1 Hub</option>
            <option value="Ikeja City Hub">Ikeja City Hub</option>
            <option value="Wuse Zone 4 Hub">Wuse Zone 4 Hub</option>
            <option value="Port Harcourt Hub">Port Harcourt Hub</option>
          </select>
          @error('hub') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

      </div>

      <!-- Submit / Save Changes Button -->
      <div class="pt-4">
        <button 
          type="submit" 
          wire:loading.attr="disabled"
          wire:target="updateProfile"
          class="w-full py-3.5 bg-black hover:bg-gray-800 text-white font-bold text-sm rounded-lg transition-colors cursor-pointer text-center shadow-md disabled:opacity-50"
        >
          <span wire:loading.remove wire:target="updateProfile">Save Changes</span>
          <span wire:loading wire:target="updateProfile">Saving Changes...</span>
        </button>
      </div>

    </form>

  </div>
</div>
