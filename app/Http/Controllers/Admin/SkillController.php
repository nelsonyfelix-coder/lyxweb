<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SkillController extends Controller
{
    public function index(): View
    {
        return view('admin.skills.index', ['skills' => Skill::query()->orderBy('group')->orderBy('sort_order')->paginate(30)]);
    }

    public function create(): View
    {
        return view('admin.skills.form', ['skill' => new Skill(), 'pageTitle' => 'Add skill']);
    }

    public function store(Request $request): RedirectResponse
    {
        Skill::create($this->validatedData($request));

        return to_route('admin.skills.index')->with('status', 'Skill created.');
    }

    public function edit(Skill $skill): View
    {
        return view('admin.skills.form', ['skill' => $skill, 'pageTitle' => 'Edit skill']);
    }

    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $skill->update($this->validatedData($request, $skill));

        return to_route('admin.skills.edit', $skill)->with('status', 'Skill updated.');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();

        return to_route('admin.skills.index')->with('status', 'Skill deleted.');
    }

    private function validatedData(Request $request, ?Skill $skill = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'group' => ['required', 'string', 'max:60'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:65535'],
        ]);
        $unique = Rule::unique('skills', 'name')->where('group', $data['group']);
        if ($skill) {
            $unique->ignore($skill->id);
        }
        $request->validate(['name' => ['required', $unique]]);

        return [...$data, 'sort_order' => $data['sort_order'] ?? 0];
    }
}
