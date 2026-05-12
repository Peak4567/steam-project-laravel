@extends('backend.layout')
@section('content')
<section class="w-full h-full p-6 md:p-10 font-kanit bg-gray-50/50">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-slate-800 tracking-tight">จัดการผู้ใช้งาน</h2>
                <p class="text-sm text-gray-500 mt-1">จัดการผู้ใช้ภายในระบบเพื่อคัดกรอง</p>
            </div>
            
            <form action="{{ route('backend.users') }}" method="GET" class="w-full md:w-80 relative">
                {{-- ปรับความมนเป็น rounded-md --}}
                <input type="text" name="search" value="{{ request('search') }}" placeholder="search name, email, id..."
                    class="w-full bg-white border border-gray-100 rounded-md px-5 py-2 text-sm focus:outline-none focus:border-[#5EBEE6] shadow-sm">
                <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 hover:text-[#5EBEE6]">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </button>
            </form>
        </div>

        {{-- ปรับความมนเป็น rounded-md --}}
        <div class="bg-white rounded-md shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 uppercase">
                        <th class="p-4 text-[10px] font-bold text-gray-400 tracking-widest text-center w-16">id</th>
                        <th class="p-4 text-[10px] font-bold text-gray-400 tracking-widest">full name / profile</th>
                        <th class="p-4 text-[10px] font-bold text-gray-400 tracking-widest">student info</th>
                        <th class="p-4 text-[10px] font-bold text-gray-400 tracking-widest">email</th>
                        <th class="p-4 text-[10px] font-bold text-gray-400 tracking-widest text-center">level</th>
                        <th class="p-4 text-[10px] font-bold text-gray-400 tracking-widest text-center">action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-lowercase">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="p-4 text-xs text-gray-300 text-center">{{ $user->id }}</td>
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                {{-- ปรับ Profile เป็น rounded-md --}}
                                <div class="w-10 h-10 flex-shrink-0 rounded-md border border-gray-100 shadow-sm flex items-center justify-center text-slate-400 text-sm font-bold uppercase overflow-hidden bg-slate-50">
                                    @if($user->profile)
                                        <img src="{{ asset('assets/img/profile/' . $user->profile) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-slate-300">{{ substr($user->first_name, 0, 1) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-slate-700 leading-tight">{{ $user->prefix }}{{ $user->first_name }} {{ $user->last_name }}</div>
                                    <div class="text-[10px] text-[#5EBEE6] font-bold tracking-wider italic">nickname: {{ $user->nickname ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 text-xs text-gray-500">
                            <div class="font-medium">id: {{ $user->student_id ?? '-' }}</div>
                            <div class="text-[10px] opacity-70">{{ $user->grade_level ?? 'no grade' }}</div>
                        </td>
                        <td class="p-4 text-xs text-gray-500 font-light">{{ $user->email }}</td>
                        <td class="p-4 text-center">
                            {{-- ปรับ Badge เป็น rounded-md --}}
                            <span class="inline-block px-3 py-1 rounded-md text-[9px] font-bold uppercase tracking-widest {{ $user->level == 'admin' ? 'bg-slate-800 text-white' : 'bg-gray-100 text-gray-400' }}">
                                {{ $user->level }}
                            </span>
                        </td>
                        <td class="p-4 text-center">
                            <div class="flex justify-center gap-2">
                                {{-- ปรับความกว้าง-สูง และความมนปุ่ม --}}
                                <a href="{{ route('backend.users.edit', $user->id) }}" 
                                   class="w-9 h-9 rounded-md flex items-center justify-center text-gray-300 border border-gray-50 bg-white hover:bg-[#5EBEE6] hover:text-white hover:border-[#5EBEE6] transition-all shadow-sm">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>
                                <form action="{{ route('backend.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('delete this user?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" 
                                            class="w-9 h-9 rounded-md flex items-center justify-center text-gray-300 border border-gray-50 bg-white hover:bg-rose-500 hover:text-white hover:border-rose-500 transition-all shadow-sm">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            @if($users->hasPages())
            <div class="p-4 border-t border-gray-50">
                {{ $users->links() }}
            </div>
            @endif
        </div>
</section>
@endsection