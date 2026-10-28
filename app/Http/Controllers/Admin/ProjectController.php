<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        return view('admin.projects.index', ['projects' => Project::query()->orderBy('sort_order')->latest()->paginate(12)]);
    }

    public function create(): View
    {
        return view('admin.projects.form', ['project' => new Project(), 'pageTitle' => 'Add project']);
    }

    public function store(Request $request): RedirectResponse
    {
        $project = Project::create($this->validatedData($request));

        return to_route('admin.projects.edit', $project)->with('status', 'Project created.');
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.form', ['project' => $project, 'pageTitle' => 'Edit project']);
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $project->update($this->validatedData($request, $project));

        return to_route('admin.projects.edit', $project)->with('status', 'Project updated.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return to_route('admin.projects.index')->with('status', 'Project deleted.');
    }

    private function validatedData(Request $request, ?Project $project = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:140'],
            'category' => ['required', 'string', 'max:80'],
            'short_description' => ['required', 'string', 'max:240'],
            'description' => ['required', 'string', 'max:5000'],
            'tech_stack' => ['nullable', 'string', 'max:500'],
            'live_url' => ['nullable', 'url', 'max:255'],
            'repository_url' => ['nullable', 'url', 'max:255'],
            'cover_image_url' => ['nullable', 'url', 'max:255'],
            'accent_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:65535'],
        ]);

        $slugBase = Str::slug($data['title']) ?: 'project';
        $slug = $slugBase;
        $suffix = 2;

        $slugQuery = Project::query();
        if ($project) {
            $slugQuery->where('id', '!=', $project->id);
        }

        while ($slugQuery->where('slug', $slug)->exists()) {
            $slug = $slugBase.'-'.$suffix++;
            $slugQuery = Project::query();
            if ($project) {
                $slugQuery->where('id', '!=', $project->id);
            }
        }

        return [
            'title' => $data['title'],
            'slug' => $slug,
            'category' => $data['category'],
            'short_description' => $data['short_description'],
            'description' => $data['description'],
            'technologies' => collect(explode(',', $data['tech_stack'] ?? ''))->map(fn ($item) => trim($item))->filter()->values()->all(),
            'live_url' => $data['live_url'] ?? null,
            'repository_url' => $data['repository_url'] ?? null,
            'cover_image_url' => $data['cover_image_url'] ?? null,
            'accent_color' => $data['accent_color'],
            'is_featured' => $request->boolean('is_featured'),
            'is_published' => $request->boolean('is_published'),
            'sort_order' => $data['sort_order'] ?? 0,
        ];
    }
}
