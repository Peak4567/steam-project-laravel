<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = DB::table('portfolios')
            ->join('users', 'portfolios.user_id', '=', 'users.id')
            ->select(
                'portfolios.*', 
                'users.first_name as owner_fname', 
                'users.last_name as owner_lname',
                'users.nickname'
            )
            ->latest('portfolios.created_at')
            ->paginate(10);

        return view('backend.portfolios', compact('portfolios'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:pending,approved,rejected']);

        DB::table('portfolios')->where('id', $id)->update([
            'status' => $request->status,
            'updated_at' => now()
        ]);

        return back()->with('success', 'updated status successfully');
    }

    public function destroy($id)
    {
        $portfolio = DB::table('portfolios')->where('id', $id)->first();
        if ($portfolio) {
            if ($portfolio->file_path && File::exists(public_path($portfolio->file_path))) {
                File::delete(public_path($portfolio->file_path));
            }
            DB::table('portfolios')->where('id', $id)->delete();
            return back()->with('success', 'deleted successfully');
        }
        return back()->with('error', 'not found');
    }
}