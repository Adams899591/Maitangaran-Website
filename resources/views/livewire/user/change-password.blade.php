<div class="max-w-xl mx-auto px-4 py-4 md:py-6">

  <div class="bg-white rounded-2xl shadow-[0_4px_24px_rgba(0,0,0,0.06)] border border-gray-100 p-6 md:p-10">
      
      <!-- Flash Messages -->
      @if (session()->has('success'))
          <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 text-sm rounded-lg flex items-center space-x-2">
              <span>{{ session('success') }}</span>
          </div>
      @endif

      @if (session()->has('error'))
          <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-700 text-sm rounded-lg flex items-center space-x-2">
              <span>{{ session('error') }}</span>
          </div>
      @endif

      <!-- Header Section -->
      <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-50 rounded-full mb-4 border border-gray-100">
          <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
          </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Change Password</h2>
        <p class="text-sm text-gray-500 mt-1">Ensure your account stays secure by using a strong password</p>
      </div>

      <!-- Change Password Form -->
      <form wire:submit.prevent="updatePassword" class="space-y-5">
        
        <!-- Current Password -->
        <div>
          <label for="current_password" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Current Password</label>
          <input 
            type="password" 
            id="current_password" 
            wire:model.blur="current_password" 
            placeholder="Enter current password"
            class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
            required
          />
          @error('current_password') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- New Password -->
        <div>
          <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">New Password</label>
          <input 
            type="password" 
            id="password" 
            wire:model.blur="password" 
            placeholder="Enter new password"
            class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
            required
          />
          @error('password') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Confirm Password -->
        <div>
          <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Confirm New Password</label>
          <input 
            type="password" 
            id="password_confirmation" 
            wire:model.blur="password_confirmation" 
            placeholder="Re-enter new password"
            class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
            required
          />
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
          <button 
            type="submit" 
            wire:loading.attr="disabled"
            wire:target="updatePassword"
            class="w-full py-3.5 bg-black hover:bg-gray-800 text-white font-bold text-sm rounded-lg transition-colors cursor-pointer text-center shadow-md disabled:opacity-50"
          >
            <span wire:loading.remove wire:target="updatePassword">Update Password</span>
            <span wire:loading wire:target="updatePassword">Updating Password...</span>
          </button>
        </div>

      </form>
  </div>

</div>
