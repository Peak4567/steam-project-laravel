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

        @if ($project->status == 'completed')
            <div
                class="max-w-7xl mx-auto mb-6 bg-green-500 text-white shadow-md p-6 rounded-md flex flex-col md:flex-row items-center gap-6 relative overflow-hidden">
                <i class="fa-solid fa-check-circle absolute -right-10 -bottom-10 text-9xl text-white opacity-10"></i>

                <div
                    class="w-16 h-16 shrink-0 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm shadow-inner">
                    <i class="fa-solid fa-trophy text-3xl text-yellow-300 drop-shadow-md"></i>
                </div>

                <div class="text-center md:text-left z-10">
                    <h2 class="text-2xl mb-1">ยินดีด้วย! โครงงานสำเร็จแล้ว</h2>
                    <p class="text-green-50 text-sm">โครงงาน "{{ $project->name }}" ดำเนินการเสร็จสิ้นสมบูรณ์
                        ขอบคุณสำหรับความพยายามของทุกคนในทีม!</p>
                </div>
            </div>
        @endif
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-6">

            <div class="lg:col-span-4 space-y-4">
                @if (session('success'))
                    <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-4 text-sm shadow-sm">{{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="bg-red-100 text-red-700 p-4 rounded-xl mb-4 text-sm shadow-sm">{{ session('error') }}</div>
                @endif

                <div
                    class="bg-white p-5 rounded-xl border border-gray-200 flex flex-col md:flex-row justify-between items-start md:items-center gap-5 shadow-sm">

                    <div class="w-full md:w-auto flex-1">
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-2">สถานะโครงงาน</p>

                        @if ($hasPower)
                            <form action="{{ route('projects.updateStatus', $project->id) }}" method="POST"
                                class="flex flex-wrap items-center gap-2">
                                @csrf
                                @method('PATCH')

                                <div class="relative">
                                    <select name="status" onchange="this.form.submit()"
                                        class="appearance-none bg-gray-50 border border-gray-200 text-sm text-gray-700 rounded-lg py-2 pl-3 pr-8 focus:ring-2 focus:ring-[#5EBEE6] focus:border-[#5EBEE6] outline-none cursor-pointer min-w-[140px] transition-all">
                                        <option value="in_progress"
                                            {{ $project->status == 'in_progress' ? 'selected' : '' }}>กำลังดำเนินการ
                                        </option>
                                        <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>
                                            สำเร็จแล้ว</option>
                                        <option value="canceled" {{ $project->status == 'canceled' ? 'selected' : '' }}>
                                            ยกเลิก</option>
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                                        <i class="fa-solid fa-chevron-down text-[10px]"></i>
                                    </div>
                                </div>
                            </form>
                        @else
                            <h2 class="font-bold text-gray-800 my-1 text-lg">
                                <span
                                    class="inline-block w-2 h-2 rounded-full mr-2 
                                    {{ $project->status == 'completed' ? 'bg-green-500' : ($project->status == 'in_progress' ? 'bg-[#5EBEE6]' : 'bg-red-500') }}">
                                </span>
                                {{ $statusLabels[$project->status] ?? 'กำลังดำเนินการ' }}
                            </h2>
                        @endif
                    </div>

                    <div
                        class="flex gap-6 w-full md:w-auto justify-start md:justify-end border-t md:border-t-0 pt-4 md:pt-0 border-gray-100">
                        <div class="text-center">
                            <span class="block text-xl text-gray-800">{{ $project->members_count ?? 0 }}</span>
                            <span class="text-[10px] text-gray-400 uppercase tracking-wider">สมาชิก</span>
                        </div>
                        <div class="text-center">
                            <span
                                class="block text-xl text-gray-800">{{ $project->advisor_count ?? ($project->advisors->count() ?? 0) }}</span>
                            <span class="text-[10px] text-gray-400 uppercase tracking-wider">ที่ปรึกษา</span>
                        </div>
                    </div>
                </div>

                {{-- กล่องข้อมูลโครงงาน (หัวหน้าทีมและอาจารย์สามารถแก้ไขได้) --}}
                <div class="bg-white p-5 rounded-xl border border-gray-200 space-y-4 shadow-sm">
                    <h3 class="font-bold text-gray-800 text-sm border-b border-gray-100 pb-2">ข้อมูลโครงงาน</h3>
                    <div class="space-y-4">

                        @if ($hasPower)
                            <form action="{{ route('projects.update', $project->id) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PATCH')

                                <div>
                                    <label class="text-[10px] text-gray-400 uppercase">ชื่อโครงงาน</label>
                                    <input type="text" name="name" value="{{ old('name', $project->name) }}"
                                        class="w-full text-sm text-gray-700 bg-blue-50 p-2 rounded-lg mt-1 border-none focus:ring-2 focus:ring-[#5EBEE6] outline-none"
                                        required>
                                </div>

                                <div>
                                    <label class="text-[10px] text-gray-400 uppercase">ชื่อทีม</label>
                                    <input type="text" name="team_name"
                                        value="{{ old('team_name', $project->team_name) }}"
                                        class="w-full text-sm text-gray-700 bg-blue-50 p-2 rounded-lg mt-1 border-none focus:ring-2 focus:ring-[#5EBEE6] outline-none"
                                        required>
                                </div>

                                @if (isset($amIAdvisor) && $amIAdvisor)
                                    <div>
                                        <label
                                            class="text-[10px] text-gray-400 uppercase">กำหนดจำนวนสมาชิกที่รับสูงสุด</label>
                                        <div class="flex gap-2 mt-1">
                                            <input type="number" name="max_members"
                                                value="{{ old('max_members', $project->max_members ?? 5) }}"
                                                class="w-full bg-gray-50 border border-gray-200 text-sm rounded-lg p-2 focus:ring-2 focus:ring-[#5EBEE6] outline-none"
                                                min="1" required>
                                        </div>
                                    </div>
                                @else
                                    <div>
                                        <label
                                            class="text-[10px] text-gray-400 uppercase">จำนวนสมาชิกที่รับได้สูงสุด</label>
                                        <p class="text-sm text-gray-700 bg-gray-50 p-2 rounded-lg mt-1">
                                            {{ $project->max_members ?? 5 }} คน</p>
                                    </div>
                                @endif

                                <div>
                                    <label class="text-[10px] text-gray-400 uppercase">รายละเอียด</label>
                                    <textarea name="description" rows="3"
                                        class="w-full text-xs text-gray-600 bg-blue-50 p-2 rounded-lg mt-1 border-none focus:ring-2 focus:ring-[#5EBEE6] outline-none min-h-[60px]"
                                        required>{{ old('description', $project->description) }}</textarea>
                                </div>

                                <div class="text-right">
                                    <button type="submit"
                                        class="bg-[#5EBEE6] hover:bg-[#45a8d1] text-white px-4 py-2 rounded-lg text-xs transition-all shadow-sm">
                                        บันทึกข้อมูลโครงงาน
                                    </button>
                                </div>
                            </form>
                        @else
                            <div>
                                <label class="text-[10px] text-gray-400 uppercase">ชื่อโครงงาน</label>
                                <p class="text-sm text-gray-700 bg-blue-50 p-2 rounded-lg mt-1">{{ $project->name }}</p>
                            </div>
                            <div>
                                <label class="text-[10px] text-gray-400 uppercase">ชื่อทีม</label>
                                <p class="text-sm text-gray-700 bg-blue-50 p-2 rounded-lg mt-1">{{ $project->team_name }}
                                </p>
                            </div>
                            <div>
                                <label
                                    class="text-[10px] text-gray-400 uppercase">จำนวนสมาชิกที่รับได้สูงสุด</label>
                                <p class="text-sm text-gray-700 bg-gray-50 p-2 rounded-lg mt-1">
                                    {{ $project->max_members ?? 5 }} คน</p>
                            </div>
                            <div>
                                <label class="text-[10px] text-gray-400 uppercase">รายละเอียด</label>
                                <p class="text-xs text-gray-500 bg-blue-50 p-2 rounded-lg mt-1 min-h-[60px]">
                                    {{ $project->description }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <div class="lg:col-span-8 space-y-4">

                <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-gray-800 text-sm">ผู้สมัคร/สมาชิกโครงงาน</h3>
                        @if ($hasPower)
                            @php
                                $searchableUsers = \App\Models\User::select(
                                    'id',
                                    'first_name',
                                    'last_name',
                                    'nickname',
                                    'email',
                                    'profile',
                                )->get();
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
                                        return (user.first_name && user.first_name.toLowerCase().includes(constStr)) ||
                                            (user.last_name && user.last_name.toLowerCase().includes(constStr)) ||
                                            (user.nickname && user.nickname.toLowerCase().includes(constStr)) ||
                                            (user.email && user.email.toLowerCase().includes(constStr));
                                    });
                                }
                            }">

                                <button @click="open = true"
                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg text-xs font-medium transition flex items-center gap-1">
                                    <i class="fa-solid fa-user-plus text-[10px]"></i> เชิญสมาชิก
                                </button>

                                <div x-show="open"
                                    class="fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50" x-cloak>

                                    <div class="bg-white p-6 rounded-xl w-full max-w-lg shadow-xl"
                                        @click.away="open = false">

                                        <div class="flex justify-between items-center mb-4 border-b pb-2">
                                            <h3 class="font-bold text-lg text-slate-800">ค้นหาและเชิญสมาชิกเข้าทีม</h3>
                                            <button type="button" @click="open = false"
                                                class="text-gray-400 hover:text-gray-600">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>

                                        <div class="mb-5">
                                            <label
                                                class="block text-[10px] text-gray-400 uppercase tracking-wider mb-1">ค้นหาจาก
                                                ชื่อ, นามสกุล, ชื่อเล่น หรือ อีเมล</label>
                                            <input type="text" x-model="search" placeholder="พิมพ์เพื่อค้นหา..."
                                                class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-[#5EBEE6] outline-none transition">
                                        </div>

                                        <div class="space-y-2 max-h-[260px] overflow-y-auto pr-1">

                                            <template x-for="user in filteredUsers()" :key="user.id">
                                                <div
                                                    class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-100">
                                                    <div class="flex items-center gap-3">
                                                        <div
                                                            class="w-10 h-10 rounded-full overflow-hidden border border-gray-200 shrink-0">
                                                            <template x-if="user.profile">
                                                                <img :src="'{{ asset('assets/img/profile/') }}/' + user.profile"
                                                                    class="w-full h-full object-cover" alt="Profile">
                                                            </template>
                                                            <template x-if="!user.profile">
                                                                <img :src="'https://ui-avatars.com/api/?name=' + encodeURIComponent
                                                                    (user.first_name) +
                                                                    '&color=7F9CF5&background=EBF4FF'"
                                                                    class="w-full h-full object-cover" alt="Avatar">
                                                            </template>
                                                        </div>
                                                        <div>
                                                            <p class="text-xs text-gray-800">
                                                                <span x-text="user.first_name"></span> <span
                                                                    x-text="user.last_name"></span>
                                                                <span class="text-[10px] text-gray-400 font-medium">(<span
                                                                        x-text="user.nickname"></span>)</span>
                                                            </p>
                                                            <p class="text-[10px] text-gray-500 mt-0.5"
                                                                x-text="user.email">
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <form action="{{ route('projects.invite', $project->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="email" x-bind:value="user.email">
                                                        <button type="submit"
                                                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-xs shadow-sm transition">
                                                            เชิญเข้าร่วม
                                                        </button>
                                                    </form>
                                                </div>
                                            </template>

                                            <p x-show="filteredUsers().length === 0"
                                                class="text-center text-xs text-gray-400 py-6">
                                                ไม่พบผู้ใช้งานในระบบ
                                            </p>

                                        </div>

                                        <div class="flex justify-end gap-2 mt-6 border-t pt-4">
                                            <button type="button" @click="open = false"
                                                class="px-4 py-2 text-xs text-gray-600 hover:bg-gray-100 rounded-lg transition">ปิดหน้าต่าง</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>





                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm whitespace-nowrap">
                            <thead>
                                <tr class="text-gray-400 uppercase text-[10px] border-b">
                                    <th class="pb-3 pr-4">ชื่อ</th>
                                    <th class="pb-3 pr-4">นามสกุล</th>
                                    <th class="pb-3 pr-4">ชื่อเล่น</th>
                                    <th class="pb-3 text-center">ตำแหน่ง/สถานะ</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @forelse ($project->members as $member)
                                    <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition">

                                        <td class="py-3 pr-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full overflow-hidden border border-gray-200">
                                                    @if ($member->profile)
                                                        <img src="{{ asset('assets/img/profile/' . $member->profile) }}"
                                                            class="w-full h-full object-cover" alt="Profile">
                                                    @else
                                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($member->first_name) }}&color=7F9CF5&background=EBF4FF"
                                                            class="w-full h-full object-cover" alt="Avatar">
                                                    @endif
                                                </div>
                                                <span>{{ $member->first_name }}</span>
                                            </div>
                                        </td>

                                        <td class="py-3 pr-4">{{ $member->last_name }}</td>
                                        <td class="py-3 pr-4">{{ $member->nickname }}</td>

                                        <td class="py-3 text-center">
                                            @if ($member->pivot)
                                                <div class="flex items-center justify-center gap-2">

                                                    @if ($member->pivot->position == 'Leader')
                                                        <span
                                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-600">
                                                            <i class="fa-solid fa-crown mr-1 text-[10px]"></i> หัวหน้าทีม
                                                            (Leader)
                                                        </span>
                                                    @else
                                                        <span
                                                            class="text-green-600 text-xs font-medium bg-green-50 px-2 py-1 rounded">สมาชิก
                                                            (Member)</span>
                                                    @endif

                                                    {{-- 🌟 แก้ไข: ตรวจสอบให้แน่ใจว่าผู้ใช้งานเป็นอาจารย์ที่ปรึกษา ($amIAdvisor) เท่านั้นจึงจะเห็น Dropdown ปรับตำแหน่ง --}}
                                                    @if (isset($amIAdvisor) && $amIAdvisor)
                                                        <form
                                                            action="{{ route('projects.updatePosition', ['project_id' => $project->id, 'user_id' => $member->id]) }}"
                                                            method="POST" class="inline-flex items-center">
                                                            @csrf
                                                            @method('PATCH')
                                                            <select name="position" onchange="this.form.submit()"
                                                                class="bg-gray-50 border border-gray-200 text-[10px] p-0.5 rounded focus:ring-1 focus:ring-[#5EBEE6] outline-none cursor-pointer">
                                                                <option value="Member"
                                                                    {{ $member->pivot->position == 'Member' ? 'selected' : '' }}>
                                                                    Member
                                                                </option>
                                                                <option value="Leader"
                                                                    {{ $member->pivot->position == 'Leader' ? 'selected' : '' }}>
                                                                    Leader
                                                                </option>
                                                            </select>
                                                        </form>
                                                    @endif

                                                </div>
                                            @elseif (($member->pivot->status ?? '') == 'pending')
                                                @if ($hasPower)
                                                    <div class="flex justify-center gap-2">
                                                        <form
                                                            action="{{ route('projects.accept', ['project_id' => $project->id, 'user_id' => $member->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                class="bg-green-500 text-white px-3 py-1 rounded-md text-[10px] font-medium hover:bg-green-600 transition shadow-sm">รับเข้าทีม</button>
                                                        </form>
                                                        <form
                                                            action="{{ route('projects.decline', ['project_id' => $project->id, 'user_id' => $member->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                class="bg-red-50 text-red-500 border border-red-200 px-3 py-1 rounded-md text-[10px] font-medium hover:bg-red-100 transition shadow-sm">ปฏิเสธ</button>
                                                        </form>
                                                    </div>
                                                @elseif (Auth::id() == $member->id)
                                                    <div class="flex items-center justify-center gap-2">
                                                        <span
                                                            class="text-orange-500 text-xs font-medium bg-orange-50 px-2 py-1 rounded">รอการอนุมัติ</span>
                                                        <form
                                                            action="{{ route('projects.decline', ['project_id' => $project->id, 'user_id' => Auth::id()]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                class="text-red-400 hover:text-red-600 text-[10px] underline">ยกเลิกคำขอ</button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <span
                                                        class="text-orange-500 text-xs font-medium bg-orange-50 px-2 py-1 rounded">รอการอนุมัติ</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-6 text-center text-gray-400">
                                            <i class="fa-solid fa-users text-2xl mb-2 opacity-50 block"></i>
                                            ยังไม่มีสมาชิกในทีม
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- อาจารย์ที่ปรึกษา --}}
                <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-gray-800 text-sm">อาจารย์ที่ปรึกษา</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm whitespace-nowrap">
                            <thead>
                                <tr class="text-gray-400 uppercase text-[10px] border-b">
                                    <th class="pb-3 pr-4">ชื่อ</th>
                                    <th class="pb-3 pr-4">นามสกุล</th>
                                    <th class="pb-3">อีเมล</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @forelse ($project->advisors as $advisor)
                                    <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition">
                                        <td class="py-3 pr-4">{{ $advisor->first_name }}</td>
                                        <td class="py-3 pr-4">{{ $advisor->last_name }}</td>
                                        <td class="py-3 text-gray-500">{{ $advisor->email }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-6 text-center text-gray-400">
                                            <i class="fa-solid fa-user-tie text-2xl mb-2 opacity-50 block"></i>
                                            ยังไม่มีอาจารย์ที่ปรึกษา
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        @if (isset($allProjects))
            <div class="max-w-7xl mx-auto mt-12 border-t border-gray-100 pt-12">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-2 h-8 bg-[#5EBEE6] rounded-xl"></div>
                    <h3 class="text-lg text-slate-800">โครงงานทั้งหมดของคุณ</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($allProjects as $p)
                        <a href="{{ route('project.show', $p->id) }}"
                            class="group block bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all hover:-translate-y-1">
                            <div class="h-40 rounded-lg overflow-hidden mb-3 relative">
                                <img src="{{ $p->image_path ? asset('storage/' . $p->image_path) : asset('assets/img/aerosol.jpg') }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                    alt="{{ $p->name }}">
                                <div
                                    class="absolute top-2 left-2 bg-black/50 backdrop-blur-sm px-2 py-0.5 rounded-lg text-[9px] text-white">
                                    {{ $statusLabels[$p->status] ?? 'กำลังดำเนินการ' }}
                                </div>
                            </div>
                            <h4 class="text-sm text-gray-800 truncate">{{ $p->name }}</h4>
                            <p class="text-xs text-gray-400 mt-0.5">ทีม: {{ $p->team_name }}</p>

                            <div class="flex flex-wrap gap-1 mt-3">
                                @foreach ($p->tags as $tag)
                                    <span class="bg-blue-50 text-[#5EBEE6] px-2 py-0.5 rounded text-[9px] font-medium">
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
        <div class="max-w-xl mx-auto mt-20 text-center p-12 bg-white rounded-2xl border border-gray-100 shadow-sm">
            <div class="text-5xl mb-4">📂</div>
            <h2 class="text-xl text-gray-800">คุณยังไม่มีโครงงาน</h2>
            <p class="text-gray-500 mt-2 mb-6">เริ่มต้นสร้างโครงงานหรือเข้าร่วมทีมเพื่อแสดงข้อมูลที่นี่</p>
            <a href="#"
                class="bg-[#5EBEE6] hover:bg-[#45a8d1] text-white px-6 py-2.5 rounded-lg transition shadow-sm">สร้างโครงงานของคุณ</a>
        </div>
    @endif

@endsection
