<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MAITANGARAN - Premium Fabrics Collection</title>
    @vite(["resources/css/app.css","resources/js/app.js"])
</head>
<body class="bg-black m-0 p-0 overflow-hidden font-sans">

    <!-- Background Image with Dark Overlay Gradients -->
    <div class="relative w-screen h-screen bg-cover bg-center flex flex-col justify-between px-6 pt-20 pb-16"
         style="background-image: url('https://images.unsplash.com/photo-1513094735237-8f2714d57c13?q=80&w=1470&auto=format&fit=crop');">
        
        <!-- Gradient Overlay matching the React Native LinearGradient -->
        <div class="absolute inset-0 bg-gradient-to-b from-[rgba(0,0,0,0.75)] via-[rgba(0,0,0,0.55)] to-[rgba(0,0,0,0.90)] pointer-events-none"></div>

        <!-- Content Layer -->
        <div class="relative z-10 flex flex-col justify-between h-full">
            
            <!-- Header (Fades and Scales in via Tailwind/CSS transitions) -->
            <div id="header-view" class="flex flex-col items-center opacity-0 scale-90 transition-all duration-1000 ease-out">
                <h1 class="text-white text-3xl md:text-4xl font-black tracking-[2px]">
                    MAITANGARAN
                </h1>
                <p class="text-gray-300 mt-2.5 tracking-[3px] text-xs uppercase">
                    Premium Fabrics Collection
                </p>
            </div>

            <!-- Countdown Display -->
            <div id="counter-view" class="flex flex-col items-center opacity-0 transition-opacity duration-1000">
                <span id="count-number" class="text-white text-8xl md:text-9xl font-black">
                    100
                </span>
                <span class="text-gray-300 tracking-[5px] -mt-2">
                    %
                </span>
                <p class="text-white mt-6 text-sm md:text-base tracking-[2px]">
                    Loading Collection...
                </p>
            </div>

            <!-- Progress Bar & Footer -->
            <div>
                <div class="h-1 bg-white/25 rounded-full overflow-hidden w-full">
                    <!-- Progress Bar Inner Fill -->
                    <div id="progress-bar" class="h-full bg-white w-0"></div>
                </div>

                <p class="text-gray-400 text-center mt-4 tracking-[3px] text-[11px]">
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
                    // Redirect to your target web route once finished (equivalent to router.replace)
                    window.location.href = "/page/home"; 
                }
            }, intervalTime);
        });
    </script>
</body>
</html>


