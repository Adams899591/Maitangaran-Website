<div class="max-w-md mx-auto px-4 py-16 md:py-24" x-data="{ email: '', password: '' }">
  <div class="bg-white rounded-2xl shadow-[0_4px_24px_rgba(0,0,0,0.06)] border border-gray-100 p-8 md:p-10">
    
    <!-- Header Section -->
    <div class="text-center mb-8">
      <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-50 rounded-full mb-4 border border-gray-100">
        <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
        </svg>
      </div>
      <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Welcome Back</h2>
      <p class="text-sm text-gray-500 mt-1">Please sign in to your account to continue</p>
    </div>

    <!-- Login Form -->
    <form wire:submit.prevent="login" class="space-y-5">
      
      <!-- Email Address / Username -->
      <div>
        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Email Address</label>
        <input 
          type="text" 
          id="email" 
          wire:model.blur="email" 
          x-model="email"
          placeholder="e.g. john@example.com"
          class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
          required
        />
        @error('email') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
      </div>

      <!-- Password -->
      <div>
        <div class="flex items-center justify-between mb-2">
          <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-700">Password</label>
          <a href="/forgot-password" wire:navigate class="text-xs font-medium text-gray-600 hover:text-black transition-colors">Forgot password?</a>
        </div>
        <input 
          type="password" 
          id="password" 
          wire:model.blur="password" 
          x-model="password"
          placeholder="Enter your password"
          class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all"
          required
        />
        @error('password') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
      </div>

      <!-- Remember Me Checkbox -->
      <div class="flex items-center">
        <input 
          type="checkbox" 
          id="remember" 
          wire:model="remember" 
          class="w-4 h-4 text-black border-gray-300 rounded focus:ring-black cursor-pointer"
        />
        <label for="remember" class="ml-2 text-xs text-gray-600 cursor-pointer select-none">Remember me on this device</label>
      </div>

      <!-- Submit Button -->
      <button 
        type="submit" 
        :disabled="!email || !password"
        wire:loading.attr="disabled"
        wire:target="login"
        class="w-full mt-2 py-3.5 bg-black hover:bg-gray-800 text-white font-bold text-sm rounded-lg transition-colors cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed text-center shadow-md"
      >
        <span wire:loading.remove wire:target="login">Sign In</span>
        <span wire:loading wire:target="login">Signing in...</span>
      </button>

    </form>

    <!-- Footer Register Link -->
    <div class="mt-8 text-center border-t border-gray-50 pt-6">
      <p class="text-xs text-gray-500 font-light">
        Don't have an account yet? 
        <a href="{{route("register")}}" wire:navigate class="font-semibold text-black hover:underline ml-1">Create an account</a>
      </p>
    </div>

  </div>
</div>