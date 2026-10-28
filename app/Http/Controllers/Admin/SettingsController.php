<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.edit', ['settings' => SiteSetting::current()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $settings = SiteSetting::current();
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:120'],
            'brand_name' => ['nullable', 'string', 'max:120'],
            'role' => ['required', 'string', 'max:160'],
            'headline' => ['required', 'string', 'max:180'],
            'tagline' => ['required', 'string', 'max:180'],
            'about' => ['required', 'string', 'max:2500'],
            'availability' => ['required', 'string', 'max:80'],
            'years_experience' => ['required', 'integer', 'min:0', 'max:100'],
            'projects_count' => ['required', 'integer', 'min:0', 'max:65535'],
            'clients_count' => ['required', 'integer', 'min:0', 'max:65535'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['nullable', 'string', 'max:40'],
            'location' => ['nullable', 'string', 'max:120'],
            'whatsapp_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:320'],
        ]);

        $settings->update($data);

        return to_route('admin.settings.edit')->with('status', 'Profile settings updated.');
    }
}
