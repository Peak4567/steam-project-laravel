@extends('layout')
@section('content')
    <section class="max-w-screen-xl mx-auto py-12 px-6">

        <div class="w-full bg-white rounded-xl p-4 mb-8 flex items-center justify-between border border-gray-100">
            <h3 class="text-gray-400 text-sm md:text-base ml-4 font-medium">อัปโหลดชีทสรุปของคุณ?</h3>
            <button
                class="bg-[#5EBEE6] hover:bg-[#4fb1d8] text-white px-6 py-2 rounded-xl flex items-center gap-2 transition-all font-medium text-sm shadow-none">
                อัปโหลดชีทสรุป
                <i class="fa-solid fa-upload"></i>
            </button>
        </div>

        <div class="flex flex-wrap items-center gap-4 mb-8">
            <div class="relative flex-grow max-w-2xl">
                <input type="text" placeholder="ค้นหาชีทสรุป"
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

        <div class="flex items-center gap-3 mb-10">
            <button class="px-8 py-2 bg-[#5EBEE6] text-white rounded-full font-medium text-sm shadow-none">ทั้งหมด</button>
            <button
                class="px-8 py-2 bg-white border border-gray-100 text-gray-400 rounded-full font-medium text-sm hover:bg-gray-50 transition-all">กลางภาค</button>
            <button
                class="px-8 py-2 bg-white border border-gray-100 text-gray-400 rounded-full font-medium text-sm hover:bg-gray-50 transition-all">ปลายภาค</button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8 bg-white border border-gray-100 rounded-xl p-8">
                <div class="flex justify-between items-center mb-6">
                    <h4 class="text-slate-800 font-medium text-lg">คลังชีทสรุป</h4>
                    <span class="text-xs text-gray-400 font-normal">แสดง 10 รายการ</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-gray-400 text-[13px] border-b border-gray-50">
                                <th class="pb-4 font-normal">หมวดหมู่</th>
                                <th class="pb-4 font-normal">วิชา</th>
                                <th class="pb-4 font-normal">ชื่อชีทสรุป</th>
                                <th class="pb-4 font-normal">ระดับชั้น</th>
                                <th class="pb-4 font-normal text-right">วันที่</th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-600 text-sm">
                            @for ($i = 0; $i < 8; $i++)
                                <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                                    <td class="py-5">
                                        <span class="bg-[#D1EFFF] text-[#5EBEE6] px-4 py-1 rounded-lg text-[11px] font-medium uppercase">ไฟล์</span>
                                    </td>
                                    <td class="py-5 font-normal text-slate-700">คณิตศาสตร์ <br>
                                        <span class="text-[10px] text-gray-400 font-normal">กลางภาค (โดย แอดมิน...)</span>
                                    </td>
                                    <td class="py-5">
                                        <p class="font-medium text-slate-700">ตรีโกณมิติและมิติสัมพันธ์</p>
                                        <p class="text-[10px] text-gray-400 font-normal">สายงานค่า SIN COS TAN และวงกลม 1 หน่วย</p>
                                    </td>
                                    <td class="py-5 font-normal">ม. 5</td>
                                    <td class="py-5 text-right text-xs text-gray-400">16/4/69</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-between items-center mt-8">
                    <span class="text-[11px] text-gray-400">แสดง 1-10 จาก 15</span>
                    <div class="flex gap-2">
                        <button class="w-8 h-8 flex items-center justify-center text-gray-400 text-xs"><i class="fa-solid fa-angle-left"></i></button>
                        <button class="w-8 h-8 flex items-center justify-center bg-[#5EBEE6] text-white rounded-lg text-xs font-medium">1</button>
                        <button class="w-8 h-8 flex items-center justify-center border border-gray-100 text-gray-400 rounded-lg text-xs font-medium">2</button>
                        <button class="w-8 h-8 flex items-center justify-center text-gray-400 text-xs"><i class="fa-solid fa-angle-right"></i></button>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white border border-gray-100 rounded-xl p-8 font-normal">
                    <div class="flex items-center gap-3 mb-8 text-[#5EBEE6]">
                        <div class="w-10 h-10 bg-[#5EBEE6] rounded-xl flex items-center justify-center text-white">
                            <i class="fa-solid fa-download"></i>
                        </div>
                        <h4 class="font-medium text-slate-800">ยอดดาวน์โหลดสูงสุด</h4>
                    </div>
                    <div class="space-y-6">
                        @for ($j = 1; $j <= 5; $j++)
                            <div class="flex items-center justify-between group cursor-pointer">
                                <div class="flex items-center gap-4">
                                    <span class="text-gray-300 font-medium text-xl">{{ $j }}</span>
                                    <div>
                                        <p class="text-[13px] font-medium text-slate-700 group-hover:text-[#5EBEE6] transition-colors">แคลคูลัส: อนุพันธ์และอินทิกรัล</p>
                                        <p class="text-[10px] text-gray-400 font-normal">วิชา คณิตศาสตร์</p>
                                    </div>
                                </div>
                                <span class="text-[10px] text-gray-300 font-medium">1,000 ดาวน์โหลด</span>
                            </div>
                        @endfor
                    </div>
                </div>

                <div class="bg-white border border-gray-100 rounded-xl p-8 font-normal">
                    <div class="flex items-center gap-3 mb-8 text-[#5EBEE6]">
                        <div class="w-10 h-10 bg-[#5EBEE6] rounded-xl flex items-center justify-center text-white">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </div>
                        <h4 class="font-medium text-slate-800">อัปโหลดล่าสุด</h4>
                    </div>
                    <div class="space-y-4">
                        @for ($k = 0; $k < 5; $k++)
                            <div class="flex items-center justify-between p-3 border border-gray-50 rounded-lg hover:bg-gray-50 transition-all">
                                <div class="text-left">
                                    <p class="text-[11px] font-medium text-slate-700">วิชาคณิตศาสตร์</p>
                                    <p class="text-[9px] text-gray-400 font-normal line-clamp-1">เรื่องตรีโกณมิติและมิติสัมพันธ์</p>
                                </div>
                                <button class="px-3 py-1 bg-white border border-gray-100 text-gray-400 rounded-lg text-[10px] font-medium hover:text-[#5EBEE6] transition-all">
                                    ดาวน์โหลด
                                </button>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection