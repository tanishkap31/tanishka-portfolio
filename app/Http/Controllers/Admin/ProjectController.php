<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Support\Uploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        return view('admin.projects.index', [
            'projects' => Project::orderBy('sort_order')->orderByDesc('id')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.projects.form', ['project' => new Project(['is_published' => true, 'sort_order' => 0])]);
    }

    public function store(Request $request): RedirectResponse
    {
        Project::create($this->validated($request, new Project()));

        return redirect()->route('admin.projects.index')->with('status', 'Project added.');
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.form', ['project' => $project]);
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $project->update($this->validated($request, $project));

        return redirect()->route('admin.projects.index')->with('status', 'Project updated.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        Uploads::delete($project->image);
        $project->delete();

        return redirect()->route('admin.projects.index')->with('status', 'Project deleted.');
    }

    private function validated(Request $request, Project $project): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'tagline' => ['nullable', 'string', 'max:200'],
            'description' => ['required', 'string', 'max:5000'],
            'tools' => ['nullable', 'string', 'max:300'],
            'highlights' => ['nullable', 'string', 'max:3000'],
            'github_url' => ['nullable', 'url:http,https', 'max:255'],
            'live_url' => ['nullable', 'url:http,https', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);

        $image = $project->image;

        if ($request->boolean('remove_image')) {
            Uploads::delete($image);
            $image = null;
        }

        if ($request->hasFile('image')) {
            Uploads::delete($image);
            $image = $request->file('image')->store('projects', 'public');
        }

        $data['image'] = $image;
        $data['is_published'] = $request->boolean('is_published');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        return $data;
    }
}
