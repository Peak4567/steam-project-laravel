<nav class="w-full md:w-60 bg-white rounded-lg p-4 shadow-sm border border-gray-100 sticky top-12">

    <div class="px-2 mb-6">
        <h2 class="text-base font-bold text-slate-800 tracking-tight">รายละเอียด</h2>
        <div class="w-8 h-0.5 bg-[#5EBEE6] rounded-full mt-1"></div>
    </div>
    <div class="space-y-1">

        <a href="{{ route('profile') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all group {{ Route::is('profile') ? 'bg-[#5EBEE6]/10 text-[#5EBEE6]' : 'text-slate-500 hover:bg-gray-50' }}">
            <div class="w-5 flex justify-center">
                <i class="fa-solid fa-circle-user text-base {{ Route::is('profile') ? 'text-[#5EBEE6]' : 'text-gray-400 group-hover:text-slate-600' }} transition-colors"></i>
            </div>
            <span class="text-sm tracking-wide {{ Route::is('profile') ? 'font-medium' : 'font-normal group-hover:font-medium group-hover:text-slate-700' }}">โปรไฟล์</span>
        </a>

        <a href="{{ route('profile.projects') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all group {{ Route::is('profile.projects') ? 'bg-[#5EBEE6]/10 text-[#5EBEE6]' : 'text-slate-500 hover:bg-gray-50' }}">
            <div class="w-5 flex justify-center">
                <i class="fa-solid fa-screwdriver-wrench text-base {{ Route::is('profile.projects') ? 'text-[#5EBEE6]' : 'text-gray-400 group-hover:text-slate-600' }} transition-colors"></i>
            </div>
            <span class="text-sm tracking-wide {{ Route::is('profile.projects') ? 'font-medium' : 'font-normal group-hover:font-medium group-hover:text-slate-700' }}">โครงงาน</span>
        </a>

        <a href="{{ route('projects.reports') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all group {{ Route::is('projects.reports') ? 'bg-[#5EBEE6]/10 text-[#5EBEE6]' : 'text-slate-500 hover:bg-gray-50' }}">
            <div class="w-5 flex justify-center">
                <i class="fa-solid fa-file-contract text-base {{ Route::is('projects.reports') ? 'text-[#5EBEE6]' : 'text-gray-400 group-hover:text-slate-600' }} transition-colors"></i>
            </div>
            <span class="text-sm tracking-wide {{ Route::is('projects.reports') ? 'font-medium' : 'font-normal group-hover:font-medium group-hover:text-slate-700' }}">เล่มรายงาน</span>
        </a>

        <a href="{{ route('profile.sheets') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all group {{ Route::is('profile.sheets') ? 'bg-[#5EBEE6]/10 text-[#5EBEE6]' : 'text-slate-500 hover:bg-gray-50' }}">
            <div class="w-5 flex justify-center">
                <i class="fa-solid fa-book-open text-base {{ Route::is('profile.sheets') ? 'text-[#5EBEE6]' : 'text-gray-400 group-hover:text-slate-600' }} transition-colors"></i>
            </div>
            <span class="text-sm tracking-wide {{ Route::is('profile.sheets') ? 'font-medium' : 'font-normal group-hover:font-medium group-hover:text-slate-700' }}">ชีทสรุป</span>
        </a>

        <a href="{{ route('profile.portfolio') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all group {{ Route::is('portfolio') ? 'bg-[#5EBEE6]/10 text-[#5EBEE6]' : 'text-slate-500 hover:bg-gray-50' }}">
            <div class="w-5 flex justify-center">
                <i class="fa-solid fa-suitcase text-base {{ Route::is('portfolio') ? 'text-[#5EBEE6]' : 'text-gray-400 group-hover:text-slate-600' }} transition-colors"></i>
            </div>
            <span class="text-sm tracking-wide {{ Route::is('portfolio') ? 'font-medium' : 'font-normal group-hover:font-medium group-hover:text-slate-700' }}">พอร์ตโฟลิโอ</span>
        </a>

    </div>
    <div class="mt-8 p-3 bg-gray-50 rounded-xl border border-gray-100">
        <p class="text-[9px] text-gray-400 uppercase font-bold tracking-widest mb-1">ช่วยเหลือ</p>
        <p class="text-[12px] text-slate-500 font-normal leading-tight">
            พบปัญหาการใช้งาน <br>
            <a href="#" class="text-[#5EBEE6] hover:underline font-medium">ติดต่อแอดมิน</a>
        </p>
    </div>
</nav>