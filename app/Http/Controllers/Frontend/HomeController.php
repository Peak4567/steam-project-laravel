<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $tags = DB::table('tags')->get();

        $publicAds = DB::table('ads')
            ->where('status', 'active')
            ->orderBy('id', 'desc')
            ->take(8)
            ->get();

        $query = DB::table('projects')
            ->leftJoin('users', 'projects.user_id', '=', 'users.id')
            ->select(
                'projects.*',
                'users.first_name as owner_fname',
                'users.last_name as owner_lname'
            )
            ->where('projects.status', 'in_progress');

        if ($request->filled('search')) {
            $query->where('projects.name', 'LIKE', "%{$request->search}%");
        }

        if ($request->filled('tag')) {
            $query->join('project_tags', 'projects.id', '=', 'project_tags.project_id')
                  ->where('project_tags.tag_id', $request->tag);
        }

        $projects = $query->latest('projects.created_at')->take(8)->get();
        foreach ($projects as $project) {
            $project->current_count = DB::table('project_members')
                ->where('project_id', $project->id)
                ->count();

            $project->advisors = DB::table('project_advisors')
                ->join('users', 'project_advisors.user_id', '=', 'users.id')
                ->where('project_advisors.project_id', $project->id)
                ->select('users.first_name', 'users.last_name')
                ->get();
        }

        $stats = [
            'projects'   => DB::table('projects')->count(),
            'members'    => DB::table('users')->where('level', 'member')->count(),
            'portfolios' => DB::table('portfolios')->where('status', 'approved')->count(),
            'activities' => DB::table('activities')->count(),
        ];

        $featuredSheets = DB::table('sheets')
            ->where('status', 'approved')
            ->orderBy('id', 'desc')
            ->take(4)
            ->get();

        $featuredPortfolios = Portfolio::where('status', 'approved')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        return view('home', compact('projects', 'tags', 'publicAds', 'stats', 'featuredSheets', 'featuredPortfolios'));
    }
    public function showNews($slug)
    {
        $ad = DB::table('ads')->where('slug', $slug)->where('status', 'active')->first();
        
        if (!$ad) {
            abort(404, 'ไม่พบหน้าประกาศข่าวสารประชาสัมพันธ์ชิ้นนี้ในระบบ');
        }

        $recentAds = DB::table('ads')
            ->where('status', 'active')
            ->where('id', '!=', $ad->id)
            ->orderBy('id', 'desc')
            ->take(4)
            ->get();

        return view('news_show', compact('ad', 'recentAds'));
    }
}