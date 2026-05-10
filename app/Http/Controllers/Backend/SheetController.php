<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SheetController extends Controller
{
    public function index()
    {
        $sheets = DB::table('sheets')
            ->join('users', 'sheets.user_id', '=', 'users.id')
            ->select('sheets.*', 'users.first_name', 'users.last_name')
            ->latest('sheets.created_at')
            ->paginate(10);

        return view('backend.sheets', compact('sheets'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        DB::table('sheets')->where('id', $id)->update([
            'status' => $request->status,
            'updated_at' => now()
        ]);

        return back()->with('success', 'อัปเดตสถานะชีทเรียบร้อยแล้ว');
    }

    public function destroy($id)
    {
        $sheet = DB::table('sheets')->where('id', $id)->first();
        
        if ($sheet->type == 'file' && file_exists(public_path($sheet->file_path))) {
            unlink(public_path($sheet->file_path));
        }

        DB::table('sheets')->where('id', $id)->delete();
        return back()->with('success', 'ลบชีทสรุปเรียบร้อยแล้ว');
    }
}