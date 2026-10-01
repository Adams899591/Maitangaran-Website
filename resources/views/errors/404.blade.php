<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 - Page Not Found | Maitangaran</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome for button icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-800 antialiased min-h-screen flex items-center justify-center p-4">

    <!-- Compact Box Container -->
    <div class="max-w-md w-full bg-white p-6 sm:p-7 rounded-2xl shadow-md border border-gray-200 text-center">
        
        <!-- Compact SVG Illustration -->
        <div class="flex justify-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-28 h-28 drop-shadow-sm" fill="none" viewBox="0 0 200 200">
                <!-- Soft Background Blobs -->
                <circle cx="100" cy="100" r="80" fill="#F3F4F6"/>
                <circle cx="100" cy="100" r="60" fill="#E5E7EB"/>
                
                <!-- Folded Map Document -->
                <path d="M60 65 L85 55 L115 65 L140 55 V135 L115 145 L85 135 L60 145 Z" fill="#9CA3AF"/>
                <path d="M85 55 L115 65 V145 L85 135 Z" fill="#6B7280"/>
                
                <!-- Search Magnifying Glass -->
                <circle cx="110" cy="100" r="22" fill="#1F2937" stroke="#FFFFFF" stroke-width="3"/>
                <circle cx="110" cy="100" r="14" fill="#374151"/>
                <path d="M104 94 L116 106 M116 94 L104 106" stroke="#EF4444" stroke-width="2.5" stroke-linecap="round"/>
                <path d="M125 115 L140 130" stroke="#1F2937" stroke-width="6" stroke-linecap="round"/>
            </svg>
        </div>

        <!-- Error Text Content -->
        <div class="space-y-2">
            <span class="bg-amber-50 text-amber-700 text-[10px] font-bold uppercase px-2.5 py-0.5 rounded-full inline-block tracking-wider border border-amber-200">
                Error 404
            </span>
            
            <h1 class="text-2xl font-bold tracking-tight text-black">
                Page Not Found
            </h1>
            
            <p class="text-gray-500 text-xs sm:text-sm leading-relaxed max-w-xs mx-auto">
                The page you are looking for doesn't exist or has been moved.
            </p>
        </div>

        <!-- Action Buttons (Inline Grid) -->
        <div class="mt-6 grid grid-cols-2 gap-2.5">
            <button onclick="window.history.back()" class="w-full inline-flex justify-center items-center bg-black hover:bg-gray-800 text-white py-2.5 px-4 rounded-lg font-medium transition-all duration-200 text-xs shadow-sm">
                <i class="fas fa-arrow-left mr-1.5 text-gray-300"></i>
                Go Back
            </button>
            
            <a href="{{ route("home") }}" class="w-full inline-flex justify-center items-center bg-gray-100 hover:bg-gray-200 text-black py-2.5 px-4 rounded-lg font-medium transition-all duration-200 border border-gray-200 text-xs">
                <i class="fas fa-home mr-1.5 text-gray-600"></i>
                Go Home
            </a>
        </div>

        <!-- Support Link -->
        <div class="mt-5 pt-4 border-t border-gray-100">
            <p class="text-[11px] text-gray-500">
                Need help? <a href="mailto:mtextile70@yahoo.com" class="text-blue-600 hover:underline font-semibold">Contact support</a>
            </p>
        </div>

    </div>

</body>
</html>