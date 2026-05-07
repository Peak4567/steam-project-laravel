@extends('layout') 

@section('content')
<section class="min-h-screen bg-[#F8FBFF] py-12 px-6">
    <div class="max-w-5xl mx-auto">
        <a href="{{ route('projects') }}" class="inline-flex items-center text-gray-400 hover:text-[#5EBEE6] transition-colors mb-6">
            <i class="fa-duotone fa-regular fa-angle-left mr-2"></i> กลับไปหน้าค้นหาโครงงาน
        </a>

        @if (session('success'))
            <div class="bg-green-100 border border-green-200 text-green-700 px-6 py-4 rounded-xl mb-6 shadow-sm">
                <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 border border-red-200 text-red-700 px-6 py-4 rounded-xl mb-6 shadow-sm">
                <i class="fa-solid fa-triangle-exclamation mr-2"></i> {{ $errors->first() }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col md:flex-row">
            
            <div class="w-full md:w-1/2 p-8 md:p-10 bg-gradient-to-br from-white to-blue-50/50">
                <div class="flex gap-2 mb-4">
                    @foreach($project->tags as $tag)
                        <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-[10px] font-bold">{{ $tag->name }}</span>
                    @endforeach
                </div>
                
                <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $project->name }}</h1>
                <p class="text-sm text-[#5EBEE6] font-medium mb-6">ทีม: {{ $project->team_name }}</p>

                <div class="space-y-6">
                    <div>
                        <h3 class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-2">รายละเอียดโครงงาน</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $project->description }}</p>
                    </div>

                    <div>
                        <h3 class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-2">อาจารย์ที่ปรึกษา</h3>
                        <ul class="text-sm text-gray-600 space-y-1">
                            @forelse($project->advisors as $advisor)
                                <li><i class="fa-solid fa-user-tie mr-2 text-gray-400"></i> {{ $advisor->first_name }} {{ $advisor->last_name }}</li>
                            @empty
                                <li>ยังไม่ระบุอาจารย์ที่ปรึกษา</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-1/2 p-8 md:p-10 border-t md:border-t-0 md:border-l border-gray-100 bg-white">
                <h2 class="text-xl font-bold text-gray-800 mb-6">ฟอร์มส่งคำขอเข้าร่วมทีม</h2>

                @php
                    $currentMembersCount = $project->members_count ?? $project->members->count() ?? 0;
                    $maxMembersAllowed = $project->max_members ?? 5;
                    $isFull = $currentMembersCount >= $maxMembersAllowed;
                @endphp

                @if($isFull)
                    <div class="text-center py-10">
                        <div class="w-16 h-16 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                            <i class="fa-solid fa-ban"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2">ขออภัย สมาชิกเต็มแล้ว</h3>
                        <p class="text-sm text-gray-500">โครงงานนี้รับสมาชิกครบจำนวน {{ $maxMembersAllowed }} คนแล้ว</p>
                    </div>
                @elseif($isMember)
                    <div class="text-center py-10">
                        <div class="w-16 h-16 bg-blue-100 text-blue-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                            <i class="fa-solid fa-paper-plane"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2">คุณได้ส่งคำขอไปแล้ว</h3>
                        <p class="text-sm text-gray-500">สถานะปัจจุบันของคุณอยู่ในทีมนี้ หรือกำลังรอการตอบรับจากหัวหน้าทีม</p>
                    </div>
                @else
                    <form action="{{ route('projects.requestJoin', $project->id) }}" method="POST">
                        @csrf
                        
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">ทำไมคุณถึงอยากทำโครงงานนี้? (ไม่บังคับ)</label>
                            <textarea name="message" rows="4" class="w-full bg-[#EEEEEE] border-none rounded-xl p-4 text-gray-600 focus:ring-2 focus:ring-[#5EBEE6] transition-all outline-none resize-none" placeholder="บอกหัวหน้าทีมหน่อยว่าคุณถนัดอะไร หรือช่วยส่วนไหนของทีมได้บ้าง..."></textarea>
                        </div>

                        <div class="bg-orange-50 border border-orange-100 rounded-xl p-4 mb-8">
                            <p class="text-[11px] text-orange-600">
                                <i class="fa-solid fa-circle-info mr-1"></i> เมื่อกดยืนยัน ข้อมูลโปรไฟล์ของคุณจะถูกส่งไปให้หัวหน้าทีมพิจารณาเพื่อกดรับเข้าทีม
                            </p>
                        </div>

                        <button type="submit" class="w-full py-4 bg-[#5EBEE6] hover:bg-[#45a8d1] text-white font-bold rounded-xl shadow-sm transition-all hover:-translate-y-1">
                            ยืนยันการส่งใบสมัคร
                        </button>
                    </form>
                @endif
            </div>

        </div>
    </div>
</section>
@endsection