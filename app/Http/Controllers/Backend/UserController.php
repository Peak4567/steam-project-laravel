<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BannedIp;
use App\Models\LoginLog;
use App\Models\Portfolio;
use App\Models\Sheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('users');

        // ระบบค้นหาข้อมูลสมาชิก
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'LIKE', "%{$request->search}%")
                  ->orWhere('last_name', 'LIKE', "%{$request->search}%")
                  ->orWhere('email', 'LIKE', "%{$request->search}%")
                  ->orWhere('student_id', 'LIKE', "%{$request->search}%");
            });
        }

        $users = $query->latest()->paginate(10);
        return view('backend.users', compact('users'));
    }

    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        $loginLogs = LoginLog::where('user_id', $id)->latest()->take(10)->get();

        $bannedIp = $user->last_login_ip
            ? BannedIp::where('ip_address', $user->last_login_ip)->first()
            : null;

        $stats = [
            'portfolios' => Portfolio::where('user_id', $id)->count(),
            'sheets'     => Sheet::where('user_id', $id)->count(),
            'sheet_downloads' => (int) Sheet::where('user_id', $id)->sum('downloads'),
            'projects'   => DB::table('project_members')->where('user_id', $id)->count(),
        ];

        return view('backend.users_edit', compact('user', 'loginLogs', 'bannedIp', 'stats'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nickname' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'level' => 'required|in:member,teacher,admin',
            'is_hall_of_fame' => 'required|in:0,1',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|string|min:6',
        ]);

        $data = [
            'nickname' => $request->nickname,
            'prefix' => $request->prefix,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'grade_level' => $request->grade_level,
            'student_id' => $request->student_id,
            'favorite_subject' => $request->favorite_subject,
            'school_name' => $request->school_name,
            'dream_university' => $request->dream_university,
            'bio' => $request->bio,
            'email' => $request->email,
            'level' => $request->level,
            'is_hall_of_fame' => (int) $request->is_hall_of_fame,
            'updated_at' => now(),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        DB::table('users')->where('id', $id)->update($data);

        return redirect()->route('backend.users')->with('success', 'updated user successfully');
    }

    public function destroy($id)
    {
        if (Auth::id() == $id) {
            return back()->with('error', 'cannot delete your own account');
        }

        DB::table('users')->where('id', $id)->delete();
        return back()->with('success', 'deleted user successfully');
    }

    public function banIp(Request $request, $id)
    {
        if (Auth::id() == $id) {
            return back()->with('error', 'ไม่สามารถแบนไอพีของบัญชีตัวเองได้');
        }

        $request->validate([
            'reason' => 'nullable|string|max:255',
        ]);

        $user = DB::table('users')->where('id', $id)->first();

        if (!$user || !$user->last_login_ip) {
            return back()->with('error', 'ไม่พบข้อมูลไอพีของผู้ใช้งานรายนี้ (ยังไม่เคยเข้าสู่ระบบ)');
        }

        BannedIp::updateOrCreate(
            ['ip_address' => $user->last_login_ip],
            ['reason' => $request->reason, 'banned_by' => Auth::id()]
        );

        DB::table('users')
            ->where('last_login_ip', $user->last_login_ip)
            ->update([
                'is_banned' => 1,
                'banned_at' => now(),
                'ban_reason' => $request->reason,
            ]);

        return back()->with('success', 'แบนไอพี ' . $user->last_login_ip . ' เรียบร้อยแล้ว');
    }

    public function unbanIp($id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        if (!$user || !$user->last_login_ip) {
            return back()->with('error', 'ไม่พบข้อมูลไอพีของผู้ใช้งานรายนี้');
        }

        BannedIp::where('ip_address', $user->last_login_ip)->delete();

        DB::table('users')
            ->where('last_login_ip', $user->last_login_ip)
            ->update([
                'is_banned' => 0,
                'banned_at' => null,
                'ban_reason' => null,
            ]);

        return back()->with('success', 'ปลดแบนไอพี ' . $user->last_login_ip . ' เรียบร้อยแล้ว');
    }
}