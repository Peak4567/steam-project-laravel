@extends('layout')
@section('content')

    <section class="w-full min-h-screen bg-slate-50/50 py-12 px-4 md:px-6 font-mitr relative overflow-hidden">
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
                        <h2 class="text-2xl md:text-3xl text-slate-800 font-extrabold tracking-tight">คลังชีทสรุปเนื้อหา</h2>
                        <p class="text-slate-400 text-sm font-medium mt-1">แบ่งปันและค้นหาไฟล์สรุปบทเรียนจากเพื่อนๆ เพื่อเตรียมตัวเข้าสู่ห้องสอบ</p>
                    </div>
                </div>
                <a href="{{ route('profile.sheets') }}"
                    class="w-full md:w-auto flex items-center justify-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-8 py-3.5 rounded-xl font-bold text-xs transition-all shadow-md active:scale-95">
                    แชร์แบ่งปันชีทสรุปใหม่
                    <i class="fa-solid fa-cloud-arrow-up text-sm text-[#5EBEE6]"></i>
                </a>
            </div>

            {{-- Search & Filter Section --}}
            <form action="{{ url()->current() }}" method="GET" class="flex flex-col md:flex-row items-center gap-4 mb-10 relative z-20">
                <div class="relative w-full flex-grow shadow-sm rounded-2xl">
                    <div class="absolute inset-y-0 left-6 flex items-center pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-[#5EBEE6] text-base"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="ค้นหาด้วยชื่อกระบวนวิชา หัวข้อสรุป หรือเนื้อหาบทเรียน..."
                        class="w-full bg-white border border-slate-100 text-slate-700 text-xs font-medium rounded-2xl py-4 pl-14 pr-32 outline-none focus:ring-4 focus:ring-[#5EBEE6]/10 focus:border-[#5EBEE6] shadow-[0_4px_20px_rgba(0,0,0,0.01)] transition-all">
                    <button type="submit"
                        class="absolute right-2.5 top-1/2 -translate-y-1/2 bg-slate-900 hover:bg-slate-800 transition-colors text-white px-6 py-2 rounded-xl text-xs font-bold shadow-md">
                        ค้นหาด่วน
                    </button>
                </div>

                <div class="relative w-full md:w-auto shrink-0 shadow-sm rounded-2xl">
                    <select name="sort" onchange="this.form.submit()"
                        class="appearance-none w-full md:w-auto bg-white border border-slate-100 text-slate-600 font-bold text-xs rounded-2xl px-6 py-4 outline-none focus:ring-4 focus:ring-[#5EBEE6]/10 cursor-pointer pr-12 transition-all">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>จัดเรียง: อัปเดตล่าสุด</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>จัดเรียง: ยอดดาวน์โหลดสูงสุด</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-5 flex items-center text-slate-400">
                        <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </div>
                </div>
            </form>

            {{-- Categories Filter Tabs --}}
            <div class="flex items-center gap-2 mb-8 overflow-x-auto pb-3 scrollbar-hide -mx-4 px-4 md:mx-0 md:px-0">
                <a href="{{ request()->fullUrlWithQuery(['term' => null]) }}" 
                    class="whitespace-nowrap px-6 py-2 rounded-full font-bold text-xs transition-all {{ !request('term') ? 'bg-slate-900 text-white shadow-md' : 'bg-white border border-slate-100 text-slate-400 hover:bg-slate-50' }}">คลังชีททั้งหมด</a>
                <a href="{{ request()->fullUrlWithQuery(['term' => 'กลางภาค']) }}"
                    class="whitespace-nowrap px-6 py-2 rounded-full font-bold text-xs transition-all {{ request('term') == 'กลางภาค' ? 'bg-gradient-to-r from-[#5EBEE6] to-blue-500 text-white shadow-md border-none' : 'bg-white border border-slate-100 text-slate-400 hover:bg-slate-50' }}">ช่วงสอบกลางภาค</a>
                <a href="{{ request()->fullUrlWithQuery(['term' => 'ปลายภาค']) }}"
                    class="whitespace-nowrap px-6 py-2 rounded-full font-bold text-xs transition-all {{ request('term') == 'ปลายภาค' ? 'bg-gradient-to-r from-[#5EBEE6] to-blue-500 text-white shadow-md border-none' : 'bg-white border border-slate-100 text-slate-400 hover:bg-slate-50' }}">ช่วงสอบปลายภาค</a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                
                {{-- 📋 ฝั่งซ้าย: รายการเอกสารชีทสรุปวิชาหลัก (lg:col-span-8) 📋 --}}
                <div class="lg:col-span-8 bg-white border border-slate-100 rounded-2xl p-5 md:p-8 shadow-[0_8px_30px_rgba(0,0,0,0.01)] relative overflow-hidden">
                    <div class="flex justify-between items-center mb-6 border-b border-slate-50 pb-4">
                        <h4 class="text-slate-800 font-extrabold text-base tracking-tight">คลังสารสนเทศเอกสารสรุป</h4>
                        <span class="text-[10px] text-[#5EBEE6] bg-blue-50 px-3 py-1 rounded-lg font-bold border border-blue-100/30">
                            พบทูลระบบข้อมูลทั้งหมด {{ count($sheets) }} รายการ
                        </span>
                    </div>

                    {{-- Desktop Table View --}}
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[650px]">
                            <thead>
                                <tr class="text-slate-400 text-[10px] font-bold uppercase tracking-wider border-b border-slate-100 pb-3">
                                    <th class="pb-3.5 w-24">ประเภทสื่อ</th>
                                    <th class="pb-3.5 w-40">กลุ่มสาระ/วิชา</th>
                                    <th class="pb-3.5">หัวข้อหัวเรื่องชีท</th>
                                    <th class="pb-3.5 w-24 text-center">ระดับชั้น</th>
                                    <th class="pb-3.5 text-right w-28">สั่งการคลัง</th>
                                </tr>
                            </thead>
                            <tbody class="text-slate-600 text-xs divide-y divide-slate-50">
                                @forelse ($sheets as $sheet)
                                    @if($sheet->status == 'approved')
                                        <tr class="hover:bg-slate-50/40 transition-colors group">
                                            <td class="py-4">
                                                @if($sheet->type == 'file')
                                                    <span class="bg-blue-50 text-[#5EBEE6] px-2.5 py-1 rounded-lg text-[9px] font-bold border border-blue-100/30 whitespace-nowrap"><i class="fa-solid fa-file-pdf mr-1"></i> PDF FILE</span>
                                                @else
                                                    <span class="bg-purple-50 text-purple-500 px-2.5 py-1 rounded-lg text-[9px] font-bold border border-purple-100/30 whitespace-nowrap"><i class="fa-solid fa-link mr-1"></i> WEB URL</span>
                                                @endif
                                            </td>
                                            <td class="py-4 font-bold text-slate-800">
                                                <div class="line-clamp-1 group-hover:text-[#5EBEE6] transition-colors text-sm">{{ $sheet->subject }}</div>
                                                <div class="text-[9px] text-slate-400 font-bold mt-1 inline-block bg-slate-50 border border-slate-100 px-2 py-0.5 rounded-md">{{ $sheet->term }}</div>
                                            </td>
                                            <td class="py-4">
                                                {{-- 🛠️ ปรับปรุง: แก้ไขตัวแปรชื่อผู้ส่งเป็นคอลัมน์จริงจาก SQL ($sheet->first_name) พร้อมแก้ลิ้งก์ให้กดได้โดยตรง --}}
                                                <p class="font-bold text-slate-700 text-sm line-clamp-1 mb-1">
                                                    <a href="{{ $sheet->type == 'file' ? asset($sheet->file_path) : $sheet->file_path }}" target="_blank" class="hover:text-[#5EBEE6] hover:underline transition-all">
                                                        {{ $sheet->sheet_name }}
                                                    </a>
                                                </p>
                                                <p class="text-[10px] text-slate-400 font-medium flex items-center gap-1"><i class="fa-regular fa-user text-[9px]"></i> ผู้ส่ง: {{ $sheet->first_name ?? 'สมาชิกสตรีม' }} {{ $sheet->last_name ?? '' }}</p>
                                            </td>
                                            <td class="py-4 font-bold text-center text-slate-500 whitespace-nowrap">
                                                <span class="bg-slate-50 border border-slate-100 px-2 py-1 rounded-md">{{ $sheet->level }}</span>
                                            </td>
                                            {{-- 🛠️ ปรับปรุง: เพิ่มปุ่มดาวน์โหลด/เปิดลิงก์ที่แสดงผลถาวรให้คลิกทำงานได้ง่ายๆ บนฝั่งคอมพิวเตอร์ Desktop --}}
                                            <td class="py-4 text-right whitespace-nowrap">
                                                @if($sheet->type == 'file')
                                                    <a href="{{ asset($sheet->file_path) }}" download target="_blank" class="inline-flex items-center gap-1 bg-[#5EBEE6] text-white px-3 py-1.5 rounded-xl font-bold text-[10px] shadow-sm hover:bg-sky-400 transition-all">
                                                        <i class="fa-solid fa-cloud-arrow-down"></i> โหลดไฟล์
                                                    </a>
                                                @else
                                                    <a href="{{ $sheet->file_path }}" target="_blank" class="inline-flex items-center gap-1 bg-purple-500 text-white px-3 py-1.5 rounded-xl font-bold text-[10px] shadow-sm hover:bg-purple-600 transition-all">
                                                        <i class="fa-solid fa-arrow-up-right-from-square"></i> เปิดลิงก์
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-16 text-center text-slate-400">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="w-12 h-12 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center mb-3">
                                                    <i class="fa-solid fa-folder-open text-xl text-slate-300"></i>
                                                </div>
                                                <h5 class="text-sm font-bold text-slate-700">ไม่มีข้อมูลชีทสรุปในคลังระบบ</h5>
                                                <p class="text-xs text-slate-400 font-medium mt-0.5">ขณะนี้ยังไม่มีสรุปไฟล์ข้อมูลวิชาในกลุ่มตัวกรองนี้เผยแพร่บนระบบ</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Mobile Card View --}}
                    <div class="grid grid-cols-1 gap-4 md:hidden">
                        @forelse ($sheets as $sheet)
                            @if($sheet->status == 'approved')
                                <div class="bg-white border border-slate-100 rounded-2xl p-4 shadow-sm relative hover:-translate-y-0.5 transition-all">
                                    <div class="flex justify-between items-start mb-3">
                                        @if($sheet->type == 'file')
                                            <span class="bg-blue-50 text-[#5EBEE6] px-2.5 py-1 rounded-lg text-[9px] font-bold border border-blue-100/30"><i class="fa-solid fa-file-pdf"></i> PDF</span>
                                        @else
                                            <span class="bg-purple-50 text-purple-500 px-2.5 py-1 rounded-lg text-[9px] font-bold border border-purple-100/30"><i class="fa-solid fa-link"></i> LINK</span>
                                        @endif
                                        <span class="text-[9px] text-slate-400 font-semibold"><i class="fa-regular fa-calendar mr-0.5"></i>{{ $sheet->created_at->format('d/m/Y') }}</span>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <p class="font-extrabold text-slate-800 text-sm line-clamp-1 mb-1">
                                            {{ $sheet->sheet_name }}
                                        </p>
                                        <span class="text-[10px] font-bold text-slate-500 bg-slate-50 border border-slate-100 px-2 py-0.5 rounded inline-block">วิชา: {{ $sheet->subject }} ({{ $sheet->term }})</span>
                                    </div>

                                    <div class="flex items-center justify-between text-[10px] text-slate-400 border-t border-slate-50 pt-3 mb-3 font-medium">
                                        <span><i class="fa-regular fa-user mr-1"></i>{{ $sheet->first_name ?? 'สมาชิกสตรีม' }}</span>
                                        <span class="font-bold bg-slate-50 border border-slate-100 px-1.5 py-0.5 rounded-md text-slate-600">{{ $sheet->level }}</span>
                                    </div>

                                    {{-- ปุ่มคลิกสั่งดาวน์โหลดบนเวอร์ชันโมบาย --}}
                                    <div class="pt-1">
                                        @if($sheet->type == 'file')
                                            <a href="{{ asset($sheet->file_path) }}" download target="_blank" class="w-full inline-flex items-center justify-center gap-1 bg-[#5EBEE6] text-white py-2 rounded-xl text-xs font-bold shadow-sm">
                                                <i class="fa-solid fa-cloud-arrow-down"></i> ดาวน์โหลดไฟล์ PDF
                                            </a>
                                        @else
                                            <a href="{{ $sheet->file_path }}" target="_blank" class="w-full inline-flex items-center justify-center gap-1 bg-purple-500 text-white py-2 rounded-xl text-xs font-bold shadow-sm">
                                                <i class="fa-solid fa-arrow-up-right-from-square"></i> เปิดลิงก์เชื่อมโยงเว็บ
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="py-12 text-center text-slate-400 text-xs font-medium border border-dashed border-slate-200 rounded-2xl bg-white">ไม่มีข้อมูลเอกสารในกลุ่มนี้</div>
                        @endforelse
                    </div>

                    {{-- ตัวแบ่งหน้าเลขลิงก์คลัง (Pagination) --}}
                    @if(isset($sheets) && method_exists($sheets, 'links') && $sheets->hasPages())
                        <div class="mt-6 border-t border-slate-50 pt-4">
                            {{ $sheets->links() }}
                        </div>
                    @endif
                </div>

                {{-- 🗃️ ฝั่งขวา: แผงข้อมูลสถิติสแกนและยอดนิยมระบบ (lg:col-span-4) 🗃️ --}}
                <div class="lg:col-span-4 space-y-6">
                    
                    {{-- อันดับโหลดสูงสุด --}}
                    <div class="bg-white border border-slate-100 rounded-2xl p-5 shadow-[0_8px_30px_rgba(0,0,0,0.01)]">
                        <div class="flex items-center gap-3 mb-6 text-[#5EBEE6] border-b border-slate-50 pb-3.5">
                            <div class="w-10 h-10 bg-gradient-to-br from-[#5EBEE6] to-blue-500 rounded-xl flex items-center justify-center text-white shadow-md shadow-blue-500/10">
                                <i class="fa-solid fa-arrow-trend-up text-base"></i>
                            </div>
                            <h4 class="font-extrabold text-slate-800 text-base tracking-tight">ยอดดาวน์โหลดสูงสุด</h4>
                        </div>
                        
                        <div class="space-y-3">
                            @if(isset($topDownloads) && $topDownloads->count() > 0)
                                @foreach ($topDownloads as $index => $top)
                                    @if($top->status == 'approved')
                                        <div class="flex items-center justify-between p-2 rounded-xl hover:bg-slate-50 border border-transparent hover:border-slate-100/70 transition-all group">
                                            <div class="flex items-center gap-3 overflow-hidden">
                                                <div class="w-6 h-6 rounded-md {{ $index < 3 ? 'bg-gradient-to-br from-yellow-300 to-orange-400 text-white font-black' : 'bg-slate-50 border border-slate-100 text-slate-400 font-bold' }} flex items-center justify-center text-[10px] shrink-0">
                                                    {{ $index + 1 }}
                                                </div>
                                                <div class="overflow-hidden">
                                                    {{-- 🛠️ ปรับปรุง: แก้ไขช่อง href ฝั่งขวาลิ้งก์แนะนําให้กดดึงไฟล์ไปรันงานดาวน์โหลดได้จริงตรงตัว --}}
                                                    <a href="{{ $top->type == 'file' ? asset($top->file_path) : $top->file_path }}" target="_blank" class="text-xs font-bold text-slate-700 group-hover:text-[#5EBEE6] transition-colors line-clamp-1 mb-0.5">
                                                        {{ $top->sheet_name }}
                                                    </a>
                                                    <p class="text-[9px] text-slate-400 font-medium truncate">วิชา: {{ $top->subject }}</p>
                                                </div>
                                            </div>
                                            <span class="text-[9px] font-bold text-[#5EBEE6] bg-blue-50/50 border border-blue-100/30 px-2 py-0.5 rounded-md whitespace-nowrap ml-2 shrink-0">{{ number_format($top->downloads) }} โหลด</span>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <p class="text-[11px] text-slate-400 font-medium text-center py-6 bg-slate-50 rounded-xl border border-dashed border-slate-100">ยังไม่มีประวัติสถิติคำสั่งโหลด</p>
                            @endif
                        </div>
                    </div>

                    {{-- อัปโหลดล่าสุด --}}
                    <div class="bg-white border border-slate-100 rounded-2xl p-5 shadow-[0_8px_30px_rgba(0,0,0,0.01)]">
                        <div class="flex items-center gap-3 mb-6 text-[#5EBEE6] border-b border-slate-50 pb-3.5">
                            <div class="w-10 h-10 bg-slate-900 rounded-xl flex items-center justify-center text-white shadow-md shadow-slate-900/10">
                                <i class="fa-regular fa-clock text-base"></i>
                            </div>
                            <h4 class="font-extrabold text-slate-800 text-base tracking-tight">รายการอัปโหลดล่าสุด</h4>
                        </div>
                        
                        <div class="space-y-2.5">
                            @if(isset($recentSheets) && $recentSheets->count() > 0)
                                @foreach ($recentSheets as $recent)
                                    @if($recent->status == 'approved')
                                        <div class="flex items-center justify-between p-3 border border-slate-100 rounded-xl hover:border-[#5EBEE6]/40 hover:shadow-sm transition-all bg-white group">
                                            <div class="text-left overflow-hidden pr-2">
                                                <p class="text-[11px] font-bold text-slate-800 line-clamp-1 mb-0.5 group-hover:text-[#5EBEE6] transition-colors">{{ $recent->subject }}</p>
                                                <p class="text-[10px] text-slate-400 font-medium truncate">{{ $recent->sheet_name }}</p>
                                            </div>
                                            {{-- 🛠️ ปรับปรุง: แก้ไขลิงก์ไอคอนวงกลมฝั่งขวาอัปเดตล่าสุดให้ชี้ดึงข้อมูลไปใช้งานได้จริงร้อยเปอร์เซ็นต์ --}}
                                            <a href="{{ $recent->type == 'file' ? asset($recent->file_path) : $recent->file_path }}" target="_blank" class="w-7 h-7 rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0 text-slate-400 hover:bg-[#5EBEE6] hover:text-white hover:border-[#5EBEE6] transition-all">
                                                <i class="fa-solid {{ $recent->type == 'file' ? 'fa-arrow-down' : 'fa-link' }} text-[9px]"></i>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <p class="text-[11px] text-slate-400 font-medium text-center py-6 bg-slate-50 rounded-xl border border-dashed border-slate-100">ยังไม่มีไฟล์อัปโหลดเข้ามาวิชานี้</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection