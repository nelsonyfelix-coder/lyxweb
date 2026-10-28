<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('admin.services.index', ['services' => Service::query()->orderBy('sort_order')->latest()->paginate(15)]);
    }

    public function create(): View
    {
        return view('admin.services.form', ['service' => new Service(), 'pageTitle' => 'Add service']);
    }

    public function store(Request $request): RedirectResponse
    {
        Service::create($this->validatedData($request));

        return to_route('admin.services.index')->with('status', 'Service created.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.form', ['service' => $service, 'pageTitle' => 'Edit service']);
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $service->update($this->validatedData($request));

        return to_route('admin.services.edit', $service)->with('status', 'Service updated.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return to_route('admin.services.index')->with('status', 'Service deleted.');
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'summary' => ['required', 'string', 'max:1000'],
            'icon' => ['nullable', 'string', 'max:12'],
            'tech_stack' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:65535'],
        ]);

        return [
            'title' => $data['title'],
            'summary' => $data['summary'],
            'icon' => $data['icon'] ?? '✦',
            'technologies' => collect(explode(',', $data['tech_stack'] ?? ''))->map(fn ($item) => trim($item))->filter()->values()->all(),
            'is_visible' => $request->boolean('is_visible'),
            'sort_order' => $data['sort_order'] ?? 0,
        ];
    }
}
