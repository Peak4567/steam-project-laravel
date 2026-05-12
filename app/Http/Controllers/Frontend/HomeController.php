<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. ดึง Tags ทั้งหมดมาแสดงปุ่มหมวดหมู่
        $tags = DB::table('tags')->get();

        // 2. เริ่มต้น Query ของ Projects
        $query = DB::table('projects')
            ->leftJoin('users', 'projects.user_id', '=', 'users.id')
            ->select(
                'projects.*',
                'users.first_name as owner_fname',
                'users.last_name as owner_lname'
            )
            ->where('projects.status', 'in_progress'); // แสดงเฉพาะที่ยังไม่จบ

        // ระบบค้นหา
        if ($request->filled('search')) {
            $query->where('projects.name', 'LIKE', "%{$request->search}%");
        }

        // กรองตาม Tag
        if ($request->filled('tag')) {
            $query->join('project_tags', 'projects.id', '=', 'project_tags.project_id')
                  ->where('project_tags.tag_id', $request->tag);
        }

        // ดึงข้อมูลโปรเจกต์
        $projects = $query->latest('projects.created_at')->take(8)->get();

        // 3. วนลูปเพื่อดึงข้อมูลสมาชิกและที่ปรึกษา (แก้ไขชื่อ Property ตรงนี้)
        foreach ($projects as $project) {
            // ดึงจำนวนสมาชิกปัจจุบัน และตั้งชื่อว่า current_count 🌟
            $project->current_count = DB::table('project_members')
                ->where('project_id', $project->id)
                ->count();

            // ดึงรายชื่ออาจารย์ที่ปรึกษา
            $project->advisors = DB::table('project_advisors')
                ->join('users', 'project_advisors.user_id', '=', 'users.id')
                ->where('project_advisors.project_id', $project->id)
                ->select('users.first_name', 'users.last_name')
                ->get();
        }

        // ส่งตัวแปรไปที่หน้า home
        return view('home', compact('projects', 'tags'));
    }
}