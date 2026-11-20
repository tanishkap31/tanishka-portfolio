<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use App\Support\Uploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ResumeController extends Controller
{
    public function index(): View
    {
        return view('admin.resumes.index', [
            'resumes' => Resume::orderByDesc('is_active')->orderByDesc('id')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:pdf', 'max:5120'],
        ]);

        $file = $request->file('file');
        $isFirst = Resume::count() === 0;

        $resume = Resume::create([
            'original_name' => Str::limit(basename($file->getClientOriginalName()), 120, ''),
            'file' => $file->store('resumes', 'public'),
            'is_active' => false,
        ]);

        // The first resume you upload goes live straight away.
        if ($isFirst || $request->boolean('make_active')) {
            $this->makeActive($resume);
        }

        return redirect()->route('admin.resumes.index')->with('status', 'Resume uploaded.');
    }

    public function activate(Resume $resume): RedirectResponse
    {
        $this->makeActive($resume);

        return redirect()->route('admin.resumes.index')->with('status', 'This resume is now the one visitors download.');
    }

    public function download(Resume $resume)
    {
        abort_unless(Storage::disk('public')->exists($resume->file), 404);

        return Storage::disk('public')->download($resume->file, $resume->original_name);
    }

    public function destroy(Resume $resume): RedirectResponse
    {
        $wasActive = $resume->is_active;

        Uploads::delete($resume->file);
        $resume->delete();

        // If the live resume was deleted, put the newest remaining one live.
        if ($wasActive && ($next = Resume::latest('id')->first())) {
            $this->makeActive($next);
        }

        return redirect()->route('admin.resumes.index')->with('status', 'Resume deleted.');
    }

    private function makeActive(Resume $resume): void
    {
        Resume::query()->update(['is_active' => false]);
        $resume->update(['is_active' => true]);
    }
}
