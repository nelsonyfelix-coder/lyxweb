<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Skill;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        return view('portfolio.index', [
            'settings' => SiteSetting::current(),
            'projects' => Project::query()->where('is_published', true)->orderByDesc('is_featured')->orderBy('sort_order')->orderByDesc('created_at')->get(),
            'services' => Service::query()->where('is_visible', true)->orderBy('sort_order')->get(),
            'skillGroups' => Skill::query()->orderBy('group')->orderBy('sort_order')->get()->groupBy('group'),
        ]);
    }

    public function show(string $slug): View
    {
        $project = Project::query()->where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('portfolio.project', [
            'settings' => SiteSetting::current(),
            'project' => $project,
            'relatedProjects' => Project::query()
                ->where('is_published', true)
                ->where('id', '!=', $project->id)
                ->orderByDesc('is_featured')
                ->limit(3)
                ->get(),
        ]);
    }

    public function sitemap(): Response
    {
        return response()->view('portfolio.sitemap', [
            'projects' => Project::query()->where('is_published', true)->orderBy('updated_at')->get(),
        ])->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
