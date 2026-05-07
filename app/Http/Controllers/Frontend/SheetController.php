<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Sheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class SheetController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $sheets = Sheet::where('user_id', $userId)->latest()->paginate(10);
        
        $totalFiles = Sheet::where('user_id', $userId)->count();
        $totalDownloads = Sheet::where('user_id', $userId)->sum('downloads');
        $totalSubjects = Sheet::where('user_id', $userId)->distinct('subject')->count();
        $totalViews = Sheet::where('user_id', $userId)->sum('views');

        return view('profile.sheets', compact('sheets', 'totalFiles', 'totalDownloads', 'totalSubjects', 'totalViews'));
    }

    public function publicIndex(Request $request)
    {
        $query = Sheet::with('user')->where('status', 'approved');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('sheet_name', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        if ($request->filled('term')) {
            $query->where('term', 'like', "%{$request->term}%");
        }

        if ($request->sort == 'popular') {
            $query->orderBy('downloads', 'desc');
        } else {
            $query->latest();
        }

        $sheets = $query->paginate(10)->withQueryString();

        $topDownloads = Sheet::where('status', 'approved')
                             ->orderBy('downloads', 'desc')
                             ->take(5)
                             ->get();

        $recentSheets = Sheet::where('status', 'approved')
                             ->latest()
                             ->take(5)
                             ->get();

        return view('sheets', compact('sheets', 'topDownloads', 'recentSheets'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'sheet_name' => 'required|string|max:255',
            'level'      => 'required|string',
            'subject'    => 'required|string|max:255',
            'term'       => 'required|string',
            'type_check' => 'required|in:file,link'
        ]);

        $type = $request->type_check;
        $filePath = '';

        if ($type === 'file') {
            $request->validate([
                'document' => 'required|file|mimes:pdf,png,jpg,jpeg,doc,docx|max:10240',
            ]);

            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/sheets'), $filename);
                $filePath = 'assets/sheets/' . $filename;
            } else {
                return back()->withErrors(['error' => 'ไม่พบไฟล์เอกสาร']);
            }

        } else {
            $request->validate([
                'link_url' => 'required|url',
            ]);
            
            $filePath = $request->link_url;
        }

        Sheet::create([
            'user_id'    => Auth::id(),
            'sheet_name' => $request->sheet_name,
            'level'      => $request->level,
            'subject'    => $request->subject,
            'term'       => $request->term,
            'file_path'  => $filePath,
            'type'       => $type,
            'status'     => 'pending',
        ]);

        return back()->with('success', 'อัปโหลดข้อมูลชีทเรียบร้อยแล้ว! กรุณารอการตรวจสอบ');
    }

    public function destroy($id)
    {
        $sheet = Sheet::where('user_id', Auth::id())->findOrFail($id);

        if ($sheet->type === 'file' && File::exists(public_path($sheet->file_path))) {
            File::delete(public_path($sheet->file_path));
        }

        $sheet->delete();
        return back()->with('success', 'ลบข้อมูลชีทเรียบร้อยแล้ว');
    }
}