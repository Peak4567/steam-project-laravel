<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'nickname' => ['required', 'string'],
            'password' => ['required'],
        ], [
            'nickname.required' => 'กรุณากรอกชื่อเล่นผู้ใช้งาน',
            'password.required' => 'กรุณากรอกรหัสผ่าน',
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $user->update([
                'last_login_at' => now(),
                'last_login_ip' => $request->ip(),
            ]);

            LoginLog::create([
                'user_id' => $user->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'action' => 'login',
                'created_at' => now(),
            ]);

            return redirect()->intended('/')
                ->with('success', 'เข้าสู่ระบบสำเร็จ! ยินดีต้อนรับกลับมาครับคุณ ' . $user->nickname);
        }
        return back()->withErrors([
            'nickname' => 'ชื่อเล่นหรือรหัสผ่านไม่ถูกต้อง',
        ])->onlyInput('nickname');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            LoginLog::create([
                'user_id' => $user->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'action' => 'logout',
                'created_at' => now(),
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'ออกจากระบบเรียบร้อยแล้ว');
    }
}