<nav class="lg:hidden fixed bottom-0 inset-x-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-100 shadow-[0_-4px_20px_rgba(0,0,0,0.05)] font-mitr"
    style="padding-bottom: env(safe-area-inset-bottom);">
    <div class="grid grid-cols-5">
        <a href="{{ route('home') }}"
            class="flex flex-col items-center justify-center gap-1 py-2.5 text-[10px] font-bold transition-colors {{ request()->routeIs('home') ? 'text-[#5EBEE6]' : 'text-slate-400' }}">
            <i class="fa-solid fa-house text-base"></i>
            <span>หน้าหลัก</span>
        </a>
        <a href="{{ route('projects') }}"
            class="flex flex-col items-center justify-center gap-1 py-2.5 text-[10px] font-bold transition-colors {{ request()->routeIs('projects*') || request()->routeIs('project.*') ? 'text-[#5EBEE6]' : 'text-slate-400' }}">
            <i class="fa-solid fa-diagram-project text-base"></i>
            <span>โครงงาน</span>
        </a>
        <a href="{{ route('activity') }}"
            class="flex flex-col items-center justify-center gap-1 py-2.5 text-[10px] font-bold transition-colors {{ request()->routeIs('activity*') ? 'text-[#5EBEE6]' : 'text-slate-400' }}">
            <i class="fa-solid fa-calendar-check text-base"></i>
            <span>กิจกรรม</span>
        </a>
        <a href="{{ route('sheets') }}"
            class="flex flex-col items-center justify-center gap-1 py-2.5 text-[10px] font-bold transition-colors {{ request()->routeIs('sheets*') ? 'text-[#5EBEE6]' : 'text-slate-400' }}">
            <i class="fa-solid fa-book-open-reader text-base"></i>
            <span>ชีทสรุป</span>
        </a>
        <a href="{{ route('portfolio') }}"
            class="flex flex-col items-center justify-center gap-1 py-2.5 text-[10px] font-bold transition-colors {{ request()->routeIs('portfolio*') ? 'text-[#5EBEE6]' : 'text-slate-400' }}">
            <i class="fa-solid fa-folder-open text-base"></i>
            <span>แฟ้มผลงาน</span>
        </a>
    </div>
</nav>
