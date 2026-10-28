<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
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
        $data = $this->validatedData($request);

        if ($request->hasFile('cover_image')) {
            $data['cover_image_url'] = $this->storeCoverImage($request);
        }

        $project = Project::create($data);

        return to_route('admin.projects.edit', $project)->with('status', 'Project created.');
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.form', ['project' => $project, 'pageTitle' => 'Edit project']);
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $previousImage = $project->cover_image_url;
        $data = $this->validatedData($request, $project);

        if ($request->hasFile('cover_image')) {
            $data['cover_image_url'] = $this->storeCoverImage($request);
        }

        $project->update($data);

        if ($previousImage !== $project->cover_image_url) {
            $this->deleteStoredCoverImage($previousImage);
        }

        return to_route('admin.projects.edit', $project)->with('status', 'Project updated.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $coverImage = $project->cover_image_url;
        $project->delete();
        $this->deleteStoredCoverImage($coverImage);

        return to_route('admin.projects.index')->with('status', 'Project deleted.');
    }

    private function validatedData(Request $request, ?Project $project = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:140'],
            'category' => ['required', Rule::in(['Web App', 'Mobile App', 'SaaS', 'Enterprise App'])],
            'short_description' => ['required', 'string', 'max:240'],
            'description' => ['required', 'string', 'max:5000'],
            'tech_stack' => ['nullable', 'string', 'max:500'],
            'live_url' => ['nullable', 'url', 'max:255'],
            'repository_url' => ['nullable', 'url', 'max:255'],
            'cover_image_url' => ['nullable', 'string', 'max:255'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'accent_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:65535'],
        ]);

        $imageUrl = trim((string) ($data['cover_image_url'] ?? ''));
        $isLocalImage = preg_match('#^/(?:storage|images)/[A-Za-z0-9_./-]+$#D', $imageUrl) === 1
            && ! str_contains($imageUrl, '..');
        $isRemoteImage = filter_var($imageUrl, FILTER_VALIDATE_URL)
            && in_array(parse_url($imageUrl, PHP_URL_SCHEME), ['http', 'https'], true);

        if ($imageUrl !== '' && ! $isLocalImage && ! $isRemoteImage) {
            throw ValidationException::withMessages([
                'cover_image_url' => 'Enter an http or https image URL, or a local /storage/ or /images/ path.',
            ]);
        }

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
            'cover_image_url' => $imageUrl !== '' ? $imageUrl : null,
            'accent_color' => $data['accent_color'],
            'is_featured' => $request->boolean('is_featured'),
            'is_published' => $request->boolean('is_published'),
            'sort_order' => $data['sort_order'] ?? 0,
        ];
    }

    private function storeCoverImage(Request $request): string
    {
        $path = $request->file('cover_image')->storePublicly('projects', 'public');

        return '/storage/'.$path;
    }

    private function deleteStoredCoverImage(?string $imageUrl): void
    {
        if (! $imageUrl || ! str_starts_with($imageUrl, '/storage/')) {
            return;
        }

        Storage::disk('public')->delete(substr($imageUrl, strlen('/storage/')));
    }
}

