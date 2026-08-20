<div class="max-w-md mx-auto px-4 py-8 md:py-12" x-data="{ email: '' }">
  <div class="bg-white rounded-2xl shadow-[0_4px_24px_rgba(0,0,0,0.06)] border border-gray-100 p-8 md:p-10">
    
    <!-- Header Section -->
    <div class="text-center mb-8">
      <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-50 rounded-full mb-4 border border-gray-100">
        <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 0121 9z"/>
        </svg>
      </div>
      <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Forgot Password?</h2>
      <p class="text-sm text-gray-500 mt-1">Enter your email address and we'll send you a link to reset your password</p>
    </div>

    <!-- Status Message Alert -->
    @if (session('status'))
      <div class="mb-5 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-xs text-emerald-800">
        {{ session('status') }}
      </div>
    @endif

    <!-- Forgot Password Form -->
    {{-- <form wire:submit.prevent="sendResetLink" class="space-y-5">
      
      <!-- Email Address -->
      <div>
        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Email Address</label>
        <input 
          type="email" 
          id="email" 
          wire:model.blur="email" 
          x-model="email"
          placeholder="yourname@example.com"
          class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
          required
        />
        @error('email') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
      </div>

      <!-- Submit Button -->
      <button 
        type="submit" 
        :disabled="!email"
        wire:loading.attr="disabled"
        wire:target="sendResetLink"
        class="w-full mt-2 py-3.5 bg-black hover:bg-gray-800 text-white font-bold text-sm rounded-lg transition-colors cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed text-center shadow-md"
      >
        <span wire:loading.remove wire:target="sendResetLink">Send Reset Link</span>
        <span wire:loading wire:target="sendResetLink">Sending link...</span>
      </button>

    </form> --}}
    <form wire:submit.prevent="sendResetLink" class="space-y-5">

    <!-- Success Alert -->
    @if ($successMessage)
        <div class="p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-xs text-emerald-800">
        {{ $successMessage }}
        </div>
    @endif

    <!-- Error Alert -->
    @if ($errorMessage)
        <div class="p-4 rounded-lg bg-red-50 border border-red-200 text-xs text-red-800">
        {{ $errorMessage }}
        </div>
    @endif
    
    <!-- Email Address -->
    <div>
        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Email Address</label>
        <input 
        type="email" 
        id="email" 
        wire:model.blur="email" 
        x-model="email"
        placeholder="yourname@example.com"
        class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
        required
        />
        @error('email') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <!-- Submit Button -->
    <button 
        type="submit" 
        :disabled="!email"
        wire:loading.attr="disabled"
        wire:target="sendResetLink"
        class="w-full mt-2 py-3.5 bg-black hover:bg-gray-800 text-white font-bold text-sm rounded-lg transition-colors cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed text-center shadow-md"
    >
        <span wire:loading.remove wire:target="sendResetLink">Send Reset Link</span>
        <span wire:loading wire:target="sendResetLink">Sending link...</span>
    </button>

    </form>

    <!-- Footer Navigation Link -->
    <div class="mt-8 text-center border-t border-gray-50 pt-6">
      <p class="text-xs text-gray-500 font-light">
        Remember your password? 
        <a href="{{ route('login') }}" wire:navigate class="font-semibold text-black hover:underline ml-1">Back to sign in</a>
      </p>
    </div>

  </div>
</div>
