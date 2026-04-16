<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

            return redirect()->intended('/')
                ->with('success', 'เข้าสู่ระบบสำเร็จ! ยินดีต้อนรับกลับมาครับคุณ ' . Auth::user()->nickname);
        }
        return back()->withErrors([
            'nickname' => 'ชื่อเล่นหรือรหัสผ่านไม่ถูกต้อง',
        ])->onlyInput('nickname');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'ออกจากระบบเรียบร้อยแล้ว');
    }
}