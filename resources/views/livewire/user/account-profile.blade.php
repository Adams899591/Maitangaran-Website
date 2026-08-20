<div class="max-w-2xl mx-auto px-4 py-4 md:py-8">
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

        <!-- Username -->
        <div>
          <label for="username" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Username</label>
          <input 
            type="username" 
            id="username" 
            wire:model.blur="username" 
            {{-- placeholder="e.g. john@example.com" --}}
            class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
            required
          />
          @error('username') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
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

        <!-- Email -->
        <div>
          <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">STATE</label>
          <input 
            type="email" 
            id="email" 
            wire:model.blur="email" 
            {{-- placeholder="e.g. 0" --}}
            class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
            required
          />
          @error('email') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
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
        
        <!-- State -->
        <div>
          <label for="state" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">STATE</label>
          <input 
            type="text" 
            id="state" 
            wire:model.blur="state" 
            {{-- placeholder="e.g. 0" --}}
            class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
          />
          @error('state') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Preferred PrefferedAddress -->
        <div>
          <label for="PrefferedAddress" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Preferred Hu</label>
          <input 
            type="text" 
            id="PrefferedAddress" 
            wire:model.blur="PrefferedAddress" 
            {{-- placeholder="e.g. 0" --}}
            class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
          />
          @error('PrefferedAddress') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

      </div>



      <!-- Success Message Session Check -->
@if (session('success'))
  <div class="mb-4 flex items-center rounded-lg bg-emerald-50 p-4 text-emerald-800 border border-emerald-200" role="alert">
    <svg class="mr-3 h-5 w-5 flex-shrink-0 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
    </svg>
    <div class="text-sm font-medium">
      {{ session('success') }}
    </div>
  </div>
@endif

<!-- Error Message Session Check (Optional) -->
@if (session('error'))
  <div class="mb-4 flex items-center rounded-lg bg-rose-50 p-4 text-rose-800 border border-rose-200" role="alert">
    <svg class="mr-3 h-5 w-5 flex-shrink-0 text-rose-500" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
    </svg>
    <div class="text-sm font-medium">
      {{ session('error') }}
    </div>
  </div>
@endif

<!-- Save Changes Button -->
{{-- <button type="submit" class="...">Save Changes</button> --}}







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
