<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{

    public function publicIndex(Request $request)
    {
        $query = Portfolio::with('user')->where('status', 'approved');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('university', 'like', "%{$search}%")
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        if ($request->sort == 'popular') {
            $query->orderBy('views', 'desc');
        } else {
            $query->latest();
        }

        $portfolios = $query->paginate(12)->withQueryString();

        return view('portfolio', compact('portfolios'));
    }

    public function show($id)
    {
        $portfolio = Portfolio::with('user')->findOrFail($id);
        
        $portfolio->increment('views');

        return view('portfolios.show', compact('portfolio'));
    }

    public function index(Request $request)
    {
        $query = Portfolio::with('user')->where('user_id', Auth::id());

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('university', 'like', "%{$search}%")
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        if ($request->sort == 'popular') {
            $query->orderBy('views', 'desc');
        } else {
            $query->latest();
        }

        $portfolios = $query->paginate(8)->withQueryString();

        return view('profile.portfolio', compact('portfolios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'description'      => 'required|string',
            'university'       => 'required|string|max:255',
            'portfolio_file'   => 'required|array|min:1|max:3',
            'portfolio_file.*' => 'required|file|mimes:pdf,png,jpg,jpeg|max:10240',
        ]);

        $paths = [];

        foreach ($request->file('portfolio_file') as $file) {
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/portfolios'), $filename);
            $paths[] = 'assets/portfolios/' . $filename;
        }

        Portfolio::create([
            'user_id'     => Auth::id(),
            'first_name'  => $request->first_name,
            'last_name'   => $request->last_name,
            'description' => $request->description,
            'university'  => $request->university,
            'file_path'   => $paths,
            'status'      => 'pending',
        ]);

        return back()->with('success', 'อัปโหลดพอร์ตฟอลิโอสำเร็จแล้ว! กรุณารอแอดมินพิจารณาอนุมัติ');
    }

    public function destroy($id)
    {
        $portfolio = Portfolio::where('user_id', Auth::id())->findOrFail($id);

        foreach ($portfolio->file_path ?? [] as $path) {
            if (File::exists(public_path($path))) {
                File::delete(public_path($path));
            }
        }

        $portfolio->delete();
        return back()->with('success', 'ลบผลงานเรียบร้อยแล้ว');
    }
}