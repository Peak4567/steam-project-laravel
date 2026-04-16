@extends('layout')
@section('content')
    <section class="max-w-screen-xl mx-auto py-12 px-6 font-mitr bg-white">

        <div
            class="w-full bg-white border border-gray-100 rounded-xl p-6 flex flex-col md:flex-row gap-8 mb-16 items-center">
            <div class="w-full md:w-2/5 h-64 md:h-80 overflow-hidden rounded-md">
                <img src="{{ asset('assets/img/aerosol.jpg') }}" class="w-full h-full object-cover" alt="Hero Event">
            </div>
            <div class="w-full md:w-3/5 text-left">
                <span
                    class="px-4 py-1.5 bg-[#5EBEE6]/10 text-[#5EBEE6] rounded-full text-xs mb-4 inline-block">Coding
                    & Robot</span>
                <h2 class="text-2xl md:text-3xl text-slate-900 mb-4">Python Coding & Creative Work Shop</h2>
                <p class="text-gray-400 text-sm mb-6 leading-relaxed">
                    เรียนรู้การเขียนโปรแกรม Python สำหรับงานอุตสาหกรรมและปฏิบัติการผ่านระบบสมาร์ทฟาร์ม Python
                </p>
                <div class="grid grid-cols-2 gap-y-3 mb-8">
                    <div class="flex items-center gap-2 text-slate-600 text-[13px]"><i
                            class="fa-regular fa-calendar text-[#5EBEE6]"></i> 15 เมษายน 2569</div>
                    <div class="flex items-center gap-2 text-slate-600 text-[13px]"><i
                            class="fa-regular fa-clock text-[#5EBEE6]"></i> 09.00 - 17.00</div>
                    <div class="flex items-center gap-2 text-slate-600 text-[13px]"><i
                            class="fa-solid fa-location-dot text-[#5EBEE6]"></i> โรงเรียนชลประทานวิทยา</div>
                    <div class="flex items-center gap-2 text-slate-600 text-[13px]"><i
                            class="fa-solid fa-user-group text-[#5EBEE6]"></i> รับทั้งหมด 10/30 คน</div>
                </div>
                <button
                    class="px-8 py-2.5 border border-[#5EBEE6] text-[#5EBEE6] rounded-xl text-sm hover:bg-[#5EBEE6] hover:text-white transition-all">สมัครเข้าร่วม</button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start mb-16">

            <div class="lg:col-span-8">
                <div class="flex justify-between items-center mb-8 px-2">
                    <div class="flex items-center gap-3">
                        <div class="w-1.5 h-7 bg-[#5EBEE6] rounded-full"></div>
                        <h3 class="text-xl text-slate-900">กิจกรรมทั้งหมด</h3>
                    </div>
                    <a href="#" class="text-[#5EBEE6] text-sm font-medium hover:underline">ดูเพิ่มเติม</a>
                </div>

                <div class="space-y-4">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="w-full bg-white border border-gray-100 rounded-[1.8rem] p-4 flex gap-5 items-center">
                            <div class="w-32 h-32 md:w-40 md:h-40 flex-shrink-0 rounded-[1.2rem] overflow-hidden">
                                <img src="{{ asset('assets/img/aerosol.jpg') }}" class="w-full h-full object-cover"
                                    alt="Event">
                            </div>
                            <div class="flex-grow text-left">
                                <h4 class="text-lg text-slate-800 mb-3">Astronomy Night: ชมดาวและกาแล็กซี</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-4">
                                    <div class="flex items-center gap-2 text-slate-500 text-[11px] font-medium"><i
                                            class="fa-regular fa-calendar text-[#5EBEE6]"></i> 18 เมษายน 2569</div>
                                    <div class="flex items-center gap-2 text-slate-500 text-[11px] font-medium"><i
                                            class="fa-regular fa-clock text-[#5EBEE6]"></i> 09.00 - 17.00</div>
                                    <div class="flex items-center gap-2 text-slate-500 text-[11px] font-medium"><i
                                            class="fa-solid fa-location-dot text-[#5EBEE6]"></i> โรงเรียนชลประทานวิทยา</div>
                                    <div class="flex items-center gap-2 text-slate-500 text-[11px] font-medium"><i
                                            class="fa-solid fa-user-group text-[#5EBEE6]"></i> รับทั้งหมด 10/30 คน</div>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <button
                                    class="px-6 py-2 border border-[#5EBEE6] text-[#5EBEE6] rounded-xl text-xs hover:bg-[#5EBEE6] hover:text-white transition-all">สมัครเข้าร่วม</button>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="lg:col-span-4 space-y-8">
                <div class="bg-white border border-gray-100 rounded-xl overflow-hidden">
                    <div class="bg-[#5EBEE6] p-4 text-white flex justify-between items-center px-6">
                        <i class="fa-regular fa-calendar-days"></i>
                        <span class="text-sm">ปฏิทินกิจกรรม</span>
                        <div></div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6 px-2">
                            <button class="text-gray-400"><i class="fa-solid fa-angle-left"></i></button>
                            <span class="text-slate-700 text-sm">MAR 2026</span>
                            <button class="text-gray-400"><i class="fa-solid fa-angle-right"></i></button>
                        </div>
                        <div class="grid grid-cols-7 gap-1 text-center text-[10px] text-gray-400 mb-2">
                            <span>SUN</span><span>MON</span><span>TUE</span><span>WED</span><span>THU</span><span>FRI</span><span>SAT</span>
                        </div>
                        <div class="grid grid-cols-7 gap-1 text-center">
                            @for ($d = 1; $d <= 31; $d++)
                                <div
                                    class="py-2 text-[11px] {{ in_array($d, [15, 18, 24]) ? 'bg-[#FFB917] text-white rounded-lg' : 'text-slate-600' }}">
                                    {{ $d }}
                                </div>
                            @endfor
                        </div>
                        <div class="mt-6 flex gap-4 text-[10px]">
                            <div class="flex items-center gap-1">
                                <div class="w-2 h-2 rounded-full bg-[#5EBEE6]"></div> วันนี้
                            </div>
                            <div class="flex items-center gap-1">
                                <div class="w-2 h-2 rounded-full bg-[#FFB917]"></div> มีกิจกรรมขึ้น
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-100 rounded-[2rem] p-8 text-center">
                    <div class="flex items-center gap-2 justify-center mb-8 text-[#5EBEE6]">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>สถิติกิจกรรม</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-5 border border-gray-50 rounded-2xl">
                            <p class="text-3xl text-slate-800 mb-1">20</p>
                            <p class="text-[10px] text-gray-400 uppercase">กิจกรรมทั้งหมด</p>
                        </div>
                        <div class="p-5 border border-gray-50 rounded-2xl">
                            <p class="text-3xl text-slate-800 mb-1">20</p>
                            <p class="text-[10px] text-gray-400 uppercase">ผู้เข้าร่วม</p>
                        </div>
                        <div class="p-5 border border-gray-50 rounded-2xl">
                            <p class="text-3xl text-slate-800 mb-1">20</p>
                            <p class="text-[10px] text-gray-400 uppercase">วิทยากร</p>
                        </div>
                        <div class="p-5 border border-gray-50 rounded-2xl">
                            <p class="text-3xl text-slate-800 mb-1">20</p>
                            <p class="text-[10px] text-gray-400 uppercase">สาขาวิชา</p>
                        </div>
                    </div>
                    <div class="mt-8">
                        <p class="text-xs text-gray-400">เมื่อพบปัญหา <a href="#"
                                class="text-red-400 underline decoration-solid">ติดต่อสอบถาม</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-2">
            <div class="flex items-center gap-3 mb-10">
                <div class="w-1.5 h-7 bg-[#5EBEE6] rounded-full"></div>
                <h3 class="text-xl text-slate-900">ภาพกิจกรรมที่ผ่านมา</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-4">
                <div class="lg:col-span-5 h-[400px] rounded-[2rem] overflow-hidden">
                    <img src="{{ asset('assets/img/aerosol.jpg') }}" class="w-full h-full object-cover"
                        alt="Past Event">
                </div>
                <div class="lg:col-span-7 grid grid-cols-2 gap-4 h-[400px]">
                    <div class="rounded-[2rem] overflow-hidden"><img src="{{ asset('assets/img/aerosol.jpg') }}"
                            class="w-full h-full object-cover"></div>
                    <div class="rounded-[2rem] overflow-hidden"><img src="{{ asset('assets/img/aerosol.jpg') }}"
                            class="w-full h-full object-cover"></div>
                    <div class="rounded-[2rem] overflow-hidden"><img src="{{ asset('assets/img/aerosol.jpg') }}"
                            class="w-full h-full object-cover"></div>
                    <div class="rounded-[2rem] overflow-hidden"><img src="{{ asset('assets/img/aerosol.jpg') }}"
                            class="w-full h-full object-cover"></div>
                </div>
            </div>
        </div>

    </section>
@endsection
