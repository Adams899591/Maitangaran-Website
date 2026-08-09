<div>

    @props([
    'heightClass' => 'h-44',
    'message' => 'No items discovered.'
])

<div {{ $attributes->merge(['class' => "bg-white border border-gray-100 rounded-2xl flex flex-col items-center justify-center p-6 text-center shadow-sm w-full {$heightClass}"]) }}>
    <!-- Cloud Offline / Empty Icon -->
    <div class="w-12 h-12 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center mb-2">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" 
                d="M3 15a4 4 0 004 4h12a4 4 0 001-7.9 5 5 0 00-9.9-1.2A4.5 4.5 0 003 15z">
            </path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v4m0 3h.01"></path>
        </svg>
    </div>

    <!-- Empty State Text Message -->
    <Text class="text-gray-500 text-xs sm:text-sm font-semibold max-w-xs">
        {{ $message }}
    </Text>
</div>

</div>