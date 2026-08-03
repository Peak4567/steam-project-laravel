<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProjectReport;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = ProjectReport::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('project_name', 'like', '%' . $request->search . '%')
                  ->orWhere('subject', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $reports = $query->latest()->paginate(10)->withQueryString();
        return view('backend.reports', compact('reports'));
    }

    public function updateStatus(Request $request, $id)
    {
        $report = ProjectReport::findOrFail($id);
        $report->update(['status' => $request->status]);

        return back()->with('success', 'อัปเดตสถานะเล่มรายงานเรียบร้อยแล้ว');
    }

    public function destroy($id)
    {
        $report = ProjectReport::findOrFail($id);

        foreach ($report->file_path ?? [] as $path) {
            if (file_exists(public_path($path))) {
                unlink(public_path($path));
            }
        }
        if ($report->cover_image && file_exists(public_path($report->cover_image))) {
            unlink(public_path($report->cover_image));
        }

        $report->delete();
        return back()->with('success', 'ลบเล่มรายงานเรียบร้อยแล้ว');
    }
}