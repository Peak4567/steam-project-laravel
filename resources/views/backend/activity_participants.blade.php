@extends('backend.layout')
@section('content')
    <section class="w-full h-full p-6 md:p-10 font-kanit bg-gray-50/50">
        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <a href="{{ route('backend.activity') }}" class="text-[#5EBEE6] text-sm hover:underline flex items-center gap-2 mb-2">
                    <i class="fa-solid fa-arrow-left"></i> กลับไปหน้ากิจกรรม
                </a>
                <h2 class="text-2xl font-bold text-slate-800 tracking-tight">รายชื่อผู้สมัคร: {{ $activity->title }}</h2>
                <p class="text-sm text-gray-500 mt-1">จำนวนผู้สมัครปัจจุบัน: {{ $participants->count() }} คน</p>
            </div>

            <button type="button" onclick="printTemplate('{{ route('backend.activity.print', $activity->id) }}')"
                class="hidden md:flex bg-white border border-gray-200 text-gray-600 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-50 transition-all items-center gap-2 shadow-sm">
                <i class="fa-solid fa-print"></i> พิมพ์รายชื่อ
            </button>
            <iframe id="printFrame" style="display:none;"></iframe>
        </div>

        <div class="bg-white rounded-md border border-gray-100 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100/50 text-gray-600 text-[11px] uppercase tracking-widest border-b border-gray-100">
                            <th class="px-6 py-4 font-bold">ลำดับ</th>
                            <th class="px-6 py-4 font-bold">ชื่อ-นามสกุล / อีเมล</th>
                            <th class="px-6 py-4 font-bold text-center">ชั้น / เลขที่</th>
                            <th class="px-6 py-4 font-bold" style="width: 30%;">SOP</th>
                            <th class="px-6 py-4 font-bold text-center">สถานะ</th>
                            <th class="px-6 py-4 font-bold text-right">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-slate-700 divide-y divide-gray-100">
                        @forelse($participants as $index => $reg)
                            <tr class="hover:bg-gray-50/50 transition-colors align-top">
                                <td class="px-6 py-4 text-gray-400 font-medium">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">
                                    <p class="font-bold text-slate-800">{{ $reg->user->first_name }} {{ $reg->user->last_name }}</p>
                                    <p class="text-[11px] text-gray-400 mt-0.5">{{ $reg->user->email }}</p>
                                    <p class="text-[11px] text-slate-500"><i class="fa-solid fa-phone text-[9px]"></i> {{ $reg->phone }}</p>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="bg-blue-50 text-[#5EBEE6] px-2 py-1 rounded text-[11px] font-bold">
                                        {{ $reg->class_room }} / #{{ $reg->student_no }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($reg->note)
                                        <div class="relative">
                                            <div id="sop-container-{{ $reg->id }}" class="text-xs text-gray-500 leading-relaxed overflow-hidden transition-all duration-300 line-clamp-2 whitespace-pre-line bg-gray-50/50 p-2 rounded border border-transparent">
                                                {{ $reg->note }}
                                            </div>
                                            <button type="button" onclick="toggleSOP({{ $reg->id }})" class="text-[10px] text-[#5EBEE6] font-bold mt-1 hover:underline flex items-center gap-1">
                                                <span id="text-{{ $reg->id }}">ดูเพิ่มเติม</span>
                                                <i id="icon-{{ $reg->id }}" class="fa-solid fa-chevron-down transition-transform"></i>
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-gray-300 italic text-xs">- ไม่ระบุ -</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($reg->status == 'pending')
                                        <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-600 text-[10px] font-bold uppercase">รอพิจารณา</span>
                                    @elseif($reg->status == 'approved')
                                        <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-600 text-[10px] font-bold uppercase">ผ่านการยืนยัน</span>
                                    @else
                                        <span class="px-3 py-1 rounded-full bg-rose-100 text-rose-600 text-[10px] font-bold uppercase">ไม่ผ่านการยืนยัน</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <form action="{{ route('backend.activity.updateStatus', $reg->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" title="ยืนยัน" class="w-8 h-8 rounded-md bg-white text-emerald-500 flex items-center justify-center hover:bg-emerald-500 hover:text-white transition-all border border-gray-100 shadow-sm">
                                                <i class="fa-solid fa-check text-xs"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('backend.activity.updateStatus', $reg->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" title="ปฏิเสธ" class="w-8 h-8 rounded-md bg-white text-rose-500 flex items-center justify-center hover:bg-rose-500 hover:text-white transition-all border border-gray-100 shadow-sm">
                                                <i class="fa-solid fa-xmark text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-400 text-xs tracking-widest uppercase font-bold italic">ยังไม่มีผู้สมัคร</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        function toggleSOP(id) {
            const container = document.getElementById('sop-container-' + id);
            const btnText = document.getElementById('text-' + id);
            const icon = document.getElementById('icon-' + id);
            if (container.classList.contains('line-clamp-2')) {
                container.classList.remove('line-clamp-2');
                container.classList.add('bg-blue-50/30', 'border-blue-100');
                btnText.innerText = 'แสดงน้อยลง';
                icon.style.transform = 'rotate(180deg)';
            } else {
                container.classList.add('line-clamp-2');
                container.classList.remove('bg-blue-50/30', 'border-blue-100');
                btnText.innerText = 'ดูเพิ่มเติม';
                icon.style.transform = 'rotate(0deg)';
            }
        }

        function printTemplate(url) {
            const frame = document.getElementById('printFrame');
            const btn = event.currentTarget;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
            btn.disabled = true;
            frame.src = url;
            frame.onload = function() {
                frame.contentWindow.focus();
                frame.contentWindow.print();
                btn.innerHTML = originalText;
                btn.disabled = false;
            };
        }
    </script>
@endsection