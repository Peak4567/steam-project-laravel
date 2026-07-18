<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use App\Models\Tag; 
use App\Models\ProjectAdvisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with(['user', 'advisors.user']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $projects = $query->latest()->paginate(10)->withQueryString();

        $stats = [
            'total' => Project::count(),
            'complated' => Project::where('status', 'complated')->count(),
            'canceled' => Project::where('status', 'canceled')->count(),
        ];

        return view('backend.projects', compact('projects', 'stats'));
    }

    public function create()
    {
        $users = User::all();
        $tags = Tag::all(); 
        return view('backend.projects-create', compact('users', 'tags'));
    }

    /**
     * บันทึกโครงงานใหม่ พร้อมระบบป้องกันแท็กซ้ำ
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'team_name' => 'required|string|max:255',
            'max_members' => 'required|integer|min:1',
            'status' => 'required|string',
            'description' => 'nullable|string',
            'advisors' => 'nullable|array',
            'tags' => 'nullable|array', 
            'file_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        DB::transaction(function () use ($request) {
            $project = new Project();
            $project->user_id = Auth::id();
            $project->name = $request->name;
            $project->team_name = $request->team_name;
            $project->max_members = $request->max_members;
            $project->status = $request->status;
            $project->description = $request->description;

            if ($request->hasFile('file_upload')) {
                $file = $request->file('file_upload');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/img/projects'), $filename);
                $project->file_path = 'assets/img/projects/' . $filename;
            }

            $project->save();

            if ($request->has('advisors')) {
                foreach ($request->advisors as $userId) {
                    ProjectAdvisor::create([
                        'project_id' => $project->id,
                        'user_id' => $userId
                    ]);
                }
            }

            // 🛠️ ตรวจสอบและซิงค์แท็กในขั้นตอนสร้างใหม่ (ป้องกันการสร้างตัวซ้ำ)
            $processedTagIds = [];
            if ($request->has('tags')) {
                foreach ($request->tags as $tagValue) {
                    $cleanName = str_replace('#', '', trim($tagValue));
                    if ($cleanName !== '') {
                        // ดึงแท็กเดิมที่มีอยู่แล้ว หรือถ้าไม่มีจริงๆ ถึงจะสร้างใหม่
                        $tag = Tag::firstOrCreate(['name' => $cleanName]);
                        $processedTagIds[] = $tag->id;
                    }
                }
                $project->tags()->sync($processedTagIds);
            }
        });

        return redirect()->route('backend.projects')->with('success', 'เพิ่มข้อมูลโครงงานเรียบร้อยแล้ว!');
    }

    public function edit($id)
    {
        $project = Project::with(['advisors', 'tags'])->findOrFail($id);
        $users = User::all();
        $tags = Tag::all();
        
        $currentAdvisors = $project->advisors->pluck('user_id')->toArray();
        $currentTags = $project->tags->pluck('id')->toArray();
        
        return view('backend.projects-edit', compact('project', 'users', 'tags', 'currentAdvisors', 'currentTags'));
    }

    /**
     * บันทึกข้อมูลแก้ไขโครงงาน แก้ไขระบบซิงค์แท็กไม่ให้เพิ่มซ้ำถ้ามีคำนั้นอยู่แล้ว
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'team_name' => 'required|string|max:255',
            'max_members' => 'required|integer|min:1',
            'status' => 'required|string',
            'description' => 'nullable|string',
            'advisors' => 'nullable|array',
            'tags' => 'nullable|array', 
            'file_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        DB::transaction(function () use ($request, $project) {
            $project->name = $request->name;
            $project->team_name = $request->team_name;
            $project->max_members = $request->max_members;
            $project->status = $request->status;
            $project->description = $request->description;

            if ($request->hasFile('file_upload')) {
                if ($project->file_path && file_exists(public_path($project->file_path))) {
                    unlink(public_path($project->file_path));
                }

                $file = $request->file('file_upload');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/img/projects'), $filename);
                $project->file_path = 'assets/img/projects/' . $filename;
            }

            $project->save();

            ProjectAdvisor::where('project_id', $project->id)->delete();
            if ($request->has('advisors')) {
                foreach ($request->advisors as $userId) {
                    ProjectAdvisor::create([
                        'project_id' => $project->id,
                        'user_id' => $userId
                    ]);
                }
            }

            // 🌟 🛠️ แก้ไขจุดสำคัญ: ใช้ firstOrCreate เพื่อตรวจจับชื่อแท็กแทนการเช็ค ID สลับไปมา
            $processedTagIds = [];
            if ($request->has('tags')) {
                foreach ($request->tags as $tagValue) {
                    // เคลียร์ค่าเครื่องหมาย # และตัดช่องว่างออกให้สะอาด
                    $cleanName = str_replace('#', '', trim($tagValue));
                    
                    if ($cleanName !== '') {
                        // 1. ถ้ามีคำว่า "เกษตร" หรือ "มายคราฟ" อยู่แล้วในฐานข้อมูล มันจะไป get ไอดีเดิมมาทันที 
                        // 2. แต่ถ้ายังไม่มีใครเคยพิมพ์คำนี้มาก่อนเลย มันถึงจะสั่ง insert ลงตาราง tags ให้ครับ
                        $tag = Tag::firstOrCreate([
                            'name' => $cleanName
                        ]);
                        
                        // มั่นใจได้ 100% ว่าจะได้ ID ตัวเลขจริงของแท็กนั้นๆ ใส่กลับเข้าไปในอาเรย์ซิงค์
                        $processedTagIds[] = $tag->id;
                    }
                }
            }
            
            // ซิงค์ส่งข้อมูลไอดีเลขล้วนๆ เข้าไปอัปเดตตารางกลาง project_tags
            $project->tags()->sync($processedTagIds);
        });

        return redirect()->route('backend.projects')->with('success', 'อัปเดตข้อมูลโครงงานเรียบร้อยแล้ว!');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        if ($project->file_path && file_exists(public_path($project->file_path))) {
            unlink(public_path($project->file_path));
        }

        $project->delete();

        return redirect()->route('backend.projects')->with('success', 'ลบข้อมูลโครงงานเรียบร้อยแล้ว!');
    }
}