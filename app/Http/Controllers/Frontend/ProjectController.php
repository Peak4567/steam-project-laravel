<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use App\Models\Tag;
use App\Models\ProjectMember;
use App\Models\ProjectReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;

class ProjectController extends Controller
{
    public function index()
    {
        $project = Project::whereHas('members', function ($query) {
            $query->where('user_id', Auth::id());
        })->with(['members' => function ($query) {
            $query->withPivot('position', 'status');
        }])->withCount('members')->first();

        $allProjects = Project::with(['advisors', 'tags'])->get();

        return view('profile.projects', compact('project', 'allProjects'));
    }

    public function searchProjects(Request $request)
    {
        $projectQuery = Project::with(['advisors', 'tags'])
            ->withCount('members')
            ->where('status', 'in_progress');

        if ($request->has('tag') && $request->tag != '') {
            $projectQuery->whereHas('tags', function ($q) use ($request) {
                $q->where('tags.id', $request->tag)->orWhere('tags.name', $request->tag);
            });
        }

        $projects = $projectQuery->get();
        $tags = Tag::all();

        $reportQuery = ProjectReport::with(['project.members', 'project.tags']);

        if ($request->filled('year')) {
            $reportQuery->whereYear('created_at', $request->year);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $reportQuery->where(function ($q) use ($search) {
                $q->where('project_name', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhereHas('project', function ($pq) use ($search) {
                        $pq->where('team_name', 'like', "%{$search}%");
                    });
            });
        }
        if ($request->filled('tag')) {
            $tag = $request->tag;
            $reportQuery->whereHas('project.tags', function ($q) use ($tag) {
                $q->where('name', $tag);
            });
        }

        $reports = $reportQuery->latest()->paginate(12)->withQueryString();

        return view('projects', compact('projects', 'tags', 'reports'));
    }

    public function showProject($id)
    {
        $project = Project::with(['members', 'advisors', 'tags'])->withCount('members')->findOrFail($id);

        $allProjects = Project::with(['advisors', 'tags'])->get();

        return view('profile.projects', compact('project', 'allProjects'));
    }

    public function inviteMember(Request $request, Project $project)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'ไม่พบผู้ใช้ในระบบ']);
        }

        if ($project->members()->where('user_id', $user->id)->exists()) {
            return back()->withErrors(['email' => 'ผู้ใช้นี้อยู่ในทีมแล้ว']);
        }

        $project->members()->attach($user->id, [
            'position' => 'Member',
            'status'   => 'pending'
        ]);

        return back()->with('success', 'ส่งคำเชิญสำเร็จ!');
    }

    public function acceptMember($project_id, $user_id)
    {
        $project = Project::findOrFail($project_id);

        $isLeader = $project->members()->where('user_id', Auth::id())->wherePivot('position', 'Leader')->exists();
        $isAdvisor = $project->advisors()->where('user_id', Auth::id())->exists();

        if (!$isLeader && !$isAdvisor) {
            return back()->withErrors(['error' => 'เฉพาะหัวหน้าทีมหรืออาจารย์ที่ปรึกษาเท่านั้นที่กดรับสมาชิกได้']);
        }

        $project->members()->updateExistingPivot($user_id, ['status' => 'accept']);

        return back()->with('success', 'รับสมาชิกเข้าทีมเรียบร้อยแล้ว!');
    }

    public function declineMember($project_id, $user_id)
    {
        $project = Project::findOrFail($project_id);

        $isLeader = $project->members()->where('user_id', Auth::id())->wherePivot('position', 'Leader')->exists();
        $isAdvisor = $project->advisors()->where('user_id', Auth::id())->exists();

        if (!$isLeader && !$isAdvisor && Auth::id() != $user_id) {
            return back()->withErrors(['error' => 'คุณไม่มีสิทธิ์ทำรายการนี้']);
        }

        $project->members()->detach($user_id);

        return back()->with('success', 'ทำรายการเรียบร้อยแล้ว');
    }

    public function uploadDocument(Request $request, $id)
    {
        $request->validate(['document' => 'required|mimes:pdf,doc,docx|max:5120']);

        $project = Project::findOrFail($id);
        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('projects/docs', 'public');
            $project->update(['file_path' => $path]);
        }
        return back()->with('success', 'อัปโหลดไฟล์เรียบร้อยแล้ว');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'team_name' => 'required|string|max:255',
            'description' => 'required|string',
            'max_members' => 'nullable|integer|min:1'
        ]);

        $project = Project::findOrFail($id);

        $isAdvisor = $project->advisors()->where('user_id', Auth::id())->exists();

        $data = [
            'name' => $validated['name'],
            'team_name' => $validated['team_name'],
            'description' => $validated['description'],
        ];

        if ($isAdvisor && isset($validated['max_members'])) {
            $data['max_members'] = $validated['max_members'];
        }

        $project->update($data);

        return back()->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    public function applyPage($id)
    {
        $project = Project::with(['advisors', 'tags'])->withCount('members')->findOrFail($id);
        $isMember = $project->members()->where('user_id', Auth::id())->exists();

        return view('projects.apply', compact('project', 'isMember'));
    }

    public function requestJoin(Request $request, $id)
    {
        $project = Project::withCount('members')->findOrFail($id);

        $maxMembers = $project->max_members ?? 5;
        if ($project->members_count >= $maxMembers) {
            return back()->withErrors(['error' => 'ขออภัย! โครงงานนี้มีสมาชิกเต็มตามจำนวนที่กำหนดแล้ว']);
        }

        if ($project->members()->where('user_id', Auth::id())->exists()) {
            return back()->withErrors(['error' => 'คุณอยู่ในทีมนี้ หรือได้ส่งคำขอไปแล้ว']);
        }

        $project->members()->attach(Auth::id(), [
            'position' => 'Member',
            'status' => 'pending'
        ]);

        return back()->with('success', 'ส่งใบสมัครเรียบร้อยแล้ว! กรุณารอหัวหน้าทีมติดต่อกลับ');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:in_progress,completed,canceled'
        ]);

        $project = Project::findOrFail($id);

        $isLeader = $project->members()->where('user_id', Auth::id())->wherePivot('position', 'Leader')->exists();
        $isAdvisor = $project->advisors()->where('user_id', Auth::id())->exists();

        if (!$isLeader && !$isAdvisor) {
            return back()->withErrors(['error' => 'คุณไม่มีสิทธิ์เปลี่ยนสถานะโครงงานนี้']);
        }

        $project->update(['status' => $request->status]);

        return back()->with('success', 'อัปเดตสถานะโครงงานเรียบร้อยแล้ว!');
    }

    public function updateMaxMembers(Request $request, $id)
    {
        $request->validate([
            'max_members' => 'required|integer|min:1'
        ]);

        $project = Project::findOrFail($id);

        $isLeader = $project->members()->where('user_id', Auth::id())->wherePivot('position', 'Leader')->exists();
        $isAdvisor = $project->advisors()->where('user_id', Auth::id())->exists();

        if (!$isLeader && !$isAdvisor) {
            return back()->withErrors(['error' => 'คุณไม่มีสิทธิ์แก้ไขข้อมูลโครงงานนี้']);
        }

        $project->update(['max_members' => $request->max_members]);

        return back()->with('success', 'อัปเดตจำนวนรับสมัครสมาชิกเรียบร้อยแล้ว!');
    }

    public function updatePosition(Request $request, $project_id, $user_id)
    {
        $request->validate([
            'position' => 'required|in:Member,Leader'
        ]);

        $project = Project::findOrFail($project_id);

        $isLeader = $project->members()->where('user_id', Auth::id())->wherePivot('position', 'Leader')->exists();
        $isAdvisor = $project->advisors()->where('user_id', Auth::id())->exists();

        if (!$isLeader && !$isAdvisor) {
            return back()->withErrors(['error' => 'คุณไม่มีสิทธิ์เปลี่ยนตำแหน่งของสมาชิก']);
        }

        $project->members()->updateExistingPivot($user_id, ['position' => $request->position]);

        return back()->with('success', 'อัปเดตตำแหน่งเรียบร้อยแล้ว');
    }

    public function showReportsWithoutId()
    {
        $project = Project::whereHas('members', function ($query) {
            $query->where('user_id', Auth::id());
        })->with(['advisors', 'tags'])->withCount('members')->first();

        $allProjects = Project::with(['advisors', 'tags'])->get();
        $reports = $project ? ProjectReport::where('project_id', $project->id)->get() : collect();
        return view('profile.reports', compact('project', 'allProjects', 'reports'));
    }

    public function uploadReports(Request $request, $id)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'advisor' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'document' => 'required|mimes:pdf|max:10240'
        ]);

        $project = Project::findOrFail($id);

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $timestamp = time();

            $extension = $file->getClientOriginalExtension();
            $filename = $timestamp . '_' . uniqid() . '.' . $extension;

            $file->move(public_path('assets/file'), $filename);
            $pdfPath = 'assets/file/' . $filename;

            $thumbnailName = $timestamp . '_' . uniqid() . '_thumb.jpg';
            $thumbnailRelativePath = 'assets/file/thumbnails/' . $thumbnailName;
            $thumbnailFullPath = public_path($thumbnailRelativePath);

            if (extension_loaded('imagick')) {
                try {
                    $pdfInfo = new Pdf(public_path($pdfPath));
                    $pdfInfo->setResolution(150);
                    $pdfInfo->saveImage($thumbnailFullPath);
                } catch (\Exception $e) {
                    $thumbnailRelativePath = null;
                }
            } else {
                $thumbnailRelativePath = null;
            }

            ProjectReport::create([
                'project_id'   => $project->id,
                'project_name' => $request->project_name,
                'advisor'      => $request->advisor,
                'subject'      => $request->subject,
                'file_path'    => $pdfPath,
                'cover_image'  => $thumbnailRelativePath,
                'status'       => 'pending',
            ]);

            return back()->with('success', 'อัปโหลดเล่มรายงานเรียบร้อยแล้ว');
        }

        return back()->withErrors(['error' => 'กรุณาอัปโหลดไฟล์']);
    }

    public function deleteReport($id)
    {
        $report = ProjectReport::findOrFail($id);

        $filePath = public_path($report->file_path);

        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $report->delete();

        return back()->with('success', 'ลบเล่มรายงานเรียบร้อยแล้ว');
    }

    public function showReportLibrary(Request $request)
    {
        $project = Project::whereHas('members', function ($query) {
            $query->where('user_id', Auth::id());
        })->first();

        $query = ProjectReport::with(['project.members', 'project.tags']);

        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('project_name', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhereHas('project', function ($pq) use ($search) {
                        $pq->where('team_name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('tag')) {
            $tag = $request->tag;
            $query->whereHas('project.tags', function ($q) use ($tag) {
                $q->where('name', $tag);
            });
        }

        $reports = $query->latest()->paginate(12)->withQueryString();

        return view('profile.reports', compact('reports', 'project'));
    }

    public function viewReport($id)
    {
        $report = ProjectReport::findOrFail($id);
        $filePath = public_path($report->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'ไม่พบไฟล์ในระบบ');
        }

        return response()->file($filePath);
    }

    public function downloadReport($id)
    {
        $report = ProjectReport::findOrFail($id);
        $filePath = public_path($report->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'ไม่พบไฟล์ในระบบ');
        }

        return response()->download($filePath, 'Report_' . $report->project_name . '.' . pathinfo($filePath, PATHINFO_EXTENSION));
    }
}