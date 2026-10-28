<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Project;
use App\Models\Service;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'projectCount' => Project::count(),
            'serviceCount' => Service::count(),
            'unreadCount' => ContactMessage::where('is_read', false)->count(),
            'recentMessages' => ContactMessage::latest()->limit(5)->get(),
            'recentProjects' => Project::latest()->limit(5)->get(),
        ]);
    }
}
