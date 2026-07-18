@extends('layout')
@section('content')

{{-- 📰 หน้าอ่านเนื้อหาประกาศข่าวประชาสัมพันธ์เชิงลึก (News Article Detail View) --}}
<section class="w-full min-h-screen bg-slate-50/50 py-8 px-4 md:px-6 font-mitr text-slate-700">
    <div class="max-w-6xl mx-auto">
        
        {{-- Breadcrumb นำทาง --}}
        <div class="mb-6 flex items-center gap-2 text-xs font-bold text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-[#5EBEE6] transition-colors">หน้าแรก</a>
            <i class="fa-solid fa-chevron-right text-[8px]"></i>
            <span class="text-slate-500">ข่าวประชาสัมพันธ์</span>
            <i class="fa-solid fa-chevron-right text-[8px]"></i>
            <span class="text-[#5EBEE6] truncate max-w-[200px]">{{ $ad->title }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            {{-- 📝 ฝั่งซ้าย: เนื้อหาหลักของข่าว (lg:col-span-8) --}}
            <article class="lg:col-span-8 bg-white p-6 md:p-8 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.01)] space-y-6">
                
                {{-- หัวข้อข่าวใหญ่ --}}
                <div class="space-y-3 border-b border-slate-50 pb-5">
                    <span class="inline-block bg-blue-50 border border-blue-100 text-[#5EBEE6] text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider">
                        <i class="fa-solid fa-bullhorn text-[9px] mr-1"></i> ข้อมูลประชาสัมพันธ์
                    </span>
                    <h1 class="text-xl md:text-3xl font-black text-slate-800 leading-snug tracking-tight">
                        {{ $ad->title }}
                    </h1>
                    
                    {{-- เมตาเดตาข่าว --}}
                    <div class="flex flex-wrap items-center gap-4 text-xs font-medium text-slate-400 pt-1">
                        <div class="flex items-center gap-1.5">
                            <i class="fa-regular fa-calendar text-[#5EBEE6]"></i>
                            <span>วันที่ประกาศ: {{ date('d/m/Y H:i', strtotime($ad->created_at)) }} น.</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <i class="fa-regular fa-eye text-indigo-400"></i>
                            <span>หมายเลขบันทึก: #{{ $ad->id }}</span>
                        </div>
                    </div>
                </div>

                {{-- พื้นที่ภาพแบนเนอร์ข่าว --}}
                @php
                    $images = json_decode($ad->image_path, true);
                    $firstImage = is_array($images) && count($images) > 0 ? $images[0] : null;
                @endphp
                
                <div class="w-full aspect-[16/9] bg-slate-50 rounded-2xl overflow-hidden border border-slate-100 shadow-sm relative">
                    @if($firstImage)
                        <img src="{{ asset($firstImage) }}" class="w-full h-full object-cover" alt="{{ $ad->title }}">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-300">
                            <i class="fa-regular fa-image text-4xl mb-2"></i>
                            <span class="text-xs">ไม่มีรูปภาพประกอบเนื้อหา</span>
                        </div>
                    @endif
                </div>

                {{-- เนื้อหาข่าวเจาะลึก --}}
                <div class="text-slate-600 text-sm md:text-base leading-relaxed space-y-4 font-normal tracking-wide whitespace-pre-line pt-2">
                    {!! nl2br(e($ad->description ?? 'ไม่มีรายละเอียดเนื้อหาเพิ่มเติมสำหรับประกาศข่าวชิ้นนี้')) !!}
                </div>

                {{-- ปุ่ม Action เสริมหากข่าวระบุลิงก์นำทางไว้ --}}
                @if($ad->link_url)
                    <div class="pt-4">
                        <a href="{{ $ad->link_url }}" target="_blank" 
                           class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs px-6 py-3.5 rounded-xl shadow-md transition-all active:scale-95">
                            <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-[#5EBEE6]"></i> คลิกเพื่อเปิดลิงก์เชื่อมโยงรายละเอียดภายนอก
                        </a>
                    </div>
                @endif
            </article>

            {{-- 📌 ฝั่งขวา: แถบข่าวอื่นๆ แนะนำ (lg:col-span-4) --}}
            <aside class="lg:col-span-4 space-y-6">
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                    <div class="flex items-center gap-2 border-b border-slate-50 pb-2.5">
                        <div class="w-1 h-3.5 bg-[#5EBEE6] rounded-full"></div>
                        <h4 class="font-extrabold text-slate-800 text-xs uppercase tracking-wider">ประกาศข่าวสารอื่นที่น่าสนใจ</h4>
                    </div>
                    
                    <div class="space-y-3.5">
                        @forelse($recentAds ?? [] as $recent)
                            @php
                                $rImages = json_decode($recent->image_path, true);
                                $rFirstImage = is_array($rImages) && count($rImages) > 0 ? $rImages[0] : null;
                            @endphp
                            <a href="{{ route('news.show', $recent->slug) }}" class="flex gap-3 group items-start border-b border-slate-50 pb-3 last:border-0 last:pb-0">
                                <div class="w-20 h-14 bg-slate-50 border border-slate-100 rounded-lg overflow-hidden shrink-0 relative">
                                    @if($rFirstImage)
                                        <img src="{{ asset($rFirstImage) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300 text-[10px]"><i class="fa-regular fa-image"></i></div>
                                    @endif
                                </div>
                                <div class="overflow-hidden space-y-1">
                                    <h5 class="text-xs font-bold text-slate-700 leading-snug line-clamp-2 group-hover:text-[#5EBEE6] transition-colors">
                                        {{ $recent->title }}
                                    </h5>
                                    <p class="text-[9px] text-slate-400 font-medium"><i class="fa-regular fa-calendar mr-0.5"></i> {{ date('d/m/Y', strtotime($recent->created_at)) }}</p>
                                </div>
                            </a>
                        @empty
                            <p class="text-xs text-slate-400 italic text-center py-2">ไม่มีประกาศข่าวอื่นๆ ในขณะนี้</p>
                        @endforelse
                    </div>
                </div>
            </aside>

        </div>
    </div>
</section>

@endsection