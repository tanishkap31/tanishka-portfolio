<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Support\Uploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CertificationController extends Controller
{
    public function index(): View
    {
        return view('admin.certifications.index', [
            'certifications' => Certification::orderBy('sort_order')->orderByDesc('id')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.certifications.form', ['certification' => new Certification(['sort_order' => 0])]);
    }

    public function store(Request $request): RedirectResponse
    {
        Certification::create($this->validated($request, new Certification()));

        return redirect()->route('admin.certifications.index')->with('status', 'Certification added.');
    }

    public function edit(Certification $certification): View
    {
        return view('admin.certifications.form', ['certification' => $certification]);
    }

    public function update(Request $request, Certification $certification): RedirectResponse
    {
        $certification->update($this->validated($request, $certification));

        return redirect()->route('admin.certifications.index')->with('status', 'Certification updated.');
    }

    public function destroy(Certification $certification): RedirectResponse
    {
        Uploads::delete($certification->file);
        $certification->delete();

        return redirect()->route('admin.certifications.index')->with('status', 'Certification deleted.');
    }

    private function validated(Request $request, Certification $certification): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'issuer' => ['required', 'string', 'max:200'],
            'issued_on' => ['nullable', 'string', 'max:60'],
            'credential_url' => ['nullable', 'url:http,https', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $file = $certification->file;

        if ($request->boolean('remove_file')) {
            Uploads::delete($file);
            $file = null;
        }

        if ($request->hasFile('file')) {
            Uploads::delete($file);
            $file = $request->file('file')->store('certifications', 'public');
        }

        $data['file'] = $file;
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        return $data;
    }
}
