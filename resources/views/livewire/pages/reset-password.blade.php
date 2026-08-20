<div class="max-w-md mx-auto px-4 py-8 md:py-12" x-data="{ password: '', password_confirmation: '' }">
  <div class="bg-white rounded-2xl shadow-[0_4px_24px_rgba(0,0,0,0.06)] border border-gray-100 p-8 md:p-10">
    
    <!-- Header Section -->
    <div class="text-center mb-8">
      <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-50 rounded-full mb-4 border border-gray-100">
        <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
        </svg>
      </div>
      <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Set New Password</h2>
      <p class="text-sm text-gray-500 mt-1">Please enter your new password below to secure your account</p>
    </div>

    <!-- Status Message Alert -->
    @if (session('status'))
      <div class="mb-5 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-xs text-emerald-800">
        {{ session('status') }}
      </div>
    @endif

    <!-- Reset Password Form -->
    {{-- <form wire:submit.prevent="resetPassword" class="space-y-5">
      
      <!-- Hidden Token Input (or bound via Livewire) -->
      <input type="hidden" wire:model="token">

      <!-- New Password -->
      <div>
        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">New Password</label>
        <input 
          type="password" 
          id="password" 
          wire:model.blur="password" 
          x-model="password"
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
          x-model="password_confirmation"
          placeholder="Re-enter new password"
          class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
          required
        />
        @error('password_confirmation') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
      </div>

      <!-- Submit Button -->
      <button 
        type="submit" 
        :disabled="!password || !password_confirmation || password !== password_confirmation"
        wire:loading.attr="disabled"
        wire:target="resetPassword"
        class="w-full mt-2 py-3.5 bg-black hover:bg-gray-800 text-white font-bold text-sm rounded-lg transition-colors cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed text-center shadow-md"
      >
        <span wire:loading.remove wire:target="resetPassword">Reset Password</span>
        <span wire:loading wire:target="resetPassword">Updating password...</span>
      </button>

    </form> --}}
    <form wire:submit.prevent="resetPassword" class="space-y-5">

    <!-- Success Alert -->
    @if ($successMessage)
        <div class="p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-xs text-emerald-800">
        {{ $successMessage }}
        <div class="mt-2">
            <a href="{{ route('login') }}" wire:navigate class="font-bold underline">Click here to Sign In</a>
        </div>
        </div>
    @endif

    <!-- Error Alert -->
    @if ($errorMessage)
        <div class="p-4 rounded-lg bg-red-50 border border-red-200 text-xs text-red-800">
        {{ $errorMessage }}
        </div>
    @endif
    
    <!-- Hidden Token Input -->
    <input type="hidden" wire:model="token">

    <!-- New Password -->
    <div>
        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">New Password</label>
        <input 
        type="password" 
        id="password" 
        wire:model.blur="password" 
        x-model="password"
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
        x-model="password_confirmation"
        placeholder="Re-enter new password"
        class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
        required
        />
        @error('password_confirmation') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <!-- Submit Button -->
    <button 
        type="submit" 
        :disabled="!password || !password_confirmation || password !== password_confirmation"
        wire:loading.attr="disabled"
        wire:target="resetPassword"
        class="w-full mt-2 py-3.5 bg-black hover:bg-gray-800 text-white font-bold text-sm rounded-lg transition-colors cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed text-center shadow-md"
    >
        <span wire:loading.remove wire:target="resetPassword">Reset Password</span>
        <span wire:loading wire:target="resetPassword">Updating password...</span>
    </button>

    </form>

    <!-- Footer Navigation Link -->
    <div class="mt-8 text-center border-t border-gray-50 pt-6">
      <p class="text-xs text-gray-500 font-light">
        Remembered your password? 
        <a href="{{ route('login') }}" wire:navigate class="font-semibold text-black hover:underline ml-1">Back to sign in</a>
      </p>
    </div>

  </div>
</div>
