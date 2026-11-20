@if(count($projects))
<section id="projects" class="section">
    <div class="wrap">
        <div class="section-head reveal">
            <h2>My Projects</h2>
            <p>Things I have built. Open a project to read more about it.</p>
        </div>

        <div class="row g-4">
            @foreach($projects as $project)
                <div class="col-md-6 reveal">
                    <article class="proj-card">
                        <div class="proj-media">
                            @if($project->image_url)
                                <img src="{{ $project->image_url }}" alt="Screenshot of {{ $project->title }}" loading="lazy">
                            @else
                                <span class="monogram" aria-hidden="true">{{ strtoupper(substr($project->title, 0, 2)) }}</span>
                            @endif
                        </div>
                        <div class="proj-body">
                            <h3><a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a></h3>
                            @if($project->tagline)
                                <p class="tagline">{{ $project->tagline }}</p>
                            @endif
                            @if(count($project->tool_list))
                                <ul class="tag-list">
                                    @foreach($project->tool_list as $tool)
                                        <li>{{ $tool }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="proj-links">
                                <a class="btn btn-primary btn-sm-pill" href="{{ route('projects.show', $project) }}">View details</a>
                                @if($project->github_url)
                                    <a class="btn btn-outline-ink btn-sm-pill" href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-github" aria-hidden="true"></i> GitHub</a>
                                @endif
                                @if($project->live_url)
                                    <a class="btn btn-outline-ink btn-sm-pill" href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> Live demo</a>
                                @endif
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
