@extends('admin.layouts.app')

@php
    $openForWork = $errors->any() ? (bool) old('open_for_work') : (bool) ($profile->exists ? $profile->open_for_work : true);
@endphp

@section('title', 'Profile')
@section('heading', 'Profile Management')

@section('content')
<div class="card form-card">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.profile.update') }}">
            @csrf
            @method('PUT')

            <div class="row g-3">
                @include('admin.partials.input', ['name' => 'name', 'label' => 'Full name', 'value' => $profile->name, 'required' => true, 'col' => 'col-md-6', 'max' => 100])
                @include('admin.partials.input', ['name' => 'headline', 'label' => 'Headline', 'value' => $profile->headline, 'required' => true, 'col' => 'col-md-6', 'max' => 150, 'placeholder' => 'Frontend & Laravel Developer'])
                @include('admin.partials.textarea', ['name' => 'short_intro', 'label' => 'Short introduction', 'value' => $profile->short_intro, 'rows' => 2, 'max' => 500, 'help' => 'Shown under your name at the top of the website.'])
                @include('admin.partials.textarea', ['name' => 'about', 'label' => 'About me', 'value' => $profile->about, 'rows' => 8, 'help' => 'Leave an empty line to start a new paragraph. The About section stays hidden while this is empty.'])
                @include('admin.partials.input', ['name' => 'email', 'label' => 'Email', 'value' => $profile->email, 'type' => 'email', 'required' => true, 'col' => 'col-md-6'])
                @include('admin.partials.input', ['name' => 'phone', 'label' => 'Phone', 'value' => $profile->phone, 'col' => 'col-md-6', 'max' => 30, 'placeholder' => '+91 84214 90719'])
                @include('admin.partials.input', ['name' => 'whatsapp', 'label' => 'WhatsApp number', 'value' => $profile->whatsapp, 'col' => 'col-md-6', 'max' => 20, 'placeholder' => '918421490719', 'help' => 'Country code and number, digits only.'])
                @include('admin.partials.input', ['name' => 'location', 'label' => 'Location', 'value' => $profile->location, 'col' => 'col-md-6', 'max' => 150])
                @include('admin.partials.input', ['name' => 'github', 'label' => 'GitHub link', 'value' => $profile->github, 'type' => 'url', 'col' => 'col-md-6'])
                @include('admin.partials.input', ['name' => 'linkedin', 'label' => 'LinkedIn link', 'value' => $profile->linkedin, 'type' => 'url', 'col' => 'col-md-6'])
                @include('admin.partials.upload', ['name' => 'photo', 'label' => 'Profile photo', 'current' => $profile->photo_url, 'remove' => 'remove_photo', 'col' => 'col-md-6', 'help' => 'JPG, PNG or WebP, up to 2 MB. Without a photo the site shows your initials.'])

                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" name="open_for_work" id="open_for_work" value="1" {{ $openForWork ? 'checked' : '' }}>
                        <label class="form-check-label" for="open_for_work">Show "Open for freelance projects" on the website</label>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-primary" type="submit">Save profile</button>
                <a class="btn btn-outline-secondary" href="{{ route('home') }}" target="_blank" rel="noopener">View site</a>
            </div>
        </form>
    </div>
</div>
@endsection
