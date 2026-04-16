@extends('layout')
@section('content')
    <section class="max-w-screen-xl mx-auto py-12 px-6">

        <div class="w-full bg-white rounded-xl p-4 mb-8 flex items-center justify-between border border-gray-100">
            <h3 class="text-gray-400 text-sm md:text-base ml-4 font-medium">อัปโหลดเล่มรายงานของคุณ?</h3>
            <button
                class="bg-[#5EBEE6] hover:bg-[#4fb1d8] text-white px-6 py-2 rounded-xl flex items-center gap-2 transition-all font-medium text-sm shadow-none">
                อัปโหลดรายงาน
                <i class="fa-solid fa-upload"></i>
            </button>
        </div>

        <div class="flex flex-wrap items-center gap-4 mb-8">
            <div class="relative flex-grow max-w-2xl">
                <input type="text" placeholder="ค้นหา Portfolio"
                    class="w-full bg-white border border-gray-100 text-sm rounded-xl px-4 py-3 outline-none focus:ring-1 focus:ring-[#5EBEE6]">
                <button
                    class="absolute right-2 top-1/2 -translate-y-1/2 bg-[#5EBEE6] text-white px-6 py-1.5 rounded-lg text-sm font-medium">
                    ค้นหา
                </button>
            </div>
            <select
                class="bg-white border border-gray-100 text-gray-500 text-sm rounded-xl px-4 py-3 outline-none min-w-[140px]">
                <option>ล่าสุด</option>
                <option>ยอดนิยม</option>
            </select>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <div class="lg:col-span-9 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @for ($i = 0; $i < 12; $i++)
                    <div
                        class="group cursor-pointer bg-white rounded-xl overflow-hidden border border-gray-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:shadow-blue-500/5">
                        <div class="relative h-72 md:h-80 overflow-hidden bg-gray-50">
                            <img src="{{ asset('assets/img/portfolio.png') }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                alt="Portfolio Cover">
                        </div>

                        <div class="p-4 text-left border-t border-gray-50">
                            <div class="flex items-center gap-2 mb-2">
                                <img src="{{ asset('assets/img/avatar.png') }}" class="w-5 h-5 rounded-full object-cover">
                                <span class="text-[10px] text-gray-400 font-medium">จุฬาลงกรณ์มหาวิทยาลัย</span>
                            </div>
                            <h4 class="text-slate-800 text-sm font-medium mb-1 line-clamp-1">นายศรัณยกร เทพสุนทร</h4>
                            <p class="text-gray-400 text-[10px] font-normal leading-relaxed line-clamp-2 mb-3">
                                Portfolio สำหรับเข้าเรียนคณะวิศวกรรมศาสตร์ สาขาวิชาคอมพิวเตอร์
                            </p>
                            <div
                                class="flex items-center justify-between text-[10px] text-gray-400 pt-3 border-t border-gray-50">
                                <div class="flex items-center gap-1">
                                    <i class="fa-solid fa-eye"></i>
                                    <span>2.5k</span>
                                </div>
                                <span class="font-normal">2569</span>
                            </div>
                        </div>
                    </div>
                @endfor

            </div>

            <div class="lg:col-span-3 space-y-6">
                <div class="bg-white border border-gray-100 rounded-xl p-6">
                    <div class="flex items-center gap-3 mb-6 text-[#5EBEE6]">
                        <i class="fa-solid fa-lightbulb text-xl"></i>
                        <h4 class="font-medium text-slate-800">เคล็ดลับ Portfolio ที่ดี</h4>
                    </div>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <span class="text-gray-200 font-medium text-2xl">1</span>
                            <div>
                                <p class="text-xs font-medium text-slate-700 mb-1">ใช้ภาพประกอบชัดเจน</p>
                                <p class="text-[10px] text-gray-400 font-normal leading-relaxed">
                                    ถ่ายรูปผลงานจริงในที่ที่มีแสงเพียงพอ จะช่วยให้พอร์ตดูน่าสนใจขึ้นมาก</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span class="text-gray-200 font-medium text-2xl">2</span>
                            <div>
                                <p class="text-xs font-medium text-slate-700 mb-1">อธิบาย Process</p>
                                <p class="text-[10px] text-gray-400 font-normal leading-relaxed">
                                    เล่าเรื่องราวที่มาที่ไปของผลงาน และบทบาทที่ได้รับในโปรเจกต์</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span class="text-gray-200 font-medium text-2xl">3</span>
                            <div>
                                <p class="text-xs font-medium text-slate-700 mb-1">ระบุเป้าหมาย</p>
                                <p class="text-[10px] text-gray-400 font-normal leading-relaxed">
                                    บอกให้ชัดเจนว่าโปรเจกต์นี้ตั้งใจจะแก้ไขปัญหาอะไร</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span class="text-gray-200 font-medium text-2xl">4</span>
                            <div>
                                <p class="text-xs font-medium text-slate-700 mb-1">แนบลิงก์สาธิต</p>
                                <p class="text-[10px] text-gray-400 font-normal leading-relaxed">ใส่ QR Code
                                    หรือลิงก์วิดีโอเพื่อเพิ่มความน่าเชื่อถือให้พอร์ต</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="flex justify-center items-center mt-12 gap-2">
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 text-xs"><i
                    class="fa-solid fa-angle-left"></i></button>
            <button
                class="w-8 h-8 flex items-center justify-center bg-[#5EBEE6] text-white rounded-lg text-xs font-medium">1</button>
            <button
                class="w-8 h-8 flex items-center justify-center border border-gray-100 text-gray-400 rounded-lg text-xs font-medium hover:bg-gray-50">2</button>
            <button class="w-8 h-8 flex items-center justify-center text-gray-400 text-xs"><i
                    class="fa-solid fa-angle-right"></i></button>
        </div>

    </section>
@endsection
