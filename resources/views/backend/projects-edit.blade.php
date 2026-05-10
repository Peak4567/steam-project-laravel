@extends('backend.layout')
@section('content')
    <section class="w-full min-h-[calc(100vh-80px)] p-6 md:p-10 font-kanit bg-gray-50/50">
        <div class="max-w-6xl mx-auto">
            <div class="mb-8">
                <a href="{{ route('backend.projects') }}"
                    class="text-sm font-medium text-gray-400 hover:text-[#5EBEE6] transition-colors flex items-center gap-2 mb-2">
                    <i class="fa-solid fa-arrow-left"></i> กลับไปหน้าจัดการโครงงาน
                </a>
                <h2 class="text-2xl font-bold text-slate-800">แก้ไขโครงงาน: {{ $project->name }}</h2>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <div class="w-full lg:w-2/3">
                    <form action="{{ route('backend.projects.update', $project->id) }}" method="POST"
                        enctype="multipart/form-data"
                        class="bg-white p-6 md:p-8 rounded-md border border-gray-200 shadow-sm space-y-5">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">ชื่อโครงงาน <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" id="in-name" value="{{ $project->name }}" required
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm focus:outline-none focus:border-[#5EBEE6]">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1.5">ชื่อทีม <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="team_name" id="in-team" value="{{ $project->team_name }}"
                                    required
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm focus:outline-none focus:border-[#5EBEE6]">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1.5">จำนวนสมาชิกที่รับ <span
                                        class="text-red-500">*</span></label>
                                <input type="number" name="max_members" id="in-max" value="{{ $project->max_members }}"
                                    required min="1"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm focus:outline-none focus:border-[#5EBEE6]">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">อาจารย์ที่ปรึกษา
                                (ค้นหาชื่อ)</label>
                            <select name="advisors[]" id="advisors-select" placeholder="พิมพ์เพื่อค้นหาชื่ออาจารย์..."
                                multiple autocomplete="off">
                                <option value="">เลือกอาจารย์ที่ปรึกษา</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ in_array($user->id, $currentAdvisors) ? 'selected' : '' }}>
                                        {{ $user->first_name }} {{ $user->last_name }} ({{ $user->nickname }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">สถานะโครงงาน <span
                                    class="text-red-500">*</span></label>
                            <select name="status" required
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-600 focus:outline-none focus:border-[#5EBEE6] cursor-pointer">
                                <option value="in_progress" {{ $project->status == 'in_progress' ? 'selected' : '' }}>
                                    กําลังดําเนินการ</option>
                                <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>
                                    สําเร็จแล้ว</option>
                                <option value="canceled" {{ $project->status == 'canceled' ? 'selected' : '' }}>ยกเลิก
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">รายละเอียดโครงงาน</label>
                            <textarea name="description" rows="4"
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-md text-sm focus:outline-none focus:border-[#5EBEE6]">{{ $project->description }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">เปลี่ยนรูปภาพโครงงาน
                                (อัปโหลดใหม่เพื่อเปลี่ยนรูปเดิม)</label>
                            <input type="file" name="file_upload" id="in-img" accept="image/*"
                                class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-500 file:mr-4 file:py-1.5 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-[#5EBEE6] cursor-pointer">
                        </div>

                        <div class="pt-6 border-t border-gray-50 flex gap-3">
                            <button type="submit"
                                class="flex-1 bg-[#5EBEE6] hover:bg-[#4fb1d8] text-white py-2.5 rounded-md font-medium shadow-sm transition-all">
                                <i class="fa-solid fa-save mr-2"></i> อัปเดตข้อมูล
                            </button>
                            <a href="{{ route('backend.projects') }}"
                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 py-2.5 rounded-md text-sm font-medium text-center transition-all">
                                ยกเลิก
                            </a>
                        </div>
                    </form>
                </div>

                <div class="w-full lg:w-1/3">
                    <p class="text-sm font-medium text-gray-400 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-eye"></i> ตัวอย่างการแสดงผล
                    </p>

                    <div class="bg-white rounded-md border border-gray-100 p-4 shadow-sm space-y-4">
                        <div class="aspect-video bg-gray-100 rounded-md overflow-hidden relative">
                            <img id="pv-img" src="{{ $project->file_path ? asset($project->file_path) : '' }}"
                                class="w-full h-full object-cover {{ $project->file_path ? '' : 'hidden' }}">
                            <div id="pv-no-img"
                                class="w-full h-full flex flex-col items-center justify-center text-gray-300 {{ $project->file_path ? 'hidden' : '' }}">
                                <i class="fa-regular fa-image text-3xl"></i>
                            </div>
                            <div
                                class="absolute top-3 left-3 bg-black/50 backdrop-blur-sm px-2 py-0.5 rounded-sm border border-white/20">
                                <p class="text-[9px] text-green-400 uppercase font-bold tracking-widest" id="pv-status">
                                    {{ $project->status == 'completed' ? 'Completed' : ($project->status == 'canceled' ? 'Canceled' : 'In Progress') }}
                                </p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <span
                                class="text-[10px] bg-blue-50 text-[#5EBEE6] px-2 py-0.5 rounded-sm font-bold border border-blue-100 uppercase tracking-widest"
                                id="pv-team">{{ $project->team_name ?? 'TEAM NAME' }}</span>
                            <h3 class="text-sm font-bold text-slate-800 line-clamp-2" id="pv-name">{{ $project->name }}
                            </h3>
                            <p class="text-[10px] text-gray-400">
                                <i class="fa-solid fa-user-tie mr-1"></i> อาจารย์ที่ปรึกษา:
                                <span id="pv-advisor" class="font-medium text-slate-600">
                                    @forelse($project->advisors as $adv)
                                        {{ $adv->user ? $adv->user->first_name : '' }}@if (!$loop->last)
                                            ,
                                        @endif
                                        @empty
                                            รอระบุ
                                        @endforelse
                                    </span>
                                </p>
                                <div class="flex items-center gap-1">
                                    <span class="text-[10px] text-[#5EBEE6]">รับสมัคร:</span>
                                    <span class="text-[10px] text-gray-400">0 / <span
                                            id="pv-max">{{ $project->max_members }}</span> คน</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="{{ asset('assets/js/project-edit.js') }}"></script>
    @endsection
