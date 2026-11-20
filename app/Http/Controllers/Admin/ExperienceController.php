<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    public function index(): View
    {
        return view('admin.experiences.index', [
            'experiences' => Experience::orderBy('sort_order')->orderByDesc('id')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.experiences.form', ['experience' => new Experience(['sort_order' => 0])]);
    }

    public function store(Request $request): RedirectResponse
    {
        Experience::create($this->validated($request));

        return redirect()->route('admin.experiences.index')->with('status', 'Experience added.');
    }

    public function edit(Experience $experience): View
    {
        return view('admin.experiences.form', ['experience' => $experience]);
    }

    public function update(Request $request, Experience $experience): RedirectResponse
    {
        $experience->update($this->validated($request));

        return redirect()->route('admin.experiences.index')->with('status', 'Experience updated.');
    }

    public function destroy(Experience $experience): RedirectResponse
    {
        $experience->delete();

        return redirect()->route('admin.experiences.index')->with('status', 'Experience deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'company' => ['required', 'string', 'max:150'],
            'role' => ['required', 'string', 'max:150'],
            'location' => ['nullable', 'string', 'max:150'],
            'duration' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:4000'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        return $data;
    }
}
