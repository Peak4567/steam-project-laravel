<nav class="w-full md:w-60 bg-white rounded-2xl p-4 shadow-[0_8px_30px_rgba(0,0,0,0.02)] border border-slate-100/50 sticky top-12 font-mitr transition-all">

    {{-- ส่วนหัวเมนูข้าง --}}
    <div class="px-2 mb-5">
        <span class="inline-block text-[#5EBEE6] text-[10px] font-bold uppercase tracking-[0.15em] mb-0.5">Account Menu</span>
        <h2 class="text-base font-extrabold text-slate-800 tracking-tight">รายละเอียดบัญชี</h2>
    </div>

    {{-- รายการเมนูลิงก์ --}}
    <div class="space-y-1">

        {{-- โปรไฟล์ --}}
        <a href="{{ route('profile') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all group duration-300 {{ Route::is('profile') ? 'bg-[#5EBEE6]/10 text-slate-900 font-bold' : 'text-slate-500 hover:bg-slate-50/80 hover:text-[#5EBEE6] hover:translate-x-1' }}">
            <div class="w-5 flex justify-center">
                <i class="fa-solid fa-circle-user text-base {{ Route::is('profile') ? 'text-[#5EBEE6]' : 'text-slate-400 group-hover:text-[#5EBEE6]' }} transition-colors"></i>
            </div>
            <span class="text-sm tracking-wide {{ Route::is('profile') ? '' : 'font-medium opacity-90' }}">โปรไฟล์</span>
        </a>

        {{-- โครงงาน --}}
        <a href="{{ route('profile.projects') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all group duration-300 {{ Route::is('profile.projects') ? 'bg-[#5EBEE6]/10 text-slate-900 font-bold' : 'text-slate-500 hover:bg-slate-50/80 hover:text-[#5EBEE6] hover:translate-x-1' }}">
            <div class="w-5 flex justify-center">
                <i class="fa-solid fa-screwdriver-wrench text-base {{ Route::is('profile.projects') ? 'text-[#5EBEE6]' : 'text-slate-400 group-hover:text-[#5EBEE6]' }} transition-colors"></i>
            </div>
            <span class="text-sm tracking-wide {{ Route::is('profile.projects') ? '' : 'font-medium opacity-90' }}">โครงงาน</span>
        </a>

        {{-- เล่มรายงาน --}}
        <a href="{{ route('projects.reports') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all group duration-300 {{ Route::is('projects.reports') ? 'bg-[#5EBEE6]/10 text-slate-900 font-bold' : 'text-slate-500 hover:bg-slate-50/80 hover:text-[#5EBEE6] hover:translate-x-1' }}">
            <div class="w-5 flex justify-center">
                <i class="fa-solid fa-file-contract text-base {{ Route::is('projects.reports') ? 'text-[#5EBEE6]' : 'text-slate-400 group-hover:text-[#5EBEE6]' }} transition-colors"></i>
            </div>
            <span class="text-sm tracking-wide {{ Route::is('projects.reports') ? '' : 'font-medium opacity-90' }}">เล่มรายงาน</span>
        </a>

        {{-- ชีทสรุป --}}
        <a href="{{ route('profile.sheets') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all group duration-300 {{ Route::is('profile.sheets') ? 'bg-[#5EBEE6]/10 text-slate-900 font-bold' : 'text-slate-500 hover:bg-slate-50/80 hover:text-[#5EBEE6] hover:translate-x-1' }}">
            <div class="w-5 flex justify-center">
                <i class="fa-solid fa-book-open text-base {{ Route::is('profile.sheets') ? 'text-[#5EBEE6]' : 'text-slate-400 group-hover:text-[#5EBEE6]' }} transition-colors"></i>
            </div>
            <span class="text-sm tracking-wide {{ Route::is('profile.sheets') ? '' : 'font-medium opacity-90' }}">ชีทสรุป</span>
        </a>

        {{-- พอร์ตโฟลิโอ --}}
        <a href="{{ route('profile.portfolio') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all group duration-300 {{ Route::is('portfolio') ? 'bg-[#5EBEE6]/10 text-slate-900 font-bold' : 'text-slate-500 hover:bg-slate-50/80 hover:text-[#5EBEE6] hover:translate-x-1' }}">
            <div class="w-5 flex justify-center">
                <i class="fa-solid fa-suitcase text-base {{ Route::is('portfolio') ? 'text-[#5EBEE6]' : 'text-slate-400 group-hover:text-[#5EBEE6]' }} transition-colors"></i>
            </div>
            <span class="text-sm tracking-wide {{ Route::is('portfolio') ? '' : 'font-medium opacity-90' }}">พอร์ตโฟลิโอ</span>
        </a>

    </div>

    {{-- Widget ช่วยเหลือด้านล่าง --}}
    <div class="mt-6 p-3.5 bg-slate-50/70 rounded-xl border border-slate-100/50">
        <p class="text-[9px] text-slate-400 uppercase font-bold tracking-widest mb-1">Support</p>
        <p class="text-[12px] text-slate-500 font-medium leading-normal">
            พบปัญหาการใช้งานระบบ? <br>
            <a href="#" class="text-[#5EBEE6] hover:text-[#45a8d1] font-bold inline-flex items-center gap-1 mt-0.5 group/link">
                ติดต่อแอดมิน 
                <i class="fa-solid fa-arrow-right text-[9px] transform group-hover/link:translate-x-0.5 transition-transform"></i>
            </a>
        </p>
    </div>
</nav>