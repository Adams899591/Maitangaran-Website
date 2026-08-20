<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MAITANGARAN - Premium Fabrics Collection</title>
    <link rel="icon" type="image/png" href="{{asset("images/logo.png")}}" style="border-radius: 50%">
    @vite(["resources/css/app.css","resources/js/app.js"])
</head>
<body class="bg-gray-100/80 m-0 p-0 overflow-hidden font-sans">

    <!-- Container with Soft Light Background Matching Hero Banner -->
    <div class="relative w-screen h-screen bg-gray-100/80 border-b border-gray-200 flex flex-col justify-between px-6 pt-20 pb-16">
        
        <!-- Subtle Overlay Gradient for Depth -->
        <div class="absolute inset-0 bg-gradient-to-b from-gray-100/60 via-gray-100/80 to-gray-200/90 pointer-events-none"></div>

        <!-- Content Layer -->
        <div class="relative z-10 flex flex-col justify-between h-full">
            
            <!-- Header with Rounded Logo -->
            <div id="header-view" class="flex flex-col items-center opacity-0 scale-90 transition-all duration-1000 ease-out">
                <!-- Circular Rounded Website Logo with Subtle Border & Shadow -->
                <div class="w-20 h-20 md:w-24 md:h-24 rounded-full overflow-hidden shadow-md border border-gray-300/80 bg-white flex items-center justify-center mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="MAITANGARAN Logo" class="w-full h-full object-cover">
                </div>
                
                <h1 class="text-gray-900 text-3xl md:text-4xl font-extrabold tracking-[2px]">
                    MAITANGARAN
                </h1>
                <p class="text-gray-600 mt-2 tracking-[3px] text-xs uppercase font-medium">
                    Premium Fabrics Collection
                </p>
            </div>

            <!-- Countdown Display -->
            <div id="counter-view" class="flex flex-col items-center opacity-0 transition-opacity duration-1000">
                <span id="count-number" class="text-gray-900 text-8xl md:text-9xl font-black">
                    100
                </span>
                <span class="text-gray-500 tracking-[5px] -mt-2 font-bold">
                    %
                </span>
                <p class="text-gray-700 mt-6 text-sm md:text-base tracking-[2px] font-semibold">
                    Loading Collection...
                </p>
            </div>

            
            <!-- Progress Bar & Footer -->
            <div>
                <!-- Progress Bar Track (Light Gray Background for Contrast) -->
                <div class="h-2 bg-gray-300/80 rounded-full overflow-hidden w-full shadow-inner">
                    <!-- Progress Bar Inner Fill (Pure Black Fill) -->
                    <div id="progress-bar" class="h-full bg-black w-0 rounded-full transition-all"></div>
                </div>

                <p class="text-gray-500 text-center mt-4 tracking-[3px] text-[11px] uppercase font-medium">
                    Luxury &bull; Elegance &bull; Quality
                </p>
            </div>

        </div>
    </div>

    <!-- Animation and Navigation Script -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const LOADING_TIME = 10000; // 10 seconds
            const START_COUNT = 100;
            
            let count = START_COUNT;
            const countElement = document.getElementById("count-number");
            const progressBar = document.getElementById("progress-bar");
            const headerView = document.getElementById("header-view");
            const counterView = document.getElementById("counter-view");

            // Trigger entrance animations safely after load
            setTimeout(() => {
                headerView.classList.remove("opacity-0", "scale-90");
                headerView.classList.add("opacity-100", "scale-100");

                counterView.classList.remove("opacity-0");
                counterView.classList.add("opacity-100");

                // Smoothly animate the progress bar width to 100% over the specified duration
                progressBar.style.transition = `width ${LOADING_TIME}ms linear`;
                progressBar.style.width = "100%";
            }, 100);

            // Countdown interval logic
            const intervalTime = LOADING_TIME / START_COUNT;
            const timer = setInterval(() => {
                count--;
                countElement.textContent = count;

                if (count <= 0) {
                    clearInterval(timer);
                    // Redirect to your target web route once finished
                    window.location.href = "/page/home"; 
                }
            }, intervalTime);
        });
    </script>
</body>
</html>