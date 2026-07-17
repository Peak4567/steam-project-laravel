@extends('layout')
@section('content')

    <section class="w-full bg-slate-50/50 py-16 px-4 md:px-6 font-mitr relative overflow-hidden">
        {{-- Background Glow --}}
        <div class="absolute top-0 left-0 w-[400px] h-[400px] bg-[#5EBEE6]/10 rounded-full blur-3xl -z-10 pointer-events-none -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-[300px] h-[300px] bg-blue-400/5 rounded-full blur-3xl -z-10 pointer-events-none translate-x-1/2 translate-y-1/2"></div>

        <div class="max-w-6xl mx-auto">

            {{-- Title & Action Button --}}
            <div class="w-full bg-white/80 backdrop-blur-xl rounded-[2rem] p-6 md:p-8 mb-10 flex flex-col md:flex-row items-center justify-between border border-white/60 shadow-[0_8px_30px_rgba(0,0,0,0.03)] gap-6 group">
                <div class="flex items-center gap-5 w-full md:w-auto">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#5EBEE6] to-blue-500 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/20 shrink-0 group-hover:scale-105 transition-transform duration-500">
                        <i class="fa-solid fa-file-lines text-white text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl md:text-3xl text-slate-900 font-extrabold tracking-tight">คลังชีทสรุป</h2>
                        <p class="text-slate-500 text-sm font-medium mt-1">แบ่งปันและค้นหาไฟล์สรุปบทเรียนเพื่อเตรียมสอบ</p>
                    </div>
                </div>
                <a href="{{ route('profile.sheets') ?? '#' }}"
                    class="w-full md:w-auto flex items-center justify-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-8 py-3.5 rounded-xl font-semibold text-sm transition-all shadow-md active:scale-95">
                    อัปโหลดชีทสรุป
                    <i class="fa-solid fa-cloud-arrow-up text-lg"></i>
                </a>
            </div>

            {{-- Search & Filter Section --}}
            <form action="{{ url()->current() }}" method="GET" class="flex flex-col md:flex-row items-center gap-4 mb-10 relative z-20">
                <div class="relative w-full flex-grow shadow-sm">
                    <div class="absolute inset-y-0 left-6 flex items-center pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-[#5EBEE6] text-lg"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="ค้นหาชื่อวิชา หรือเนื้อหาชีทสรุป..."
                        class="w-full bg-white border border-slate-100 text-slate-700 text-sm font-medium rounded-2xl py-4.5 pl-14 pr-32 outline-none focus:ring-2 focus:ring-[#5EBEE6]/50 focus:border-[#5EBEE6] shadow-[0_4px_20px_rgba(0,0,0,0.02)] transition-all">
                    <button type="submit"
                        class="absolute right-2.5 top-1/2 -translate-y-1/2 bg-gradient-to-r from-[#5EBEE6] to-[#3B9ADE] hover:opacity-90 transition-opacity text-white px-6 py-2 rounded-xl text-sm font-bold shadow-md shadow-blue-500/20">
                        ค้นหา
                    </button>
                </div>

                <div class="relative w-full md:w-auto shrink-0 shadow-sm">
                    <select name="sort" onchange="this.form.submit()"
                        class="appearance-none w-full md:w-auto bg-white border border-slate-100 text-slate-600 font-bold text-sm rounded-2xl px-6 py-4.5 outline-none focus:ring-2 focus:ring-[#5EBEE6]/50 shadow-[0_4px_20px_rgba(0,0,0,0.02)] cursor-pointer pr-12 transition-all">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>เรียงจาก: ล่าสุด</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>เรียงจาก: ยอดนิยม</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-5 flex items-center text-slate-400">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </div>
                </div>
            </form>

            {{-- Categories --}}
            <div class="flex items-center gap-3 mb-10 overflow-x-auto pb-4 scrollbar-hide -mx-4 px-4 md:mx-0 md:px-0">
                <a href="{{ request()->fullUrlWithQuery(['term' => null]) }}" 
                    class="whitespace-nowrap px-8 py-2.5 rounded-full font-bold text-xs transition-all {{ !request('term') ? 'bg-slate-800 text-white shadow-md shadow-slate-200' : 'bg-white border border-slate-200 text-slate-500 hover:bg-slate-50' }}">ทั้งหมด</a>
                <a href="{{ request()->fullUrlWithQuery(['term' => 'กลางภาค']) }}"
                    class="whitespace-nowrap px-8 py-2.5 rounded-full font-bold text-xs transition-all {{ request('term') == 'กลางภาค' ? 'bg-gradient-to-r from-[#5EBEE6] to-blue-500 text-white shadow-md shadow-blue-500/20 border-none' : 'bg-white border border-slate-200 text-slate-500 hover:bg-slate-50' }}">กลางภาค</a>
                <a href="{{ request()->fullUrlWithQuery(['term' => 'ปลายภาค']) }}"
                    class="whitespace-nowrap px-8 py-2.5 rounded-full font-bold text-xs transition-all {{ request('term') == 'ปลายภาค' ? 'bg-gradient-to-r from-[#5EBEE6] to-blue-500 text-white shadow-md shadow-blue-500/20 border-none' : 'bg-white border border-slate-200 text-slate-500 hover:bg-slate-50' }}">ปลายภาค</a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                {{-- Left Content: Table / Cards --}}
                <div class="lg:col-span-8 bg-white border border-slate-100 rounded-3xl p-6 md:p-10 shadow-sm relative overflow-hidden">
                    <div class="flex justify-between items-center mb-8 border-b border-slate-50 pb-4">
                        <h4 class="text-slate-900 font-extrabold text-xl tracking-tight">รายการเอกสาร</h4>
                        <span class="text-xs text-[#5EBEE6] bg-blue-50 px-4 py-1.5 rounded-lg font-bold border border-blue-100/50">
                            แสดง @if(isset($sheets)) {{ $sheets->count() }} @else 0 @endif รายการ
                        </span>
                    </div>

                    {{-- Desktop Table View --}}
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[650px]">
                            <thead>
                                <tr class="text-slate-400 text-xs font-bold uppercase tracking-wider border-b border-slate-100">
                                    <th class="pb-4 w-24">ประเภท</th>
                                    <th class="pb-4 w-40">วิชา</th>
                                    <th class="pb-4">ชื่อเอกสาร</th>
                                    <th class="pb-4 w-24 text-center">ระดับชั้น</th>
                                    <th class="pb-4 text-right w-24">วันที่</th>
                                </tr>
                            </thead>
                            <tbody class="text-slate-600 text-sm">
                                @if(isset($sheets) && $sheets->count() > 0)
                                    @foreach ($sheets as $sheet)
                                        @if($sheet->status == 'approved')
                                            <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors group">
                                                <td class="py-5">
                                                    @if($sheet->type == 'file')
                                                        <span class="bg-blue-50 text-[#5EBEE6] px-3 py-1.5 rounded-lg text-[10px] font-bold border border-blue-100/50"><i class="fa-solid fa-file-pdf mr-1"></i> ไฟล์</span>
                                                    @else
                                                        <span class="bg-orange-50 text-orange-500 px-3 py-1.5 rounded-lg text-[10px] font-bold border border-orange-100/50"><i class="fa-solid fa-link mr-1"></i> ลิงก์</span>
                                                    @endif
                                                </td>
                                                <td class="py-5 font-bold text-slate-800">
                                                    <div class="line-clamp-1 group-hover:text-[#5EBEE6] transition-colors">{{ $sheet->subject }}</div>
                                                    <div class="text-[10px] text-slate-400 font-medium mt-1 inline-block bg-white border border-slate-100 px-2 py-0.5 rounded-md">{{ $sheet->term }}</div>
                                                </td>
                                                <td class="py-5">
                                                    <p class="font-bold text-slate-700 line-clamp-1 mb-1">
                                                        @if($sheet->type == 'file')
                                                            <a href="{{ asset($sheet->file_path) }}" target="_blank" class="hover:text-[#5EBEE6] transition-colors">{{ $sheet->sheet_name }}</a>
                                                        @else
                                                            <a href="{{ $sheet->file_path }}" target="_blank" class="hover:text-orange-500 transition-colors">{{ $sheet->sheet_name }}</a>
                                                        @endif
                                                    </p>
                                                    <p class="text-[10px] text-slate-400 font-medium flex items-center gap-1.5"><i class="fa-solid fa-user-pen text-[9px]"></i> {{ $sheet->user->name ?? 'ผู้ใช้งาน' }}</p>
                                                </td>
                                                <td class="py-5 font-bold text-xs text-center text-slate-600">{{ $sheet->level }}</td>
                                                <td class="py-5 text-right text-xs font-medium text-slate-400">{{ $sheet->created_at->format('d/m/y') }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="py-16 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                                                    <i class="fa-solid fa-folder-open text-2xl text-slate-300"></i>
                                                </div>
                                                <p class="text-slate-500 font-medium">ยังไม่มีชีทสรุปในระบบ</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{-- Mobile Card View --}}
                    <div class="grid grid-cols-1 gap-5 md:hidden">
                        @if(isset($sheets) && $sheets->count() > 0)
                            @foreach ($sheets as $sheet)
                                @if($sheet->status == 'approved')
                                    <div class="bg-white border border-slate-100 rounded-2xl p-5 shadow-[0_4px_15px_rgba(0,0,0,0.02)] relative hover:-translate-y-1 hover:shadow-md transition-all duration-300">
                                        <div class="flex justify-between items-start mb-4">
                                            @if($sheet->type == 'file')
                                                <span class="bg-blue-50 text-[#5EBEE6] px-3 py-1.5 rounded-lg text-[9px] font-bold uppercase border border-blue-100/50"><i class="fa-solid fa-file-pdf mr-1"></i> ไฟล์</span>
                                            @else
                                                <span class="bg-orange-50 text-orange-500 px-3 py-1.5 rounded-lg text-[9px] font-bold uppercase border border-orange-100/50"><i class="fa-solid fa-link mr-1"></i> ลิงก์</span>
                                            @endif
                                            <span class="text-[10px] text-slate-400 font-medium"><i class="fa-regular fa-clock mr-1"></i>{{ $sheet->created_at->format('d/m/y') }}</span>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <p class="font-extrabold text-slate-800 text-sm line-clamp-2 leading-snug mb-2">
                                                {{ $sheet->sheet_name }}
                                            </p>
                                            <div class="flex items-center gap-2">
                                                <span class="text-[10px] font-bold bg-slate-50 text-slate-600 px-2.5 py-1.5 rounded-md border border-slate-100 flex-1 line-clamp-1"><i class="fa-solid fa-book-open text-[#5EBEE6] mr-1.5"></i>{{ $sheet->subject }} ({{ $sheet->term }})</span>
                                            </div>
                                        </div>

                                        <div class="flex items-center justify-between text-[10px] text-slate-500 border-t border-slate-50 pt-4 mb-4">
                                            <span class="flex items-center gap-1.5 font-medium"><div class="w-5 h-5 rounded-full bg-slate-100 flex items-center justify-center"><i class="fa-solid fa-user text-[8px] text-slate-400"></i></div> {{ $sheet->user->name ?? 'ผู้ใช้งาน' }}</span>
                                            <span class="font-bold bg-slate-100 px-2 py-1 rounded">{{ $sheet->level }}</span>
                                        </div>

                                        <div class="flex justify-end mt-2">
                                            @if($sheet->type == 'file')
                                                <a href="{{ asset($sheet->file_path) }}" target="_blank" class="w-full text-center bg-blue-50 text-[#5EBEE6] hover:bg-[#5EBEE6] hover:text-white py-2.5 rounded-xl text-xs font-bold transition-colors">
                                                    <i class="fa-solid fa-cloud-arrow-down mr-1"></i> ดาวน์โหลด
                                                </a>
                                            @else
                                                <a href="{{ $sheet->file_path }}" target="_blank" class="w-full text-center bg-orange-50 text-orange-500 hover:bg-orange-500 hover:text-white py-2.5 rounded-xl text-xs font-bold transition-colors">
                                                    <i class="fa-solid fa-arrow-up-right-from-square mr-1"></i> เปิดลิงก์
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div class="py-12 text-center text-slate-400 text-sm border border-dashed border-slate-200 rounded-2xl bg-white">ยังไม่มีชีทสรุปในระบบ</div>
                        @endif
                    </div>

                    @if(isset($sheets) && method_exists($sheets, 'links') && $sheets->hasPages())
                        <div class="mt-8 md:mt-10 border-t border-slate-50 pt-6">
                            {{ $sheets->links() }}
                        </div>
                    @endif
                </div>

                {{-- Right Sidebar: Top Downloads & Recent --}}
                <div class="lg:col-span-4 space-y-8">
                    
                    {{-- Widget: Top Downloads --}}
                    <div class="bg-white border border-slate-100 rounded-3xl p-6 md:p-8 shadow-[0_8px_30px_rgba(0,0,0,0.02)]">
                        <div class="flex items-center gap-4 mb-8 text-[#5EBEE6]">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#5EBEE6] to-blue-500 rounded-xl flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                                <i class="fa-solid fa-arrow-trend-up text-xl"></i>
                            </div>
                            <h4 class="font-extrabold text-slate-900 text-lg tracking-tight">ยอดดาวน์โหลดสูงสุด</h4>
                        </div>
                        <div class="space-y-4">
                            @if(isset($topDownloads) && $topDownloads->count() > 0)
                                @foreach ($topDownloads as $index => $top)
                                    @if($top->status == 'approved')
                                        <div class="flex items-center justify-between group cursor-pointer p-3 rounded-2xl hover:bg-slate-50 transition-all border border-transparent hover:border-slate-100">
                                            <div class="flex items-center gap-4 overflow-hidden">
                                                <div class="w-8 h-8 rounded-lg {{ $index < 3 ? 'bg-gradient-to-br from-yellow-300 to-orange-400 text-white shadow-sm' : 'bg-slate-100 text-slate-400' }} flex items-center justify-center font-black text-sm shrink-0">
                                                    {{ $index + 1 }}
                                                </div>
                                                <div class="overflow-hidden">
                                                    <a href="{{ $top->type == 'file' ? asset($top->file_path) : $top->file_path }}" target="_blank" class="text-xs font-bold text-slate-800 group-hover:text-[#5EBEE6] transition-colors line-clamp-1 mb-0.5">{{ $top->sheet_name }}</a>
                                                    <p class="text-[10px] text-slate-400 font-medium line-clamp-1">วิชา {{ $top->subject }}</p>
                                                </div>
                                            </div>
                                            <span class="text-[9px] text-[#5EBEE6] bg-blue-50 px-2.5 py-1 rounded-md font-bold whitespace-nowrap ml-3 border border-blue-100/50">{{ number_format($top->downloads) }} โหลด</span>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <p class="text-xs text-slate-400 text-center py-6 bg-slate-50 rounded-2xl border border-dashed border-slate-200">ยังไม่มีสถิติในขณะนี้</p>
                            @endif
                        </div>
                    </div>

                    {{-- Widget: Recent Uploads --}}
                    <div class="bg-white border border-slate-100 rounded-3xl p-6 md:p-8 shadow-[0_8px_30px_rgba(0,0,0,0.02)]">
                        <div class="flex items-center gap-4 mb-8 text-[#5EBEE6]">
                            <div class="w-12 h-12 bg-slate-900 rounded-xl flex items-center justify-center text-white shadow-md shadow-slate-900/20">
                                <i class="fa-regular fa-clock text-xl"></i>
                            </div>
                            <h4 class="font-extrabold text-slate-900 text-lg tracking-tight">อัปโหลดล่าสุด</h4>
                        </div>
                        <div class="space-y-4">
                            @if(isset($recentSheets) && $recentSheets->count() > 0)
                                @foreach ($recentSheets as $recent)
                                    @if($recent->status == 'approved')
                                        <div class="flex items-center justify-between p-4 border border-slate-100 rounded-2xl hover:border-[#5EBEE6]/40 hover:shadow-md transition-all bg-white group">
                                            <div class="text-left overflow-hidden pr-3">
                                                <p class="text-[11px] font-bold text-slate-800 line-clamp-1 mb-1 group-hover:text-[#5EBEE6] transition-colors">{{ $recent->subject }}</p>
                                                <p class="text-[10px] text-slate-400 font-medium line-clamp-1">{{ $recent->sheet_name }}</p>
                                            </div>
                                            <a href="{{ $recent->type == 'file' ? asset($recent->file_path) : $recent->file_path }}" target="_blank" class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center shrink-0 text-slate-400 group-hover:bg-[#5EBEE6] group-hover:text-white transition-all">
                                                <i class="fa-solid {{ $recent->type == 'file' ? 'fa-arrow-down' : 'fa-link' }} text-[10px]"></i>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <p class="text-xs text-slate-400 text-center py-6 bg-slate-50 rounded-2xl border border-dashed border-slate-200">ยังไม่มีไฟล์ล่าสุด</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection