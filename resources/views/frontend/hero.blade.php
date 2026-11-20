@php
    $heroWords = explode(' ', "Hi, I'm " . $profile->name);
    $firstEducation = count($education) ? $education[0] : null;
@endphp
<section id="home" class="hero">
    <div class="wrap">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                @if($profile->open_for_work)
                    <span class="status-pill"><span class="dot" aria-hidden="true"></span>Open for freelance projects</span>
                @endif

                <h1 aria-label="Hi, I'm {{ $profile->name }}">
                    @foreach($heroWords as $i => $word)
                        <span class="w" aria-hidden="true"><span style="--i: {{ $i }}">{{ $word }}</span></span>
                    @endforeach
                </h1>
                <p class="role">{{ $profile->headline }}</p>
                @if($profile->short_intro)
                    <p class="lede">{{ $profile->short_intro }}</p>
                @endif

                <div class="hero-actions">
                    <a class="btn btn-primary" href="#projects">View Projects</a>
                    @if($resume)
                        <a class="btn btn-outline-ink" href="{{ route('resume.download') }}"><i class="bi bi-download" aria-hidden="true"></i> Download Resume</a>
                    @endif
                </div>
            </div>

            <div class="col-lg-5">
                <div class="hero-card">
                    <div class="hero-photo">
                        @if($profile->photo_url)
                            <img src="{{ $profile->photo_url }}" alt="{{ $profile->name }}">
                        @else
                            <span class="monogram" aria-hidden="true">{{ strtoupper(substr($profile->name, 0, 1)) }}{{ strtoupper(substr(strrchr(' ' . $profile->name, ' '), 1, 1)) }}</span>
                        @endif
                    </div>
                    <dl class="hero-facts">
                        @if($profile->location)
                            <div><dt>Based in</dt><dd>{{ $profile->location }}</dd></div>
                        @endif
                        @if(count($stack))
                            <div><dt>Stack</dt><dd>{{ implode(', ', $stack) }}</dd></div>
                        @endif
                        @if($firstEducation)
                            <div><dt>Education</dt><dd>{{ $firstEducation->degree }}@if($firstEducation->grade), {{ $firstEducation->grade }}@endif</dd></div>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
    </div>
</section>
