<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard | MAITANGARAN' }}</title>
    <!-- Tailwind CSS / Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50 font-sans antialiased">

  <div class="min-h-screen flex flex-col md:flex-row" x-data="{ mobileMenuOpen: false }">
    
    <!-- Sidebar Navigation (Desktop Fixed/Sticky & Mobile Slide-over) -->
    <aside 
      :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full'" 
      class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-100 p-6 flex flex-col justify-between transition-transform duration-300 ease-in-out md:translate-x-0 md:sticky md:top-0 md:h-screen"
    >
      <div>
        <!-- Brand / Logo Area -->
        <div class="flex items-center justify-between pb-6 mb-6 border-b border-gray-100">
          <h1 class="text-lg font-extrabold text-gray-900 tracking-tight">MAITANGARAN</h1>
          <button @click="mobileMenuOpen = false" class="md:hidden text-gray-400 hover:text-gray-600 cursor-pointer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>

        <!-- Side Menu Items -->
        <nav class="space-y-1.5">
          <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-3 px-4 py-3 text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} rounded-lg transition-colors">
            <svg class="w-4 h-4 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Dashboard
          </a>
          <a href="{{ route('profile') }}" wire:navigate class="flex items-center gap-3 px-4 py-3 text-sm font-medium {{ request()->routeIs('profile') ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} rounded-lg transition-colors">
            <svg class="w-4 h-4 {{ request()->routeIs('profile') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Account Profile
          </a>
          <a href="{{ route('order-ladger') }}" wire:navigate class="flex items-center gap-3 px-4 py-3 text-sm font-medium {{ request()->routeIs(['order-ladger',"orders-details"]) ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} rounded-lg transition-colors">
            <svg class="w-4 h-4 {{ request()->routeIs('order-ladger') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
            </svg>
            Order Ledger
          </a>
          <a href="{{ route('change-password') }}" wire:navigate class="flex items-center gap-3 px-4 py-3 text-sm font-medium {{ request()->routeIs('change-password') ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} rounded-lg transition-colors">
            <svg class="w-4 h-4 {{ request()->routeIs('change-password') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
            </svg>
            Change Password
          </a>
        </nav>
      </div>

      <!-- Logout Option at Bottom -->
    <div class="pt-6 border-t border-gray-100">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-semibold text-red-600 hover:bg-red-50 rounded-lg transition-colors cursor-pointer">
            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            Log Out
          </button>
        </form>
    </div>




    </aside>

    <!-- Main Content Body Shell -->
    <div class="flex-1 flex flex-col min-w-0">
      
      <!-- Top Header (Unified for Mobile & Desktop) -->
      <header class="bg-white border-b border-gray-100 px-6 py-4 flex items-center justify-between sticky top-0 z-40">
        <!-- Page Heading (Dynamic title with fallback) -->
        <h1 class="text-lg md:text-xl font-bold text-gray-900">
          {{ $headerTitle ?? $title ?? 'Dashboard' }}
        </h1>

        <div class="flex items-center gap-3 md:gap-4">
          <!-- Desktop User Quick Actions -->
          <div class="hidden md:flex items-center gap-3 border-l border-gray-100 pl-4">
            <div class="w-8 h-8 rounded-full bg-gray-900 text-white flex items-center justify-center font-bold text-xs">
              {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
            </div>
            <span class="text-sm font-medium text-gray-700">
              {{ auth()->user()->name ?? 'User' }}
            </span>
          </div>

          <!-- Mobile Navigation Toggle Button -->
          <button @click="mobileMenuOpen = true" class="md:hidden p-2 rounded-lg bg-gray-50 text-gray-700 cursor-pointer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
          </button>
        </div>
      </header>

      <!-- Dynamic Page Slot Content -->
      <main class="flex-1 max-w-7xl w-full mx-auto p-6 md:p-10 space-y-8">
        {{ $slot }}
      </main>

    </div>
  </div>

  @livewireScripts
</body>
</html>