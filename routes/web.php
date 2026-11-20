<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ResumeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public portfolio (everyone can open these)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/projects/{project}', [HomeController::class, 'project'])->name('projects.show');
Route::get('/resume', [HomeController::class, 'resume'])->name('resume.download');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');

/*
|--------------------------------------------------------------------------
| Admin login (the route named "login" is where Laravel sends visitors
| who try to open the admin panel without signing in)
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.attempt');

/*
|--------------------------------------------------------------------------
| Admin panel (only for a signed-in user)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('skills', SkillController::class)->except('show');
    Route::resource('projects', ProjectController::class)->except('show');
    Route::resource('experiences', ExperienceController::class)->except('show');
    Route::resource('education', EducationController::class)->except('show')->parameters(['education' => 'education']);
    Route::resource('certifications', CertificationController::class)->except('show');

    Route::get('enquiries', [EnquiryController::class, 'index'])->name('enquiries.index');
    Route::get('enquiries/{enquiry}', [EnquiryController::class, 'show'])->name('enquiries.show');
    Route::put('enquiries/{enquiry}', [EnquiryController::class, 'update'])->name('enquiries.update');
    Route::delete('enquiries/{enquiry}', [EnquiryController::class, 'destroy'])->name('enquiries.destroy');

    Route::get('resumes', [ResumeController::class, 'index'])->name('resumes.index');
    Route::post('resumes', [ResumeController::class, 'store'])->name('resumes.store');
    Route::put('resumes/{resume}/activate', [ResumeController::class, 'activate'])->name('resumes.activate');
    Route::get('resumes/{resume}/download', [ResumeController::class, 'download'])->name('resumes.download');
    Route::delete('resumes/{resume}', [ResumeController::class, 'destroy'])->name('resumes.destroy');

    Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::put('settings/password', [SettingController::class, 'password'])->name('settings.password');
});
