@extends('backend.layout')
@section('content')
<section class="w-full min-h-[calc(100vh-80px)] p-6 md:p-10 font-kanit bg-gray-50/50">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">จัดการชีทสรุปเนื้อหา</h2>
                <p class="text-sm text-gray-500">ตรวจสอบและอนุมัติไฟล์ชีทสรุปจากสมาชิก</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-widest w-16 text-center">ID</th>
                        <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-widest">หัวข้อ/วิชา</th>
                        <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-widest">ระดับชั้น/เทอม</th>
                        <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-widest">ผู้ส่ง</th>
                        <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">ประเภท</th>
                        <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">สถานะ</th>
                        <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($sheets as $sheet)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="p-4 text-sm text-gray-400 text-center">{{ $sheet->id }}</td>
                        <td class="p-4">
                            <div class="font-bold text-slate-700 text-sm">{{ $sheet->sheet_name }}</div>
                            <div class="text-[10px] text-[#5EBEE6] font-bold uppercase">{{ $sheet->subject }}</div>
                        </td>
                        <td class="p-4 text-xs text-gray-500">
                            {{ $sheet->level }}<br>
                            <span class="text-[10px]">{{ $sheet->term }}</span>
                        </td>
                        <td class="p-4 text-xs text-gray-600 font-medium">
                            {{ $sheet->first_name }} {{ $sheet->last_name }}
                        </td>
                        <td class="p-4 text-center">
                            @if($sheet->type == 'file')
                                <a href="{{ asset($sheet->file_path) }}" target="_blank" class="text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded">
                                    <i class="fa-solid fa-file-pdf mr-1"></i> PDF
                                </a>
                            @else
                                <a href="{{ $sheet->file_path }}" target="_blank" class="text-xs bg-purple-50 text-purple-600 px-2 py-1 rounded">
                                    <i class="fa-solid fa-link mr-1"></i> LINK
                                </a>
                            @endif
                        </td>
                        <td class="p-4">
                            <form action="{{ route('backend.sheets.updateStatus', $sheet->id) }}" method="POST" id="form-status-{{ $sheet->id }}">
                                @csrf @method('PATCH')
                                <select name="status" onchange="document.getElementById('form-status-{{ $sheet->id }}').submit()"
                                    class="text-[11px] font-bold border-none rounded-full px-3 py-1 cursor-pointer focus:ring-0
                                    {{ $sheet->status == 'approved' ? 'bg-emerald-100 text-emerald-600' : ($sheet->status == 'rejected' ? 'bg-rose-100 text-rose-600' : 'bg-amber-100 text-amber-600') }}">
                                    <option value="pending" {{ $sheet->status == 'pending' ? 'selected' : '' }}>PENDING</option>
                                    <option value="approved" {{ $sheet->status == 'approved' ? 'selected' : '' }}>APPROVED</option>
                                    <option value="rejected" {{ $sheet->status == 'rejected' ? 'selected' : '' }}>REJECTED</option>
                                </select>
                            </form>
                        </td>
                        <td class="p-4 text-center">
                            <form action="{{ route('backend.sheets.destroy', $sheet->id) }}" method="POST" onsubmit="return confirm('ยืนยันการลบชีทนี้?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-gray-300 hover:text-rose-500 transition-colors">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4 border-t border-gray-50">
                {{ $sheets->links() }}
            </div>
        </div>
    </div>
</section>
@endsection