
<div>


    <!-- Contact Us Section -->
  <section class="bg-gray-100/80 text-gray-800 py-12 md:py-16 border-b border-gray-200">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Hero Header -->
      <div class="text-center max-w-2xl mx-auto mb-10">
        <span class="text-xs font-bold uppercase tracking-widest text-gray-500">Get In Touch</span>
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight uppercase mt-1">
          Contact Us
        </h1>
        <p class="text-sm sm:text-base text-gray-600 mt-3 leading-relaxed">
          For wholesale or retail inquiries, nationwide delivery, or premium fabric stock questions, please send us a message or contact our support lines directly.
        </p>
      </div>

      <!-- Main Content Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

        <!-- Left Column: Inquiry Form -->
        <div class="lg:col-span-7 bg-white p-6 sm:p-8 rounded-2xl border border-gray-200 shadow-sm">
          <h2 class="text-sm font-bold tracking-wider text-gray-900 uppercase mb-6">Inquiry Form</h2>
          
          <form wire:submit.prevent="submit" class="space-y-4">

            <!-- Success Alert -->
            @if ($successMessage)
              <div class="p-3 bg-green-100 border border-green-300 text-green-800 rounded-xl text-xs">
                {{ $successMessage }}
              </div>
            @endif

            <!-- Error Alert -->
            @if ($errorMessage)
              <div class="p-3 bg-red-100 border border-red-300 text-red-800 rounded-xl text-xs">
                {{ $errorMessage }}
              </div>
            @endif

            <!-- Full Name -->
            <div>
              <label class="block text-xs font-semibold text-gray-700 mb-1">Full Name *</label>
              <input 
                type="text" 
                wire:model="name"
                placeholder="Your name" 
                class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm text-gray-900 focus:outline-none focus:border-gray-900 focus:bg-white transition"
              />
              @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Email Address -->
            <div>
              <label class="block text-xs font-semibold text-gray-700 mb-1">Email Address *</label>
              <input 
                type="email" 
                wire:model="email"
                placeholder="yourname@domain.com" 
                class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm text-gray-900 focus:outline-none focus:border-gray-900 focus:bg-white transition"
              />
              @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Phone Number -->
            <div>
              <label class="block text-xs font-semibold text-gray-700 mb-1">Phone Number (Optional)</label>
              <input 
                type="tel" 
                wire:model="phone"
                placeholder="09000000000" 
                class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm text-gray-900 focus:outline-none focus:border-gray-900 focus:bg-white transition"
              />
              @error('phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Message -->
            <div>
              <label class="block text-xs font-semibold text-gray-700 mb-1">Your Message *</label>
              <textarea 
                rows="4" 
                wire:model="message"
                placeholder="Write details about your premium order rules, quantities, or styles here..." 
                class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm text-gray-900 focus:outline-none focus:border-gray-900 focus:bg-white transition resize-none"
              ></textarea>
              @error('message') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <button 
              type="submit" 
              wire:loading.attr="disabled"
              class="w-full bg-gray-900 hover:bg-black text-white font-bold text-xs uppercase tracking-wider py-3.5 rounded-xl transition duration-150 shadow-sm disabled:opacity-50"
            >
              <span wire:loading.remove wire:target="submit">Dispatch Message</span>
              <span wire:loading wire:target="submit">Sending...</span>
            </button>
          </form>
        </div>

        <!-- Right Column: Direct Connect & Locations -->
        <div class="lg:col-span-5 space-y-6">

          <!-- Live Location / Map Card -->
          <a 
            href="https://www.google.com/maps/place/Maitangaran+Textiles+Limited+Abuja/@9.0805177,7.4727197,17s/" 
            target="_blank" 
            rel="noopener noreferrer" 
            class="block group bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm hover:border-gray-900 transition duration-200"
          >
            <!-- Map Blueprint Visual -->
            <div class="bg-gray-100 h-36 w-full flex items-center justify-center relative px-6 border-b border-gray-200">
              <div class="bg-white p-3 rounded-full border border-gray-200 shadow-sm group-hover:scale-110 transition duration-200">
                <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
              </div>
              <div class="absolute bottom-3 left-3 bg-gray-900 text-white text-[10px] font-bold px-2.5 py-1 rounded-lg">
                Wuse II, Abuja
              </div>
            </div>

            <!-- Map Footer -->
            <div class="p-4 flex items-center justify-between">
              <div>
                <p class="text-xs font-bold text-gray-900">Maitangaran Textiles Limited</p>
                <p class="text-[11px] text-gray-500 mt-0.5 truncate max-w-[180px]">
                  Plot 1723 Suite 19, Adetokunbo Ademola Cres
                </p>
              </div>
              <span class="bg-gray-100 text-gray-900 text-xs font-bold px-3 py-1.5 rounded-xl border border-gray-300 group-hover:bg-gray-900 group-hover:text-white transition">
                Navigate
              </span>
            </div>
          </a>

          <!-- Showroom Hours -->
          <div class="bg-white border border-gray-200 rounded-2xl p-4 flex items-center justify-between shadow-sm">
            <div class="flex items-center space-x-3">
              <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              <div>
                <p class="text-[10px] font-bold text-gray-500 uppercase tracking-wide">Showroom Hours</p>
                <p class="text-xs font-bold text-gray-900 mt-0.5">Mon - Sat: 9:00 AM – 6:00 PM</p>
              </div>
            </div>
            <span class="bg-gray-100 text-gray-600 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase border border-gray-200">
              Sun Closed
            </span>
          </div>

          <!-- Direct Contact Links Hub -->
          <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm divide-y divide-gray-100">
            
            <!-- Kano Call -->
            <a href="tel:+2348032838463" class="flex items-center justify-between p-4 hover:bg-gray-50 transition">
              <div class="flex items-center space-x-3">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                <span class="text-xs font-semibold text-gray-800">Call Kano HQ</span>
              </div>
              <span class="text-xs font-mono text-gray-500">+234 803 283 8463</span>
            </a>

            <!-- WhatsApp Kano -->
            <a href="https://wa.me/2348032959574" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-4 hover:bg-gray-50 transition">
              <div class="flex items-center space-x-3">
                <span class="text-emerald-600 font-bold text-xs">WA</span>
                <span class="text-xs font-semibold text-gray-800">WhatsApp Kano</span>
              </div>
              <span class="text-xs font-medium text-emerald-600">Chat Online</span>
            </a>

            <!-- WhatsApp Abuja -->
            <a href="https://wa.me/2348065498720" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-4 hover:bg-gray-50 transition">
              <div class="flex items-center space-x-3">
                <span class="text-emerald-600 font-bold text-xs">WA</span>
                <span class="text-xs font-semibold text-gray-800">WhatsApp Abuja</span>
              </div>
              <span class="text-xs font-medium text-emerald-600">Chat Online</span>
            </a>

            <!-- Email Support -->
            <a href="mailto:mtextile70@yahoo.com" class="flex items-center justify-between p-4 hover:bg-gray-50 transition">
              <div class="flex items-center space-x-3">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span class="text-xs font-semibold text-gray-800">Email Support</span>
              </div>
              <span class="text-xs font-mono text-gray-500 truncate max-w-[150px]">mtextile70@yahoo.com</span>
            </a>

            <!-- Instagram -->
            <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-4 hover:bg-gray-50 transition">
              <div class="flex items-center space-x-3">
                <span class="text-pink-600 font-bold text-xs">IG</span>
                <span class="text-xs font-semibold text-gray-800">Instagram Official</span>
              </div>
              <span class="text-xs font-mono text-gray-500">@maitangaran_textiles</span>
            </a>

          </div>

        </div>
      </div>

      <!-- Nationwide Logistics Banner -->
      <div class="mt-10 bg-black text-white rounded-2xl p-6 text-center shadow-sm">
        <p class="text-sm font-bold tracking-wide">Nationwide Logistics Network 🌍</p>
        <p class="text-xs text-gray-400 mt-1 max-w-lg mx-auto">
          Safe and secured distribution across all 36 Nigerian States. Wholesale and retail delivery pipelines are fully tracked.
        </p>
      </div>

    </div>
  </section>

</div>



