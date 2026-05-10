@extends('backend.layout')
@section('content')
    <section class="w-full h-full p-6 md:p-10 font-kanit bg-gray-50/50">

        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-slate-800 tracking-tight">จัดการเล่มรายงาน</h2>
                <p class="text-sm text-gray-500 mt-1">ตรวจสอบความถูกต้องและอนุมัติเล่มรายงานโครงงาน</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-md border border-gray-100 mb-6 shadow-sm">
            <form action="{{ route('backend.reports') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-grow relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="ค้นหาชื่อโครงงาน หรือ วิชา..."
                        class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm focus:outline-none focus:border-[#5EBEE6] focus:ring-1 focus:ring-[#5EBEE6] transition-colors">
                </div>
                <select name="status"
                    class="py-2.5 px-4 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-600 focus:outline-none focus:border-[#5EBEE6] min-w-[150px] cursor-pointer"
                    onchange="this.form.submit()">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>ทุกสถานะ</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>รอพิจารณา</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>อนุมัติแล้ว</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>ถูกปฏิเสธ</option>
                </select>
                <button type="submit"
                    class="bg-[#5EBEE6] hover:bg-[#4fb1d8] text-white px-8 py-2.5 rounded-md text-sm font-medium transition-all whitespace-nowrap shadow-sm">
                    ค้นหา
                </button>
            </form>
        </div>

        <div class="bg-white rounded-md border border-gray-100 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100/50 text-gray-600 text-[11px] uppercase tracking-widest border-b border-gray-100">
                            <th class="px-6 py-4 font-bold">เล่มรายงาน / วิชา</th>
                            <th class="px-6 py-4 font-bold text-center">อาจารย์ที่ปรึกษา</th>
                            <th class="px-6 py-4 font-bold text-center">ไฟล์เอกสาร</th>
                            <th class="px-6 py-4 font-bold text-center">สถานะ</th>
                            <th class="px-6 py-4 font-bold text-right">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-slate-700 divide-y divide-gray-100">

                        @forelse($reports as $report)
                            <tr class="hover:bg-blue-50/20 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        @if($report->cover_image)
                                            <img src="{{ asset($report->cover_image) }}" class="w-12 h-16 object-cover rounded-md border border-gray-100 shadow-sm">
                                        @else
                                            <div class="w-12 h-16 bg-gray-100 rounded-md flex items-center justify-center text-gray-400 border border-gray-50">
                                                <i class="fa-solid fa-file-pdf text-xl"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-bold text-slate-800 line-clamp-1">{{ $report->project_name }}</p>
                                            <p class="text-[11px] text-[#5EBEE6] font-medium mt-0.5 uppercase tracking-wider italic">วิชา: {{ $report->subject }}</p>
                                            <p class="text-[10px] text-gray-400 mt-1">วันที่ส่ง: {{ $report->created_at->format('d/m/Y H:i') }} น.</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <p class="text-xs font-semibold text-gray-600">{{ $report->advisor }}</p>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <a href="{{ asset($report->file_path) }}" target="_blank" 
                                       class="inline-flex items-center gap-2 text-[#5EBEE6] hover:underline font-medium text-xs">
                                        <i class="fa-solid fa-file-arrow-down"></i> ดูไฟล์ PDF
                                    </a>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if ($report->status == 'approved')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                            <i class="fa-solid fa-circle-check"></i> อนุมัติแล้ว
                                        </span>
                                    @elseif($report->status == 'rejected')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-[10px] font-bold bg-red-50 text-red-500 border border-red-100">
                                            <i class="fa-solid fa-circle-xmark"></i> ปฏิเสธ
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-[10px] font-bold bg-orange-50 text-orange-500 border border-orange-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span>
                                            รอตรวจสอบ
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <form action="{{ route('backend.reports.update-status', $report->id) }}" method="POST" class="inline-flex gap-1">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" name="status" value="approved" title="อนุมัติ"
                                                class="w-8 h-8 rounded-md bg-white text-emerald-500 flex items-center justify-center hover:bg-emerald-500 hover:text-white transition-all border border-gray-100 shadow-sm">
                                                <i class="fa-solid fa-check text-xs"></i>
                                            </button>
                                            <button type="submit" name="status" value="rejected" title="ปฏิเสธ"
                                                class="w-8 h-8 rounded-md bg-white text-red-400 flex items-center justify-center hover:bg-red-400 hover:text-white transition-all border border-gray-100 shadow-sm">
                                                <i class="fa-solid fa-xmark text-xs"></i>
                                            </button>
                                        </form>

                                        <div class="w-px h-6 bg-gray-100 mx-1"></div>

                                        <form action="{{ route('backend.reports.destroy', $report->id) }}" method="POST"
                                            onsubmit="return confirm('⚠️ ต้องการลบเล่มรายงานนี้หรือไม่?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-8 h-8 rounded-md bg-white text-gray-400 flex items-center justify-center hover:bg-red-500 hover:text-white transition-all border border-gray-100 shadow-sm"
                                                title="ลบ">
                                                <i class="fa-regular fa-trash-can text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-20 text-center text-gray-400">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-50 text-gray-200 rounded-full flex items-center justify-center mb-4">
                                            <i class="fa-solid fa-file-circle-exclamation text-3xl"></i>
                                        </div>
                                        <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">No Reports Found</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            @if ($reports->hasPages())
                <div class="px-6 py-4 border-t border-gray-50 bg-white">
                    {{ $reports->links() }}
                </div>
            @endif
        </div>

    </section>
@endsection