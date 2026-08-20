<div class="max-w-xl mx-auto px-4 py-8 md:py-12" x-data="{ fullname: '', username: '', email: '', phone: '', address: '', password: '', password_confirmation: '' }">
  <div class="bg-white rounded-2xl shadow-[0_4px_24px_rgba(0,0,0,0.06)] border border-gray-100 p-8 md:p-10">
    
    <!-- Header Section -->
    <div class="text-center mb-8">
      <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-50 rounded-full mb-4 border border-gray-100">
        <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
        </svg>
      </div>
      <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Create an Account</h2>
      <p class="text-sm text-gray-500 mt-1">Please fill in your details to get started</p>
    </div>

    <!-- Flash Banner for Error / General Message -->
    @if (session()->has('error'))
      <div class="mb-6 p-4 rounded-xl border border-red-200 bg-red-50 text-red-800 text-sm">
        {{ session('error') }}
      </div>
    @endif

    <!-- Register Form -->
    <form wire:submit.prevent="register" class="space-y-5">
      
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        
        <!-- Full Name -->
        <div>
          <label for="fullname" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Full Name</label>
          <input 
            type="text" 
            id="fullname" 
            wire:model.live="fullname" 
            x-model="fullname"
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
            type="text" 
            id="username" 
            wire:model.live="username" 
            x-model="username"
            placeholder="e.g. johndoe"
            class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
            required
          />
          @error('username') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        
        <!-- Email Address -->
        <div>
          <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Email Address</label>
          <input 
            type="email" 
            id="email" 
            wire:model.live="email" 
            x-model="email"
            placeholder="e.g. john@example.com"
            class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
            required
          />
          @error('email') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Phone Number -->
        <div>
          <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Phone Number</label>
          <input 
            type="tel" 
            id="phone" 
            wire:model.live="phone" 
            x-model="phone"
            placeholder="e.g. 08012345678"
            class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
            required
          />
          @error('phone') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

      </div>

      <!-- Delivery Address -->
      <div>
        <label for="address" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Delivery Address</label>
        <input 
          type="text" 
          id="address" 
          wire:model.live="address" 
          x-model="address"
          placeholder="Enter your detailed street address"
          class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
          required
        />
        @error('address') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        
        <!-- Password -->
        <div>
          <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Password</label>
          <input 
            type="password" 
            id="password" 
            wire:model.live="password" 
            x-model="password"
            placeholder="Create a password"
            class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
            required
          />
          @error('password') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Confirm Password -->
        <div>
          <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Confirm Password</label>
          <input 
            type="password" 
            id="password_confirmation" 
            wire:model.live="password_confirmation" 
            x-model="password_confirmation"
            placeholder="Re-enter password"
            class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
            required
          />
        </div>

      </div>

      <!-- Password Mismatch Feedback -->
      <template x-if="password !== '' && password_confirmation !== '' && password !== password_confirmation">
        <span class="text-xs text-red-600 font-semibold block">Passwords do not match</span>
      </template>

      <!-- Submit Button -->
      <button 
        type="submit" 
        :disabled="!fullname || !username || !email || !phone || !address || !password || !password_confirmation || (password !== password_confirmation)"
        wire:loading.attr="disabled"
        wire:target="register"
        class="w-full mt-4 py-3.5 bg-black hover:bg-gray-800 text-white font-bold text-sm rounded-lg transition-colors cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed text-center shadow-md flex justify-center items-center gap-2"
      >
        <span wire:loading.remove wire:target="register">Create Account</span>
        <span wire:loading wire:target="register" class="inline-flex items-center gap-2">
          <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          Creating Account...
        </span>
      </button>

    </form>

    <!-- Footer Login Link -->
    <div class="mt-8 text-center border-t border-gray-50 pt-6">
      <p class="text-xs text-gray-500 font-light">
        Already have an account? 
        <a href="{{ route('login') }}" wire:navigate class="font-semibold text-black hover:underline ml-1">Sign in here</a>
      </p>
    </div>

  </div>
</div>