<footer class="w-full bg-[#333333] pt-16 pb-8 px-6 font-mitr text-white">
    <div class="max-w-screen-xl mx-auto">

        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-16">

            <div class="md:col-span-5">
                <img src="{{ asset('assets/img/steam-logo.png') }}" alt="STEAM Logo" class="h-12 w-auto mb-6">
                <p class="text-gray-400 text-sm leading-relaxed max-w-sm mb-8">
                    จุดประกายไอเดีย เริ่มต้นสร้างโครงงาน STEAM ของคุณที่นี่
                    แหล่งเรียนรู้นวัตกรรมและเทคโนโลยีเพื่ออนาคตสำหรับเยาวชนไทย
                </p>

                <div class="flex items-center gap-4">
                    <a href="#"
                        class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-[#5EBEE6] hover:-translate-y-1 transition-all duration-300">
                        <i class="fa-brands fa-instagram text-lg"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-[#1877F2] hover:-translate-y-1 transition-all duration-300">
                        <i class="fa-brands fa-facebook-f text-lg"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-[#FF0000] hover:-translate-y-1 transition-all duration-300">
                        <i class="fa-brands fa-youtube text-lg"></i>
                    </a>
                </div>
            </div>

            <div class="md:col-span-3">
                <h4 class="text-lg mb-6 border-b border-white/10 pb-2 inline-block">เมนู</h4>
                <ul class="space-y-4">
                    <li><a href="#"
                            class="text-gray-400 hover:text-[#5EBEE6] text-sm transition-colors">หน้าหลัก</a></li>
                    <li><a href="#"
                            class="text-gray-400 hover:text-[#5EBEE6] text-sm transition-colors">โครงงานทั้งหมด</a></li>
                    <li><a href="#"
                            class="text-gray-400 hover:text-[#5EBEE6] text-sm transition-colors">กิจกรรมข่าวสาร</a></li>
                    <li><a href="#"
                            class="text-gray-400 hover:text-[#5EBEE6] text-sm transition-colors">แฟ้มผลงาน</a></li>
                </ul>
            </div>

            <div class="md:col-span-4">
                <h4 class="text-lg mb-6 border-b border-white/10 pb-2 inline-block">ติดต่อเรา</h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-gray-400 text-sm">
                        <i class="fa-solid fa-location-dot mt-1 text-[#5EBEE6]"></i>
                        <span>โรงเรียนชลประทานวิทยา <br>อ.ปากเกร็ด จ.นนทบุรี 11120</span>
                    </li>
                    <li class="flex items-center gap-3 text-gray-400 text-sm">
                        <i class="fa-solid fa-envelope text-[#5EBEE6]"></i>
                        <span>contact@steamproject.in.th</span>
                    </li>
                </ul>
            </div>

        </div>

        <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-gray-500 text-[12px]">
                © 2026 <span class="text-gray-400">Steam Project.</span> All rights reserved.
            </p>
            <div class="flex gap-6">
                <a href="{{route('privacy')}}" class="text-gray-500 hover:text-gray-400 text-[12px]">Privacy Policy</a>
                <a href="{{route('terms')}}" class="text-gray-500 hover:text-gray-400 text-[12px]">Terms of Service</a>
            </div>
        </div>

    </div>
</footer>
