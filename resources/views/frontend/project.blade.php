@extends('frontend.layouts.app')

@section('title', $project->title . ' | ' . \App\Support\Site::setting('site_title'))
@section('description', $project->tagline ?: \App\Support\Site::setting('meta_description'))

@section('content')
<section class="project-hero">
    <div class="wrap">
        <a class="back-link" href="{{ route('home') }}#projects"><i class="bi bi-arrow-left" aria-hidden="true"></i> All projects</a>

        <div class="row g-5 align-items-start">
            <div class="col-lg-6">
                <h1>{{ $project->title }}</h1>
                @if($project->tagline)
                    <p class="lede text-secondary fs-5">{{ $project->tagline }}</p>
                @endif

                <div class="proj-links mt-4">
                    @if($project->github_url)
                        <a class="btn btn-primary" href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-github" aria-hidden="true"></i> View code on GitHub</a>
                    @endif
                    @if($project->live_url)
                        <a class="btn btn-outline-ink" href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> Live demo</a>
                    @endif
                    @unless($project->github_url || $project->live_url)
                        <a class="btn btn-primary" href="{{ route('home') }}#contact">Ask me about this project</a>
                    @endunless
                </div>
            </div>

            <div class="col-lg-6">
                <div class="project-shot">
                    @if($project->image_url)
                        <img src="{{ $project->image_url }}" alt="Screenshot of {{ $project->title }}">
                    @else
                        <span class="monogram" aria-hidden="true">{{ strtoupper(substr($project->title, 0, 2)) }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="wrap">
        <div class="row g-5">
            <div class="col-lg-7">
                <h2 class="col-title">About this project</h2>
                <div class="about-text">
                    @foreach(preg_split('/\R{2,}/', trim($project->description)) as $paragraph)
                        <p>{!! nl2br(e($paragraph)) !!}</p>
                    @endforeach
                </div>

                @if(count($project->highlight_list))
                    <h2 class="col-title mt-5">What I built</h2>
                    <ul class="check-list">
                        @foreach($project->highlight_list as $point)
                            <li><i class="bi bi-check-circle-fill" aria-hidden="true"></i><span>{{ $point }}</span></li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="col-lg-5">
                @if(count($project->tool_list))
                    <h2 class="col-title">Tools used</h2>
                    <ul class="tag-list">
                        @foreach($project->tool_list as $tool)
                            <li>{{ $tool }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="info-card mt-5">
                    <p><strong>Want something like this?</strong></p>
                    <p class="text-secondary">Tell me what you need and I will reply with a plan and a quote.</p>
                    <div><a class="btn btn-primary" href="{{ route('home') }}#contact">Contact me</a></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
