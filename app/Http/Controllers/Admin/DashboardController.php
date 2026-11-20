<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\Education;
use App\Models\Enquiry;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Resume;
use App\Models\Skill;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'totalProjects' => Project::count(),
            'totalEnquiries' => Enquiry::count(),
            'totalSkills' => Skill::count(),
            'unread' => Enquiry::where('status', 'new')->count(),
            'extra' => [
                'Experience entries' => Experience::count(),
                'Education entries' => Education::count(),
                'Certifications' => Certification::count(),
                'Resume files' => Resume::count(),
            ],
            'latest' => Enquiry::latest()->take(6)->get(),
            'activeResume' => Resume::where('is_active', true)->first(),
        ]);
    }
}
