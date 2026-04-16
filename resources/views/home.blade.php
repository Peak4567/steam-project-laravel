@extends('layout')
@section('content')
    {{-- banner --}}
    <section class="w-full bg-white py-12 px-4 font-mitr">
        <div class="max-w-screen-xl mx-auto">
            <div
                class="relative w-full bg-white border border-gray-100 rounded-xl p-8 md:p-16 flex flex-col md:flex-row items-center justify-between overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.03)]">

                <div class="w-full md:w-1/2 z-10 text-center md:text-left">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-100 rounded-full shadow-sm mb-8">
                        <img src="{{ asset('assets/img/cpw.png') }}" class="w-6 h-6 object-contain"
                            alt="Chonprathanwittaya School">
                        <span class="text-[12px] font-medium text-gray-600">Chonprathanwittaya School</span>
                    </div>

                    <h2 class="text-4xl md:text-5xl text-slate-900 mb-6 tracking-tight">
                        ศูนย์โครงการสตีมคืออะไร?
                    </h2>

                    <p class="text-gray-500 text-base leading-relaxed mb-10 max-w-md">
                        เราคือ STEAM ผู้เชี่ยวชาญด้านการบูรณาการวิทยาศาสตร์ เทคโนโลยี วิศวกรรม ศิลปะ และคณิตศาสตร์
                        พร้อมยกระดับการเรียนรู้สู่ยุคใหม่ ด้วยนวัตกรรมทันสมัย
                    </p>

                    <a href="#"
                        class="inline-block px-10 py-3.5 bg-[#5EBEE6] text-white rounded-2xl hover:bg-[#4fb1d8] transition-all active:scale-95">
                        สมัครสมาชิก
                    </a>
                </div>

                <div class="w-full md:w-1/2 mt-16 md:mt-0 relative flex justify-center items-center p-4">

                    <div class="absolute w-[280px] h-[280px] md:w-[360px] md:h-[360px] bg-[#C6ECFA] rounded-full z-0"></div>

                    <img src="{{ asset('assets/img/adam.png') }}"
                        class="relative z-10 w-[280px] md:w-[350px] object-contain" alt="Person">

                    <div
                        class="absolute top-4 left-0 md:left-4 z-20 bg-white/95 backdrop-blur-sm border border-gray-100 rounded-xl p-3 shadow-lg shadow-black/5 min-w-[130px]">
                        <h4 class="text-[#5EBEE6] text-lg">Analyze</h4>
                        <p class="text-[10px] text-gray-400">คิดวิเคราะห์อย่างเป็นระบบ</p>
                    </div>

                    <div
                        class="absolute top-12 right-0 md:right-8 z-20 bg-white/95 backdrop-blur-sm border border-gray-100 rounded-xl p-3 shadow-lg shadow-black/5 min-w-[130px]">
                        <h4 class="text-[#5EBEE6] text-lg">Develop</h4>
                        <p class="text-[10px] text-gray-400">พัฒนาและลงมือทำจริง</p>
                    </div>

                    <div
                        class="absolute bottom-16 left-0 md:left-8 z-20 bg-white/95 backdrop-blur-sm border border-gray-100 rounded-xl p-3 shadow-lg shadow-black/5 min-w-[130px]">
                        <h4 class="text-[#5EBEE6] text-lg">Master</h4>
                        <p class="text-[10px] text-gray-400">เชี่ยวชาญทักษะแห่งอนาคต</p>
                    </div>

                    <div
                        class="absolute bottom-6 right-0 md:right-12 z-20 bg-white/95 backdrop-blur-sm border border-gray-100 rounded-xl p-3 shadow-lg shadow-black/5 min-w-[130px]">
                        <h4 class="text-[#5EBEE6] text-lg">Apply</h4>
                        <p class="text-[10px] text-gray-400">ประยุกต์ความรู้สู่การแก้ปัญหา</p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- โครงงาน --}}
    <section class="max-w-[1600px] mx-auto py-12 px-6 font-mitr">

        <div class="flex items-center gap-4 mb-10">
            <div class="w-2 h-10 bg-[#5EBEE6] rounded-full"></div>
            <h2 class="text-2xl md:text-3xl text-slate-900">โครงงาน / รายการแข่งขัน</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-5">

            <div class="group cursor-pointer transition-all hover:-translate-y-2">
                <div class="relative h-48 md:h-56 rounded-xl overflow-hidden border border-gray-100 shadow-sm">
                    <img src="{{ asset('assets/img/aerosol.jpg') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="Project">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>

                    <div
                        class="absolute top-3 left-3 bg-black/50 backdrop-blur-sm px-3 py-1 rounded-full border border-white/20">
                        <p class="text-[9px] text-green-400 uppercase tracking-wider">กำลังรับสมัคร</p>
                    </div>

                    <div class="absolute bottom-4 left-4 right-4">
                        <h4 class="text-white text-[11px] leading-tight mb-1 line-clamp-2">
                            โครงงาน : เครื่องเพาะปลูกเพื่อเศรษฐกิจแบบอัจฉริยะด้วยระบบแอโรโพนิกส์
                        </h4>
                        <p class="text-gray-300 text-[9px] line-clamp-1">อาจารย์ที่ปรึกษา : แอดมินสลีปปี้ สเตชั่น</p>
                    </div>
                </div>

                <div class="mt-3 px-2 flex justify-between items-center">
                    <div class="flex items-center gap-1">
                        <span class="text-[10px] text-[#5EBEE6]">จำนวนที่รับ</span>
                        <span class="text-[10px] text-gray-400">4/5 คน</span>
                    </div>
                </div>
            </div>
            <div class="group cursor-pointer transition-all hover:-translate-y-2">
                <div class="relative h-48 md:h-56 rounded-xl overflow-hidden border border-gray-100 shadow-sm">
                    <img src="{{ asset('assets/img/aerosol.jpg') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="Project">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>

                    <div
                        class="absolute top-3 left-3 bg-black/50 backdrop-blur-sm px-3 py-1 rounded-full border border-white/20">
                        <p class="text-[9px] text-green-400 uppercase tracking-wider">กำลังรับสมัคร</p>
                    </div>

                    <div class="absolute bottom-4 left-4 right-4">
                        <h4 class="text-white text-[11px] leading-tight mb-1 line-clamp-2">
                            โครงงาน : เครื่องเพาะปลูกเพื่อเศรษฐกิจแบบอัจฉริยะด้วยระบบแอโรโพนิกส์
                        </h4>
                        <p class="text-gray-300 text-[9px] line-clamp-1">อาจารย์ที่ปรึกษา : แอดมินสลีปปี้ สเตชั่น</p>
                    </div>
                </div>

                <div class="mt-3 px-2 flex justify-between items-center">
                    <div class="flex items-center gap-1">
                        <span class="text-[10px] text-[#5EBEE6]">จำนวนที่รับ</span>
                        <span class="text-[10px] text-gray-400">4/5 คน</span>
                    </div>
                </div>
            </div>
            <div class="group cursor-pointer transition-all hover:-translate-y-2">
                <div class="relative h-48 md:h-56 rounded-xl overflow-hidden border border-gray-100 shadow-sm">
                    <img src="{{ asset('assets/img/aerosol.jpg') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="Project">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>

                    <div
                        class="absolute top-3 left-3 bg-black/50 backdrop-blur-sm px-3 py-1 rounded-full border border-white/20">
                        <p class="text-[9px] text-green-400 uppercase tracking-wider">กำลังรับสมัคร</p>
                    </div>

                    <div class="absolute bottom-4 left-4 right-4">
                        <h4 class="text-white text-[11px] leading-tight mb-1 line-clamp-2">
                            โครงงาน : เครื่องเพาะปลูกเพื่อเศรษฐกิจแบบอัจฉริยะด้วยระบบแอโรโพนิกส์
                        </h4>
                        <p class="text-gray-300 text-[9px] line-clamp-1">อาจารย์ที่ปรึกษา : แอดมินสลีปปี้ สเตชั่น</p>
                    </div>
                </div>

                <div class="mt-3 px-2 flex justify-between items-center">
                    <div class="flex items-center gap-1">
                        <span class="text-[10px] text-[#5EBEE6]">จำนวนที่รับ</span>
                        <span class="text-[10px] text-gray-400">4/5 คน</span>
                    </div>
                </div>
            </div>
            <div class="group cursor-pointer transition-all hover:-translate-y-2">
                <div class="relative h-48 md:h-56 rounded-xl overflow-hidden border border-gray-100 shadow-sm">
                    <img src="{{ asset('assets/img/aerosol.jpg') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="Project">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>

                    <div
                        class="absolute top-3 left-3 bg-black/50 backdrop-blur-sm px-3 py-1 rounded-full border border-white/20">
                        <p class="text-[9px] text-green-400 uppercase tracking-wider">กำลังรับสมัคร</p>
                    </div>

                    <div class="absolute bottom-4 left-4 right-4">
                        <h4 class="text-white text-[11px] leading-tight mb-1 line-clamp-2">
                            โครงงาน : เครื่องเพาะปลูกเพื่อเศรษฐกิจแบบอัจฉริยะด้วยระบบแอโรโพนิกส์
                        </h4>
                        <p class="text-gray-300 text-[9px] line-clamp-1">อาจารย์ที่ปรึกษา : แอดมินสลีปปี้ สเตชั่น</p>
                    </div>
                </div>

                <div class="mt-3 px-2 flex justify-between items-center">
                    <div class="flex items-center gap-1">
                        <span class="text-[10px] text-[#5EBEE6]">จำนวนที่รับ</span>
                        <span class="text-[10px] text-gray-400">4/5 คน</span>
                    </div>
                </div>
            </div>
            <div class="group cursor-pointer transition-all hover:-translate-y-2">
                <div class="relative h-48 md:h-56 rounded-xl overflow-hidden border border-gray-100 shadow-sm">
                    <img src="{{ asset('assets/img/aerosol.jpg') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="Project">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>

                    <div
                        class="absolute top-3 left-3 bg-black/50 backdrop-blur-sm px-3 py-1 rounded-full border border-white/20">
                        <p class="text-[9px] text-green-400 uppercase tracking-wider">กำลังรับสมัคร</p>
                    </div>

                    <div class="absolute bottom-4 left-4 right-4">
                        <h4 class="text-white text-[11px] leading-tight mb-1 line-clamp-2">
                            โครงงาน : เครื่องเพาะปลูกเพื่อเศรษฐกิจแบบอัจฉริยะด้วยระบบแอโรโพนิกส์
                        </h4>
                        <p class="text-gray-300 text-[9px] line-clamp-1">อาจารย์ที่ปรึกษา : แอดมินสลีปปี้ สเตชั่น</p>
                    </div>
                </div>

                <div class="mt-3 px-2 flex justify-between items-center">
                    <div class="flex items-center gap-1">
                        <span class="text-[10px] text-[#5EBEE6]">จำนวนที่รับ</span>
                        <span class="text-[10px] text-gray-400">4/5 คน</span>
                    </div>
                </div>
            </div>
            <div class="group cursor-pointer transition-all hover:-translate-y-2">
                <div class="relative h-48 md:h-56 rounded-xl overflow-hidden border border-gray-100 shadow-sm">
                    <img src="{{ asset('assets/img/aerosol.jpg') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="Project">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>

                    <div
                        class="absolute top-3 left-3 bg-black/50 backdrop-blur-sm px-3 py-1 rounded-full border border-white/20">
                        <p class="text-[9px] text-green-400 uppercase tracking-wider">กำลังรับสมัคร</p>
                    </div>

                    <div class="absolute bottom-4 left-4 right-4">
                        <h4 class="text-white text-[11px] leading-tight mb-1 line-clamp-2">
                            โครงงาน : เครื่องเพาะปลูกเพื่อเศรษฐกิจแบบอัจฉริยะด้วยระบบแอโรโพนิกส์
                        </h4>
                        <p class="text-gray-300 text-[9px] line-clamp-1">อาจารย์ที่ปรึกษา : แอดมินสลีปปี้ สเตชั่น</p>
                    </div>
                </div>

                <div class="mt-3 px-2 flex justify-between items-center">
                    <div class="flex items-center gap-1">
                        <span class="text-[10px] text-[#5EBEE6]">จำนวนที่รับ</span>
                        <span class="text-[10px] text-gray-400">4/5 คน</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ค้นหาโครงงาน --}}
    <section class="w-full bg-[#F9F9F9] py-16 px-4">
        <div class="max-w-screen-xl mx-auto">

            <div
                class="w-full bg-white border border-gray-100 rounded-xl p-10 md:p-16 flex flex-col items-center text-center">

                <h2 class="text-[#5EBEE6] text-3xl md:text-4xl mb-4">
                    กำลังหาโครงงานอยู่ รึเปล่า!!
                </h2>
                <p class="text-gray-600 text-sm md:text-base mb-12 max-w-2xl">
                    ค้นหาไอเดียและโครงงาน STEAM ที่น่าสนใจ พิมพ์สิ่งที่คุณอยากเรียนรู้ แล้วมาเริ่มลงมือทำโปรเจกต์เจ๋งๆ
                    ไปด้วยกัน
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-4xl mb-12">

                    <div
                        class="flex items-center gap-4 p-5 bg-white border border-gray-100 rounded-[1.5rem] transition-all hover:border-[#5EBEE6]/50">
                        <div class="w-12 h-12 flex items-center justify-center bg-gray-50 rounded-xl">
                            <i class="fa-solid fa-laptop text-2xl text-gray-800"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-[10px] text-gray-400 font-medium">ระดับชั้น</p>
                            <p class="text-sm text-gray-700">มัธยมศึกษาปีที่ 1</p>
                        </div>
                    </div>

                    <div
                        class="flex items-center gap-4 p-5 bg-white border border-gray-100 rounded-[1.5rem] transition-all hover:border-[#5EBEE6]/50">
                        <div class="w-12 h-12 flex items-center justify-center bg-gray-50 rounded-xl">
                            <i class="fa-solid fa-book-open-reader text-2xl text-gray-800"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-[10px] text-gray-400 font-medium">คณะ</p>
                            <p class="text-sm text-gray-700">วิทยาศาสตร์</p>
                        </div>
                    </div>

                    <div
                        class="flex items-center gap-4 p-5 bg-white border border-gray-100 rounded-[1.5rem] transition-all hover:border-[#5EBEE6]/50">
                        <div class="w-12 h-12 flex items-center justify-center bg-gray-50 rounded-xl">
                            <i class="fa-solid fa-school text-2xl text-gray-800"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-[10px] text-gray-400 font-medium">สาขา</p>
                            <p class="text-sm text-gray-700">วิทยาการคอมพิวเตอร์</p>
                        </div>
                    </div>

                </div>

                <button
                    class="px-12 py-3.5 bg-[#5EBEE6] text-white rounded-2xl hover:bg-[#4fb1d8] transition-all active:scale-95 mb-6">
                    ดูโครงงานแนะนำ
                </button>

                <p class="text-[13px] text-gray-500">
                    ถ้ายังไม่รู้ว่าอยากต่อคณะไหน <a href="#"
                        class="text-[#5EBEE6] underline decoration-solid">ติดต่อสอบถาม</a>
                </p>

            </div>
        </div>
    </section>

    {{-- STEAM --}}
    <section class="w-full bg-white py-20 px-4 font-mitr">
        <div class="max-w-screen-xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-stretch">

                <div class="md:col-span-6">
                    <div
                        class="h-full bg-white border border-gray-100 rounded-2xl p-10 flex flex-col items-center text-center relative overflow-hidden group hover:border-[#5EBEE6]/30 transition-all duration-500 hover:-translate-y-2">

                        <span
                            class="absolute -top-10 -left-10 text-[20rem] text-[#5EBEE6]/5 opacity-80 group-hover:scale-110 transition-transform duration-700 select-none">S</span>

                        <div class="flex-grow flex items-center justify-center z-10 relative mb-8">
                            <img src="{{ asset('assets/img/adam-labs.png') }}"
                                class="w-full max-w-[320px] h-auto object-contain" alt="Science">
                        </div>

                        <h3 class="text-[#5EBEE6] text-3xl mb-4 z-10 relative">Science</h3>
                        <p class="text-gray-500 text-sm leading-relaxed max-w-sm z-10 relative">
                            จุดเริ่มต้นของการตั้งคำถามและค้นหาคำตอบ สำรวจกฎเกณฑ์ของธรรมชาติ ตั้งแต่สมการฟิสิกส์ที่ควบคุมโลก
                            ไปจนถึงปฏิกิริยาเคมีที่สร้างสิ่งใหม่ๆ ผ่านการทดลองที่คุณพิสูจน์ได้เอง
                        </p>
                    </div>
                </div>

                <div class="md:col-span-6 grid grid-cols-1 sm:grid-cols-2 gap-6">

                    <div
                        class="bg-white border border-gray-100 rounded-xl p-8 flex flex-col h-full group hover:border-[#5EBEE6]/30 transition-all duration-300 hover:-translate-y-1">
                        <span class="text-[5rem] text-[#5EBEE6]/10 mb-[-2rem] mt-[-1rem] select-none">T</span>
                        <h4 class="text-[#5EBEE6] text-xl mb-3">Technology</h4>
                        <p class="text-gray-500 text-[12px] leading-relaxed flex-grow">
                            เปลี่ยนไอเดียให้เป็นระบบ ลุยโลกของการเขียนโปรแกรม พัฒนาเว็บไซต์ และสร้างซอฟต์แวร์
                            เพื่อแก้ปัญหาในโลกยุคดิจิทัล
                        </p>
                    </div>

                    <div
                        class="bg-white border border-gray-100 rounded-xl p-8 flex flex-col h-full group hover:border-[#5EBEE6]/30 transition-all duration-300 hover:-translate-y-1">
                        <span class="text-[5rem] text-[#5EBEE6]/10 mb-[-2rem] mt-[-1rem] select-none">A</span>
                        <h4 class="text-[#5EBEE6] text-xl mb-3">Arts</h4>
                        <p class="text-gray-500 text-[12px] leading-relaxed flex-grow">
                            ผสานความสวยงามเข้ากับฟังก์ชัน ใช้ความคิดสร้างสรรค์ออกแบบประสบการณ์ผู้ใช้ (UI/UX)
                            จนถึงงานออกแบบสถาปัตยกรรมที่น่าทึ่ง
                        </p>
                    </div>

                    <div
                        class="bg-white border border-gray-100 rounded-xl p-8 flex flex-col h-full group hover:border-[#5EBEE6]/30 transition-all duration-300 hover:-translate-y-1">
                        <span class="text-[5rem] text-[#5EBEE6]/10 mb-[-2rem] mt-[-1rem] select-none">E</span>
                        <h4 class="text-[#5EBEE6] text-xl mb-3">Engineering</h4>
                        <p class="text-gray-500 text-[12px] leading-relaxed flex-grow">
                            นำทฤษฎีมาสร้างเป็นชิ้นงานจริง ออกแบบและพัฒนานวัตกรรมอย่างเป็นระบบ เช่น การต่อวงจร
                            หรือสร้างระบบอัตโนมัติ
                        </p>
                    </div>

                    <div
                        class="bg-white border border-gray-100 rounded-xl p-8 flex flex-col h-full group hover:border-[#5EBEE6]/30 transition-all duration-300 hover:-translate-y-1">
                        <span class="text-[5rem] text-[#5EBEE6]/10 mb-[-2rem] mt-[-1rem] select-none">M</span>
                        <h4 class="text-[#5EBEE6] text-xl mb-3">Mathematics</h4>
                        <p class="text-gray-500 text-[12px] leading-relaxed flex-grow">
                            ใช้ตรรกะและตัวเลขแก้ปัญหา ซับซ้อน พัฒนาทักษะการคิดวิเคราะห์ เพื่อสร้างโมเดลคณิตศาสตร์ที่แม่นยำ
                        </p>
                    </div>

                </div>

            </div>
        </div>
    </section>



    {{-- ประกาศประชาสัมพันธ์ --}}
    <section class="max-w-screen-2xl mx-auto py-12 px-6 font-mitr">

        <div class="flex items-center gap-4 mb-10">
            <div class="w-2 h-10 bg-[#5EBEE6] rounded-full"></div>
            <h2 class="text-2xl md:text-3xl text-slate-900">ประกาศ / ข่าวประชาสัมพันธ์</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">

            <div
                class="group cursor-pointer bg-white rounded-xl overflow-hidden border border-gray-100 transition-all hover:-translate-y-2">
                <div class="relative h-32 md:h-40 overflow-hidden">
                    <img src="{{ asset('assets/img/aerosol.jpg') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="News Image">

                    <div class="absolute bottom-2 right-2 bg-black/40 backdrop-blur-md px-2 py-0.5 rounded-md">
                        <p class="text-[8px] text-white font-medium">1 ม.ค. 2569</p>
                    </div>
                </div>

                <div class="bg-[#5EBEE6] p-3">
                    <p class="text-white text-[11px] leading-snug font-medium line-clamp-2">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry
                    </p>
                </div>
            </div>
            <div
                class="group cursor-pointer bg-white rounded-xl overflow-hidden border border-gray-100 transition-all hover:-translate-y-2">
                <div class="relative h-32 md:h-40 overflow-hidden">
                    <img src="{{ asset('assets/img/aerosol.jpg') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="News Image">

                    <div class="absolute bottom-2 right-2 bg-black/40 backdrop-blur-md px-2 py-0.5 rounded-md">
                        <p class="text-[8px] text-white font-medium">1 ม.ค. 2569</p>
                    </div>
                </div>

                <div class="bg-[#5EBEE6] p-3">
                    <p class="text-white text-[11px] leading-snug font-medium line-clamp-2">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry
                    </p>
                </div>
            </div>
            <div
                class="group cursor-pointer bg-white rounded-xl overflow-hidden border border-gray-100 transition-all hover:-translate-y-2">
                <div class="relative h-32 md:h-40 overflow-hidden">
                    <img src="{{ asset('assets/img/aerosol.jpg') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="News Image">

                    <div class="absolute bottom-2 right-2 bg-black/40 backdrop-blur-md px-2 py-0.5 rounded-md">
                        <p class="text-[8px] text-white font-medium">1 ม.ค. 2569</p>
                    </div>
                </div>

                <div class="bg-[#5EBEE6] p-3">
                    <p class="text-white text-[11px] leading-snug font-medium line-clamp-2">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry
                    </p>
                </div>
            </div>
            <div
                class="group cursor-pointer bg-white rounded-xl overflow-hidden border border-gray-100 transition-all hover:-translate-y-2">
                <div class="relative h-32 md:h-40 overflow-hidden">
                    <img src="{{ asset('assets/img/aerosol.jpg') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="News Image">

                    <div class="absolute bottom-2 right-2 bg-black/40 backdrop-blur-md px-2 py-0.5 rounded-md">
                        <p class="text-[8px] text-white font-medium">1 ม.ค. 2569</p>
                    </div>
                </div>

                <div class="bg-[#5EBEE6] p-3">
                    <p class="text-white text-[11px] leading-snug font-medium line-clamp-2">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry
                    </p>
                </div>
            </div>
            <div
                class="group cursor-pointer bg-white rounded-xl overflow-hidden border border-gray-100 transition-all hover:-translate-y-2">
                <div class="relative h-32 md:h-40 overflow-hidden">
                    <img src="{{ asset('assets/img/aerosol.jpg') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="News Image">

                    <div class="absolute bottom-2 right-2 bg-black/40 backdrop-blur-md px-2 py-0.5 rounded-md">
                        <p class="text-[8px] text-white font-medium">1 ม.ค. 2569</p>
                    </div>
                </div>

                <div class="bg-[#5EBEE6] p-3">
                    <p class="text-white text-[11px] leading-snug font-medium line-clamp-2">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry
                    </p>
                </div>
            </div>
            <div
                class="group cursor-pointer bg-white rounded-xl overflow-hidden border border-gray-100 transition-all hover:-translate-y-2">
                <div class="relative h-32 md:h-40 overflow-hidden">
                    <img src="{{ asset('assets/img/aerosol.jpg') }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="News Image">

                    <div class="absolute bottom-2 right-2 bg-black/40 backdrop-blur-md px-2 py-0.5 rounded-md">
                        <p class="text-[8px] text-white font-medium">1 ม.ค. 2569</p>
                    </div>
                </div>

                <div class="bg-[#5EBEE6] p-3">
                    <p class="text-white text-[11px] leading-snug font-medium line-clamp-2">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
