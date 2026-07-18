<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    /**
     * 1. หน้าแสดงฟอร์มการตั้งค่าขั้นสูง (Expert Mode Settings View)
     */
    public function index()
    {
        // ดึงข้อมูลทั้งหมดจากตาราง settings มาทำเป็น Key-Value Array เพื่อให้เรียกใช้งานใน Blade ง่ายๆ
        $settings = DB::table('settings')->pluck('value', 'key')->toArray();

        // ดึงสถิติภาพรวมจากตารางอื่นๆ เพื่อนำไปแสดงในบล็อก Database Snapshot ฝั่งซ้าย
        $dbSnapshot = [
            'total_users'     => DB::table('users')->count(),
            'total_projects'  => DB::table('projects')->count(),
            'total_reports'   => DB::table('project_reports')->count(),
            'total_sheets'    => DB::table('sheets')->count(),
            'total_portfolios'=> DB::table('portfolios')->count(),
        ];

        return view('backend.settings', compact('settings', 'dbSnapshot'));
    }

    /**
     * 2. ระบบประมวลผลบันทึกข้อมูลแบบ Dynamic Array (Bulk Update Settings)
     */
    public function update(Request $request)
    {
        // ตรวจสอบความปลอดภัยและความถูกต้องของข้อมูลยิบย่อยที่ส่งมาจากฟอร์ม
        $request->validate([
            'settings' => 'required|array',
            'settings.site_name' => 'required|string|max:255',
            'settings.primary_color' => 'required|string|max:7', // เช็ค Code สี เช่น #5ebee6
            'settings.is_maintenance' => 'required|in:0,1',
            'settings.seo_keywords' => 'nullable|string',
            'settings.seo_description' => 'nullable|string',
            'settings.footer_description' => 'nullable|string',
            'settings.footer_credit' => 'nullable|string',
        ]);

        // เริ่มต้นกระบวนการ Database Transaction เพื่อความปลอดภัยระดับลึก
        DB::beginTransaction();
        try {
            // ลูปข้อมูลอัปเดตค่าทีละ Key ตามที่กรอกมาจากหน้าจอ Advanced Form
            foreach ($request->input('settings') as $key => $value) {
                DB::table('settings')
                    ->where('key', $key)
                    ->update([
                        'value' => $value,
                        'updated_at' => now()
                    ]);
            }

            DB::commit();

            // ⚡ CRITICAL: เคลียร์ Global Cache ระบบทั้งหมดทันที เพื่อให้หน้าเว็บเปลี่ยนสีและข้อความตามค่าใหม่รวดเร็วที่สุด
            Cache::forget('global_settings');

            return redirect()->back()->with('success', 'สตรีมระบบคอมฟิกูเรชันทำการบันทึกลงตาราง settings เรียบร้อยแล้ว!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาดระดับลึกในระบบ SQL DB: ' . $e->getMessage());
        }
    }
}