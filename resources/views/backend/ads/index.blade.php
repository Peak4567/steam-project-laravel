@extends('backend.layout')
@section('content')
    <section class="w-full h-full p-4 md:p-8 font-mitr bg-slate-50/50 text-slate-700">
        
        {{-- Flash Message แจ้งเตือนความสำเร็จ --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl text-xs font-bold flex items-center gap-2 shadow-sm">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        {{-- หัวข้อหลักและปุ่มสร้าง --}}
        <div class="mb-8 border-b border-slate-100 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <div class="w-2.5 h-6 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight">จัดการข่าวประชาสัมพันธ์ & ADS</h2>
                </div>
                <p class="text-xs md:text-sm text-slate-400 font-medium mt-1">บริหารจัดการแบนเนอร์กิจกรรม ข้อมูลข่าวประชาสัมพันธ์ และป้ายโฆษณาบนหน้าเว็บไซต์หลัก</p>
            </div>
            
            <a href="{{ route('backend.ads.create') }}" class="bg-slate-900 hover:bg-slate-800 text-white px-5 py-3 rounded-xl text-xs font-bold transition-all shadow-md active:scale-95 flex items-center justify-center gap-2 w-full sm:w-auto shrink-0">
                <i class="fa-solid fa-plus text-[10px]"></i> เพิ่มป้ายประชาสัมพันธ์ใหม่
            </a>
        </div>

        {{-- แผงสถิติย่อย --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">รายการทั้งหมด</p>
                    <h3 class="text-2xl font-black text-slate-800 leading-none">{{ number_format($stats['total']) }} <span class="text-xs font-normal text-slate-400">รายการ</span></h3>
                </div>
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#5EBEE6] flex items-center justify-center text-base"><i class="fa-solid fa-ad"></i></div>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">กำลังแสดงผลบนเว็บ</p>
                    <h3 class="text-2xl font-black text-slate-800 leading-none">{{ number_format($stats['active']) }} <span class="text-xs font-normal text-slate-400">ป้าย</span></h3>
                </div>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center text-base"><i class="fa-solid fa-eye"></i></div>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">ซ่อนการแสดงผล</p>
                    <h3 class="text-2xl font-black text-slate-800 leading-none">{{ number_format($stats['inactive']) }} <span class="text-xs font-normal text-slate-400">รายการ</span></h3>
                </div>
                <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center text-base"><i class="fa-solid fa-eye-slash"></i></div>
            </div>
        </div>

        {{-- ตารางข้อมูล --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.02)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[900px]">
                    <thead>
                        <tr class="bg-slate-50/80 text-slate-400 text-[10px] font-bold uppercase tracking-wider border-b border-slate-100">
                            <th class="px-4 py-4 w-16 text-center">ID</th>
                            <th class="px-6 py-4 w-80">รูปภาพปก / หัวข้อข่าวประชาสัมพันธ์</th>
                            <th class="px-6 py-4 w-48">รายละเอียดข้อมูลย่อ</th>
                            <th class="px-6 py-4 text-center w-36">สถานะระบบ</th>
                            <th class="px-6 py-4 text-center w-40">วันที่เริ่มลงประกาศ</th>
                            <th class="px-6 py-4 text-right w-32">การสั่งการ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 text-xs font-medium text-slate-600">
                        @forelse($ads as $ad)
                            @php
                                $images = json_decode($ad->image_path, true);
                                $firstImage = is_array($images) && count($images) > 0 ? $images[0] : null;
                            @endphp
                            <tr class="hover:bg-slate-50/40 transition-colors group">
                                <td class="px-4 py-4 text-center font-bold text-slate-400 bg-slate-50/20 shadow-inner">#{{ $ad->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3.5">
                                        @if($firstImage)
                                            <img src="{{ asset($firstImage) }}" class="w-16 h-10 object-cover rounded-xl border border-slate-100 shadow-sm shrink-0">
                                        @else
                                            <div class="w-16 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-300 shrink-0"><i class="fa-regular fa-image text-base"></i></div>
                                        @endif
                                        <div class="overflow-hidden">
                                            <p class="font-bold text-slate-800 text-sm line-clamp-1 group-hover:text-[#5EBEE6] transition-colors leading-tight">{{ $ad->title }}</p>
                                            <p class="text-[9px] text-slate-400 font-mono mt-1">Slug: {{ $ad->slug }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-slate-400 line-clamp-1 max-w-[200px]" title="{{ $ad->description }}">{{ $ad->description }}</p>
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    @if($ad->status == 'active')
                                        <span class="inline-flex items-center gap-1 bg-emerald-50 border border-emerald-100 text-emerald-500 px-2.5 py-1 rounded-lg font-bold text-[10px]"><i class="fa-solid fa-circle-check text-[9px]"></i>กำลังแสดงผล</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 bg-slate-50 border border-slate-100 text-slate-400 px-2.5 py-1 rounded-lg font-bold text-[10px]"><i class="fa-solid fa-eye-slash text-[9px]"></i>ปิดการใช้งาน</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center text-slate-400 whitespace-nowrap">
                                    <span class="font-bold text-slate-600"><i class="fa-regular fa-calendar text-[10px] mr-0.5"></i> {{ date('d/m/Y', strtotime($ad->created_at)) }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('backend.ads.edit', $ad->id) }}" class="w-7 h-7 rounded-lg bg-slate-50 text-orange-400 flex items-center justify-center hover:bg-orange-400 hover:text-white border border-slate-100 shadow-sm transition-all" title="แก้ไขข้อมูลป้าย"><i class="fa-solid fa-pen-to-square text-[11px]"></i></a>
                                        <form action="{{ route('backend.ads.destroy', $ad->id) }}" method="POST" onsubmit="return confirm('⚠️ ยืนยันต้องการลบแบนเนอร์ประชาสัมพันธ์นี้ถาวรใช่หรือไม่?')" class="inline-flex">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="w-7 h-7 rounded-lg bg-slate-50 text-rose-500 hover:bg-rose-500 hover:text-white border border-slate-100 shadow-sm transition-all flex items-center justify-center" title="ลบข้อมูล"><i class="fa-regular fa-trash-can text-[11px]"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center text-slate-400 font-medium">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-14 h-14 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center mb-3"><i class="fa-solid fa-ad text-2xl text-slate-300"></i></div>
                                        <h4 class="text-sm font-bold text-slate-700 mb-0.5">ไม่พบข้อมูลป้ายประชาสัมพันธ์</h4>
                                        <p class="text-xs text-slate-400 font-medium">ยังไม่มีข้อมูล Ads ในระบบย่อยขณะนี้</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($ads->hasPages())
                <div class="px-6 py-4 border-t border-slate-50 bg-white">
                    {{ $ads->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection