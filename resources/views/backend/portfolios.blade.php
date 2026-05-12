@extends('backend.layout')
@section('content')
<section class="w-full h-full p-6 md:p-10 font-kanit bg-gray-50/50">
        <div class="mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-slate-800 tracking-tight">จัดการแฟ้มสะสมผลงาน</h2>
            <p class="text-sm text-gray-500 mt-1">ตรวจสอบเป้าหมายและอนุมัติเล่มผลงานของนักเรียน</p>
        </div>

        {{-- ปรับจาก rounded-xl เป็น rounded-md --}}
        <div class="bg-white rounded-md shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 uppercase">
                        <th class="p-4 text-[11px] font-bold text-gray-400 tracking-widest w-16 text-center">id</th>
                        <th class="p-4 text-[11px] font-bold text-gray-400 tracking-widest">portfolio detail</th>
                        <th class="p-4 text-[11px] font-bold text-gray-400 tracking-widest">submitted by</th>
                        <th class="p-4 text-[11px] font-bold text-gray-400 tracking-widest text-center">preview</th>
                        <th class="p-4 text-[11px] font-bold text-gray-400 tracking-widest text-center">status</th>
                        <th class="p-4 text-[11px] font-bold text-gray-400 tracking-widest text-center">action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-lowercase">
                    @forelse($portfolios as $pf)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="p-4 text-xs text-gray-400 text-center">{{ $pf->id }}</td>
                        <td class="p-4">
                            <div class="font-bold text-slate-700 text-sm">
                                {{ $pf->first_name }} {{ $pf->last_name }}
                            </div>
                            <div class="text-[10px] text-[#5EBEE6] font-bold">
                                <i class="fa-solid fa-graduation-cap mr-1"></i> target: {{ $pf->university ?? '-' }}
                            </div>
                            <div class="text-[10px] text-gray-400 line-clamp-1 mt-1">{{ $pf->description }}</div>
                        </td>
                        <td class="p-4">
                            <div class="text-xs font-semibold text-slate-600">{{ $pf->owner_fname }} {{ $pf->owner_lname }}</div>
                            <div class="text-[10px] text-gray-400 italic">nickname: {{ $pf->nickname ?? '-' }}</div>
                        </td>
                        <td class="p-4 text-center">
                            @if($pf->file_path)
                                {{-- ปรับจาก rounded-full เป็น rounded-md --}}
                                <a href="{{ asset($pf->file_path) }}" target="_blank" 
                                   class="px-4 py-1.5 bg-slate-800 text-white text-[10px] font-bold rounded-md hover:bg-[#5EBEE6] transition-all">
                                   view portfolio
                                </a>
                            @else
                                <span class="text-[10px] text-gray-300 italic">no file</span>
                            @endif
                        </td>
                        <td class="p-4 text-center">
                            <form action="{{ route('backend.portfolios.updateStatus', $pf->id) }}" method="POST" id="form-{{ $pf->id }}">
                                @csrf @method('PATCH')
                                {{-- ปรับจาก rounded-full เป็น rounded-md และเพิ่ม border สีอ่อน --}}
                                <select name="status" onchange="this.form.submit()"
                                    class="text-[11px] font-bold border border-transparent rounded-md px-4 py-1.5 cursor-pointer focus:ring-0 appearance-none
                                    {{ $pf->status == 'approved' ? 'bg-emerald-100 text-emerald-600' : ($pf->status == 'rejected' ? 'bg-rose-100 text-rose-600' : 'bg-amber-100 text-amber-600') }}">
                                    <option value="pending" {{ $pf->status == 'pending' ? 'selected' : '' }}>pending</option>
                                    <option value="approved" {{ $pf->status == 'approved' ? 'selected' : '' }}>approved</option>
                                    <option value="rejected" {{ $pf->status == 'rejected' ? 'selected' : '' }}>rejected</option>
                                </select>
                            </form>
                        </td>
                        <td class="p-4 text-center">
                            <form action="{{ route('backend.portfolios.destroy', $pf->id) }}" method="POST" onsubmit="return confirm('delete this portfolio?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-gray-300 hover:text-rose-500 transition-colors">
                                    <i class="fa-solid fa-trash-can text-sm"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-10 text-center text-gray-400 text-xs italic">no portfolio data found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-4 border-t border-gray-50">
                {{ $portfolios->links() }}
            </div>
        </div>
</section>
@endsection