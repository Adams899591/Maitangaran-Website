<div>
    @props([
    'heightClass' => 'h-[400px]',
    'class' => ''
])

<div class="relative overflow-hidden w-full bg-gray-100 rounded-lg flex flex-col items-center justify-center p-6 text-gray-400 select-none {{ $heightClass }} {{ $class }}">
    <!-- Image Icon -->
    <svg 
        class="w-16 h-16 mb-3 stroke-current text-gray-400 opacity-75" 
        fill="none" 
        viewBox="0 0 24 24" 
        stroke="currentColor" 
        stroke-width="1.5"
    >
        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
    </svg>

    <!-- Fallback Text -->
    <span class="text-sm font-bold text-gray-500 tracking-wider uppercase">
        No image uploaded
    </span>
</div>
</div>