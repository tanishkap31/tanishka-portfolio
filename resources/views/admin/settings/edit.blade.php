@extends('admin.layouts.app')

@section('title', 'Settings')
@section('heading', 'Website Settings')

@section('content')
<div class="row g-4">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-title-row"><h2>Website</h2></div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.settings.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        @include('admin.partials.input', ['name' => 'site_title', 'label' => 'Website title', 'value' => $settings['site_title'], 'required' => true, 'max' => 100, 'help' => 'Shown in the menu and in the browser tab.'])
                        @include('admin.partials.textarea', ['name' => 'meta_description', 'label' => 'Search engine description', 'value' => $settings['meta_description'], 'rows' => 3, 'max' => 300, 'help' => 'One or two sentences that Google shows under your website name.'])
                        @include('admin.partials.input', ['name' => 'footer_text', 'label' => 'Extra footer text (optional)', 'value' => $settings['footer_text'], 'max' => 200])
                        @include('admin.partials.input', ['name' => 'notify_email', 'label' => 'Send new enquiries to this email', 'value' => $settings['notify_email'], 'type' => 'email', 'help' => 'Needs email sending to be set up in your .env file. Enquiries always appear in this admin panel.'])

                        <div class="col-md-6">
                            <label class="form-label" for="default_theme">Website colour theme</label>
                            <select class="form-select @error('default_theme') is-invalid @enderror" id="default_theme" name="default_theme">
                                @foreach(['auto' => 'Follow the visitor\'s device', 'light' => 'Always light (ivory)', 'dark' => 'Always dark (navy)'] as $key => $label)
                                    <option value="{{ $key }}" {{ old('default_theme', $settings['default_theme']) === $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('default_theme')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <div class="form-text">Visitors can still switch with the theme button.</div>
                        </div>

                        @include('admin.partials.upload', ['name' => 'logo', 'label' => 'Logo (optional)', 'current' => \App\Support\Site::logoUrl(), 'remove' => 'remove_logo', 'col' => 'col-md-6', 'help' => 'Small JPG, PNG or WebP, up to 1 MB.'])
                    </div>

                    <button class="btn btn-primary mt-4" type="submit">Save settings</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-xl-5">
        <div class="card">
            <div class="card-title-row"><h2>Change password</h2></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.settings.password') }}" class="d-grid gap-3">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="form-label" for="current_password">Current password</label>
                        <input class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" type="password" autocomplete="current-password" required>
                        @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div>
                        <label class="form-label" for="password">New password</label>
                        <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" autocomplete="new-password" minlength="8" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="form-text">At least 8 characters.</div>
                    </div>

                    <div>
                        <label class="form-label" for="password_confirmation">Repeat new password</label>
                        <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" minlength="8" required>
                    </div>

                    <button class="btn btn-primary" type="submit">Change password</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
