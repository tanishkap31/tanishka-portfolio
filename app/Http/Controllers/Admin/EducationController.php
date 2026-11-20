<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EducationController extends Controller
{
    public function index(): View
    {
        return view('admin.education.index', [
            'items' => Education::orderBy('sort_order')->orderByDesc('id')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.education.form', ['education' => new Education(['sort_order' => 0])]);
    }

    public function store(Request $request): RedirectResponse
    {
        Education::create($this->validated($request));

        return redirect()->route('admin.education.index')->with('status', 'Education added.');
    }

    public function edit(Education $education): View
    {
        return view('admin.education.form', ['education' => $education]);
    }

    public function update(Request $request, Education $education): RedirectResponse
    {
        $education->update($this->validated($request));

        return redirect()->route('admin.education.index')->with('status', 'Education updated.');
    }

    public function destroy(Education $education): RedirectResponse
    {
        $education->delete();

        return redirect()->route('admin.education.index')->with('status', 'Education deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'degree' => ['required', 'string', 'max:150'],
            'college' => ['required', 'string', 'max:200'],
            'university' => ['nullable', 'string', 'max:200'],
            'duration' => ['nullable', 'string', 'max:100'],
            'grade' => ['nullable', 'string', 'max:60'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        return $data;
    }
}
