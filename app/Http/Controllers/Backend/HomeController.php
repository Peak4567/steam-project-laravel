<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_portfolios' => Portfolio::count(),
            'pending_approvals' => Portfolio::where('status', 'pending')->count(),
            'total_views' => Portfolio::sum('views'),
        ];

        $recentPending = Portfolio::with('user')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('backend.home', compact('stats', 'recentPending'));
    }
}