@extends('backend.layout')
@section('content')

<section class="w-full h-full p-6 md:p-10 font-kanit bg-gray-50/50">

    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="text-2xl md:text-3xl font-semibold text-slate-800">แดชบอร์ด (Dashboard)</h2>
            <p class="text-sm text-gray-500 mt-1">ภาพรวมและสถิติของระบบ Steam Portfolio</p>
        </div>
        <div class="text-sm text-gray-500 bg-white px-4 py-2 rounded-xl border border-gray-100 shadow-sm flex items-center gap-2">
            <i class="fa-regular fa-clock text-[#5EBEE6]"></i> ข้อมูลอัปเดตล่าสุด: {{ date('d/m/Y H:i') }}
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex items-center gap-5 hover:-translate-y-1 transition-transform duration-300">
            <div class="w-14 h-14 rounded-xl bg-[#eaf6fc] flex items-center justify-center text-[#5EBEE6] shrink-0">
                <i class="fa-solid fa-users text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-400 mb-1">ผู้ใช้งานทั้งหมด</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ number_format($stats['total_users']) }} <span class="text-sm font-normal text-gray-400">คน</span></h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex items-center gap-5 hover:-translate-y-1 transition-transform duration-300">
            <div class="w-14 h-14 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-500 shrink-0">
                <i class="fa-solid fa-folder-open text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-400 mb-1">ผลงานทั้งหมด</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ number_format($stats['total_portfolios']) }} <span class="text-sm font-normal text-gray-400">เล่ม</span></h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex items-center gap-5 hover:-translate-y-1 transition-transform duration-300 relative overflow-hidden">
            @if ($stats['pending_approvals'] > 0)
                <div class="absolute left-0 top-0 w-1 h-full bg-orange-400"></div>
            @endif
            <div class="w-14 h-14 rounded-xl bg-orange-50 flex items-center justify-center text-orange-500 shrink-0">
                <i class="fa-solid fa-hourglass-half text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-400 mb-1">รอพิจารณา</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ number_format($stats['pending_approvals']) }} <span class="text-sm font-normal text-gray-400">รายการ</span></h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex items-center gap-5 hover:-translate-y-1 transition-transform duration-300">
            <div class="w-14 h-14 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500 shrink-0">
                <i class="fa-solid fa-chart-line text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-400 mb-1">ยอดเข้าชมรวม</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ number_format($stats['total_views']) }} <span class="text-sm font-normal text-gray-400">ครั้ง</span></h3>
            </div>
        </div>

    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-50 flex justify-between items-center bg-white">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-orange-100 text-orange-500 flex items-center justify-center">
                    <i class="fa-solid fa-bell text-sm"></i>
                </div>
                <h3 class="text-lg font-semibold text-slate-800">ผลงานที่รอการตรวจสอบล่าสุด</h3>
            </div>
            <a href="#" class="text-sm font-medium text-[#5EBEE6] hover:text-[#4fb1d8] transition-colors flex items-center gap-1">
                ดูทั้งหมด <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/80 text-gray-500 text-xs uppercase tracking-wider">
                        <th class="px-6 py-4 font-medium">ผู้จัดทำ</th>
                        <th class="px-6 py-4 font-medium">มหาวิทยาลัย</th>
                        <th class="px-6 py-4 font-medium">วันที่อัปโหลด</th>
                        <th class="px-6 py-4 font-medium text-center">สถานะ</th>
                        <th class="px-6 py-4 font-medium text-right">จัดการ</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-slate-700 divide-y divide-gray-100">

                    @forelse($recentPending as $portfolio)
                        <tr class="hover:bg-gray-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    @if ($portfolio->user && $portfolio->user->profile_image)
                                        <img src="{{ asset($portfolio->user->profile_image) }}" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center border border-gray-200">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-medium text-slate-800 line-clamp-1">{{ $portfolio->first_name }} {{ $portfolio->last_name }}</p>
                                        <p class="text-xs text-gray-400 mt-0.5">ID: {{ $portfolio->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs bg-gray-100 text-gray-600 px-3 py-1.5 rounded-lg line-clamp-1 max-w-[200px]" title="{{ $portfolio->university }}">
                                    {{ $portfolio->university }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-xs whitespace-nowrap">
                                {{ $portfolio->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-orange-50 text-orange-500 border border-orange-100 whitespace-nowrap">
                                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span> รอพิจารณา
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-100 md:opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('portfolio.show', $portfolio->id) }}" target="_blank"
                                        class="w-9 h-9 rounded-xl bg-white text-gray-500 flex items-center justify-center hover:bg-[#5EBEE6] hover:text-white transition-colors border border-gray-200 shadow-sm"
                                        title="ดูผลงาน">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <button class="w-9 h-9 rounded-xl bg-white text-emerald-500 flex items-center justify-center hover:bg-emerald-500 hover:text-white transition-colors border border-gray-200 shadow-sm"
                                        title="อนุมัติ">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                    <button class="w-9 h-9 rounded-xl bg-white text-red-500 flex items-center justify-center hover:bg-red-500 hover:text-white transition-colors border border-gray-200 shadow-sm"
                                        title="ปฏิเสธ">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center text-gray-400">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-emerald-50 text-emerald-400 rounded-full flex items-center justify-center mb-4">
                                        <i class="fa-solid fa-check text-3xl"></i>
                                    </div>
                                    <p class="text-base font-medium text-slate-700">ไม่มีผลงานที่รอการพิจารณา</p>
                                    <p class="text-sm mt-1">เก่งมาก! คุณเคลียร์งานหมดแล้ว</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

</section>
@endsection