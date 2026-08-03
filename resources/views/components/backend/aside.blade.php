<div class="font-mitr">
    
    <div x-show="sidebarOpen" class="fixed inset-0 z-40 transition-opacity bg-slate-950/40 backdrop-blur-sm lg:hidden"
        @click="sidebarOpen = false" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
    </div>

    <aside 
        :class="[
            sidebarOpen ? 'translate-x-0' : '-translate-x-full',
            sidebarCollapsed ? 'lg:w-24' : 'lg:w-64'
        ]"
        class="fixed inset-y-0 left-0 z-50 overflow-y-auto transition-all duration-300 ease-in-out transform bg-white border-r border-slate-100 lg:translate-x-0 lg:static lg:inset-0 shadow-[0_8px_30px_rgba(0,0,0,0.01)] flex flex-col h-screen shrink-0 custom-scrollbar">

        <div class="flex items-center justify-between h-20 border-b border-slate-50 px-4 shrink-0 transition-all duration-300"
             :class="sidebarCollapsed ? 'lg:justify-center' : 'lg:px-6'">
            
            <a href="{{ route('backend.home') }}" x-show="!sidebarCollapsed" x-transition:enter="transition ease-out duration-200"
                class="text-xl font-black text-slate-900 tracking-wider flex items-center gap-2">
                <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-[#5EBEE6] to-blue-500 flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                    <i class="fa-solid fa-graduation-cap text-sm"></i>
                </div>
                <span class="tracking-tight">STEAM<span class="text-[#5EBEE6]">X</span></span>
            </a>

            <button @click="sidebarCollapsed = !sidebarCollapsed" 
                    class="hidden lg:flex w-8 h-8 rounded-xl bg-slate-50 text-slate-400 hover:text-[#5EBEE6] hover:bg-blue-50 border border-slate-100 items-center justify-center transition-colors">
                <i class="fa-solid" :class="sidebarCollapsed ? 'fa-angles-right' : 'fa-angles-left'"></i>
            </button>
            
            <button @click="sidebarOpen = false" class="lg:hidden w-8 h-8 text-slate-400 hover:text-rose-500 transition-colors">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <div class="px-3 pt-4">
            <a href="{{ route('home') }}"
               :class="sidebarCollapsed ? 'lg:flex-col lg:py-3 lg:px-1 text-center' : 'flex-row px-4 py-2.5'"
               class="flex items-center gap-3 text-xs font-bold transition-all rounded-xl duration-300 bg-slate-50 border border-slate-100 text-slate-500 hover:bg-blue-50 hover:text-[#5EBEE6] hover:border-blue-100">
                <i class="fa-solid fa-arrow-left-long text-sm shrink-0" :class="sidebarCollapsed ? 'w-auto' : 'w-5 text-center'"></i>
                <span class="tracking-wide" :class="sidebarCollapsed ? 'text-[8px] mt-0.5 font-bold' : 'text-xs font-bold'">กลับสู่หน้าเว็บไซต์หลัก</span>
            </a>
        </div>

        <nav class="flex-1 px-3 py-4 space-y-1.5 relative">

            <a href="{{ route('backend.home') }}"
               :class="sidebarCollapsed ? 'lg:flex-col lg:py-3.5 lg:px-1 text-center' : 'flex-row px-4 py-3'"
               class="flex items-center gap-3 text-xs font-bold transition-all rounded-xl duration-300 {{ request()->routeIs('backend.home') ? 'bg-[#5EBEE6]/10 text-[#5EBEE6]' : 'text-slate-500 hover:bg-slate-50 hover:text-[#5EBEE6]' }}">
                <i class="fa-solid fa-house text-base shrink-0" :class="sidebarCollapsed ? 'w-auto' : 'w-5 text-center'"></i>
                <span class="tracking-wide" :class="sidebarCollapsed ? 'text-[9px] mt-1 font-bold' : 'text-sm font-medium'">แดชบอร์ด</span>
            </a>

            <div x-data="{ open: {{ request()->routeIs(['backend.projects*', 'backend.reports*', 'backend.activity*', 'backend.sheets*', 'backend.portfolios*']) ? 'true' : 'false' }} }" class="space-y-1" @click.away="open = false">
                <button @click="open = !open"
                    :class="sidebarCollapsed ? 'lg:flex-col lg:py-3.5 lg:px-1 text-center' : 'flex-row px-4 py-3'"
                    class="w-full flex items-center justify-between text-xs font-bold transition-all rounded-xl duration-300 {{ request()->routeIs(['backend.projects*', 'backend.reports*', 'backend.activity*', 'backend.sheets*', 'backend.portfolios*']) ? 'bg-[#5EBEE6]/10 text-[#5EBEE6]' : 'text-slate-500 hover:bg-slate-50 hover:text-[#5EBEE6]' }}">
                    <div class="flex items-center gap-3" :class="sidebarCollapsed ? 'flex-col' : 'flex-row'">
                        <i class="fa-solid fa-layer-group text-base shrink-0" :class="sidebarCollapsed ? 'w-auto' : 'w-5 text-center'"></i>
                        <span class="tracking-wide" :class="sidebarCollapsed ? 'text-[9px] mt-1 font-bold' : 'text-sm font-medium'">ระบบจัดการ</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
                </button>

                <div x-show="open" x-collapse 
                     :class="sidebarCollapsed ? 'lg:pl-0 lg:pr-0 lg:bg-slate-50/70 lg:rounded-xl lg:py-1.5 lg:space-y-1' : 'pl-12 pr-2 py-1 space-y-1'"
                     class="transition-all duration-300">
                    
                    <a href="{{route('backend.projects')}}" 
                       :class="sidebarCollapsed ? 'lg:flex lg:flex-col lg:items-center lg:justify-center lg:py-2.5 lg:px-1 text-center' : 'block py-2 text-xs relative before:content-[\'\'] before:absolute before:left-[-14px] before:top-1/2 before:-translate-y-1/2 before:w-1 before:h-1 before:rounded-full before:bg-slate-300 hover:before:bg-[#5EBEE6]'"
                       class="font-semibold transition-colors {{ request()->routeIs('backend.projects*') ? 'text-[#5EBEE6]' : 'text-slate-500 hover:text-[#5EBEE6]' }}" title="จัดการโครงงาน">
                        <i x-show="sidebarCollapsed" class="fa-solid fa-folder-tree text-sm mb-1 text-slate-400 group-hover:text-[#5EBEE6]"></i>
                        <span :class="sidebarCollapsed ? 'text-[8px] font-bold scale-90' : 'text-xs'">จัดการโครงงาน</span>
                    </a>
                    
                    <a href="{{route('backend.reports')}}" 
                       :class="sidebarCollapsed ? 'lg:flex lg:flex-col lg:items-center lg:justify-center lg:py-2.5 lg:px-1 text-center' : 'block py-2 text-xs relative before:content-[\'\'] before:absolute before:left-[-14px] before:top-1/2 before:-translate-y-1/2 before:w-1 before:h-1 before:rounded-full before:bg-slate-300 hover:before:bg-[#5EBEE6]'"
                       class="font-semibold transition-colors {{ request()->routeIs('backend.reports*') ? 'text-[#5EBEE6]' : 'text-slate-500 hover:text-[#5EBEE6]' }}" title="จัดการเล่มโครงงาน">
                        <i x-show="sidebarCollapsed" class="fa-solid fa-file-invoice text-sm mb-1 text-slate-400 group-hover:text-[#5EBEE6]"></i>
                        <span :class="sidebarCollapsed ? 'text-[8px] font-bold scale-90' : 'text-xs'">จัดการเล่มโครงงาน</span>
                    </a>
                    
                    <a href="{{route('backend.activity')}}" 
                       :class="sidebarCollapsed ? 'lg:flex lg:flex-col lg:items-center lg:justify-center lg:py-2.5 lg:px-1 text-center' : 'block py-2 text-xs relative before:content-[\'\'] before:absolute before:left-[-14px] before:top-1/2 before:-translate-y-1/2 before:w-1 before:h-1 before:rounded-full before:bg-slate-300 hover:before:bg-[#5EBEE6]'"
                       class="font-semibold transition-colors {{ request()->routeIs('backend.activity*') ? 'text-[#5EBEE6]' : 'text-slate-500 hover:text-[#5EBEE6]' }}" title="จัดการกิจกรรม">
                        <i x-show="sidebarCollapsed" class="fa-solid fa-calendar-check text-sm mb-1 text-slate-400 group-hover:text-[#5EBEE6]"></i>
                        <span :class="sidebarCollapsed ? 'text-[8px] font-bold scale-90' : 'text-xs'">จัดการกิจกรรม</span>
                    </a>
                    
                    <a href="{{ route('backend.sheets') }}" 
                       :class="sidebarCollapsed ? 'lg:flex lg:flex-col lg:items-center lg:justify-center lg:py-2.5 lg:px-1 text-center' : 'block py-2 text-xs relative before:content-[\'\'] before:absolute before:left-[-14px] before:top-1/2 before:-translate-y-1/2 before:w-1 before:h-1 before:rounded-full before:bg-slate-300 hover:before:bg-[#5EBEE6]'"
                       class="font-semibold transition-colors {{ request()->routeIs('backend.sheets*') ? 'text-[#5EBEE6]' : 'text-slate-500 hover:text-[#5EBEE6]' }}" title="จัดการชีทสรุป">
                        <i x-show="sidebarCollapsed" class="fa-solid fa-book-open-reader text-sm mb-1 text-slate-400 group-hover:text-[#5EBEE6]"></i>
                        <span :class="sidebarCollapsed ? 'text-[8px] font-bold scale-90' : 'text-xs'">จัดการชีทสรุป</span>
                    </a>
                    
                    <a href="{{ route('backend.portfolios') }}" 
                       :class="sidebarCollapsed ? 'lg:flex lg:flex-col lg:items-center lg:justify-center lg:py-2.5 lg:px-1 text-center' : 'justify-between py-2 text-xs relative before:content-[\'\'] before:absolute before:left-[-14px] before:top-1/2 before:-translate-y-1/2 before:w-1 before:h-1 before:rounded-full before:bg-slate-300 hover:before:bg-[#5EBEE6]'"
                       class="flex items-center font-semibold transition-colors {{ request()->routeIs('backend.portfolios*') ? 'text-[#5EBEE6]' : 'text-slate-500 hover:text-[#5EBEE6]' }}" title="จัดการพอร์ต">
                        <i x-show="sidebarCollapsed" class="fa-solid fa-address-card text-sm mb-1 text-slate-400 group-hover:text-[#5EBEE6]"></i>
                        <span :class="sidebarCollapsed ? 'text-[8px] font-bold scale-90' : 'text-xs'">จัดการพอร์ต</span>
                        <span :class="sidebarCollapsed ? 'hidden' : 'inline-block'" class="bg-orange-50 text-orange-500 py-0.5 px-2 rounded-md text-[9px] font-bold border border-orange-100/30 uppercase tracking-wide">New</span>
                    </a>
                </div>
            </div>

            <a href="{{ route('backend.users') }}"
               :class="sidebarCollapsed ? 'lg:flex-col lg:py-3.5 lg:px-1 text-center' : 'flex-row px-4 py-3'"
               class="flex items-center gap-3 text-xs font-bold transition-all rounded-xl duration-300 {{ request()->routeIs('backend.users*') ? 'bg-[#5EBEE6]/10 text-[#5EBEE6]' : 'text-slate-500 hover:bg-slate-50 hover:text-[#5EBEE6]' }}">
                <i class="fa-solid fa-users text-base shrink-0" :class="sidebarCollapsed ? 'w-auto' : 'w-5 text-center'"></i>
                <span class="tracking-wide" :class="sidebarCollapsed ? 'text-[9px] mt-1 font-bold' : 'text-sm font-medium'">จัดการผู้ใช้</span>
            </a>

            <a href="{{ route('backend.ads') }}"
               :class="sidebarCollapsed ? 'lg:flex-col lg:py-3.5 lg:px-1 text-center' : 'flex-row px-4 py-3'"
               class="flex items-center gap-3 text-xs font-bold transition-all rounded-xl duration-300 {{ request()->routeIs('backend.ads*') ? 'bg-[#5EBEE6]/10 text-[#5EBEE6]' : 'text-slate-500 hover:bg-slate-50 hover:text-[#5EBEE6]' }}">
                <i class="fa-solid fa-bullhorn text-base shrink-0" :class="sidebarCollapsed ? 'w-auto' : 'w-5 text-center'"></i>
                <span class="tracking-wide" :class="sidebarCollapsed ? 'text-[9px] mt-1 font-bold' : 'text-sm font-medium'">ตั้งค่าโฆษณา</span>
            </a>

            <a href="{{ route('backend.settings') }}"
               :class="sidebarCollapsed ? 'lg:flex-col lg:py-3.5 lg:px-1 text-center' : 'flex-row px-4 py-3'"
               class="flex items-center gap-3 text-xs font-bold transition-all rounded-xl duration-300 {{ request()->routeIs('backend.settings*') ? 'bg-[#5EBEE6]/10 text-[#5EBEE6]' : 'text-slate-500 hover:bg-slate-50 hover:text-[#5EBEE6]' }}">
                <i class="fa-solid fa-gear text-base shrink-0" :class="sidebarCollapsed ? 'w-auto' : 'w-5 text-center'"></i>
                <span class="tracking-wide" :class="sidebarCollapsed ? 'text-[9px] mt-1 font-bold' : 'text-sm font-medium'">ตั้งค่าระบบ</span>
            </a>

        </nav>

        <div class="p-3 border-t border-slate-50 shrink-0 space-y-2">
            <div class="flex items-center gap-2.5 bg-slate-50/70 rounded-xl p-2.5" :class="sidebarCollapsed ? 'lg:justify-center lg:p-1.5' : ''">
                <div class="w-8 h-8 rounded-full border-2 border-white shadow-sm overflow-hidden shrink-0 bg-white flex items-center justify-center text-slate-300">
                    @if (Auth::user()->profile)
                        <img src="{{ asset('assets/img/profile/' . Auth::user()->profile) }}" class="w-full h-full object-cover" alt="Admin Photo">
                    @else
                        <i class="fa-solid fa-circle-user text-2xl"></i>
                    @endif
                </div>
                <div class="min-w-0" x-show="!sidebarCollapsed">
                    <p class="text-xs font-bold text-slate-800 truncate">{{ Auth::user()->nickname ?? Auth::user()->first_name }}</p>
                    <p class="text-[9px] font-bold text-[#5EBEE6] uppercase tracking-wider">{{ Auth::user()->level }}</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    :class="sidebarCollapsed ? 'lg:flex-col lg:py-3.5 lg:px-1 text-center' : 'flex-row px-4 py-3'"
                    class="flex items-center gap-3 w-full text-xs font-bold text-rose-500 transition-colors rounded-xl hover:bg-rose-50 duration-300">
                    <i class="fa-solid fa-right-from-bracket text-base shrink-0" :class="sidebarCollapsed ? 'w-auto' : 'w-5 text-center'"></i>
                    <span class="tracking-wide" :class="sidebarCollapsed ? 'text-[9px] mt-1 font-bold' : 'text-sm font-medium'">ออกจากระบบ</span>
                </button>
            </form>
        </div>

    </aside>
</div>