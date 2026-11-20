<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Support\Site;
use App\Support\Uploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.edit', ['settings' => Site::settings()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'site_title' => ['required', 'string', 'max:100'],
            'meta_description' => ['nullable', 'string', 'max:300'],
            'footer_text' => ['nullable', 'string', 'max:200'],
            'notify_email' => ['nullable', 'email', 'max:150'],
            'default_theme' => ['required', Rule::in(['auto', 'light', 'dark'])],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
        ]);

        foreach (['site_title', 'meta_description', 'footer_text', 'notify_email', 'default_theme'] as $name) {
            Setting::put($name, $data[$name] ?? null);
        }

        $logo = Site::setting('logo');

        if ($request->boolean('remove_logo')) {
            Uploads::delete($logo);
            Setting::put('logo', null);
        }

        if ($request->hasFile('logo')) {
            Uploads::delete($logo);
            Setting::put('logo', $request->file('logo')->store('settings', 'public'));
        }

        Site::flush();

        return redirect()->route('admin.settings.edit')->with('status', 'Settings saved.');
    }

    public function password(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $request->user()->update(['password' => Hash::make($request->input('password'))]);

        return redirect()->route('admin.settings.edit')->with('status', 'Password changed.');
    }
}
