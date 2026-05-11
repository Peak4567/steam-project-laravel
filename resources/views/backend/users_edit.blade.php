@extends('backend.layout')
@section('content')
<section class="w-full min-h-[calc(100vh-80px)] p-6 md:p-10 font-kanit bg-gray-50/50">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('backend.users') }}" class="text-sm text-gray-400 hover:text-[#5EBEE6] transition-colors flex items-center gap-2 mb-2 lowercase">
                <i class="fa-solid fa-arrow-left text-xs"></i> back to users list
            </a>
            <h2 class="text-2xl font-bold text-slate-800">แก้ไขข้อมูลผู้ใช้งาน</h2>
        </div>

        <form action="{{ route('backend.users.update', $user->id) }}" method="POST" class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 space-y-6">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">prefix</label>
                    <input type="text" name="prefix" value="{{ $user->prefix }}" class="w-full bg-gray-50 border border-gray-100 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-[#5EBEE6]">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">first name</label>
                    <input type="text" name="first_name" value="{{ $user->first_name }}" required class="w-full bg-gray-50 border border-gray-100 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-[#5EBEE6]">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">last name</label>
                    <input type="text" name="last_name" value="{{ $user->last_name }}" required class="w-full bg-gray-50 border border-gray-100 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-[#5EBEE6]">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">nickname</label>
                    <input type="text" name="nickname" value="{{ $user->nickname }}" required class="w-full bg-gray-50 border border-gray-100 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-[#5EBEE6]">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">email address</label>
                    <input type="email" name="email" value="{{ $user->email }}" required class="w-full bg-gray-50 border border-gray-100 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-[#5EBEE6]">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">student id</label>
                    <input type="text" name="student_id" value="{{ $user->student_id }}" class="w-full bg-gray-50 border border-gray-100 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-[#5EBEE6]">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">grade level</label>
                    <input type="text" name="grade_level" value="{{ $user->grade_level }}" class="w-full bg-gray-50 border border-gray-100 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-[#5EBEE6]">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">access level</label>
                    <select name="level" class="w-full bg-gray-50 border border-gray-100 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-[#5EBEE6]">
                        <option value="member" {{ $user->level == 'member' ? 'selected' : '' }}>member (student)</option>
                        <option value="admin" {{ $user->level == 'admin' ? 'selected' : '' }}>admin (staff)</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 italic text-[#5EBEE6]">new password (leave blank to keep current)</label>
                <input type="password" name="password" placeholder="••••••••" class="w-full bg-gray-50 border border-gray-100 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-[#5EBEE6]">
            </div>

            <div class="pt-6 border-t border-gray-50 flex gap-4">
                <button type="submit" class="flex-1 bg-slate-800 hover:bg-slate-900 text-white py-3 rounded-lg font-bold text-sm uppercase tracking-widest transition-all">update user information</button>
                <a href="{{ route('backend.users') }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-500 py-3 rounded-lg font-bold text-sm text-center uppercase tracking-widest transition-all">cancel</a>
            </div>
        </form>
    </div>
</section>
@endsection 