<nav class="w-full bg-[#333333] border-b border-white/5 py-2 px-6 flex items-center justify-between font-anuphan">
    
    <div class="flex items-center gap-3">
        <span class="text-white text-[11px] font-medium uppercase tracking-wider">Toggle Light Theme</span>
        <button type="button" class="relative inline-flex h-5 w-10 shrink-0 cursor-pointer items-center rounded-full bg-[#444444] border border-white/10 transition-colors duration-200 focus:outline-none">
            <span class="translate-x-1 inline-block h-3 w-3 transform rounded-full bg-white transition duration-200 ease-in-out"></span>
        </button>
    </div>

    <div class="absolute left-1/2 transform -translate-x-1/2">
        <a href="/" class="flex items-center">
            <img src="{{ asset('assets/img/steam-logo.png') }}" alt="STEAM Logo" class="h-10 w-auto object-contain">
        </a>
    </div>

    <div class="flex items-center bg-white rounded-full p-1 w-[80px] h-8 relative">
        <div class="absolute right-1 w-[40px] h-[24px] bg-[#5EBEE6] rounded-full transition-all duration-300"></div>
        
        <div class="flex w-full justify-between items-center z-10 px-2">
            <button class="text-[10px] font-bold text-gray-400 w-1/2 text-center uppercase">EN</button>
            <button class="text-[10px] font-bold text-white w-1/2 text-center uppercase">TH</button>
        </div>
    </div>

</nav>