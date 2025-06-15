<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\User;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_news' => News::count(),
            'published_news' => News::where('status', 'published')->count(),
            'draft_news' => News::where('status', 'draft')->count(),
            'total_users' => User::count(),
            'total_categories' => Category::count(),
        ];

        $recent_news = News::with(['author', 'category'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $pending_approval = News::where('status', 'draft')
            ->with(['author', 'category'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_news', 'pending_approval'));
    }
}