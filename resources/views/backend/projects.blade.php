@extends('backend.layout')
@section('content')
    <section class="w-full h-full p-6 md:p-10 font-kanit bg-gray-50/50">

        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-slate-800 tracking-tight">จัดการโครงงาน</h2>
                <p class="text-sm text-gray-500 mt-1">ตรวจสอบและบริหารจัดการโครงงานทั้งหมดในระบบ</p>
            </div>

            <a href="{{ route('backend.projects.create') }}"
                class="bg-[#5EBEE6] hover:bg-[#4fb1d8] text-white px-6 py-2.5 rounded-md text-sm font-medium transition-all shadow-sm flex items-center gap-2 w-fit">
                <i class="fa-solid fa-plus"></i> เพิ่มโครงงานใหม่
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-md border border-gray-100 shadow-sm relative overflow-hidden group">
                <div class="absolute right-0 top-0 h-full w-1 bg-indigo-500"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">โครงงานทั้งหมด</p>
                        <h3 class="text-3xl font-black text-slate-800">{{ number_format($stats['total']) }}</h3>
                    </div>
                    <div class="w-14 h-14 rounded-md bg-indigo-50 flex items-center justify-center text-indigo-500 relative">
                        <i class="fa-solid fa-layer-group text-2xl relative z-10"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-md border border-gray-100 shadow-sm relative overflow-hidden group">
                <div class="absolute right-0 top-0 h-full w-1 bg-orange-400"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">สําเร็จ</p>
                        <h3 class="text-3xl font-black text-slate-800">{{ number_format($stats['complated']) }}</h3>
                    </div>
                    <div class="w-14 h-14 rounded-md bg-orange-50 flex items-center justify-center text-orange-400 relative">
                        <i class="fa-solid fa-clock-rotate-left text-2xl relative z-10"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-md border border-gray-100 shadow-sm relative overflow-hidden group">
                <div class="absolute right-0 top-0 h-full w-1 bg-red-500"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">ยกเลิก</p>
                        <h3 class="text-3xl font-black text-slate-800">{{ number_format($stats['canceled']) }}</h3>
                    </div>
                    <div class="w-14 h-14 rounded-md bg-red-50 flex items-center justify-center text-red-500 relative">
                        <i class="fa-duotone fa-regular fa-ban text-2xl relative z-10"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-md border border-gray-100 shadow-sm mb-6">
            <form action="{{ route('backend.projects') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-grow relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="ค้นหาชื่อโครงงาน..."
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
                    class="bg-[#5EBEE6] hover:bg-[#4fb1d8] text-white px-8 py-2.5 rounded-md text-sm font-medium transition-all whitespace-nowrap">
                    ค้นหา
                </button>
            </form>
        </div>

        <div class="bg-white rounded-md border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100/50 text-gray-600 text-[11px] uppercase tracking-widest border-b border-gray-100">
                            <th class="px-6 py-4 font-bold">ข้อมูลโครงงาน</th>
                            <th class="px-6 py-4 font-bold text-center">ผู้จัดทำ</th>
                            <th class="px-6 py-4 font-bold text-center">วันที่สร้าง</th>
                            <th class="px-6 py-4 font-bold text-center">สถานะ</th>
                            <th class="px-6 py-4 font-bold text-right">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-slate-700 divide-y divide-gray-100">

                        @forelse($projects as $project)
                            <tr class="hover:bg-blue-50/20 transition-colors">
                                <td class="px-6 py-4">
                                    <p class="font-bold text-slate-800 line-clamp-1">
                                        {{ $project->name ?? 'ไม่ระบุชื่อโครงงาน' }}
                                    </p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-[10px] bg-gray-100 text-gray-500 px-1.5 py-0.5 rounded-sm font-medium border border-gray-200">ID: {{ $project->id }}</span>
                                        <span class="text-[10px] text-gray-400 font-light italic">ทีม: {{ $project->team_name ?? '-' }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-col items-center justify-center min-w-[120px]">
                                        @if ($project->user && $project->user->profile_image)
                                            <img src="{{ asset($project->user->profile_image) }}"
                                                class="w-9 h-9 rounded-full object-cover border-2 border-white shadow-sm mb-1">
                                        @else
                                            <div class="w-9 h-9 rounded-full bg-blue-50 text-[#5EBEE6] flex items-center justify-center border border-blue-100 mb-1">
                                                <i class="fa-solid fa-user-pen text-sm"></i>
                                            </div>
                                        @endif
                                        <p class="font-bold text-gray-600 text-[11px] text-center">
                                            {{ $project->user ? $project->user->first_name . ' ' . $project->user->last_name : 'Admin System' }}
                                        </p>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-center text-gray-500 text-xs">
                                    <span class="font-medium">{{ $project->created_at->format('d/m/Y') }}</span><br>
                                    <span class="text-[10px] opacity-60">{{ $project->created_at->format('H:i') }} น.</span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if ($project->status == 'approved')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                            <i class="fa-solid fa-check-double"></i> อนุมัติแล้ว
                                        </span>
                                    @elseif($project->status == 'rejected')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-[10px] font-bold bg-red-50 text-red-500 border border-red-100">
                                            <i class="fa-solid fa-ban"></i> ปฏิเสธ
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-[10px] font-bold bg-orange-50 text-orange-500 border border-orange-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span>
                                            รอพิจารณา
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('backend.projects.edit', $project->id) }}"
                                            class="w-8 h-8 rounded-md bg-white text-orange-400 flex items-center justify-center hover:bg-orange-400 hover:text-white transition-all border border-gray-100 shadow-sm"
                                            title="แก้ไข">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </a>
                                        <form action="{{ route('backend.projects.destroy', $project->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('⚠️ ต้องการลบโครงงาน {{ $project->name }} หรือไม่?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-8 h-8 rounded-md bg-white text-red-500 flex items-center justify-center hover:bg-red-500 hover:text-white transition-all border border-gray-100 shadow-sm"
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
                                            <i class="fa-solid fa-box-open text-3xl"></i>
                                        </div>
                                        <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">No Projects Found</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            @if ($projects->hasPages())
                <div class="px-6 py-4 border-t border-gray-50 bg-white">
                    {{ $projects->links() }}
                </div>
            @endif
        </div>

    </section>
@endsection