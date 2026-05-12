<div x-show="sidebarOpen" class="fixed inset-0 z-20 transition-opacity bg-black bg-opacity-50 lg:hidden"
    @click="sidebarOpen = false" x-transition.opacity style="display: none;">
</div>

<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-white border-r border-gray-100 lg:translate-x-0 lg:static lg:inset-0 shadow-sm flex flex-col custom-scrollbar">

    <div class="flex items-center justify-center h-20 border-b border-gray-50 px-6 shrink-0">
        <a href="{{ route('backend.home') }}"
            class="text-2xl font-black text-[#5EBEE6] tracking-wider flex items-center gap-2">
            <i class="fa-solid fa-graduation-cap"></i> STEAM
        </a>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2">

        <a href="{{ route('backend.home') }}"
            class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-xl {{ request()->routeIs('backend.home') ? 'bg-[#eaf6fc] text-[#5EBEE6]' : 'text-gray-500 hover:bg-gray-50 hover:text-[#5EBEE6]' }}">
            <i class="fa-solid fa-house w-6"></i> แดชบอร์ด
        </a>

        <div x-data="{ open: false }" class="space-y-1">
            <button @click="open = !open" 
                class="w-full flex items-center justify-between px-4 py-3 text-sm font-medium transition-colors rounded-xl text-gray-500 hover:bg-gray-50 hover:text-[#5EBEE6]">
                <div class="flex items-center">
                    <i class="fa-solid fa-layer-group w-6"></i> ระบบจัดการ
                </div>
                <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
            </button>

            <div x-show="open" x-collapse x-transition.duration.300ms class="pl-11 pr-4 py-1 space-y-1" style="display: none;">
                <a href="{{route('backend.projects')}}" class="block py-2 text-sm text-gray-500 hover:text-[#5EBEE6] transition-colors relative before:content-[''] before:absolute before:left-[-16px] before:top-1/2 before:-translate-y-1/2 before:w-1.5 before:h-1.5 before:rounded-full before:bg-gray-300 hover:before:bg-[#5EBEE6]">
                    จัดการโครงงาน
                </a>
                <a href="{{route('backend.reports')}}" class="block py-2 text-sm text-gray-500 hover:text-[#5EBEE6] transition-colors relative before:content-[''] before:absolute before:left-[-16px] before:top-1/2 before:-translate-y-1/2 before:w-1.5 before:h-1.5 before:rounded-full before:bg-gray-300 hover:before:bg-[#5EBEE6]">
                    จัดการเล่มโครงงาน
                </a>
                <a href="{{route('backend.activity')}}" class="block py-2 text-sm text-gray-500 hover:text-[#5EBEE6] transition-colors relative before:content-[''] before:absolute before:left-[-16px] before:top-1/2 before:-translate-y-1/2 before:w-1.5 before:h-1.5 before:rounded-full before:bg-gray-300 hover:before:bg-[#5EBEE6]">
                    จัดการกิจกรรม
                </a>
                <a href="{{ route('backend.sheets') }}" class="block py-2 text-sm text-gray-500 hover:text-[#5EBEE6] transition-colors relative before:content-[''] before:absolute before:left-[-16px] before:top-1/2 before:-translate-y-1/2 before:w-1.5 before:h-1.5 before:rounded-full before:bg-gray-300 hover:before:bg-[#5EBEE6]">
                    จัดการชีทสรุป
                </a>
                <a href="{{ route('backend.portfolios') }}" class="flex items-center justify-between py-2 text-sm text-gray-500 hover:text-[#5EBEE6] transition-colors relative before:content-[''] before:absolute before:left-[-16px] before:top-1/2 before:-translate-y-1/2 before:w-1.5 before:h-1.5 before:rounded-full before:bg-gray-300 hover:before:bg-[#5EBEE6]">
                    <span>จัดการแฟ้มสะสมผลงาน</span>
                    <span class="bg-orange-100 text-orange-500 py-0.5 px-2 rounded-full text-[10px] font-bold">ใหม่</span>
                </a>
            </div>
        </div>

        <a href="{{ route('backend.users') }}"
            class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-xl text-gray-500 hover:bg-gray-50 hover:text-[#5EBEE6]">
            <i class="fa-solid fa-users w-6"></i> จัดการผู้ใช้
        </a>

        <a href="#"
            class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-xl text-gray-500 hover:bg-gray-50 hover:text-[#5EBEE6]">
            <i class="fa-solid fa-bullhorn w-6"></i> ตั้งค่าโฆษณา
        </a>

        <a href="#"
            class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-xl text-gray-500 hover:bg-gray-50 hover:text-[#5EBEE6]">
            <i class="fa-solid fa-gear w-6"></i> ตั้งค่าระบบ
        </a>

    </nav>

    <div class="p-4 border-t border-gray-50 shrink-0">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="flex items-center w-full px-4 py-3 text-sm font-medium text-red-500 transition-colors rounded-xl hover:bg-red-50">
                <i class="fa-solid fa-right-from-bracket w-6"></i> ออกจากระบบ
            </button>
        </form>
    </div>

</aside>