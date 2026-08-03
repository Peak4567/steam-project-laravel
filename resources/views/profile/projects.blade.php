@extends('profile.profile-layout')

@section('profile-content')

    @if (isset($project) && $project)
        @php
            $amILeader = $project->members->where('id', Auth::id())->where('pivot.position', 'Leader')->isNotEmpty();
            $amILeaderTh = $project->members->where('id', Auth::id())->where('pivot.position', 'หัวหน้า')->isNotEmpty();

            $amIAdvisor = $project->advisors->where('id', Auth::id())->isNotEmpty();
            $hasPower = $amILeader || $amILeaderTh || $amIAdvisor;

            $statusLabels = [
                'in_progress' => 'กำลังดำเนินการ',
                'completed' => 'สำเร็จแล้ว',
                'canceled' => 'ยกเลิก',
            ];
        @endphp

        {{-- Completion Banner --}}
        @if ($project->status == 'completed')
            <div class="max-w-6xl mx-auto mb-6 bg-gradient-to-r from-emerald-500 to-teal-600 text-white shadow-md p-6 rounded-2xl flex flex-col md:flex-row items-center gap-6 relative overflow-hidden font-mitr">
                <i class="fa-solid fa-check-circle absolute -right-10 -bottom-10 text-9xl text-white opacity-10"></i>

                <div class="w-14 h-14 shrink-0 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm shadow-inner">
                    <i class="fa-solid fa-trophy text-2xl text-yellow-300 drop-shadow-md"></i>
                </div>

                <div class="text-center md:text-left z-10">
                    <h2 class="text-xl font-bold tracking-tight mb-0.5">ยินดีด้วย! โครงงานเสร็จสิ้นสมบูรณ์</h2>
                    <p class="text-emerald-50/90 text-xs font-medium">โครงงาน "{{ $project->name }}" ดำเนินการเสร็จสิ้นเรียบร้อย ขอบคุณสำหรับความพยายามและการร่วมมือของทุกคนในทีม!</p>
                </div>
            </div>
        @endif

        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-6 font-mitr">

            {{-- ฝั่งซ้าย: ข้อมูลสถานะและแบบฟอร์มแก้ไขข้อมูล --}}
            <div class="lg:col-span-4 space-y-5">

                {{-- การ์ดสถานะทีม --}}
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.02)] flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="w-full sm:w-auto flex-1">
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-2">สถานะทีม</p>

                        @if ($hasPower)
                            <form action="{{ route('projects.updateStatus', $project->id) }}" method="POST" class="flex flex-wrap items-center">
                                @csrf
                                @method('PATCH')

                                <div class="relative w-full shadow-sm">
                                    <select name="status" onchange="this.form.submit()"
                                        class="appearance-none w-full bg-slate-50 border border-slate-100 text-xs font-bold text-slate-700 rounded-xl py-2.5 pl-3.5 pr-10 focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 outline-none cursor-pointer transition-all">
                                        <option value="in_progress" {{ $project->status == 'in_progress' ? 'selected' : '' }}>กำลังดำเนินการ</option>
                                        <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>สำเร็จแล้ว</option>
                                        <option value="canceled" {{ $project->status == 'canceled' ? 'selected' : '' }}>ยกเลิก</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3.5 text-slate-400">
                                        <i class="fa-solid fa-chevron-down text-[10px]"></i>
                                    </div>
                                </div>
                            </form>
                        @else
                            <h2 class="font-bold text-slate-800 text-sm py-1">
                                <span class="inline-block w-2 h-2 rounded-full mr-1.5 {{ $project->status == 'completed' ? 'bg-emerald-500 shadow-sm shadow-emerald-400' : ($project->status == 'in_progress' ? 'bg-[#5EBEE6] shadow-sm shadow-sky-400' : 'bg-rose-500 shadow-sm shadow-rose-400') }}"></span>
                                {{ $statusLabels[$project->status] ?? 'กำลังดำเนินการ' }}
                            </h2>
                        @endif
                    </div>

                    <div class="flex gap-5 w-full sm:w-auto justify-start sm:justify-end border-t sm:border-t-0 pt-3.5 sm:pt-0 border-slate-50">
                        <div class="text-center min-w-[45px]">
                            <span class="block text-lg font-bold text-slate-800 leading-none">{{ $project->members_count ?? 0 }}</span>
                            <span class="text-[9px] text-slate-400 font-bold uppercase tracking-wider mt-1 block">สมาชิก</span>
                        </div>
                        <div class="text-center min-w-[45px]">
                            <span class="block text-lg font-bold text-slate-800 leading-none">{{ $project->advisor_count ?? ($project->advisors->count() ?? 0) }}</span>
                            <span class="text-[9px] text-slate-400 font-bold uppercase tracking-wider mt-1 block">ที่ปรึกษา</span>
                        </div>
                    </div>
                </div>

                {{-- ฟอร์มรายละเอียดรายวิชา --}}
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.02)] space-y-4">
                    <div class="flex items-center gap-2 mb-2 border-b border-slate-50 pb-2">
                        <div class="w-1.5 h-4 bg-[#5EBEE6] rounded-full"></div>
                        <h3 class="font-extrabold text-slate-800 text-sm tracking-tight">ข้อมูลรายวิชาโครงงาน</h3>
                    </div>

                    <div class="space-y-4">
                        @if ($hasPower)
                            <form action="{{ route('projects.update', $project->id) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PATCH')

                                <div class="space-y-1">
                                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wide pl-0.5">ชื่อโครงงาน</label>
                                    <input type="text" name="name" value="{{ old('name', $project->name) }}"
                                        class="w-full text-xs text-slate-700 font-medium bg-slate-50 border border-slate-100 p-2.5 rounded-xl outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all" required>
                                </div>

                                <div class="space-y-1">
                                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wide pl-0.5">ชื่อกลุ่ม / ชื่อทีม</label>
                                    <input type="text" name="team_name" value="{{ old('team_name', $project->team_name) }}"
                                        class="w-full text-xs text-slate-700 font-medium bg-slate-50 border border-slate-100 p-2.5 rounded-xl outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all" required>
                                </div>

                                @if (isset($amIAdvisor) && $amIAdvisor)
                                    <div class="space-y-1">
                                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wide pl-0.5">จำนวนสมาชิกสูงสุด (อาจารย์ระบุ)</label>
                                        <input type="number" name="max_members" value="{{ old('max_members', $project->max_members ?? 5) }}"
                                            class="w-full text-xs text-slate-700 font-medium bg-slate-50 border border-slate-100 p-2.5 rounded-xl outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all" min="1" required>
                                    </div>
                                @else
                                    <div class="space-y-0.5">
                                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wide pl-0.5">จำนวนที่รับสมัครสูงสุด</label>
                                        <p class="text-xs font-bold text-slate-700 bg-slate-50/70 border border-slate-100/50 p-2.5 rounded-xl">{{ $project->max_members ?? 5 }} คน</p>
                                    </div>
                                @endif

                                <div class="space-y-1">
                                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wide pl-0.5">คำอธิบาย/รายละเอียดหลัก</label>
                                    <textarea name="description" rows="3"
                                        class="w-full text-xs text-slate-600 font-medium bg-slate-50 border border-slate-100 p-2.5 rounded-xl outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 min-h-[70px] resize-none transition-all" required>{{ old('description', $project->description) }}</textarea>
                                </div>

                                <div class="text-right pt-1">
                                    <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded-xl text-xs font-bold transition-all shadow-sm active:scale-95">
                                        บันทึกการปรับปรุง
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="space-y-3">
                                <div>
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wide pl-0.5">ชื่อโครงงาน</label>
                                    <p class="text-xs font-bold text-slate-800 bg-slate-50/40 border border-slate-100 p-2.5 rounded-xl mt-0.5">{{ $project->name }}</p>
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wide pl-0.5">ชื่อกลุ่ม / ชื่อทีม</label>
                                    <p class="text-xs font-bold text-slate-800 bg-slate-50/40 border border-slate-100 p-2.5 rounded-xl mt-0.5">{{ $project->team_name }}</p>
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wide pl-0.5">จำนวนสมาชิกสูงสุด</label>
                                    <p class="text-xs font-bold text-slate-800 bg-slate-50/40 border border-slate-100 p-2.5 rounded-xl mt-0.5">{{ $project->max_members ?? 5 }} คน</p>
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wide pl-0.5">คำอธิบาย</label>
                                    <p class="text-xs text-slate-500 font-medium bg-slate-50/40 border border-slate-100 p-2.5 rounded-xl mt-0.5 min-h-[60px] leading-relaxed">{{ $project->description }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            {{-- ฝั่งขวา: รายชื่อสมาชิก และ ที่ปรึกษา --}}
            <div class="lg:col-span-8 space-y-5">

                {{-- รายชื่อนักเรียนในทีม --}}
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.02)]">
                    <div class="flex justify-between items-center mb-5 border-b border-slate-50 pb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-6 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                            <h3 class="font-extrabold text-slate-900 text-base tracking-tight">รายชื่อนักเรียนในทีม</h3>
                        </div>

                        {{-- Modal เชิญสมาชิกผ่าน Alpine.js --}}
                        @if ($hasPower)
                            @php
                                $searchableUsers = \App\Models\User::select('id', 'first_name', 'last_name', 'nickname', 'email', 'profile')->get();
                            @endphp

                            <div x-data="{
                                open: false,
                                search: '',
                                allUsers: @js($searchableUsers),
                                getRandomUsers() {
                                    let shuffled = [...this.allUsers].sort(() => 0.5 - Math.random());
                                    return shuffled.slice(0, 3);
                                },
                                filteredUsers() {
                                    if (this.search === '') {
                                        return this.getRandomUsers();
                                    }
                                    return this.allUsers.filter(user => {
                                        const searchStr = this.search.toLowerCase();
                                        return (user.first_name && user.first_name.toLowerCase().includes(searchStr)) ||
                                            (user.last_name && user.last_name.toLowerCase().includes(searchStr)) ||
                                            (user.nickname && user.nickname.toLowerCase().includes(searchStr)) ||
                                            (user.email && user.email.toLowerCase().includes(searchStr));
                                    });
                                }
                            }">

                                <button @click="open = true" class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:opacity-90 text-white px-4 py-2 rounded-xl text-xs font-bold shadow-md shadow-emerald-500/10 transition-all flex items-center gap-1.5 active:scale-95">
                                    <i class="fa-solid fa-user-plus text-[10px]"></i> เชิญสมาชิกเข้าทีม
                                </button>

                                <div x-show="open" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4 z-50" x-cloak x-transition>
                                    <div class="bg-white p-6 rounded-2xl w-full max-w-lg shadow-xl border border-slate-100" @click.away="open = false">
                                        <div class="flex justify-between items-center mb-5 border-b border-slate-50 pb-3">
                                            <h3 class="font-extrabold text-lg text-slate-800 tracking-tight">ค้นหาและเชิญเพื่อนร่วมทีม</h3>
                                            <button type="button" @click="open = false" class="w-7 h-7 rounded-lg bg-slate-50 text-slate-400 hover:bg-red-50 hover:text-red-500 transition-colors">
                                                <i class="fa-solid fa-xmark text-sm"></i>
                                            </button>
                                        </div>

                                        <div class="mb-5">
                                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1.5 pl-0.5">พิมพ์ระบุ ชื่อ, นามสกุล, ชื่อเล่น หรือ อีเมลผู้ใช้</label>
                                            <input type="text" x-model="search" placeholder="พิมพ์คีย์เวิร์ดเพื่อค้นหา..." class="w-full bg-slate-50 border border-slate-100 rounded-xl p-3 text-sm outline-none focus:bg-white focus:border-[#5EBEE6] focus:ring-4 focus:ring-[#5EBEE6]/10 transition-all">
                                        </div>

                                        <div class="space-y-2.5 max-h-[250px] overflow-y-auto pr-1">
                                            <template x-for="user in filteredUsers()" :key="user.id">
                                                <div class="flex items-center justify-between p-3 bg-slate-50/50 rounded-xl border border-slate-100/70">
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-9 h-9 rounded-full overflow-hidden border-2 border-white shadow-sm shrink-0 bg-slate-50 flex items-center justify-center text-slate-300">
                                                            <template x-if="user.profile">
                                                                <img :src="'{{ asset('assets/img/profile/') }}/' + user.profile" class="w-full h-full object-cover" alt="Profile">
                                                            </template>
                                                            <template x-if="!user.profile">
                                                                <i class="fa-solid fa-circle-user text-xl"></i>
                                                            </template>
                                                        </div>
                                                        <div>
                                                            <p class="text-xs font-bold text-slate-800">
                                                                <span x-text="user.first_name"></span> <span x-text="user.last_name"></span>
                                                                <span class="text-[10px] text-slate-400 font-semibold">(<span x-text="user.nickname"></span>)</span>
                                                            </p>
                                                            <p class="text-[10px] font-medium text-slate-400 mt-0.5" x-text="user.email"></p>
                                                        </div>
                                                    </div>

                                                    <form action="{{ route('projects.invite', $project->id) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="email" x-bind:value="user.email">
                                                        <button type="submit" class="bg-[#5EBEE6] hover:bg-[#45a8d1] text-white px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm transition-colors">
                                                            ส่งคำเชิญ
                                                        </button>
                                                    </form>
                                                </div>
                                            </template>

                                            <p x-show="filteredUsers().length === 0" class="text-center text-xs text-slate-400 py-8 font-medium">❌ ไม่พบรายชื่อผู้ใช้งานระบบนี้</p>
                                        </div>

                                        <div class="flex justify-end gap-2 mt-6 border-t border-slate-50 pt-4">
                                            <button type="button" @click="open = false" class="px-4 py-2 text-xs font-bold text-slate-500 hover:bg-slate-50 rounded-xl transition-colors">ยกเลิก</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm whitespace-nowrap">
                            <thead>
                                <tr class="text-slate-400 font-bold uppercase text-[10px] tracking-wider border-b border-slate-50">
                                    <th class="pb-3 pr-4">ชื่อสมาชิก</th>
                                    <th class="pb-3 pr-4">นามสกุล</th>
                                    <th class="pb-3 pr-4 text-center">ชื่อเล่น</th>
                                    <th class="pb-3 text-center">สถานะ / สิทธิ์ทีม</th>
                                </tr>
                            </thead>
                            <tbody class="text-slate-700 font-medium text-xs">
                                @forelse ($project->members as $member)
                                    <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition duration-200">
                                        <td class="py-3.5 pr-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full overflow-hidden border-2 border-white shadow-sm shrink-0 bg-slate-50 flex items-center justify-center text-slate-300">
                                                    @if ($member->profile)
                                                        <img src="{{ asset('assets/img/profile/' . $member->profile) }}" class="w-full h-full object-cover" alt="Profile">
                                                    @else
                                                        <i class="fa-solid fa-circle-user text-lg"></i>
                                                    @endif
                                                </div>
                                                <span class="font-bold text-slate-800">{{ $member->first_name }}</span>
                                            </div>
                                        </td>

                                        <td class="py-3.5 pr-4 text-slate-600">{{ $member->last_name }}</td>
                                        <td class="py-3.5 pr-4 text-center text-slate-500 font-semibold">{{ $member->nickname }}</td>

                                        <td class="py-3.5 text-center">
                                            @if (($member->pivot->status ?? '') == 'accept')
                                                <div class="flex items-center justify-center gap-2">
                                                    @if ($member->pivot->position == 'Leader')
                                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold bg-blue-50 border border-blue-100/50 text-[#5EBEE6] tracking-wide">
                                                            <i class="fa-solid fa-crown mr-1.5 text-[9px]"></i> หัวหน้ากลุ่ม (Leader)
                                                        </span>
                                                    @else
                                                        <span class="text-slate-500 text-[10px] font-bold bg-slate-50 border border-slate-100 px-2.5 py-1 rounded-lg">สมาชิกทีม (Member)</span>
                                                    @endif

                                                    @if (isset($amIAdvisor) && $amIAdvisor)
                                                        <form action="{{ route('projects.updatePosition', ['project_id' => $project->id, 'user_id' => $member->id]) }}" method="POST" class="inline-flex items-center">
                                                            @csrf
                                                            @method('PATCH')
                                                            <select name="position" onchange="this.form.submit()" class="bg-slate-50 border border-slate-100 text-[10px] p-1 font-bold rounded-lg outline-none cursor-pointer focus:bg-white transition-all">
                                                                <option value="Member" {{ $member->pivot->position == 'Member' ? 'selected' : '' }}>Member</option>
                                                                <option value="Leader" {{ $member->pivot->position == 'Leader' ? 'selected' : '' }}>Leader</option>
                                                            </select>
                                                        </form>
                                                    @endif
                                                </div>
                                            @elseif (($member->pivot->status ?? '') == 'pending')
                                                @if ($hasPower)
                                                    <div class="flex justify-center gap-2">
                                                        <form action="{{ route('projects.accept', ['project_id' => $project->id, 'user_id' => $member->id]) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="bg-emerald-500 text-white px-3 py-1 rounded-lg text-[10px] font-bold hover:bg-emerald-600 transition-colors shadow-sm">อนุมัติ</button>
                                                        </form>
                                                        <form action="{{ route('projects.decline', ['project_id' => $project->id, 'user_id' => $member->id]) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="bg-rose-50 text-rose-500 border border-rose-100 px-3 py-1 rounded-lg text-[10px] font-bold hover:bg-rose-100 transition-colors">ปฏิเสธ</button>
                                                        </form>
                                                    </div>
                                                @elseif (Auth::id() == $member->id)
                                                    <div class="flex items-center justify-center gap-2">
                                                        <span class="text-orange-500 text-[10px] font-bold bg-orange-50 border border-orange-100/50 px-2 py-1 rounded-lg flex items-center gap-1"><i class="fa-regular fa-clock"></i> รอการอนุมัติ</span>
                                                        <form action="{{ route('projects.decline', ['project_id' => $project->id, 'user_id' => Auth::id()]) }}" method="POST" class="inline-flex">
                                                            @csrf
                                                            <button type="submit" class="text-slate-400 hover:text-red-500 text-[10px] underline ml-1 font-normal">ยกเลิก</button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <span class="text-orange-500 text-[10px] font-bold bg-orange-50 border border-orange-100/50 px-2.5 py-1 rounded-lg"><i class="fa-regular fa-clock"></i> รออนุมัติ</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-10 text-center text-slate-400 font-medium">
                                            <i class="fa-solid fa-users text-2xl mb-2 opacity-30 block"></i> ยังไม่มีรายชื่อสมาชิกร่วมทีมงานในขณะนี้
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- อาจารย์ที่ปรึกษา --}}
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.02)]">
                    <div class="flex items-center gap-3 mb-5 border-b border-slate-50 pb-3">
                        <div class="w-2 h-6 bg-gradient-to-b from-purple-400 to-indigo-500 rounded-full shadow-sm"></div>
                        <h3 class="font-extrabold text-slate-900 text-base tracking-tight">คุณครู / อาจารย์ที่ปรึกษาโครงงาน</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm whitespace-nowrap">
                            <thead>
                                <tr class="text-slate-400 font-bold uppercase text-[10px] tracking-wider border-b border-slate-50">
                                    <th class="pb-3 pr-4">ชื่อ-นามสกุล</th>
                                    <th class="pb-3">ช่องทางการติดต่อ (Email)</th>
                                </tr>
                            </thead>
                            <tbody class="text-slate-700 font-medium text-xs">
                                @forelse ($project->advisors as $advisor)
                                    <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition duration-200">
                                        <td class="py-3.5 pr-4 font-bold text-slate-800">Aj. {{ $advisor->first_name }} {{ $advisor->last_name }}</td>
                                        <td class="py-3.5 text-slate-500 font-semibold"><i class="fa-regular fa-envelope text-[10px] text-slate-400 mr-1"></i> {{ $advisor->email }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="py-8 text-center text-slate-400 font-medium">
                                            <i class="fa-solid fa-user-tie text-2xl mb-2 opacity-30 block"></i> ยังไม่ได้มีการผูกข้อมูลอาจารย์ที่ปรึกษา
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        {{-- โครงงานทั้งหมดของผู้ใช้ --}}
        @if (isset($allProjects) && count($allProjects) > 0)
            <div class="max-w-6xl mx-auto mt-12 border-t border-slate-100 pt-10 font-mitr">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-2.5 h-6 bg-gradient-to-b from-[#5EBEE6] to-blue-500 rounded-full shadow-sm"></div>
                    <h3 class="text-lg font-extrabold text-slate-800 tracking-tight">โครงงานทั้งหมดของคุณ</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($allProjects as $p)
                        <a href="{{ route('project.show', $p->id) }}"
                            class="group block bg-white p-3.5 rounded-2xl border border-slate-100 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                            <div class="h-40 rounded-xl overflow-hidden mb-3 relative bg-slate-50">
                                <img src="{{ $p->image_path ? asset('storage/' . $p->image_path) : asset('assets/img/aerosol.jpg') }}"
                                    class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-700 ease-out" alt="{{ $p->name }}">
                                <div class="absolute top-2.5 left-2.5 bg-slate-900/70 backdrop-blur-sm px-2.5 py-1 rounded-md text-[9px] font-bold text-white uppercase tracking-wider">
                                    {{ $statusLabels[$p->status] ?? 'กำลังดำเนินการ' }}
                                </div>
                            </div>
                            <h4 class="text-sm font-bold text-slate-800 truncate mb-0.5 group-hover:text-[#5EBEE6] transition-colors">{{ $p->name }}</h4>
                            <p class="text-xs font-medium text-slate-400">ทีม: {{ $p->team_name }}</p>

                            <div class="flex flex-wrap gap-1.5 mt-3">
                                @foreach ($p->tags as $tag)
                                    <span class="bg-blue-50 border border-blue-100/50 text-[#5EBEE6] px-2 py-0.5 rounded text-[9px] font-bold">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    @else
        {{-- Empty State กรณีผู้ใช้ยังไม่มีโครงงาน --}}
        <div class="max-w-xl mx-auto mt-16 text-center p-10 bg-white rounded-2xl border border-slate-100 shadow-lg font-mitr">
            <div class="w-16 h-16 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center mx-auto text-3xl mb-4 shadow-inner">📂</div>
            <h2 class="text-xl font-extrabold text-slate-800 tracking-tight">คุณยังไม่มีข้อมูลรายวิชาโครงงาน</h2>
            <p class="text-slate-400 text-sm mt-1 mb-6 font-medium leading-relaxed">กรุณาคลิกเลือกหรือร่วมทีมกับโครงงานที่กำลังเปิดรับสมัครเพื่อเริ่มบริหารจัดการระบบทีม</p>
            <a href="{{ route('projects') }}" class="inline-block bg-slate-900 hover:bg-slate-800 text-white px-6 py-3 rounded-xl text-xs font-bold transition-all shadow-md active:scale-95">
                ไปที่หน้าค้นหาโครงงาน <i class="fa-solid fa-arrow-right ml-1 text-[10px]"></i>
            </a>
        </div>
    @endif

@endsection