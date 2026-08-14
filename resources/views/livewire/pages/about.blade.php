
{{-- <div>
<!-- About Us Section -->
<section class="bg-gray-100/80 text-gray-800 py-12 md:py-16 border-b border-gray-200">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Heading -->
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gray-900 text-center mb-8 md:mb-10 tracking-tight uppercase">
      About Us
    </h1>

     <!-- Scrolling Text Section -->
    <div class="relative h-72 sm:h-80 overflow-hidden border-y-2 border-gray-900 py-4">
      <div class="absolute w-full animate-[scroll-up_60s_linear_infinite]">
        
        <!-- Content Block -->
        <div class="space-y-6 text-base sm:text-lg leading-relaxed text-gray-600">

          <p>
            Welcome to <strong class="text-gray-900 font-bold">Maitangaran Textiles</strong>, Nigeria’s Premier Textile Destination and a division of A.A. Maitangaran & Sons Ltd. We have proudly served customers across Nigeria with premium quality fabrics for decades.
          </p>

          <p>
            We are licensed global distributors for top tier international brands including <strong class="text-gray-900 font-semibold">Getzner, Excelsior, Filtex, HC Germany, Bauer, and Hollandaise</strong>. We specialize in authorized distribution for premium African brocades, luxury shirting, and exquisite laces.
          </p>

          <p>
            With strong nationwide logistics, we safely serve both wholesale and retail pipelines across all Nigerian states with 100% authenticity guaranteed.
          </p>

          <div class="p-4 bg-white/80 rounded-xl border-l-4 border-gray-900 space-y-2 my-4 shadow-sm border border-gray-200">
            <p><strong class="text-gray-900">Our Core Mission:</strong> "To provide the finest textiles and unmatched customer service across Nigeria by offering genuine products, transparent pricing, and reliable nationwide delivery."</p>
          </div>

          <!-- Locations -->
          <div class="space-y-3 pt-2">
            <p class="font-bold text-gray-900 uppercase text-sm tracking-wider">Our Branch Locations:</p>
            <p><strong class="text-gray-900">Kano (Head Office):</strong> 4 Fagge Ta Kudu, A.A. Maitangaran House, Opposite Kwari Market, Kano State.</p>
            <p><strong class="text-gray-900">Abuja Showroom:</strong> Suite 19, Nürnberger Plaza, Beside Rockview Hotel, Adetokunbo Ademola Crescent, Wuse II, Abuja.</p>
          </div>

          <p class="font-semibold text-gray-900">— The Maitangaran Team 🖤</p>

          <!-- Direct Contact & Developer Credit -->
          <div class="pt-4 border-t border-gray-300 text-sm sm:text-base text-gray-600 space-y-1">
            <p><strong class="text-gray-900">Kano Phone:</strong> <a href="tel:+2348032838463" class="text-gray-900 hover:underline">+234 803 283 8463</a></p>
            <p><strong class="text-gray-900">WhatsApp Kano:</strong> <a href="https://wa.me/2348032959574" target="_blank" class="text-gray-900 hover:underline">+234 803 295 9574</a></p>
            <p><strong class="text-gray-900">WhatsApp Abuja:</strong> <a href="https://wa.me/2348065498720" target="_blank" class="text-gray-900 hover:underline">+234 806 549 8720</a></p>
            <p><strong class="text-gray-900">Email:</strong> <a href="mailto:mtextile70@yahoo.com" class="text-gray-900 hover:underline">mtextile70@yahoo.com</a></p>
          </div>

          <!-- Loop Divider / Gap -->
          <div class="py-12"></div>

          <!-- Duplicate Content Block (For Seamless Infinite Scroll) -->
          <p>
            Welcome to <strong class="text-gray-900 font-bold">Maitangaran Textiles</strong>, Nigeria’s Premier Textile Destination and a division of A.A. Maitangaran & Sons Ltd...
          </p>
          <p>
            We are licensed global distributors for <strong class="text-gray-900 font-semibold">Getzner, Excelsior, Filtex, HC Germany, Bauer, and Hollandaise</strong>...
          </p>
          <p>
            With strong nationwide logistics, we safely serve both wholesale and retail pipelines across all Nigerian states...
          </p>
          <div class="p-4 bg-white/80 rounded-xl border-l-4 border-gray-900 space-y-2 my-4 shadow-sm border border-gray-200">
            <p><strong class="text-gray-900">Our Core Mission:</strong> "To provide the finest textiles and unmatched customer service across Nigeria..."</p>
          </div>
          <div class="space-y-1 text-sm">
            <p><strong class="text-gray-900">Kano HQ:</strong> 4 Fagge Ta Kudu, A.A. Maitangaran House, Opposite Kwari Market, Kano.</p>
            <p><strong class="text-gray-900">Abuja:</strong> Suite 19, Nürnberger Plaza, Wuse II, Abuja.</p>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<!-- Custom Scroll Animation Keyframe Rule -->
<style>
  @keyframes scroll-up {
    0% { top: 100%; }
    100% { top: -200%; }
  }
</style>
</div> --}}

<div>
<!-- About Us Section -->
<section class="bg-gray-100/80 text-gray-800 py-12 md:py-16 border-b border-gray-200">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Heading -->
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gray-900 text-center mb-8 md:mb-10 tracking-tight uppercase">
      About Us
    </h1>

    @if($isLoading)
      <!-- Loading Skeleton State -->
      <div wire:key="about-loading-skeleton" class="animate-pulse space-y-4 max-w-2xl mx-auto py-10">
        <div class="h-6 bg-gray-300 rounded w-3/4 mx-auto"></div>
        <div class="h-4 bg-gray-300 rounded w-5/6 mx-auto"></div>
        <div class="h-4 bg-gray-300 rounded w-2/3 mx-auto"></div>
        <div class="h-20 bg-gray-300 rounded w-full mt-6"></div>
      </div>

    @elseif($networkError)
      <!-- Network Error State -->
      <div wire:key="about-network-error" class="text-center py-10">
        <x-fetch-error retry-action="about" />
      </div>

    @else
      <!-- Dynamic Scrolling Content Section -->
      <div wire:key="about-content-loaded" class="relative h-72 sm:h-80 overflow-hidden border-y-2 border-gray-900 py-4">
        <div class="absolute w-full animate-[scroll-up_60s_linear_infinite]">
          
          <!-- Content Block 1 -->
          <div class="space-y-6 text-base sm:text-lg leading-relaxed text-gray-600">

            <p>
              Welcome to <strong class="text-gray-900 font-bold">{{ $company['CompanyName'] ?? 'Our Company' }}</strong>. 
              {{ $company['Description'] ?? '' }}
            </p>

            @if(!empty($company['CompanyMotto']))
              <div class="p-4 bg-white/80 rounded-xl border-l-4 border-gray-900 space-y-2 my-4 shadow-sm border border-gray-200">
                <p><strong class="text-gray-900">Our Core Mission:</strong> "{{ $company['CompanyMotto'] }}"</p>
              </div>
            @endif

            <!-- Location -->
            @if(!empty($company['ContactAddress']))
              <div class="space-y-3 pt-2">
                <p class="font-bold text-gray-900 uppercase text-sm tracking-wider">Address / Location:</p>
                <p><strong class="text-gray-900">Main Office:</strong> {{ $company['ContactAddress'] }}</p>
                @if(!empty($company['Address2']))
                  <p><strong class="text-gray-900">Secondary Address:</strong> {{ $company['Address2'] }}</p>
                @endif
              </div>
            @endif

            <p class="font-semibold text-gray-900">— The {{ $company['CompanyName'] ?? 'Company' }} Team 🖤</p>

            <!-- Direct Contact -->
            <div class="pt-4 border-t border-gray-300 text-sm sm:text-base text-gray-600 space-y-1">
              @if(!empty($company['PhoneNumber']))
                <p>
                  <strong class="text-gray-900">Phone:</strong> 
                  <a href="tel:{{ $company['PhoneNumber'] }}" class="text-gray-900 hover:underline">{{ $company['PhoneNumber'] }}</a>
                </p>
              @endif

              @if(!empty($company['EmailAddress']))
                <p>
                  <strong class="text-gray-900">Email:</strong> 
                  <a href="mailto:{{ $company['EmailAddress'] }}" class="text-gray-900 hover:underline">{{ $company['EmailAddress'] }}</a>
                </p>
              @endif

              @if(!empty($company['WebsiteAddress']))
                <p>
                  <strong class="text-gray-900">Website:</strong> 
                  <a href="{{ $company['WebsiteAddress'] }}" target="_blank" class="text-gray-900 hover:underline">{{ $company['WebsiteAddress'] }}</a>
                </p>
              @endif
            </div>

            <!-- Loop Divider / Gap -->
            <div class="py-12"></div>

            <!-- Content Block 2 (Duplicate for Seamless Infinite Scroll Loop) -->
            <p>
              Welcome to <strong class="text-gray-900 font-bold">{{ $company['CompanyName'] ?? 'Our Company' }}</strong>. 
              {{ $company['Description'] ?? '' }}
            </p>

            @if(!empty($company['CompanyMotto']))
              <div class="p-4 bg-white/80 rounded-xl border-l-4 border-gray-900 space-y-2 my-4 shadow-sm border border-gray-200">
                <p><strong class="text-gray-900">Our Core Mission:</strong> "{{ $company['CompanyMotto'] }}"</p>
              </div>
            @endif

            @if(!empty($company['ContactAddress']))
              <div class="space-y-1 text-sm">
                <p><strong class="text-gray-900">Main Office:</strong> {{ $company['ContactAddress'] }}</p>
              </div>
            @endif

          </div>
        </div>
      </div>
    @endif

  </div>
</section>

<!-- Custom Scroll Animation Keyframe Rule -->
<style>
  @keyframes scroll-up {
    0% { top: 100%; }
    100% { top: -200%; }
  }
</style>
</div>