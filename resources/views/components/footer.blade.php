<footer class="w-full bg-[#333333] pt-16 pb-8 px-4 md:px-6 font-mitr text-white border-t border-white/5 relative overflow-hidden">

    {{-- Top accent line --}}
    <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-[#5EBEE6]/60 to-transparent"></div>

    {{-- Decorative subtle background elements --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-[#5EBEE6]/[0.04] rounded-full blur-3xl transform translate-x-1/3 -translate-y-1/2 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-[#5EBEE6]/[0.03] rounded-full blur-3xl transform -translate-x-1/3 translate-y-1/2 pointer-events-none"></div>
    <div class="absolute inset-0 opacity-[0.4] [background-image:radial-gradient(rgba(255,255,255,0.04)_1px,transparent_1px)] [background-size:26px_26px] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,black_10%,transparent_75%)] pointer-events-none"></div>

    <div class="max-w-6xl mx-auto relative z-10">

        {{-- Newsletter CTA --}}
        <div class="w-full bg-white/[0.03] border border-white/10 rounded-3xl p-6 md:p-8 mb-14 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="text-center md:text-left">
                <h3 class="text-lg md:text-xl font-bold text-white mb-1.5 flex items-center justify-center md:justify-start gap-2">
                    <i class="fa-solid fa-paper-plane text-[#5EBEE6] text-base"></i> รับข่าวสารโครงงาน STEAM ก่อนใคร
                </h3>
                <p class="text-gray-400 text-sm">สมัครรับจดหมายข่าว อัปเดตกิจกรรมและโครงงานใหม่ๆ ทุกเดือน</p>
            </div>
            <form class="w-full md:w-auto flex flex-col sm:flex-row items-center gap-2.5">
                <input type="email" placeholder="อีเมลของคุณ"
                    class="w-full sm:w-64 px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-sm text-white placeholder:text-gray-500 focus:outline-none focus:border-[#5EBEE6]/60 focus:bg-white/[0.07] transition-all">
                <button type="submit"
                    class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-[#5EBEE6] to-[#3B9ADE] text-white text-sm font-medium rounded-xl hover:shadow-lg hover:shadow-[#5EBEE6]/20 hover:-translate-y-0.5 transition-all active:scale-95 shrink-0">
                    สมัครรับข่าว
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 lg:gap-8 mb-10">
            {{-- 1. Brand & Description --}}
            <div class="lg:col-span-5 flex flex-col items-center md:items-start text-center md:text-left">
                <img src="{{ asset('assets/img/steam-logo-white.png') }}" alt="STEAM Logo" class="h-10 md:h-12 w-auto mb-6 opacity-90 hover:opacity-100 transition-opacity duration-300">
                <p class="text-gray-400 text-sm md:text-base leading-relaxed max-w-sm mb-6">
                    {{ $globalSettings['footer_description'] ?? 'จุดประกายไอเดีย เริ่มต้นสร้างโครงงาน STEAM ของคุณที่นี่ แหล่งเรียนรู้นวัตกรรมและเทคโนโลยีเพื่ออนาคตสำหรับเยาวชนไทย' }}
                </p>
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-white/5 border border-white/10 rounded-full">
                    <span class="relative flex h-1.5 w-1.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#5EBEE6] opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-[#5EBEE6]"></span>
                    </span>
                    <span class="text-[11px] text-gray-400 font-medium">Chonprathanwittaya School</span>
                </div>
            </div>

            {{-- 2. Quick Links --}}
            <div class="lg:col-span-3">
                <h4 class="text-white text-lg font-bold mb-6 tracking-wide flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-[#5EBEE6] shadow-[0_0_8px_#5EBEE6]"></span> เมนู
                </h4>
                <ul class="space-y-3.5">
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white text-sm font-medium transition-all duration-300 hover:translate-x-1.5 flex items-center gap-2 group">
                            <i class="fa-solid fa-angle-right text-[#5EBEE6] text-[10px] opacity-0 group-hover:opacity-100 transition-all duration-300 -ml-3 group-hover:ml-0"></i>
                            หน้าหลัก
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white text-sm font-medium transition-all duration-300 hover:translate-x-1.5 flex items-center gap-2 group">
                            <i class="fa-solid fa-angle-right text-[#5EBEE6] text-[10px] opacity-0 group-hover:opacity-100 transition-all duration-300 -ml-3 group-hover:ml-0"></i>
                            โครงงานทั้งหมด
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white text-sm font-medium transition-all duration-300 hover:translate-x-1.5 flex items-center gap-2 group">
                            <i class="fa-solid fa-angle-right text-[#5EBEE6] text-[10px] opacity-0 group-hover:opacity-100 transition-all duration-300 -ml-3 group-hover:ml-0"></i>
                            กิจกรรมข่าวสาร
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white text-sm font-medium transition-all duration-300 hover:translate-x-1.5 flex items-center gap-2 group">
                            <i class="fa-solid fa-angle-right text-[#5EBEE6] text-[10px] opacity-0 group-hover:opacity-100 transition-all duration-300 -ml-3 group-hover:ml-0"></i>
                            แฟ้มผลงาน
                        </a>
                    </li>
                </ul>
            </div>

            {{-- 3. Contact & Socials --}}
            <div class="lg:col-span-4 flex flex-col">
                <h4 class="text-white text-lg font-bold mb-6 tracking-wide flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-[#5EBEE6] shadow-[0_0_8px_#5EBEE6]"></span> ติดต่อเรา
                </h4>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start gap-4 text-gray-400 text-sm group">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-white/10 to-white/5 flex items-center justify-center shrink-0 border border-white/5 group-hover:border-[#5EBEE6]/40 group-hover:from-[#5EBEE6]/20 transition-all duration-300">
                            <i class="fa-solid fa-location-dot text-[#5EBEE6]"></i>
                        </div>
                        <span class="mt-1.5 leading-relaxed">โรงเรียนชลประทานวิทยา <br>อ.ปากเกร็ด จ.นนทบุรี 11120</span>
                    </li>
                    <li class="flex items-center gap-4 text-gray-400 text-sm group">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-white/10 to-white/5 flex items-center justify-center shrink-0 border border-white/5 group-hover:border-[#5EBEE6]/40 group-hover:from-[#5EBEE6]/20 transition-all duration-300">
                            <i class="fa-solid fa-envelope text-[#5EBEE6]"></i>
                        </div>
                        <span class="font-medium">contact@steamproject.in.th</span>
                    </li>
                </ul>
                {{-- Social Icons --}}
                <div class="flex items-center gap-3">
                    <a href="#"
                        class="w-10 h-10 bg-white/10 border border-white/5 rounded-full flex items-center justify-center text-gray-300 hover:text-white hover:bg-[#5EBEE6] hover:border-[#5EBEE6] hover:-translate-y-1 hover:shadow-lg hover:shadow-[#5EBEE6]/20 transition-all duration-300">
                        <i class="fa-brands fa-instagram text-base"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 bg-white/10 border border-white/5 rounded-full flex items-center justify-center text-gray-300 hover:text-white hover:bg-[#1877F2] hover:border-[#1877F2] hover:-translate-y-1 hover:shadow-lg hover:shadow-[#1877F2]/20 transition-all duration-300">
                        <i class="fa-brands fa-facebook-f text-base"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 bg-white/10 border border-white/5 rounded-full flex items-center justify-center text-gray-300 hover:text-white hover:bg-[#FF0000] hover:border-[#FF0000] hover:-translate-y-1 hover:shadow-lg hover:shadow-[#FF0000]/20 transition-all duration-300">
                        <i class="fa-brands fa-youtube text-base"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Bottom bar: legal links + copyright + back to top --}}
        <div class="border-t border-white/10 pt-6 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-gray-500 text-[13px] font-medium flex items-center justify-center gap-1.5 flex-wrap order-2 md:order-1">
                {{ $globalSettings['footer_credit'] ?? '© 2026 Steam Project. All rights reserved.' }}
            </p>

            <div class="flex items-center gap-5 order-1 md:order-2">
                <a href="{{route('privacy')}}" class="text-gray-400 hover:text-[#5EBEE6] text-[13px] font-medium transition-colors">Privacy Policy</a>
                <span class="w-1 h-1 rounded-full bg-gray-600 hidden md:block"></span>
                <a href="{{route('terms')}}" class="text-gray-400 hover:text-[#5EBEE6] text-[13px] font-medium transition-colors">Terms of Service</a>
                <button type="button" onclick="window.scrollTo({top:0,behavior:'smooth'})"
                    class="w-9 h-9 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:text-white hover:bg-[#5EBEE6] hover:border-[#5EBEE6] transition-all duration-300 shrink-0">
                    <i class="fa-solid fa-arrow-up text-xs"></i>
                </button>
            </div>
        </div>
    </div>
</footer>