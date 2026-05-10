@extends('backend.layout')
@section('content')
    <section class="w-full h-full p-6 md:p-10 font-kanit bg-gray-50/50">

        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-slate-800 tracking-tight">จัดการกิจกรรม</h2>
                <p class="text-sm text-gray-500 mt-1">บริหารจัดการรายการกิจกรรม Workshop ทั้งหมด</p>
            </div>
            <a href="{{ route('backend.activity.create') }}"
                class="bg-[#5EBEE6] hover:bg-[#4fb1d8] text-white px-6 py-2.5 rounded-md text-sm font-medium transition-all shadow-sm flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> เพิ่มกิจกรรมใหม่
            </a>
        </div>

        <div class="bg-white rounded-md border border-gray-100 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100/50 text-gray-600 text-[11px] uppercase tracking-widest border-b border-gray-100">
                            <th class="px-6 py-4 font-bold">ข้อมูลกิจกรรม</th>
                            <th class="px-6 py-4 font-bold text-center">วันที่จัด</th>
                            <th class="px-6 py-4 font-bold text-center">สถานที่</th>
                            <th class="px-6 py-4 font-bold text-center">จำนวนรับ</th>
                            <th class="px-6 py-4 font-bold text-right">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-slate-700 divide-y divide-gray-100">
                        @forelse($activities as $activity)
                            <tr class="hover:bg-blue-50/20 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        @if ($activity->image_path)
                                            <img src="{{ asset($activity->image_path) }}"
                                                class="w-12 h-10 object-cover rounded-md border border-gray-100">
                                        @else
                                            <div class="w-12 h-10 bg-gray-100 rounded-md flex items-center justify-center text-gray-300 border border-gray-50">
                                                <i class="fa-regular fa-image"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-bold text-slate-800 line-clamp-1">{{ $activity->title }}</p>
                                            <p class="text-[10px] text-[#5EBEE6] font-medium uppercase tracking-wider">
                                                {{ $activity->category ?? 'ทั่วไป' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <p class="text-xs font-semibold text-gray-600">
                                        {{ date('d/m/Y', strtotime($activity->date)) }}</p>
                                    <p class="text-[10px] text-gray-400 mt-1">{{ $activity->time_range }}</p>
                                </td>
                                <td class="px-6 py-4 text-center text-xs text-gray-500 italic">{{ $activity->location }}</td>
                                <td class="px-6 py-4 text-center font-bold text-[#5EBEE6] text-xs">
                                    {{ $activity->current_participants }} / {{ $activity->max_participants }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('backend.activity.participants', $activity->id) }}" 
                                            title="ดูรายชื่อผู้สมัคร"
                                            class="w-8 h-8 rounded-md bg-white text-blue-500 flex items-center justify-center hover:bg-blue-500 hover:text-white transition-all border border-gray-100 shadow-sm">
                                            <i class="fa-solid fa-users text-xs"></i>
                                        </a>

                                        <form action="{{ route('backend.activity.destroy', $activity->id) }}" method="POST"
                                            onsubmit="return confirm('ยืนยันการลบกิจกรรมนี้?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-8 h-8 rounded-md bg-white text-red-500 flex items-center justify-center hover:bg-red-500 hover:text-white transition-all border border-gray-100 shadow-sm">
                                                <i class="fa-regular fa-trash-can text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-400 text-xs tracking-widest uppercase font-bold">ไม่พบข้อมูลกิจกรรม</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($activities->hasPages())
            <div class="mt-4">
                {{ $activities->links() }}
            </div>
        @endif
    </section>
@endsection