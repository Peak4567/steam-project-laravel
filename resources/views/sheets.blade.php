@extends('layout')
@section('content')
    <section class="max-w-screen-xl mx-auto py-8 md:py-12 px-4 md:px-6">

        <div class="w-full bg-white rounded-xl p-4 mb-6 md:mb-8 flex flex-col md:flex-row items-start md:items-center justify-between border border-gray-100 gap-4">
            <h3 class="text-gray-400 text-sm md:text-base md:ml-4 font-medium">อัปโหลดชีทสรุปของคุณ?</h3>
            <a href="{{ route('profile.sheets') ?? '#' }}"
                class="w-full md:w-auto justify-center bg-[#5EBEE6] hover:bg-[#4fb1d8] text-white px-6 py-2.5 rounded-xl flex items-center gap-2 transition-all font-medium text-sm shadow-sm">
                อัปโหลดชีทสรุป
                <i class="fa-solid fa-upload"></i>
            </a>
        </div>

        <form action="{{ url()->current() }}" method="GET" class="flex flex-col md:flex-row items-center gap-3 md:gap-4 mb-8">
            <div class="relative w-full flex-grow max-w-2xl">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="ค้นหาชีทสรุป..."
                    class="w-full bg-white border border-gray-100 text-sm rounded-xl px-4 py-3 outline-none focus:ring-1 focus:ring-[#5EBEE6] shadow-sm">
                <button type="submit"
                    class="absolute right-2 top-1/2 -translate-y-1/2 bg-[#5EBEE6] hover:bg-[#4fb1d8] transition-colors text-white px-5 md:px-6 py-1.5 rounded-lg text-sm font-medium shadow-sm">
                    ค้นหา
                </button>
            </div>
            <select name="sort" onchange="this.form.submit()"
                class="w-full md:w-auto bg-white border border-gray-100 text-gray-500 text-sm rounded-xl px-4 py-3 outline-none min-w-[140px] shadow-sm cursor-pointer">
                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>ล่าสุด</option>
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>ยอดนิยม</option>
            </select>
        </form>

        <div class="flex items-center gap-2 md:gap-3 mb-8 md:mb-10 overflow-x-auto pb-2 scrollbar-hide -mx-4 px-4 md:mx-0 md:px-0">
            <a href="{{ request()->fullUrlWithQuery(['term' => null]) }}" 
                class="whitespace-nowrap px-6 md:px-8 py-2 rounded-full font-medium text-xs md:text-sm transition-all shadow-sm {{ !request('term') ? 'bg-[#5EBEE6] text-white' : 'bg-white border border-gray-100 text-gray-400 hover:bg-gray-50' }}">ทั้งหมด</a>
            <a href="{{ request()->fullUrlWithQuery(['term' => 'กลางภาค']) }}"
                class="whitespace-nowrap px-6 md:px-8 py-2 rounded-full font-medium text-xs md:text-sm transition-all shadow-sm {{ request('term') == 'กลางภาค' ? 'bg-[#5EBEE6] text-white' : 'bg-white border border-gray-100 text-gray-400 hover:bg-gray-50' }}">กลางภาค</a>
            <a href="{{ request()->fullUrlWithQuery(['term' => 'ปลายภาค']) }}"
                class="whitespace-nowrap px-6 md:px-8 py-2 rounded-full font-medium text-xs md:text-sm transition-all shadow-sm {{ request('term') == 'ปลายภาค' ? 'bg-[#5EBEE6] text-white' : 'bg-white border border-gray-100 text-gray-400 hover:bg-gray-50' }}">ปลายภาค</a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 md:gap-8">
            
            <div class="lg:col-span-8 bg-white border border-gray-100 rounded-xl p-4 md:p-8 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h4 class="text-slate-800 font-medium text-lg border-l-4 border-[#5EBEE6] pl-3">คลังชีทสรุป</h4>
                    <span class="text-[10px] md:text-xs text-[#5EBEE6] bg-[#5EBEE6]/10 px-3 py-1 rounded-full font-medium">
                        แสดงผล @if(isset($sheets)) {{ $sheets->count() }} @else 0 @endif รายการ
                    </span>
                </div>

                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[600px]">
                        <thead>
                            <tr class="text-gray-400 text-[13px] border-b border-gray-50">
                                <th class="pb-4 font-normal w-24">หมวดหมู่</th>
                                <th class="pb-4 font-normal w-40">วิชา</th>
                                <th class="pb-4 font-normal">ชื่อชีทสรุป</th>
                                <th class="pb-4 font-normal w-24">ระดับชั้น</th>
                                <th class="pb-4 font-normal text-right w-24">วันที่</th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-600 text-sm">
                            @if(isset($sheets) && $sheets->count() > 0)
                                @foreach ($sheets as $sheet)
                                    @if($sheet->status == 'approved')
                                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                                            <td class="py-5">
                                                @if($sheet->type == 'file')
                                                    <span class="bg-[#D1EFFF] text-[#5EBEE6] px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase"><i class="fa-solid fa-file mr-1"></i> ไฟล์</span>
                                                @else
                                                    <span class="bg-orange-50 text-orange-500 px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase"><i class="fa-solid fa-link mr-1"></i> ลิงก์</span>
                                                @endif
                                            </td>
                                            <td class="py-5 font-normal text-slate-700">
                                                <div class="line-clamp-1">{{ $sheet->subject }}</div>
                                                <div class="text-[10px] text-gray-400 font-normal mt-0.5 line-clamp-1">{{ $sheet->term }}</div>
                                            </td>
                                            <td class="py-5">
                                                <p class="font-medium text-slate-700 line-clamp-1">
                                                    @if($sheet->type == 'file')
                                                        <a href="{{ asset($sheet->file_path) }}" target="_blank" class="hover:text-[#5EBEE6] transition-colors">{{ $sheet->sheet_name }}</a>
                                                    @else
                                                        <a href="{{ $sheet->file_path }}" target="_blank" class="hover:text-orange-500 transition-colors">{{ $sheet->sheet_name }}</a>
                                                    @endif
                                                </p>
                                                <p class="text-[10px] text-gray-400 font-normal mt-0.5">โดย {{ $sheet->user->name ?? 'ผู้ใช้งาน' }}</p>
                                            </td>
                                            <td class="py-5 font-normal text-xs">{{ $sheet->level }}</td>
                                            <td class="py-5 text-right text-xs text-gray-400">{{ $sheet->created_at->format('d/m/y') }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="py-10 text-center text-gray-400">ยังไม่มีชีทสรุปในระบบ</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="grid grid-cols-1 gap-4 md:hidden">
                    @if(isset($sheets) && $sheets->count() > 0)
                        @foreach ($sheets as $sheet)
                            @if($sheet->status == 'approved')
                                <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm relative hover:shadow-md transition-shadow">
                                    <div class="flex justify-between items-start mb-3">
                                        @if($sheet->type == 'file')
                                            <span class="bg-[#D1EFFF] text-[#5EBEE6] px-2.5 py-1 rounded-md text-[9px] font-bold uppercase"><i class="fa-solid fa-file mr-1"></i> ไฟล์</span>
                                        @else
                                            <span class="bg-orange-50 text-orange-500 px-2.5 py-1 rounded-md text-[9px] font-bold uppercase"><i class="fa-solid fa-link mr-1"></i> ลิงก์</span>
                                        @endif
                                        <span class="text-[10px] text-gray-400"><i class="fa-regular fa-clock mr-1"></i>{{ $sheet->created_at->format('d/m/y') }}</span>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <p class="font-medium text-slate-800 text-sm line-clamp-2 leading-snug">
                                            {{ $sheet->sheet_name }}
                                        </p>
                                        <div class="flex items-center gap-2 mt-2">
                                            <span class="text-[10px] bg-gray-50 text-gray-500 px-2 py-1 rounded line-clamp-1 flex-1"><i class="fa-solid fa-book-open mr-1"></i>{{ $sheet->subject }} ({{ $sheet->term }})</span>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between text-[10px] text-gray-400 border-t border-gray-50 pt-3 mb-3">
                                        <span class="flex items-center gap-1"><i class="fa-solid fa-user text-gray-300"></i> {{ $sheet->user->name ?? 'ผู้ใช้งาน' }}</span>
                                        <span class="font-medium text-slate-500">{{ $sheet->level }}</span>
                                    </div>

                                    <div class="flex justify-end">
                                        @if($sheet->type == 'file')
                                            <a href="{{ asset($sheet->file_path) }}" target="_blank" class="w-full text-center bg-[#5EBEE6]/10 text-[#5EBEE6] hover:bg-[#5EBEE6] hover:text-white py-2 rounded-lg text-xs font-bold transition-colors">
                                                <i class="fa-solid fa-download mr-1"></i> ดาวน์โหลด
                                            </a>
                                        @else
                                            <a href="{{ $sheet->file_path }}" target="_blank" class="w-full text-center bg-orange-50 text-orange-500 hover:bg-orange-500 hover:text-white py-2 rounded-lg text-xs font-bold transition-colors">
                                                <i class="fa-solid fa-external-link-alt mr-1"></i> เปิดลิงก์
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="py-8 text-center text-gray-400 text-sm border border-dashed border-gray-200 rounded-xl">ยังไม่มีชีทสรุปในระบบ</div>
                    @endif
                </div>

                @if(isset($sheets) && method_exists($sheets, 'links') && $sheets->hasPages())
                    <div class="mt-6 md:mt-8 border-t border-gray-50 pt-6">
                        {{ $sheets->links() }}
                    </div>
                @endif
            </div>

            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white border border-gray-100 rounded-xl p-6 md:p-8 font-normal shadow-sm">
                    <div class="flex items-center gap-3 mb-6 md:mb-8 text-[#5EBEE6]">
                        <div class="w-10 h-10 bg-[#5EBEE6] rounded-xl flex items-center justify-center text-white shadow-sm">
                            <i class="fa-solid fa-download"></i>
                        </div>
                        <h4 class="font-medium text-slate-800">ยอดดาวน์โหลดสูงสุด</h4>
                    </div>
                    <div class="space-y-4 md:space-y-6">
                        @if(isset($topDownloads) && $topDownloads->count() > 0)
                            @foreach ($topDownloads as $index => $top)
                                @if($top->status == 'approved')
                                    <div class="flex items-center justify-between group cursor-pointer bg-gray-50/50 md:bg-transparent p-2 md:p-0 rounded-lg md:rounded-none">
                                        <div class="flex items-center gap-3 md:gap-4 overflow-hidden">
                                            <span class="text-gray-300 font-bold text-lg md:text-xl w-4 text-center shrink-0">{{ $index + 1 }}</span>
                                            <div class="overflow-hidden">
                                                <a href="{{ $top->type == 'file' ? asset($top->file_path) : $top->file_path }}" target="_blank" class="text-[12px] md:text-[13px] font-medium text-slate-700 group-hover:text-[#5EBEE6] transition-colors line-clamp-1">{{ $top->sheet_name }}</a>
                                                <p class="text-[9px] md:text-[10px] text-gray-400 font-normal mt-0.5 line-clamp-1">วิชา {{ $top->subject }}</p>
                                            </div>
                                        </div>
                                        <span class="text-[9px] md:text-[10px] text-gray-400 bg-white md:bg-transparent px-2 py-1 md:px-0 md:py-0 rounded-md md:rounded-none font-medium whitespace-nowrap ml-2 border border-gray-100 md:border-none shadow-sm md:shadow-none">{{ number_format($top->downloads) }} โหลด</span>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <p class="text-xs text-gray-400 text-center py-4 bg-gray-50 rounded-lg">ยังไม่มีข้อมูลสถิติ</p>
                        @endif
                    </div>
                </div>

                <div class="bg-white border border-gray-100 rounded-xl p-6 md:p-8 font-normal shadow-sm">
                    <div class="flex items-center gap-3 mb-6 md:mb-8 text-[#5EBEE6]">
                        <div class="w-10 h-10 bg-[#5EBEE6] rounded-xl flex items-center justify-center text-white shadow-sm">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </div>
                        <h4 class="font-medium text-slate-800">อัปโหลดล่าสุด</h4>
                    </div>
                    <div class="space-y-3 md:space-y-4">
                        @if(isset($recentSheets) && $recentSheets->count() > 0)
                            @foreach ($recentSheets as $recent)
                                @if($recent->status == 'approved')
                                    <div class="flex items-center justify-between p-3 md:p-3.5 border border-gray-100 rounded-lg hover:border-[#5EBEE6]/30 hover:shadow-sm transition-all bg-white">
                                        <div class="text-left max-w-[130px] md:max-w-[150px]">
                                            <p class="text-[10px] md:text-[11px] font-medium text-slate-700 line-clamp-1">วิชา{{ $recent->subject }}</p>
                                            <p class="text-[9px] text-gray-400 font-normal line-clamp-1 mt-0.5">{{ $recent->sheet_name }}</p>
                                        </div>
                                        <a href="{{ $recent->type == 'file' ? asset($recent->file_path) : $recent->file_path }}" target="_blank" class="px-3 py-1.5 bg-gray-50 border border-gray-100 text-gray-500 rounded-lg text-[9px] md:text-[10px] font-medium hover:bg-[#5EBEE6] hover:text-white hover:border-[#5EBEE6] transition-all whitespace-nowrap">
                                            {{ $recent->type == 'file' ? 'ดาวน์โหลด' : 'เปิดลิงก์' }}
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <p class="text-xs text-gray-400 text-center py-4 bg-gray-50 rounded-lg">ยังไม่มีไฟล์ล่าสุด</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection