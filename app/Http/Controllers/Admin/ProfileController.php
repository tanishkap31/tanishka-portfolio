<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Support\Site;
use App\Support\Uploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view('admin.profile.edit', ['profile' => Profile::first() ?? new Profile()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $profile = Profile::first() ?? new Profile();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'headline' => ['required', 'string', 'max:150'],
            'short_intro' => ['nullable', 'string', 'max:500'],
            'about' => ['nullable', 'string', 'max:5000'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:30'],
            'whatsapp' => ['nullable', 'string', 'max:20', 'regex:/^[0-9]+$/'],
            'location' => ['nullable', 'string', 'max:150'],
            'github' => ['nullable', 'url:http,https', 'max:255'],
            'linkedin' => ['nullable', 'url:http,https', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $photo = $profile->photo;

        if ($request->boolean('remove_photo')) {
            Uploads::delete($photo);
            $photo = null;
        }

        if ($request->hasFile('photo')) {
            Uploads::delete($photo);
            $photo = $request->file('photo')->store('profile', 'public');
        }

        $data['photo'] = $photo;
        $data['open_for_work'] = $request->boolean('open_for_work');

        $profile->fill($data)->save();
        Site::flush();

        return redirect()->route('admin.profile.edit')->with('status', 'Profile saved.');
    }
}
