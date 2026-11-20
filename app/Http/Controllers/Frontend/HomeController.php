<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Resume;
use App\Models\Skill;
use App\Support\Site;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $skills = Skill::orderBy('sort_order')->orderBy('id')->get();

        return view('frontend.home', [
            'profile' => Site::profile(),
            'skills' => $skills->groupBy('category'),
            'stack' => $skills->take(4)->pluck('name')->all(),
            'projects' => Project::where('is_published', true)->orderBy('sort_order')->orderByDesc('id')->get(),
            'experiences' => Experience::orderBy('sort_order')->orderByDesc('id')->get(),
            'education' => Education::orderBy('sort_order')->orderByDesc('id')->get(),
            'certifications' => Certification::orderBy('sort_order')->orderByDesc('id')->get(),
            'resume' => Resume::where('is_active', true)->first(),
        ]);
    }

    public function project(Project $project): View
    {
        abort_unless($project->is_published, 404);

        return view('frontend.project', [
            'project' => $project,
            'profile' => Site::profile(),
        ]);
    }

    public function resume()
    {
        $resume = Resume::where('is_active', true)->firstOrFail();

        abort_unless(Storage::disk('public')->exists($resume->file), 404);

        return Storage::disk('public')->download($resume->file, $resume->original_name);
    }
}
