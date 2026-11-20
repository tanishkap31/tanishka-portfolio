@extends('admin.layouts.app')

@php
    $editing = $project->exists;
    // After a failed save, keep the box as the visitor left it; otherwise use the saved value.
    $published = $errors->any() ? (bool) old('is_published') : (bool) $project->is_published;
@endphp

@section('title', $editing ? 'Edit project' : 'Add project')
@section('heading', $editing ? 'Edit project' : 'Add project')

@section('content')
<div class="card form-card">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="{{ $editing ? route('admin.projects.update', $project) : route('admin.projects.store') }}">
            @csrf
            @if($editing)
                @method('PUT')
            @endif

            <div class="row g-3">
                @include('admin.partials.input', ['name' => 'title', 'label' => 'Title', 'value' => $project->title, 'required' => true, 'col' => 'col-md-6', 'max' => 120])
                @include('admin.partials.input', ['name' => 'tagline', 'label' => 'One line summary', 'value' => $project->tagline, 'col' => 'col-md-6', 'max' => 200])
                @include('admin.partials.textarea', ['name' => 'description', 'label' => 'Description', 'value' => $project->description, 'required' => true, 'rows' => 5, 'help' => 'Leave an empty line to start a new paragraph.'])
                @include('admin.partials.input', ['name' => 'tools', 'label' => 'Tools used', 'value' => $project->tools, 'max' => 300, 'placeholder' => 'PHP, Laravel, MySQL', 'help' => 'Separate with commas.'])
                @include('admin.partials.textarea', ['name' => 'highlights', 'label' => 'What I built (bullet points)', 'value' => $project->highlights, 'rows' => 5, 'help' => 'One bullet point per line.'])
                @include('admin.partials.input', ['name' => 'github_url', 'label' => 'GitHub link', 'value' => $project->github_url, 'type' => 'url', 'col' => 'col-md-6', 'placeholder' => 'https://github.com/you/project'])
                @include('admin.partials.input', ['name' => 'live_url', 'label' => 'Live demo link', 'value' => $project->live_url, 'type' => 'url', 'col' => 'col-md-6', 'placeholder' => 'https://your-demo.netlify.app'])
                @include('admin.partials.upload', ['name' => 'image', 'label' => 'Screenshot', 'current' => $project->image_url, 'remove' => 'remove_image', 'col' => 'col-md-6', 'help' => 'JPG, PNG or WebP, up to 3 MB. A wide picture works best.'])

                <div class="col-md-6">
                    @include('admin.partials.input', ['name' => 'sort_order', 'label' => 'Order', 'value' => $project->sort_order, 'type' => 'number', 'col' => 'col-12', 'help' => 'Smaller numbers show first.'])
                    <div class="form-check form-switch mt-3">
                        <input class="form-check-input" type="checkbox" role="switch" name="is_published" id="is_published" value="1" {{ $published ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_published">Show this project on the website</label>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-primary" type="submit">{{ $editing ? 'Save changes' : 'Add project' }}</button>
                <a class="btn btn-outline-secondary" href="{{ route('admin.projects.index') }}">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
